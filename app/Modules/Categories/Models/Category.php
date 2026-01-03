<?php

namespace App\Modules\Categories\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    // Mass assignable fields
    protected $fillable = [
        'name',
        'slug',
        'is_active'
    ];

    /**
     * A category has many posts
     */
    public function posts(): HasMany
    {
        return $this->hasMany(\App\Modules\Posts\Models\Post::class);
    }

    public function activityLogs()
    {
        return $this->morphMany(
            \App\Modules\ActivityLog\Models\ActivityLog::class,
            'loggable'
        );
    }

}
