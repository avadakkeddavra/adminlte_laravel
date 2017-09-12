$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
})
/**
 *
 * Change standard checkbox
 *
 * */
$(document).ready(function(){
  $('#tags-list label').on('click',function(){
    var input = $(this).next();
    if(input.attr('checked') == null)
    {
        input.attr('checked','checked');
        $(this).removeClass('label-default');
        $(this).addClass('label-success');
    }else{
        input.removeAttr('checked');
        $(this).removeClass('label-success');
        $(this).addClass('label-default');
    }

  })
})
/**
 *
 * FORM VALIDATION
 *
 * */
$(document).ready(function(){
  $('.add_new_product input, .update_product input').on('focusout',function(){
    var item = $(this).attr('id');
    var value = $(this).val();
    switch (item)
    {
      case 'prod_name':
        if(value.length > 191 || value.length == 0)
        {
          $(this).addClass('error');
          $(this).next().addClass('text-danger');
          $(this).next().text('This field requires length from 1 to 191 symbols');
          $(this).next().fadeIn();
        }else{
          $(this).removeClass('error');
          $(this).next().fadeOut();
          $(this).addClass('accepted');
        }
        break;
      case 'prod_price':
        if(value.length > 11 || value.length == 0)
        {
          $(this).addClass('error');
          $(this).next().addClass('text-danger');
          $(this).next().text('This field requires length from 1 to 11 symbols');
          $(this).next().fadeIn();
        }else{
          $(this).removeClass('error');
          $(this).next().fadeOut();
          $(this).addClass('accepted');
        }
        break;
      case 'prod_desc':
        if(value.length > 191)
        {
          $(this).addClass('error');
          $(this).next().addClass('text-danger');
          $(this).next().text('This field requires length from 1 to 191 symbols');
          $(this).next().fadeIn();
        }else{
          $(this).removeClass('error');
          $(this).next().fadeOut();
          $(this).addClass('accepted');
        }
        break;

    }
  })
})

/**
 * users creation form validation
 *
 * */
