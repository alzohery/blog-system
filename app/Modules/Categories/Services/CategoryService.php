<?php

namespace App\Modules\Categories\Services;

use App\Modules\Categories\Models\Category;
use App\Modules\Categories\DTOs\CategoryDTO;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use App\Modules\ActivityLog\Services\ActivityLogService;
use Exception;

/**
 * Category Service
 *
 * Handles all business logic related to categories
 */
class CategoryService
{
    protected ActivityLogService $activityLogService;

    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    /**
     * Get all categories
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Category::orderBy('created_at', 'desc')->get();
    }

    /**
     * Create a new category
     *
     * @param CategoryDTO $dto
     * @return Category
     * @throws Exception
     */
    public function create(CategoryDTO $dto): Category
    {
        try {
            // create category
            $category = Category::create([
                'name'      => $dto->name,
                'slug'      => $dto->slug ?: Str::slug($dto->name),
                'is_active' => $dto->is_active,
            ]);

            // create log
            $this->activityLogService->log(
                auth('admin')->id(),
                'created',
                $category
            );

            return $category;

        } catch (Exception $e) {
            throw new Exception('Failed to create category: ' . $e->getMessage());
        }
    }

    /**
     * Update an existing category
     *
     * @param Category $category
     * @param CategoryDTO $dto
     * @return Category
     * @throws Exception
     */
    public function update(Category $category, CategoryDTO $dto): Category
    {
        try {
            $category->update([
                'name'      => $dto->name,
                'slug'      => $dto->slug ?: Str::slug($dto->name),
                'is_active' => $dto->is_active,
            ]);

            // create log affter update
            $this->activityLogService->log(
                auth('admin')->id(),
                'updated',
                $category
            );

            return $category;

        } catch (Exception $e) {
            throw new Exception('Failed to update category: ' . $e->getMessage());
        }
    }

    /**
     * Delete category
     *
     * Prevent deleting category if it has posts
     *
     * @param Category $category
     * @return void
     * @throws Exception
     */
    public function delete(Category $category): void
    {
        try {
            if ($category->posts()->exists()) {
                throw new Exception('Cannot delete category with posts.');
            }

            $category->delete();

            // create log affter delete
            $this->activityLogService->log(
                auth('admin')->id(),
                'deleted',
                $category
            );

        } catch (Exception $e) {
            throw new Exception('Failed to delete category: ' . $e->getMessage());
        }
    }
}
