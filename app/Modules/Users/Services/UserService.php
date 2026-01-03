<?php

namespace App\Modules\Users\Services;

use App\Models\User;
use App\Modules\Users\DTOs\UserDTO;
use App\Modules\ActivityLog\Services\ActivityLogService;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserService
{
    protected ActivityLogService $activityLogService;

    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    /**
     * Create new user
     */
    public function create(UserDTO $dto): User
    {
        try {
            $user = User::create([
                'name'      => $dto->name,
                'email'     => $dto->email,
                'password'  => Hash::make($dto->password),
                'is_active' => $dto->is_active,
            ]);

            // Activity log
            $this->activityLogService->log(
                auth('admin')->id(),
                'user_created',
                $user
            );

            return $user;
        } catch (Exception $e) {
            throw new Exception('Failed to create user.');
        }
    }

    /**
     * Update existing user
     */
    public function update(User $user, UserDTO $dto): User
    {
        try {
            $oldIsActive = $user->is_active;

            $data = [
                'name'      => $dto->name,
                'email'     => $dto->email,
                'is_active' => $dto->is_active,
            ];

            if ($dto->password) {
                $data['password'] = Hash::make($dto->password);
            }

            $user->update($data);

            // General update log
            $this->activityLogService->log(
                auth('admin')->id(),
                'user_updated',
                $user
            );

            // Activate / Deactivate log
            if ($oldIsActive !== $user->is_active) {
                $this->activityLogService->log(
                    auth('admin')->id(),
                    $user->is_active ? 'user_activated' : 'user_deactivated',
                    $user
                );
            }

            return $user;
        } catch (Exception $e) {
            throw new Exception('Failed to update user.');
        }
    }

    /**
     * Delete user
     */
    public function delete(User $user): void
    {
        try {
            // Log before delete
            $this->activityLogService->log(
                auth('admin')->id(),
                'user_deleted',
                $user
            );

            $user->delete();
        } catch (Exception $e) {
            throw new Exception('Failed to delete user.');
        }
    }
}