$('.add_new_user').unbind().on('blur','input',function(){
  var item = $(this).attr('id');
  var value = $(this).val();

  switch (item)
  {
    case 'user_name':
      if(value.length > 191 || value.length == 0)
      {
        $(this).addClass('error');
        $(this).next().addClass('text-danger');
        $(this).next().text('This field requires length from 1 to 191 symbols');
        $(this).next().fadeIn();
      }else{
        $(this).removeClass('error');
        $(this).next().fadeOut();
        $(this).addClass('accepted');
      }
      break;
    case 'user_email':
      var reg_expr = /[-a-z0-9!#$%&'*+/=?^_`{|}~]+(?:\.[-a-z0-9!#$%&'*+/=?^_`{|}~]+)*@(?:[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(?:aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/;
      if(value.length > 191 || reg_expr.test(value) == false || value.length == 0 )
      {
        $(this).addClass('error');
        $(this).next().addClass('text-danger');
        $(this).next().text('Please enter your email in the following format: example@gmail.com');
        $(this).next().fadeIn();
      }else{
        checkUserEmail(value,$(this));
      }
      break;
    case 'user_password':
      if(value.length > 191 || value.length < 5)
      {
        $(this).addClass('error');
        $(this).next().addClass('text-danger');
        $(this).next().text('The password requires min 5 symbols');
        $(this).next().fadeIn();
      }else{
        $(this).removeClass('error');
        $(this).next().fadeOut();
        $(this).addClass('accepted');
      }
      break;
  }
});
/**
 * User create validation after press Submit button
 *
 *
 * */
$(document).ready(function(){
  $('.add_new_user').on('click','button',function(e){
      e.preventDefault();
      var form = $(this).parents('form');
      var validation = new FormData();
      validation.append('user_name',form.find('input[name="user_name"]').val());
      validation.append('user_email',form.find('input[name="user_email"]').val());
      validation.append('user_password',form.find('input[name="user_password"]').val());

      var reg_expr = /[-a-z0-9!#$%&'*+/=?^_`{|}~]+(?:\.[-a-z0-9!#$%&'*+/=?^_`{|}~]+)*@(?:[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(?:aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/;

      if(validation.get('user_name').length > 191 || validation.get('user_name').length == 0)
      {
          $('input[name="user_name"]').addClass('error');
          $('input[name="user_name"]').next().addClass('text-danger');
          $('input[name="user_name"]').next().text('This field requires length from 1 to 191 symbols');
          $('input[name="user_name"]').next().fadeIn();
        }else{
          $('input[name="user_name"]').removeClass('error');
          $('input[name="user_name"]').next().fadeOut();
          $('input[name="user_name"]').addClass('accepted');
      }

      if(validation.get('user_email').length > 191 || validation.get('user_email').length == 0 || reg_expr.test(validation.get('user_email')) == false)
      {
        $('input[name="user_email"]').addClass('error');
        $('input[name="user_email"]').next().addClass('text-danger');
        $('input[name="user_email"]').next().text('Please enter your email in the following format: example@gmail.com');
        $('input[name="user_email"]').next().fadeIn();
      } else{
        $ifEmailExisted = checkUserEmail(validation.get('user_email'),$('input[name="user_email"]'));
      }

    if(validation.get('user_password').length > 191 || validation.get('user_password').length < 5)
    {
      $('input[name="user_password"]').addClass('error');
      $('input[name="user_password"]').next().addClass('text-danger');
      $('input[name="user_password"]').next().text('The password requires min 5 symbols');
      $('input[name="user_password"]').next().fadeIn();
    }else{
      $('input[name="user_password"]').removeClass('error');
      $('input[name="user_password"]').next().fadeOut();
      $('input[name="user_password"]').addClass('accepted');
    }

      if($('.accepted').length >= 3)
      {
        form.submit();
      }
  })
})


/**
 * Check email for users creation
 *
 * @ajax
 * */
function checkUserEmail(value,item)
{
  var data = {
    email: value
  }
    $.ajax({
      url:'/users/checkEmail',
      data: data,
      type:'POST',
      success: function(response){
        if(response['success'])
        {
          item.removeClass('error');
          item.next().fadeOut();
          item.addClass('accepted');
        }

      },
      error:function(xhr)
      {
        var message =  xhr.responseJSON;
        item.addClass('error');
        item.next().addClass('text-danger');
        item.next().text(message['email']);
        item.next().fadeIn();
      }
    })


}



/**
 * DELETING USERS AND PRODUCTS
 * @AJAX
 *
* */
$(document).ready(function() {
  $('.control-products .delete').on('click', function () {
    var productId = $(this).data('product-id');
    var item = $(this).parents('tr');
    console.log(productId);

    var data = {
      productId: productId,
      _method: 'DELETE',
    }
    $.ajax({
      url: '/products/' + productId,
      data: data,
      type: 'POST',
      success: function (response) {
        if (response == true) {

          item.remove();
        }
      }
    })
  })
})
/**
 * Soft delete for users
 * @ajax
 * */
  $(document).ready(function() {
    $('.control-users ').on('click','.delete', function () {
      var $this = $(this);
      var userId = $(this).data('user-id');
      var item = $(this).parents('tr');
      console.log(userId);

      var data = {
        userID: userId,
        deleteType:'soft',
        _method: 'DELETE'
      }
      $.ajax({
        url: '/users/' + userId,
        data: data,
        type: 'POST',
        dataType:'json',
        success: function (response) {
          console.log(response);
          if (response['message'] == true) {
            item.children('#user_status').children('.label')
                                         .text('trashed')
                                        .removeClass('label-success')
                                        .addClass('label-danger')
            $this.addClass('restore')
              .removeClass('delete');
            $this.html('<i class="fa fa-reply"></i>')
            item.find('.for-insert').html('<button class="forceDelete" data-user-id="' + userId +  '"><i class="fa fa-trash"></i></button>');

          }
        }
      })
    })
  })
/**
 * Force delete for users
 *
 * @ajax
 * */
$(document).ready(function() {
  $('.control-users ').on('click','.forceDelete', function () {
    var $this = $(this);
    var userId = $(this).data('user-id');
    var item = $(this).parents('tr');
    console.log(userId);

    var data = {
      userID: userId,
      deleteType:'force',
      _method: 'DELETE'
    }
    $.ajax({
      url: '/users/' + userId,
      data: data,
      type: 'POST',
      dataType:'json',
      success: function (response) {
        console.log(response);
        if (response['message'] == true) {
          item.remove();
        }

      },
      error: function(xhr)
      {
        console.log(xhr);
      }
    })
  })
})

/**
 * RESTORE USERS
 *
 *
 * @AJAX
 * */
$(document).ready(function() {
  $('.control-users').on('click','.restore', function () {
    var $this = $(this);
    var userId = $(this).data('user-id');
    var item = $(this).parents('tr');
    console.log(userId);

    var data = {
      userID: userId,
      _method: 'post',
    }
    $.ajax({
      url: '/users/'+userId+'/restore',
      data: data,
      type: 'POST',
      dataType:'json',
      success: function (response) {
        console.log(response);
        if (response['message'] == true) {
          item.children('#user_status').children('.label')
                                        .text('active')
                                        .removeClass('label-danger')
                                        .addClass('label-success')
          $this.addClass('delete')
                   .removeClass('restore');
          item.find('.forceDelete').remove();
          item.find('.for-insert').html('<button class="update" data-user-id="' + userId + '" data-toggle="modal" data-target="#modal-user-update"><i class="fa fa-pencil"></i></button>');
          $this.html('<i class="fa fa-trash-o"></i>')
        }
      }
    })
  })
})
  /**
   *
   * UPDATING USERS AND PRODUCTS
   *
   * Show the modal window with form with fillable fields
   *
   * @AJAX
   *
   *
   * */
  $(document).ready(function(){

  $('.control-products .update').on('click',function(){
    var productId = $(this).data('product-id');
    $('.update_product #tags-list').children('input').removeAttr('checked');
    $('.update_product #tags-list').children('input').prev().removeClass('label-success');
    $('.update_product').attr('action','/products/'+productId);
    $('.update_product').children('input[name="id"]').val(productId);
    var data ={
      productId: productId,
    }
    $.ajax({
      url:'/products/get-fields',
      type: 'POST',
      data: data,
      dataType:'json',
      success: function (response){
          console.log(response);
          $('.update_product #prod_name').val(response['product']['name']);
          $('.update_product #prod_price').val(response['product']['price']);
          $('.update_product #prod_desc').val(response['product']['description']);
        response['tags'].forEach(function(i,elem){
          var input = $('.update_product #tags-list').find('input[value="' + i['id'] + '"]');
         input.prev().addClass('label-success');
         input.attr('checked','checked');
        })


      }
    })
  });
  });

$(document).ready(function(){


  $('.control-users .update').on('click',function(){
    var userID = $(this).data('user-id');
    console.log(userID);
    var item = $(this).parents('tr');
    $('.user_update').attr('action','/users/'+userID);
    $('.user_update').children('input[name="id"]').val(userID);

    var name = item.find('.user_name').text();
    var user_role = item.find('.user_role').children('span').text();

    if(user_role == 'user')
    {
      var role = 1;

    }else if(user_role == 'admin'){

      var role = 2;
    }


        $('.user_update #user_name').val(name);
        $('.user_update #user_role').val(role);


  });
});

$('.update_product').on('click','button',function(e){
  e.preventDefault();
  var data = new FormData();
  var url = '/products/'+$('.update_product input:hidden[name="id"]').val();
  console.log(url);
  data.append('_method', 'PUT');
  data.append('prod_name', $('.update_product #prod_name').val());
  data.append('prod_price', $('.update_product #prod_price').val());
  data.append('prod_desc', $('.update_product #prod_desc').val());
  data.append('prod_tags', $('.update_product .product_tags:checked').map(function() {return this.value;}).get());

  data = {
    _method:'PUT',
    prod_name:  $('.update_product #prod_name').val(),
    prod_price: $('.update_product #prod_price').val(),
    prod_desc:  $('.update_product #prod_desc').val(),
    prod_tags:  $('.update_product .product_tags:checked').map(function() {return this.value;}).get()
  }
  console.log(data);
  $.ajax({
    url: '/products/'+$('.update_product input:hidden[name="id"]').val(),
    data: data,
    type: 'POST',
    cache:false,
    dataType:'json',
    success:function(response)
    {
      console.log(response)
      $('.hidden-by-ajax').slideDown(200);
      $('.hidden-by-ajax .message-for-ajax').text(response['success'])
      $('button.close').click();
    },
    error:function(xhr)
    {
      var errorMessages = xhr.responseJSON;
      console.log(errorMessages)
      if(errorMessages.prod_name){
        $('.update_product #prod_name').addClass('error')
        $('.update_product #prod_name').next().text(errorMessages.prod_name)
        $('.update_product #prod_name').next().fadeIn();
      }
      if(errorMessages.prod_price != '')
      {
        $('.update_product #prod_price').addClass('error')
        $('.update_product #prod_price').next().text(errorMessages.prod_price)
        $('.update_product #prod_price').next().fadeIn();
      }



    }

  })
})
$(document).ready(function() {
  $('.add_new_product button').click(function(e){
    e.preventDefault();
    $(this).parents('form').children('.form-group').each(function(){
      var input = $(this).children('.row').children('.col-sm-9').children('input:not([type="checkbox"])');
      var item = $(this).children('.row').children('.col-sm-9').children('input:not([type="checkbox"])').attr('name');
      var value = input.val().length;
      switch (item) {
        case 'prod_name':
          if (value > 191 || value == 0) {
            input.addClass('error');
            $(this).find('.message').addClass('text-danger');
            $(this).find('.message').text('191 letters max');
            $(this).find('.message').fadeIn();
          } else {
            input.removeClass('error');
            $(this).find('.message').fadeOut();
            input.addClass('accepted');
          }
          break;
        case 'prod_price':

          if (value > 11 || value == 0) {
            input.addClass('error');
            $(this).find('.message').addClass('text-danger');
            $(this).find('.message').text('11 numbers max');
            $(this).find('.message').fadeIn();;
          } else {
            input.removeClass('error');
            $(this).find('.message').fadeOut();
            input.addClass('accepted');;
          }
          break;
        case 'prod_desc':

          if (value > 191 || value == 0) {
            input.addClass('error');
            $(this).find('.message').addClass('text-danger');
            $(this).find('.message').text('191 letters max');
            $(this).find('.message').fadeIn();
          } else {
            input.removeClass('error');
            $(this).find('.message').fadeOut();
            input.addClass('accepted');
          }
          break;
      }
       acepted = $('.accepted').length;
      if(acepted == 3)
      {
        $('.add_new_product').submit();
      }
    })


  })
})

$(document).ready(function(){
  $('.create_tag').on('click','button',function(e){
    e.preventDefault();
    var form = $(this).parents('form');
    var input = form.find('#tag_name');
    var value = input.val();
    if(value.length <= 0 || value.length > 191){
      input.removeClass('accepted');
      input.addClass('error');
      input.next().text('Error')
      input.next().fadeIn(200);
    }else{
      input.removeClass('error');
      input.addClass('accepted');
      input.next().fadeOut(200);
      $('.create_tag').submit();
    }
  })

  $('.create_tag').on('blur','#tag_name',function(e){
    e.preventDefault();
    var input = $(this);
    var value = $(this).val();

    if(value.length <= 0 || value.length > 191){
      input.removeClass('accepted');
      input.addClass('error');
      input.next().text('Error')
      input.next().fadeIn(200);
    }else{
      input.removeClass('error');
      input.addClass('accepted');
      input.next().fadeOut(200);
    }
  })
})