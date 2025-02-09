<?php

declare(strict_types=1);

namespace App\Domain\Cities;

use App\Domain\Repository;

class CitiesRepository extends Repository
{
    protected string $tableName = 'cities';

    protected string $modelClassName = Cities::class;
}
