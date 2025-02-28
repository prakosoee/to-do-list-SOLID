<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TaskRequest;
use App\Services\Interfaces\TaskServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\LabelServiceInterface;

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

    public function index(): View
    {
        $search = request('search');
        $tasks = $this->taskService->getAll($search);
        return view('task.index', compact('tasks', 'search'));
    }


    public function create(): View
    {
        $categories = $this->categoryService->getAll();
        $labels = $this->labelService->getAll();
        return view('task.create', compact('categories', 'labels'));
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        $this->taskService->create($request->validated());
        return redirect()->route('task.index')->with('success', 'Task berhasil ditambahkan!');
    }

    public function edit(Task $task): View
    {
        $categories = $this->categoryService->getAll();
        $labels = $this->labelService->getAll();
        $this->taskService->authorize($task);
        return view('task.edit', compact('task', 'categories', 'labels'));
    }

    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $this->taskService->update($task, $request->validated());
        return redirect()->route('task.index')->with('success', 'Task berhasil diperbarui!');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->taskService->delete($task);
        return redirect()->route('task.index')->with('success', 'Task berhasil dihapus!');
    }
}
