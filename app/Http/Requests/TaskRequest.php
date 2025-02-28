<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date',
            'labels' => 'array',
            'labels.*' => 'exists:labels,id',
        ];
    }
}
