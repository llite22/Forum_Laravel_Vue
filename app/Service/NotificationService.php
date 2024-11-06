<?php

namespace App\Service;

use App\Models\Notification;

class NotificationService
{
    public static function store($message, $title, $id = null): void
    {
        $id = $id ?? $message->user_id;
        if ($message->likedUsers()->where('user_id', auth()->id())->exists()) {
            return;
        }
        Notification::create([
            'title' => $title,
            'user_id' => $id,
            'url' => route('themes.show', $message->theme_id) . '#' . $message->id
        ]);
    }
}
