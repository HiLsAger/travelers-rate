<?php

declare(strict_types=1);

namespace App\Application\Actions\Ratings;

use App\Application\Actions\Action;
use App\Domain\Ratings\RatingsRepository;
use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;

abstract class RatingsAction extends Action
{
    protected RatingsRepository $repository;

    public function __construct(LoggerInterface $logger, RatingsRepository $ratingsRepository, Connection $db)
    {
        parent::__construct($logger);
        $this->repository = $ratingsRepository;
    }
}
