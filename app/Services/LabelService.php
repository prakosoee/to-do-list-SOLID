<?php

namespace App\Services;

use App\Models\Label;
use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\LabelServiceInterface;

class LabelService implements LabelServiceInterface
{
    public function authorize(object $model): void
    {
        abort_unless($model instanceof Label, 400, "Invalid model type.");
        abort_unless($model->user_id === Auth::id(), 403);
    }

    public function getAll(?string $search = null): object
    {
        $query = Label::where('user_id', Auth::id());
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }
        return $query->get();
    }


    public function create(array $data): Label
    {
        return Label::create([
            'user_id' => Auth::id(),
            'name' => $data['name'],
        ]);
    }

    public function update(object $model, array $data): bool
    {
        $this->authorize($model);
        return $model->update(['name' => $data['name']]);
    }

    public function delete(object $model): bool
    {
        $this->authorize($model);
        return $model->delete();
    }
}
