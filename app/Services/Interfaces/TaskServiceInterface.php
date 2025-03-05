<?php

namespace App\Services\Interfaces;

use App\Models\Task;
use App\Services\Interfaces\Base\CreateInterface;
use App\Services\Interfaces\Base\DeleteInterface;
use App\Services\Interfaces\Base\GetAllInterface;
use App\Services\Interfaces\Base\UpdateInterface;
use App\Services\Interfaces\Base\AuthorizeInterface;

interface TaskServiceInterface extends AuthorizeInterface, GetAllInterface, CreateInterface, UpdateInterface, DeleteInterface
{
    public function getAllTasks();
}
