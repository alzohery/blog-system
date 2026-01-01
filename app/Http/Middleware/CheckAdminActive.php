<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminActive
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('admin')->user();
        // If the admin is logged in but the account is not activated
        if ($user && !$user->is_active) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->withErrors('Your account is deactivated.');
        }

        return $next($request);
    }
}
