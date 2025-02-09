<?php

declare(strict_types=1);

namespace App\Domain\Travelers;

use App\Domain\Repository;

class TravelersRepository extends Repository
{
    protected string $tableName = 'travelers';

    protected string $modelClassName = Travelers::class;
}
