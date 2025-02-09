<?php

declare(strict_types=1);

namespace App\Application\Actions\Attractions;

use App\Application\Actions\Action;
use App\Domain\Attractions\AttractionsRepository;
use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;

abstract class AttractionsAction extends Action
{
    protected AttractionsRepository $attractionsRepository;

    public function __construct(LoggerInterface $logger, AttractionsRepository $attractionsRepository, Connection $db)
    {
        parent::__construct($logger);
        $this->attractionsRepository = $attractionsRepository;
    }
}
