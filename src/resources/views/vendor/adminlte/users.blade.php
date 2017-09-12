@extends('adminlte::layouts.app')

@section('htmlheader_title')

@endsection
@section ('contentheader_title')
    {{'Users'}}
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
                                <p>The user was not created because of errors in completing the form</p>
                                <p>Please watch the form errors</p>
                                <button class="btn btn-default" data-toggle="modal" data-target="#modal-info-user">Show errors</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="container-fluid spark-screen">
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
                            <table class="table table-hover dataTable no-margin" role="grid">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>

                                </thead>
                                <tbody>
                                    @foreach($usersList as $user)
                                        <tr>
                                            <td class="user_id">{{$user->id}}</td>
                                            <td class="user_name">{{$user->name}}</td>
                                            <td class="user_email">{{$user->email}}</td>
                                            <td class="user_role">
                                                @if($user->role_id == 1)
                                                    <span>user</span>
                                                @else
                                                    <span>admin</span>
                                                @endif
                                            </td>
                                            <td id="user_status">
                                                @if($user->trashed())
                                                    <div class="label label-danger">trashed</div>
                                                @else
                                                    <div class="label label-success">active</div>
                                                @endif
                                            </td>
                                            <td class="control-users row">
                                                @if(! $user->trashed())
                                                <div class="col-xs-6">
                                                    <button class="delete" data-user-id="{{$user->id}}"><i class="fa fa-trash-o"></i></button>
                                                </div>
                                                 <div class="col-xs-6 for-insert">
                                                        <button class="update" data-user-id="{{$user->id}}" data-toggle="modal" data-target="#modal-user-update"><i class="fa fa-pencil"></i></button>
                                                 </div>
                                                @else
                                                    @can('restore', $user)
                                                        <div class="col-xs-6">
                                                                <button class="restore" data-user-id="{{$user->id}}"><i class="fa fa-reply"></i></button>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <button class="forceDelete" data-user-id="{{$user->id}}"><i class="fa fa-trash"></i></button>
                                                        </div>
                                                        <div class="col-xs-6 for-insert">
                                                        </div>
                                                    @endcan
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <div class="row product-table-nav">
                                <div class="col-xs-4">
                                    <div class="create-new-product-nav">

                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-info-user">
                                            Create new user
                                        </button>

                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="pagination-nav">

                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-default fade" id="modal-info-user">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Create new user</h4>
                    </div>
                    <div class="modal-body">
                        <form action="/users" class="add_new_user" method="post" role="form" style="padding:10px;">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="user_name">User name</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="user_name" id="user_name">
                                        @if ($errors->has('user_name'))
                                            <span class="message-from-server error">{{ $errors->first('user_name') }}</span>
                                        @endif
                                        <span class="message"></span>
                                    </div>
                                </div>


                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="user_email">User Email</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" name="user_email" id="user_email">
                                        @if ($errors->has('user_email'))
                                            <span class="message-from-server error">{{ $errors->first('user_email') }}</span>
                                        @endif
                                        <span class="message"></span>
                                    </div>
                                </div>


                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="user_password">User password</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="user_password" id="user_password">
                                        @if ($errors->has('user_password'))
                                            <span class="message-from-server error">{{ $errors->first('user_password') }}</span>
                                        @endif
                                        <span class="message"></span>
                                    </div>
                                </div>


                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="user_role">User role</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="user_role" id="user_role">
                                            <option value="1">User</option>
                                            <option value="2">Admin</option>
                                        </select>
                                        @if ($errors->has('user_role'))
                                            <span class="message-from-server error">{{ $errors->first('user_role') }}</span>
                                        @endif
                                        <span class="message"></span>
                                    </div>
                                </div>


                            </div>


                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3" style="padding-left:7px;">
                                    <button type="submit" class="btn btn-primary">Create user</button>
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


                <!-- /.modal-content -->

        <div class="modal modal-default fade" id="modal-user-update">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Update user</h4>
                    </div>
                    <div class="modal-body">
                        <form action="/users" class="user_update" method="POST"  role="form" style="padding:10px;">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="user_name">User name</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="user_name" id="user_name">
                                        @if ($errors->has('user_name'))
                                            <span class="message error">{{ $errors->first('user_name') }}</span>
                                        @endif
                                        <span class="message"></span>
                                    </div>
                                </div>


                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="user_role">User role</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="user_role" id="user_role">
                                            <option value="1">User</option>
                                            <option value="2">Admin</option>
                                        </select>
                                        @if ($errors->has('user_email'))
                                            <span class="message-from-server error">{{ $errors->first('user_email') }}</span>
                                        @endif
                                        <span class="message"></span>
                                    </div>
                                </div>


                            </div>


                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3" style="padding-left:7px;">
                                    <button type="submit" class="btn btn-primary">Update user</button>
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


    </div>
@endsection
