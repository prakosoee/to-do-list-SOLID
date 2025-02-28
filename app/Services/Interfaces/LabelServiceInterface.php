<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\Base\CreateInterface;
use App\Services\Interfaces\Base\DeleteInterface;
use App\Services\Interfaces\Base\GetAllInterface;
use App\Services\Interfaces\Base\UpdateInterface;
use App\Services\Interfaces\Base\AuthorizeInterface;

interface LabelServiceInterface extends AuthorizeInterface, CreateInterface, DeleteInterface, GetAllInterface, UpdateInterface
{

}
