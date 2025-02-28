<?php

namespace App\Services\Interfaces\Base;

interface AuthorizeInterface
{
    /**
     * @template T of object
     * @param T $model
     */
    public function authorize(object $model): void;
}
