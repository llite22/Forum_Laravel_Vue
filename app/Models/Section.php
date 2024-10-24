<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes;

    protected $guarded = false;

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class, 'section_id', 'id');
    }

    public function parentBranches(): HasMany
    {
        return $this->hasMany(Branch::class, 'section_id', 'id')
            ->whereNull('parent_id');
    }
}
