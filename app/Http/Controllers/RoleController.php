<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreRequest;
use App\Http\Resources\Role\RoleCollection;
use App\Http\Resources\Role\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * 
     * @return \App\Http\Resources\Role\RoleCollection 
     */
    public function index()
    {
        return new RoleCollection(Role::all());
    }

    /**
     * 
     * @param \App\Http\Requests\Role\StoreRequest $request 
     * @return \App\Http\Resources\Role\RoleResource 
     */
    public function store(StoreRequest $request)
    {
        $role = Role::create($request->only(['name', 'description']));

        return new RoleResource($role);
    }

    /**
     * 
     * @param \App\Models\Role $role 
     * @return \App\Http\Resources\Role\RoleResource 
     */
    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    /**
     * 
     * @param \App\Http\Requests\Role\StoreRequest $request 
     * @param \App\Models\Role $role 
     * @return \App\Http\Resources\Role\RoleResource 
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException 
     */
    public function update(StoreRequest $request, Role $role)
    {
        $role->update($request->only(['name', 'description']));

        return new RoleResource($role);
    }

    /**
     * 
     * @param \App\Models\Role $role 
     * @return void 
     * @throws \LogicException 
     */
    public function destroy(Role $role)
    {
        $role->delete();
    }
}
