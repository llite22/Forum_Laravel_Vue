<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    protected $guarded = false;

    public function branches(): HasMany
    {

        return $this->hasMany(Branch::class, 'section_id', 'id');
    }
}
