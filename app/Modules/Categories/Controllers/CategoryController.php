<?php

namespace App\Modules\Categories\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Categories\Services\CategoryService;
use App\Modules\Categories\DTOs\CategoryDTO;
use App\Modules\Categories\Models\Category;
use App\Modules\Categories\Requests\StoreCategoryRequest;
use App\Modules\Categories\Requests\UpdateCategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

/**
 * Category Controller
 *
 * Handles HTTP requests for categories (Admin only)
 */
class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    /**
     * Inject CategoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display list of categories
     */
    public function index(): View
    {
        $categories = $this->categoryService->getAll();

        return view('admin.categories.index', compact('categories'));

    }

    /**
     * Show create form
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store new category
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        try {
            $dto = new CategoryDTO($request->validated());
            $this->categoryService->create($dto);

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Category created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show edit form
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update category
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        try {
            $dto = new CategoryDTO($request->validated());
            $this->categoryService->update($category, $dto);

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Category updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Delete category
     */
    public function destroy(Category $category): RedirectResponse
    {
        try {
            $this->categoryService->delete($category);

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Category deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
