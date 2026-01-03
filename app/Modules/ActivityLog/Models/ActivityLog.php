<?php

namespace App\Modules\ActivityLog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'admin_id',
        'action',
        'loggable_id',
        'loggable_type',
        'created_at',
    ];

    public function loggable()
    {
        return $this->morphTo();
    }

    /**
     * Related admin
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(\App\Modules\Admin\Models\Admin::class);
    }


}
