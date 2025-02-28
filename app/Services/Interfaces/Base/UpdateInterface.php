<?php

namespace App\Services\Interfaces\Base;

interface UpdateInterface
{
    public function update(object $model, array $data): bool;
}