<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ToggleRoleRequest;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\User\UserWithRolesResource;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = UserWithRolesResource::collection(User::all())->resolve();
        $roles = RoleResource::collection(Role::all())->resolve();
        return inertia('Admin/User/Index', compact('users', 'roles'));
    }

    public function toggleRole(User $user, ToggleRoleRequest $request): array
    {

        $data = $request->validated();

       $user->roles()->toggle($data);

        return UserWithRolesResource::make($user)->resolve();
    }
}
