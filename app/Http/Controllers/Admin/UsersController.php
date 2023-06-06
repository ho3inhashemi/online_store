<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\AdminUsersStore;
use App\Http\Resources\UserResource;
use App\Models\User;

class UsersController extends Controller
{
    public function store(AdminUsersStore $request)
    {
        $user = User::create($request->all());

        return success_response(new UserResource($user) , 201 , "User successfully added.The new user has been added to the system");
    }


    public function index()
    {

    }


    public function show()
    {

    }


    public function update()
    {

    }


    public function destroy()
    {

    }

}
