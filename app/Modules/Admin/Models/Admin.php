<?php

namespace App\Modules\Admin\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    // Mass assignable fields
    
    protected $fillable = [
        'name', 'email', 'password', 'is_active', 'avatar', 'last_login_at'
    ];

    // Hidden fields for arrays/json
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Admin has many posts
     */
    public function posts(): HasMany
    {
        return $this->hasMany(\App\Modules\Posts\Models\Post::class);
    }

    /**
     * Admin has many activity logs
     */
    public function activityLogs(): HasMany
    {
        return $this->hasMany(\App\Modules\ActivityLog\Models\ActivityLog::class);
    }
}
