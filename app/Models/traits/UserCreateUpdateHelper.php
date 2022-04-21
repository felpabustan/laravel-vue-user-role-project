<?php

namespace App\Models\traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

trait UserCreateUpdateHelper
{
    public function createOrUpdate(Request $request, User $user)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        if ($request->filled('role_id')) {
            $user->role_id = $request->input('role_id');
        }

        $user->save();

        return $user;
    }
}
