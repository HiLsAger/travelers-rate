<?php

declare(strict_types=1);

namespace App\Domain\Attractions;

use App\Domain\Repository;

class AttractionsRepository extends Repository
{
    protected string $tableName = 'attractions';

    protected string $modelClassName = Attractions::class;
}
