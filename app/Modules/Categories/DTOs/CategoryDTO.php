<?php

namespace App\Modules\Categories\DTOs;

/**
 * Category Data Transfer Object
 *
 * مسؤول عن حمل بيانات الـ Category
 * من الـ Controller للـ Service
 */
class CategoryDTO
{
    public string $name;
    public string $slug;
    public bool $is_active;

    /**
     * Constructor
     *
     * @param array $data بيانات جاية من Request متعملها validation
     */
    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->slug = $data['slug'];
        $this->is_active = $data['is_active'] ?? true;
    }
}
