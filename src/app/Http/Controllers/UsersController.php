<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\User\Create as CreateUserRequest;
use App\Http\Requests\User\Delete as DeleteUserRequest;
use App\Http\Requests\User\Restore as RestoreUserRequest;
use App\Http\Requests\User\Update as UpdateUserRequest;
use App\Http\Requests\User\CheckEmail as CheckEmailRequest;

use App\Jobs\User\Create as CreateUserJob;
use App\Jobs\User\Delete as DeleteUserJob;
use App\Jobs\User\Restore as RestoreUserJob;
use App\Jobs\User\Update as UpdateUserJob;


use App\Models\User as UserModel;


class UsersController extends Controller
{
    
    public function index()
    {
        $usersList = UserModel::withTrashed()->where('id', '!=', \Auth::user()->id)->get();

        return view('adminlte::users', ['usersList' => $usersList]);
    }


    public function store(CreateUserRequest $request)
    {
        $response = $this->dispatchNow(new CreateUserJob($request->all()));
        $userName = $response->name;

        return redirect()->route('users-page')
            ->with('success', $userName . ' was successfully created');
    }

    public function update(UpdateUserRequest $request, UserModel $user)
    {
        $this->dispatchNow(new UpdateUserJob($user,$request->all()));

        return redirect()->route('users-page')
            ->with('success','This user was successfully updated');
    }

    public function destroy(DeleteUserRequest $request, UserModel $user)
    {
        $response = $this->dispatchNow(new DeleteUserJob($user, $request->all()));


        return response()->json([
            'message' => $response,
        ]);
    }

    public function restore(RestoreUserRequest $request, UserModel $user)
    {

       $this->dispatchNow(new RestoreUserJob($user, $request->all()));

        $response = true;
        return response()->json([
            'message' => $response
        ]);
    }

    public function checkEmail(CheckEmailRequest $request)
    {
        return response()->json([
            'success' => true,
        ]);
    }

}
