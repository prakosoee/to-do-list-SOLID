<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\TaskRequest;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\TaskServiceInterface;
use App\Services\Interfaces\LabelServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;

class TaskController extends Controller
{
    protected $taskService;
    protected $categoryService;
    protected $labelService;

    public function __construct(
        TaskServiceInterface $taskService,
        CategoryServiceInterface $categoryService,
        LabelServiceInterface $labelService
        )
    {
        $this->taskService = $taskService;
        $this->categoryService = $categoryService;
        $this->labelService = $labelService;
    }

    public function index(Request $request): JsonResponse
    {
        $search = $request->query('search');
        $tasks = $this->taskService->getAll($search);
        return response()->json([
            'success' => true,
            'data' => $tasks,
        ], Response::HTTP_OK);
    }
    
    public function store(TaskRequest $request): JsonResponse
    {
        $task = $this->taskService->create($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Task berhasil ditambahkan!',
            'data' => $task,
        ], Response::HTTP_CREATED);
    }

    public function show(Task $task): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $task,
        ], Response::HTTP_OK);
    }

    public function update(TaskRequest $request, Task $task): JsonResponse
    {
        $this->taskService->update($task, $request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Task berhasil diperbarui!',
            'data' => $task->fresh(),
        ], Response::HTTP_OK);
    }

    public function destroy(Task $task): JsonResponse
    {
        $this->taskService->delete($task);
        return response()->json([
            'success' => true,
            'message' => 'Task berhasil dihapus!',
        ], Response::HTTP_NO_CONTENT);
    }
}
