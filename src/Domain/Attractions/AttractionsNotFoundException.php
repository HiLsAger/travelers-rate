<?php

declare(strict_types=1);

namespace App\Domain\Attractions;

use App\Domain\DomainException\DomainRecordNotFoundException;

class AttractionsNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The user you requested does not exist.';
}
