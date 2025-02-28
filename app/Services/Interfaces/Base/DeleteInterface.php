<?php

namespace App\Services\Interfaces\Base;

interface DeleteInterface
{
    public function delete(object $model): bool;
}