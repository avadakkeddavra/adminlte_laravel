<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>


<script src="{{ asset('/js/main.js') }}" type="text/javascript"></script>
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
<script>
    $(document).ready(function(){
      $('.sidebar-menu li a[data-url="{{Route::currentRouteName()}}"]').parent().addClass('active');
    })
</script>


{{$url = route('home')}}
@if(Route::currentRouteName() == 'home')
    <script type="text/javascript">

      Highcharts.chart('chart', {
        chart: {
          type: 'spline'
        },
        title: {
          text: 'How much posts was created with every tag by days'
        },
        subtitle: {
          text: 'Irregular time data in Highcharts JS'
        },
        xAxis: {
          type: 'datetime',
          dateTimeLabelFormats: { // don't display the dummy year
//            month: '%e. %b',
//            year: '%b',
            day:'%Y-%b%-%e'
          },
          title: {
            text: 'Date'
          }
        },
        yAxis: {
          title: {
            text: 'Posts quantity'
          },
          min: 0
        },
        tooltip: {
          headerFormat: '<h4><b>{series.name}</b><br></h4>',
          pointFormat: '<b>{point.x:%e. %b}:</b> {point.y:.2f} '
        },

        plotOptions: {
          spline: {
            marker: {
              enabled: true
            }
          }
        },

        series: [
          @php
          $grouped_tags = $tags->groupBy('tag_name');

          $grouped_tags = $grouped_tags->toArray();
          @endphp
                @foreach($grouped_tags as $key => $tags)
          {
            name: '{{$key}}',
            data :[
              @foreach($tags as $tag)
                @php
                    $date = explode('-',explode(' ',$tag->created_at)[0]);
                @endphp
              [Date.UTC({{$date[0]}},{{$date[1]}},{{$date[2]}}),{{$tag->CountProd}}],
              @endforeach

            ]
          },
                @endforeach

        ]
      });

    </script>
@endif
