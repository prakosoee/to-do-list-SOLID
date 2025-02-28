<?php

namespace App\Services;

use App\Services\Interfaces\LabelServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;

class TaskFormService
{
    protected $categoryService;
    protected $labelService;

    public function __construct(
        CategoryServiceInterface $categoryService,
        LabelServiceInterface $labelService
    ) {
        $this->categoryService = $categoryService;
        $this->labelService = $labelService;
    }

    public function getFormData()
    {
        return [
            'categories' => $this->categoryService->getAllCategories(),
            'labels' => $this->labelService->getAllLabels()
        ];
    }
}
