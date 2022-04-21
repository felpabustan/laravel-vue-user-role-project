<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * 
     * @return \App\Http\Resources\User\UserCollection 
     */
    public function index()
    {
        return new UserCollection(User::all());
    }

    /**
     * 
     * @param \App\Http\Requests\User\StoreRequest $request 
     * @return \App\Http\Resources\User\UserResource 
     */
    public function store(StoreRequest $request)
    {
        $user = new User();

        $user->createOrUpdate($request, $user);

        return new UserResource($user);
    }

    /**
     * 
     * @param \App\Models\User $user 
     * @return \App\Http\Resources\User\UserResource 
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * 
     * @param \App\Http\Requests\User\UpdateRequest $request 
     * @param \App\Models\User $user 
     * @return \App\Http\Resources\User\UserResource 
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user->createOrUpdate($request, $user);

        return new UserResource($user);
    }

    /**
     * 
     * @param \App\Models\User $user 
     * @return void 
     * @throws \LogicException 
     */
    public function destroy(User $user)
    {
        $user->delete();
    }
}
