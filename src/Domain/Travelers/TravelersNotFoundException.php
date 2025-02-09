<?php

declare(strict_types=1);

namespace App\Domain\Travelers;

use App\Domain\DomainException\DomainRecordNotFoundException;

class TravelersNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The user you requested does not exist.';
}
