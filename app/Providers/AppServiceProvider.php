<?php

namespace App\Providers;

use App\Services\CategoryService;
use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\LabelServiceInterface;
use App\Services\Interfaces\TaskServiceInterface;
use App\Services\LabelService;
use App\Services\TaskService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(LabelServiceInterface::class, LabelService::class);
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
