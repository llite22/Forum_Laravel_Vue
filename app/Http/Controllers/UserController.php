<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

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

        $manager = new ImageManager(new Driver());

        $image = $manager->read($data['avatar'])
            ->coverDown(100, 100);

        $filename = uniqid('avatar_') . '.jpg';
        $path = 'avatars/' . $filename;

        Storage::disk('public')->put(
            $path,
            $image->toJpg()
        );

        $user->update([
            'avatar' => $path
        ]);

        return UserResource::make(auth()->user())->resolve();
    }
}
