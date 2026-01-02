<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Requests\LoginRequest;
use App\Modules\Admin\DTOs\LoginDTO;
use App\Modules\Admin\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthController extends Controller
{
    protected AuthService $authService;

    /**
     * Constructor - inject AuthService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Show admin login form
     */
    public function showLoginForm(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Handle login form submission
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        // Creating a DTO from reliable data
        $dto = new LoginDTO($request->validated());
        try {
            $success = $this->authService->login($dto->email, $dto->password);

            if ($success) {
                return redirect()->route('admin.dashboard');
            }

            // If the data is incorrect
            return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
        }
        

catch (Exception $e) {
    // سجل الخطأ في log
    Log::error('Admin Login Error: '.$e->getMessage(), [
        'email' => $dto->email,
        'stack' => $e->getTraceAsString()
    ]);

    // ارجع رسالة عامة للمستخدم
    return redirect()->back()->withErrors(['general' => 'An error occurred while trying to login. Please check logs for details.']);
}

    }

    /**
     * Handle admin logout
     *
     * @return RedirectResponse
     */

    public function logout(): RedirectResponse
    {
        try {
            $this->authService->logout();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['general' => 'Unable to logout. Please try again.']);
        }

        return redirect()->route('admin.login');
    }
}
