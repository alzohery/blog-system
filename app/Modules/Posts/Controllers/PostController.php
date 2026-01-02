<?php

namespace App\Modules\Posts\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Posts\Services\PostService;
use App\Modules\Posts\DTOs\PostDTO;
use App\Modules\Posts\Models\Post;
use App\Modules\Posts\Requests\StorePostRequest;
use App\Modules\Posts\Requests\UpdatePostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

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
     * Display list of posts with filters
     */
    public function index(): View
    {
        $posts = $this->postService->list(request()->only([
            'category_id',
            'status',
            'title',
        ]));

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show create post form
     */
    public function create(): View
    {
        return view('admin.posts.create');
    }

    /**
     * Store a new post
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        try {
            $dto = new PostDTO($request->validated());

            $this->postService->create($dto);

            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Post created successfully.');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['general' => $e->getMessage()]);
        }
    }

    /**
     * Show edit post form
     */
    public function edit(Post $post): View
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update an existing post
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        try {
            $dto = new PostDTO($request->validated());

            $this->postService->update($post, $dto);

            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Post updated successfully.');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['general' => $e->getMessage()]);
        }
    }

    /**
     * Delete a post
     */
    public function destroy(Post $post): RedirectResponse
    {
        try {
            $this->postService->delete($post, auth('admin')->id());

            return redirect()
                ->route('admin.posts.index')
                ->with('success', 'Post deleted successfully.');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['general' => $e->getMessage()]);
        }
    }
}
