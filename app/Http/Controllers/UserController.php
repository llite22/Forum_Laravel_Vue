<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function personal()
    {
        $user = UserResource::make(auth()->user())->resolve();
        return inertia('User/Personal', compact('user'));
    }

    public function update(UpdateRequest $request): array
    {
        $data = $request->validated();

        $user = auth()->user();

        $user->deleteOldAvatar();

        $path = Storage::disk('public')->put('/avatars', $data['avatar']);

        $user->update([
            'avatar' => $path
        ]);

        return UserResource::make(auth()->user())->resolve();
    }
}