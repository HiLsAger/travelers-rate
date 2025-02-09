<?php

declare(strict_types=1);

namespace App\Application\Actions\Travelers;

use App\Application\Actions\Action;
use App\Domain\Travelers\TravelersRepository;
use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;

abstract class TravelersAction extends Action
{
    protected TravelersRepository $repository;

    public function __construct(
        LoggerInterface $logger,
        TravelersRepository $travelersRepository,
        Connection $db
    ) {
        parent::__construct($logger);
        $this->repository = $travelersRepository;
    }
}
