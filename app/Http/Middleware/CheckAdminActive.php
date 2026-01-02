<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminActive
{
    public function handle(Request $request, Closure $next)
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->route('admin.login')
                ->withErrors(['general' => 'Please login first.']);
        }

        if (!$admin->is_active) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')
                ->withErrors(['general' => 'Your account is not active.']);
        }

        return $next($request);
    }
}
