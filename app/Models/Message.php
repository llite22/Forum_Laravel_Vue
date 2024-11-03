<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $guarded = false;

    protected $withCount = ['likedUsers'];

    public function getIsLikedAttribute(): bool
    {
        return $this->likedUsers()->where('user_id', auth()->id())->exists();
    }

    public function getIsNotSolvedComplaintAttribute()
    {
        return $this->complaintedUsers()
            ->where('user_id', auth()->id())
            ->where('is_solved', false)
            ->exists();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function likedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'message_user_likes', 'message_id', 'user_id');
    }

    public function answeredUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'message_user_answers', 'message_id', 'user_id');
    }

    public function complaintedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'complaints', 'message_id', 'user_id');
    }


}
