<?php

namespace App\Jobs;

use App\Modules\Posts\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PublishScheduledPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $postId;

    /**
     * Create a new job instance.
     */
    public function __construct(int $postId)
    {
        $this->postId = $postId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $post = Post::find($this->postId);

        if (!$post) {
            return;
        }

        // نتأكد إن البوست لسه scheduled
        if ($post->status !== Post::STATUS_SCHEDULED) {
            return;
        }

        $post->update([
            'status'     => Post::STATUS_PUBLISHED,
            'publish_at' => now(),
        ]);
    }
}
