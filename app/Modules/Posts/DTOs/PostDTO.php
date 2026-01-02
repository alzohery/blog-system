<?php

namespace App\Modules\Posts\DTOs;

class PostDTO
{
    public int $admin_id;
    public int $category_id;
    public string $title;
    public string $slug;
    public array $content;
    public ?string $main_image;
    public string $status;
    public ?string $publish_at;

    /**
     * Create DTO from validated request data
     */
    public function __construct(array $data)
    {
        $this->admin_id   = $data['admin_id'];
        $this->category_id = $data['category_id'];
        $this->title      = $data['title'];
        $this->slug       = $data['slug'];
        $this->content    = $data['content'];
        $this->main_image = $data['main_image'] ?? null;
        $this->status     = $data['status'] ?? 'draft';
        $this->publish_at = $data['publish_at'] ?? null;
    }

    /**
     * Convert DTO to array for persistence
     */
    public function toArray(): array
    {
        return [
            'admin_id'    => $this->admin_id,
            'category_id' => $this->category_id,
            'title'       => $this->title,
            'slug'        => $this->slug,
            'content'     => $this->content,
            'main_image'  => $this->main_image,
            'status'      => $this->status,
            'publish_at'  => $this->publish_at,
        ];
    }
}
