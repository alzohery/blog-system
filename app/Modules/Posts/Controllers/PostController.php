<?php

namespace App\Modules\Posts\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Posts\Services\PostService;
use App\Modules\Posts\DTOs\PostDTO;
use App\Modules\Posts\Requests\StorePostRequest;
use App\Modules\Categories\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Modules\Posts\Models\Post;

use App\Modules\Posts\Requests\UpdatePostRequest;


/**
 * Post Controller
 *
 * Handles post creation (Admin only)
 */
class PostController extends Controller
{
    protected PostService $postService;

    /**
     * Inject PostService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Show create post form
     */
    public function create(): View
    {
        // Load active categories for dropdown
        $categories = Category::where('is_active', true)->get();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store new post
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        try {
            // Get logged in admin id
            $adminId = Auth::guard('admin')->id();

            // Create DTO from validated data
            $dto = new PostDTO($request->validated(), $adminId);

            // Create post using service
            $this->postService->create($dto);

            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Post created successfully.');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Index Posts
     */
    // public function index(): View
    // {
    //     // We used with('category') → to avoid N+1
    //     $posts = Post::with('category')
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(10);

    //     return view('admin.posts.index', compact('posts'));
    // }
    public function index(): View
    {
        $query = Post::with('category');

        // Filter by category
        if (request()->filled('category_id')) {
            $query->where('category_id', request('category_id'));
        }

        // Filter by status
        if (request()->filled('status')) {
            $query->where('status', request('status'));
        }

        // Filter by title (search)
        if (request()->filled('title')) {
            $query->where('title', 'like', '%' . request('title') . '%');
        }

        $posts = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString(); // مهم جدًا

        return view('admin.posts.index', compact('posts'));
    }


    /**
     * Edit Posts
     */
    public function edit(Post $post): View
    {
        $categories = Category::where('is_active', true)->get();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * update Posts
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        try {
            $adminId = Auth::guard('admin')->id();

            $dto = new PostDTO($request->validated(), $adminId);

            $this->postService->update($post, $dto);

            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Post updated successfully.');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * delet Posts
     */
    public function destroy(Post $post): RedirectResponse
    {
        try {
            $adminId = Auth::guard('admin')->id();

            $this->postService->delete($post, $adminId);

            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Post deleted successfully.');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }




}
