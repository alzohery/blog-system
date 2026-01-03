<?php

namespace App\Modules\ActivityLog\Services;

use App\Modules\ActivityLog\Models\ActivityLog;


use Illuminate\Database\Eloquent\Model;

class ActivityLogService
{
    public function log(
        int $adminId,
        string $action,
        Model $model
    ): void {
        ActivityLog::create([
            'admin_id'      => $adminId,
            'action'        => $action,
            'loggable_id'   => $model->id,
            'loggable_type' => $model->getMorphClass(),
            'created_at'    => now(),
        ]);
    }
    
}
