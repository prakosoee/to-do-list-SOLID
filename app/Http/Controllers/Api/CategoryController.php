<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\CategoryServiceInterface;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(
        CategoryServiceInterface $categoryService
        )
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request): JsonResponse
    {
        $search = $request->query('search');
        $categories = $this->categoryService->getAll($search);
        return response()->json([
            'success' => true,
            'data' => $categories,
        ], Response::HTTP_OK);
    }
    
    public function store(CategoryRequest $request): JsonResponse
    {
        $category = $this->categoryService->create($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'category berhasil ditambahkan!',
            'data' => $category,
        ], Response::HTTP_CREATED);
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $category,
        ], Response::HTTP_OK);
    }

    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        $this->categoryService->update($category, $request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Category berhasil diperbarui!',
            'data' => $category->fresh(),
        ], Response::HTTP_OK);
    }

    public function destroy(Category $category): JsonResponse
    {
        $this->categoryService->delete($category);
        return response()->json([
            'success' => true,
            'message' => 'Category berhasil dihapus!',
        ], Response::HTTP_NO_CONTENT);
    }
}
