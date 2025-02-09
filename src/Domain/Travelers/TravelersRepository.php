<?php

declare(strict_types=1);

namespace App\Domain\Travelers;

use Doctrine\DBAL\Connection;

class TravelersRepository
{
    protected Connection $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * @return Travelers[]
     */
    public function findAll(): array
    {
        return $this->db->createQueryBuilder()
            ->select('*')
            ->from('travelers')
            ->fetchAllAssociative();
    }

    /**
     * @param int $id
     * @return Travelers
     * @throws TravelersNotFoundException
     */
    public function findUserOfId(int $id): Travelers
    {
        return $this->db->createQueryBuilder()
            ->select('*')
            ->from('travelers')
            ->where('id = :id')
            ->setParameters('id', $id)
            ->fetchOne();
    }
}
