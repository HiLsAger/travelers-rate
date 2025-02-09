<?php

declare(strict_types=1);

namespace App\Application\Actions\Cities;

use App\Application\Actions\Action;
use App\Domain\Cities\CitiesRepository;
use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;

abstract class CitiesAction extends Action
{
    protected CitiesRepository $citiesRepository;

    public function __construct(LoggerInterface $logger, CitiesRepository $citiesRepository, Connection $db)
    {
        parent::__construct($logger);
        $this->citiesRepository = $citiesRepository;
    }
}
