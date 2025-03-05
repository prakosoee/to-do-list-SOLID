<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\TaskServiceInterface;

class TaskService implements TaskServiceInterface
{
    public function authorize(object $model): void
    {
        abort_unless($model instanceof Task, 400, "Invalid model type.");
        abort_unless($model->user_id === Auth::id(), 403, "You don't have permission to perform this action.");
    }

    public function getAll(?string $search = null, int $perPage = 5): object
    {
        $query = Task::where('user_id', Auth::id());

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('status', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%');
        }
        
        return $query->orderByRaw("
            CASE 
                WHEN status = 'pending' THEN 1
                WHEN status = 'in_progress' THEN 2
                WHEN status = 'completed' THEN 3
            END ASC
        ")->paginate($perPage);;
    }

    public function getAllTasks(): object
    {
        $query = Task::where('user_id', Auth::id());
        return $query->get();
    }

    public function create(array $data): Task
    {
        $task = Task::create([
            'user_id' => Auth::id(),
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'category_id' => $data['category_id'] ?? null,
            'status' => $data['status'],
            'due_date' => $data['due_date'] ?? null,
        ]);

        if (!empty($data['labels'])) {
            $task->labels()->sync($data['labels']);
        }

        if (!empty($data['categories'])) {
            $task->labels()->sync($data['categories']);
        }
        return $task;
    }

    public function update(object $model, array $data): bool
    {
        abort_unless($model instanceof Task, 400, "Invalid model type.");
        $this->authorize($model);

        $model->update($data);

        if (!empty($data['labels'])) {
            $model->labels()->sync($data['labels']);
        }

        if (!empty($data['categories'])) {
            $model->categories()->sync($data['categories']);
        }

        return true;
    }

    public function delete(object $model): bool
    {
        abort_unless($model instanceof Task, 400, "Invalid model type.");
        $this->authorize($model);

        return (bool) $model->delete();
    }
    
}
