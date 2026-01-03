<?php

namespace App\Modules\Posts\DTOs;

/**
 * Post Data Transfer Object
 *
 * Carries validated post data from controller to service
 */
class PostDTO
{
    public int $admin_id;
    public int $category_id;
    public string $title;
    public ?string $slug;
    // public array $content;
    public string $content;
    public $main_image;
    public string $status;
    public ?string $publish_at;

    /**
     * Constructor
     *
     * @param array $data Validated request data
     * @param int $adminId Logged in admin ID
     */
    public function __construct(array $data, int $adminId)
    {
        $this->admin_id    = $adminId;
        $this->category_id = $data['category_id'];
        $this->title       = $data['title'];
        $this->slug        = $data['slug'] ?? null;
        $this->content     = $data['content'];
        $this->main_image  = $data['main_image'] ?? null;
        $this->status      = $data['status'];
        $this->publish_at  = $data['publish_at'] ?? null;
    }
}
