<?php

declare(strict_types=1);

namespace App\Domain\Cities;

use App\Domain\DomainException\DomainRecordNotFoundException;

class CitiesNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The city you requested does not exist.';
}
