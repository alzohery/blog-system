<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\User;
use App\Modules\Posts\Models\Post;
use App\Modules\Categories\Models\Category;

/**
 * Admin Dashboard Controller
 */
class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index(): View
    {
        $stats = [
            'users_count'      => User::count(),
            'posts_count'      => Post::count(),
            'published_posts'  => Post::where('status', Post::STATUS_PUBLISHED)->count(),
            'scheduled_posts'  => Post::where('status', Post::STATUS_SCHEDULED)->count(),
            'categories_count' => Category::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

}
