<?php

declare(strict_types=1);

namespace App\Application\Actions\Travelers;

use App\Application\Actions\Action;
use App\Domain\Travelers\TravelersRepository;
use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;

abstract class TravelersAction extends Action
{
    protected TravelersRepository $userRepository;

    protected Connection $db;

    public function __construct(LoggerInterface $logger, TravelersRepository $userRepository, Connection $db)
    {
        parent::__construct($logger);
        $this->userRepository = $userRepository;
        $this->db = $db;
    }
}
