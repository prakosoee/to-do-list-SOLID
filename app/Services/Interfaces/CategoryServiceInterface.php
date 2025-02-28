<?php

namespace App\Services\Interfaces;

use App\Models\Category;
use App\Services\Interfaces\Base\CreateInterface;
use App\Services\Interfaces\Base\DeleteInterface;
use App\Services\Interfaces\Base\GetAllInterface;
use App\Services\Interfaces\Base\UpdateInterface;
use App\Services\Interfaces\Base\AuthorizeInterface;

interface CategoryServiceInterface extends AuthorizeInterface, GetAllInterface, CreateInterface, UpdateInterface, DeleteInterface
{
    // public function update(Category $category, array $data): bool;
}
