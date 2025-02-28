<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CategoryRequest;
use App\Services\Interfaces\CategoryServiceInterface;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(): View
    {
        $search = request('search');
        $categories = $this->categoryService->getAll($search);
        return view('category.index', compact('categories', 'search'));
    }

    public function create(): View
    {
        return view('category.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $this->categoryService->create($request->validated());
        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Category $category): View
    {
        $this->categoryService->authorize($category);
        return view('category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $this->categoryService->update($category, $request->validated());
        return redirect()->route('category.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->categoryService->delete($category);
        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
