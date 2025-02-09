<?php

declare(strict_types=1);

namespace App\Domain\Ratings;

use App\Domain\DomainException\DomainRecordNotFoundException;

class RatingsNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The user you requested does not exist.';
}
