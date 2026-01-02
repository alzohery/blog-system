<?php

namespace App\Modules\Posts\Services;

use App\Modules\Posts\Models\Post;
use App\Modules\Posts\DTOs\PostDTO;
use App\Modules\ActivityLog\Models\ActivityLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class PostService
{
    /**
     * Get paginated posts with filters
     */
    public function list(array $filters = [])
    {
        $query = Post::query()
            ->with(['category', 'admin'])
            ->orderByDesc('id');

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['title'])) {
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        }

        return $query->paginate(10);
    }

    /**
     * Create a new post
     */
    public function create(PostDTO $dto): Post
    {
        DB::beginTransaction();

        try {
            $post = Post::create($dto->toArray());

            $this->logActivity(
                $dto->admin_id,
                $post->id,
                'create'
            );

            DB::commit();

            return $post;
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Post create failed', [
                'error' => $e->getMessage(),
            ]);

            throw new Exception('Failed to create post');
        }
    }

    /**
     * Update an existing post
     */
    public function update(Post $post, PostDTO $dto): Post
    {
        DB::beginTransaction();

        try {
            $post->update($dto->toArray());

            $this->logActivity(
                $dto->admin_id,
                $post->id,
                'update'
            );

            DB::commit();

            return $post;
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Post update failed', [
                'post_id' => $post->id,
                'error'   => $e->getMessage(),
            ]);

            throw new Exception('Failed to update post');
        }
    }

    /**
     * Delete a post
     */
    public function delete(Post $post, int $adminId): void
    {
        DB::beginTransaction();

        try {
            $postId = $post->id;

            $post->delete();

            $this->logActivity(
                $adminId,
                $postId,
                'delete'
            );

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Post delete failed', [
                'post_id' => $post->id,
                'error'   => $e->getMessage(),
            ]);

            throw new Exception('Failed to delete post');
        }
    }

    /**
     * Change post status
     */
    public function changeStatus(Post $post, string $status, int $adminId): Post
    {
        DB::beginTransaction();

        try {
            $post->update([
                'status' => $status,
            ]);

            $this->logActivity(
                $adminId,
                $post->id,
                'status_change'
            );

            DB::commit();

            return $post;
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Post status change failed', [
                'post_id' => $post->id,
                'error'   => $e->getMessage(),
            ]);

            throw new Exception('Failed to change post status');
        }
    }

    /**
     * Store activity log
     */
    protected function logActivity(int $adminId, int $postId, string $action): void
    {
        ActivityLog::create([
            'admin_id' => $adminId,
            'post_id'  => $postId,
            'action'   => $action,
        ]);
    }
}
