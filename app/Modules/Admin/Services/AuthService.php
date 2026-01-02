<?php

namespace App\Modules\Admin\Services;

use App\Modules\Admin\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthService
{
    public function login(string $email, string $password): bool
    {
        try {
            $admin = Admin::where('email', $email)->first();

            if (!$admin) {
                Log::warning('Admin login failed: admin not found', ['email' => $email]);
                return false;
            }

            if (!Hash::check($password, $admin->password)) {
                Log::warning('Admin login failed: incorrect password', ['email' => $email]);
                return false;
            }

            if (!$admin->is_active) {
                Log::warning('Admin login failed: account inactive', ['email' => $email]);
                return false;
            }

            Auth::guard('admin')->login($admin);
            $admin->last_login_at = now();
            $admin->save();

            Log::info('Admin login successful', ['email' => $email]);

            return true;
        } catch (Exception $e) {
            Log::error('Admin login exception: '.$e->getMessage(), [
                'email' => $email,
                'stack' => $e->getTraceAsString()
            ]);

            throw new Exception('An error occurred while trying to login. Please try again later.');
        }
    }

    public function logout(): void
    {
        try {
            Auth::guard('admin')->logout();
        } catch (Exception $e) {
            Log::error('Admin logout exception: '.$e->getMessage());
            throw new Exception('Unable to logout. Please try again.');
        }
    }
}
