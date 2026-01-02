<?php

namespace App\Modules\Posts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    // Mass assignable fields
    
    protected $fillable = [
        'admin_id', 'category_id', 'title', 'slug', 'content', 'main_image', 'status', 'publish_at'
    ];




    // Cast content as JSON and publish_at as datetime
    protected $casts = [
        'content' => 'array',
        'publish_at' => 'datetime',
    ];

    /**
     * Post belongs to an admin
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(\App\Modules\Admin\Models\Admin::class);
    }

    /**
     * Post belongs to a category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(\App\Modules\Categories\Models\Category::class);
    }

    /**
     * Post has many activity logs
     */
    public function activityLogs(): HasMany
    {
        return $this->hasMany(\App\Modules\ActivityLog\Models\ActivityLog::class);
    }

    /**
     * Available statuses for a post
     */
    public const STATUS_DRAFT = 'draft';
    public const STATUS_SCHEDULED = 'scheduled';
    public const STATUS_PUBLISHED = 'published';

    /**
     * Default attribute values
     */
    protected $attributes = [
        'status' => self::STATUS_DRAFT,
    ];
}
