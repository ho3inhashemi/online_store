<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\AdminBlockUsers;
use App\Http\Requests\Admin\Users\AdminUnBlockUsers;
use App\Http\Requests\Admin\Users\AdminUsersDestroy;
use App\Http\Requests\Admin\Users\AdminUsersStore;
use App\Http\Requests\Admin\Users\AdminUsersUpdate;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param AdminUsersStore $request
     * @return object
     */
    public function store(AdminUsersStore $request) : object
    {
        $user = User::create($request->all());
        return success_response(new UserResource($user) , 201 , "User successfully added.The new user has been added to the system");
    }


    /**
     * Display a listing of the resources.
     *
     * @param Request $request
     * @return object
     */
    public function index(Request $request) : object
    {
        $users = User::query();

        if($request->has("search"))
        {
            $users->where(function ($query) use ($request)
            {
                $query->where('name' ,'like', '%'.$request->search.'%')
                    ->orWhere('family_name' ,'like', '%'.$request->search.'%');
            });
        }

        $users = $users->orderBy('id' , 'DESC')->paginate($request->per_page ?? '');
        return success_response(new UserCollection($users) , 201);
    }


    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return object
     */
    public function show(User $user) : object
    {
        return success_response(new UserResource($user) , 201 );
    }


    /**
     * Update the specified resource in storage.
     *
     * @return void
     */
    public function update(AdminUsersUpdate $request , User $user)
    {
        $user->name = $request->name;
        $user->family_name = $request->family_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return success_response(new UserResource($user) , 201 , "Resource updated successfully by the admin.");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @return void
     */
    public function destroy(AdminUsersDestroy $request)
    {
        User::whereIn('id' , $request->user_ids)->delete();

        return success_response(null , 201 , "Resources deleted successfully by the admin.");
    }

    /**
     * Block the specified resource in storage
     *
     * @param User $user
     * @return void
     */
    public function block(AdminBlockUsers $request)
    {
        User::whereIn('id' , $request->user_ids)->update(['status' => 0]);
        return success_response( null , 201 , "Resource blocked successfully by the admin.");
    }

    /**
     *Unblock the specified resource in storage
     *
     * @param User $user
     * @return void
     */
    public function unBlock(AdminUnBlockUsers $request)
    {
        User::whereIn('id' , $request->user_ids)->update(['status' => 1]);
        return success_response( null , 201 , "Resource unblocked successfully by the admin.");
    }
}
