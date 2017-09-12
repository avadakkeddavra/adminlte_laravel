@extends('adminlte::layouts.app')

@section('htmlheader_title')

@endsection
@section ('contentheader_title')
    {{'Products stat page'}}
@endsection

@section('main-content')
    @if(Session::has('success'))
        <div class="container-fluid spark-screen">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-primary">
                        <div class="box-body">
                            <div class="callout callout-success">
                                <h4>Success</h4>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(count($errors) > 0)
        <div class="container-fluid spark-screen">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-primary">
                        <div class="box-body">
                            <div class="callout callout-danger">
                                <h4>Warning</h4>
                                <p>The post was not created because of errors in completing the form</p>
                                <p>Please watch the form errors</p>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-info-product">Show errors</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container-fluid spark-screen hidden-by-ajax">
        <div class="row">
            <div class="col-md-12">
                <div class="box-primary">
                    <div class="box-body">
                        <div class="callout callout-success">
                            <h4 class="title">Success</h4>
                            <p class="message-for-ajax"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-file-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Posts</span>
                        <span class="info-box-number">{{$widgetData['posts']}}</span>

                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-file-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Tags</span>
                        <span class="info-box-number">{{$widgetData['tagsCount']}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-file-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">User existed</span>
                        <span class="info-box-number">{{$widgetData['userExisted']}} years</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-file-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Posts updated</span>
                        <span class="info-box-number"> {{ $widgetData['postsUpdated'] }} </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Products table</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive products-table">
                            <table class="table mo-margin">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    @if(Auth::user()->isAdmin())
                                        <th>User id</th>
                                        <th>Status</th>
                                    @endif
                                    <th>Tags</th>
                                    <th></th>
                                </tr>

                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->price}}</td>

                                        @if(Auth::user()->isAdmin())
                                            <td>{{$product->user_id}}</td>
                                        @endif
                                        @if($product->trashed())
                                            <td><span class="label label-danger">deleted</span></td>
                                        @else
                                            <td><span class="label label-success">active</span></td>
                                        @endif
                                        <td>
                                            @foreach($product->tags as $tag)
                                                {{$tag->tag_name}}
                                            @endforeach

                                        </td>
                                        <td class="control-products row">
                                            <div class="col-xs-6">
                                                <button class="delete" data-product-id="{{$product->id}}"><i class="fa fa-trash-o"></i></button>
                                            </div>
                                            <div class="col-xs-6">
                                                <button class="update" data-product-id="{{$product->id}}" data-toggle="modal" data-target="#modal-info-update"><i class="fa fa-pencil"></i></button>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                            <div class="row product-table-nav">
                                <div class="col-xs-4">
                                    <div class="create-new-product-nav">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-info-tag">
                                            Create new tag
                                        </button>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-info-product">
                                            Create new product
                                        </button>

                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="pagination-nav">
                                        {{ $products->links() }}
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-default fade" id="modal-info-product">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Create new product</h4>
                    </div>
                    <div class="modal-body">
                        <form action="/products" class="add_new_product" method="post" role="form" style="padding:10px;">
                            <input type="hidden" name="_method" value="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="prod_name">Product name <span class="required">*</span></label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="prod_name" id="prod_name">
                                        @if ($errors->has('prod_name'))
                                            <span class="message-from-server error">{{ $errors->first('prod_name') }}</span>
                                        @endif
                                        <span class="message"></span>
                                    </div>
                                </div>


                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="prod_price">Product price</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="prod_price" id="prod_price">
                                        @if ($errors->has('prod_price'))
                                            <span class="message-from-server error">{{ $errors->first('prod_price') }}</span>
                                        @endif
                                        <span class="message"></span>
                                    </div>
                                </div>


                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="prod_desc">Product desc</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="prod_desc" id="prod_desc">
                                        @if ($errors->has('prod_desc'))
                                            <span class="message-from-server error">{{ $errors->first('prod_desc') }}</span>
                                        @endif
                                        <span class="message"></span>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="prod_tags">Product tags</label>
                                    </div>
                                    <div class="col-sm-9" id="tags-list">

                                        @foreach($tags as $tag)

                                            <label for="tags" class="label label-default">{{$tag->tag_name}}</label>
                                            <input type="checkbox" name="tags[]" value="{{$tag->id}}">

                                        @endforeach

                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3" style="padding-left:7px;">
                                    <button type="submit" class="btn btn-primary">Create product</button>
                                </div>
                            </div>


                        </form>
                        <div class="clearfix"></div>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal modal-default fade" id="modal-info-tag">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Create new tag</h4>
                    </div>
                    <div class="modal-body">
                        <form action="/tags" class="create_tag" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="">Tag name</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" name="tag_name" id="tag_name" class="form-control">
                                        <span class="message"></span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Create tag</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-default fade" id="modal-info-update">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Update product</h4>
                    </div>
                    <div class="modal-body">
                        <form class="update_product" method="post" style="padding:10px;">
                            {{ csrf_field() }}
                            <input type="hidden" name="id">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="prod_name">Product name</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="prod_name" id="prod_name">
                                        <span class="message"></span>
                                    </div>
                                </div>


                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="prod_price">Product price</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="prod_price" id="prod_price">
                                        <span class="message"></span>
                                    </div>
                                </div>


                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="prod_desc">Product desc</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="prod_desc" id="prod_desc">
                                        <span class="message"></span>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="prod_tags">Product tags</label>
                                    </div>
                                    <div class="col-sm-9" id="tags-list">

                                        @foreach($tags as $tag)

                                            <label for="tags" class="label label-default">{{$tag->tag_name}}</label>
                                            <input type="checkbox" class="product_tags" name="tags[]" value="{{$tag->id}}">

                                        @endforeach

                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3" style="padding-left:7px;">
                                    <button type="submit" class="btn btn-primary">Update product</button>
                                </div>
                            </div>


                        </form>
                        <div class="clearfix"></div>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
        </div>

    </div>
@endsection
