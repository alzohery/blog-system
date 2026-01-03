<?php

namespace App\Modules\Posts\Services;

use App\Modules\Posts\Models\Post;
use App\Modules\Posts\DTOs\PostDTO;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Modules\ActivityLog\Services\ActivityLogService;
use Exception;
use Illuminate\Support\Facades\Log;    

use App\Jobs\PublishScheduledPost;
use Carbon\Carbon;


/**
 * Post Service
 *
 * Handles business logic for posts
 */
class PostService
{
    protected ActivityLogService $activityLogService;

    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    /**
     * Create new post
     *
     * @param PostDTO $dto
     * @return Post
     * @throws Exception
     */
    public function create(PostDTO $dto): Post
    {
        try {
            // Generate slug if not provided
            $slug = $dto->slug ?: Str::slug($dto->title);

            // Handle status logic
            $status = $dto->status;
            $publishAt = null;

            if ($status === Post::STATUS_PUBLISHED) {
                $publishAt = now();
            }

            if ($status === Post::STATUS_SCHEDULED) {
                if (!$dto->publish_at) {
                    throw new Exception('Publish date is required for scheduled posts.');
                }

                $publishAt = $dto->publish_at;
            }

            // Handle image upload
            $imagePath = null;
            if ($dto->main_image) {
                $imagePath = $dto->main_image->store('posts', 'public');
            }

            // Create post
            $post = Post::create([
                'admin_id'    => $dto->admin_id,
                'category_id' => $dto->category_id,
                'title'       => $dto->title,
                'slug'        => $slug,
                'content'     => $dto->content,
                'main_image'  => $imagePath,
                'status'      => $status,
                'publish_at'  => $publishAt,
            ]);
            if ($post->status === Post::STATUS_SCHEDULED && $post->publish_at) {
                PublishScheduledPost::dispatch($post->id)->delay(Carbon::parse($post->publish_at));

                \Log::info("Scheduled job dispatched for Post ID: {$post->id}, will run at {$post->publish_at}");
            }

            // Log activity (polymorphic)
            $this->activityLogService->log(
                $dto->admin_id,
                'created',
                $post
            );

            return $post;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Update existing post
     *
     * @param Post $post
     * @param PostDTO $dto
     * @return Post
     * @throws Exception
     */
    public function update(Post $post, PostDTO $dto): Post
    {
        try {
            $oldStatus = $post->status;
            // Handle image update
            if ($dto->main_image) {
                $imagePath = $dto->main_image->store('posts', 'public');
                $post->main_image = $imagePath;
            }

            // Handle status logic
            $status = $dto->status;
            $publishAt = null;

            if ($status === Post::STATUS_PUBLISHED) {
                $publishAt = now();
            }

            if ($status === Post::STATUS_SCHEDULED) {
                if (!$dto->publish_at) {
                    throw new Exception('Publish date is required for scheduled posts.');
                }
                $publishAt = $dto->publish_at;
            }

            // Update post
            $post->update([
                'category_id' => $dto->category_id,
                'title'       => $dto->title,
                'slug'        => $dto->slug ?: Str::slug($dto->title),
                'content'     => $dto->content,
                'status'      => $status,
                'publish_at'  => $publishAt,
            ]);

            // 
            if ($oldStatus !== $post->status) {
                $this->activityLogService->log(
                    $dto->admin_id,
                    'status_changed',
                    $post
                );
            }


            // Log activity
            $this->activityLogService->log(
                $dto->admin_id,
                'updated',
                $post
            );

            return $post;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Delete existing post
     *
     * @param Post $post
     * @param int $adminId
     * @return void
     * @throws Exception
     */
    public function delete(Post $post, int $adminId): void
    {
        try {
            // Delete image if exists
            if ($post->main_image) {
                Storage::disk('public')->delete($post->main_image);
            }

            // Keep ID before deleting
            $postId = $post->id;

            // Delete post
            $post->delete();

            // Log activity
            $this->activityLogService->log(
                $adminId,
                'deleted',
                tap($post)->setAttribute('id', $postId)
            );

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
