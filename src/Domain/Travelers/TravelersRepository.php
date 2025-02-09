<?php

declare(strict_types=1);

namespace App\Domain\Travelers;

use Doctrine\DBAL\Connection;

class TravelersRepository
{
    protected string $tableName = 'travelers';

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
         $data = $this->db->createQueryBuilder()
            ->select('*')
            ->from($this->tableName)
            ->fetchAllAssociative();

         $travelers = [];
         foreach ($data as $traveler) {
            $travelers[] = $this->loadTraveler($traveler);
         }

         return $travelers;
    }

    /**
     * @param int $id
     * @return Travelers
     * @throws TravelersNotFoundException
     */
    public function findUserOfId(int $id): Travelers
    {
        $traveler = $this->db->createQueryBuilder()
            ->select('*')
            ->from($this->tableName)
            ->where('id = :id')
            ->setParameter('id', $id)
            ->fetchAssociative();

        return $this->loadTraveler($traveler);
    }
    public function insertRecord(Travelers $traveler): int
    {
        $this->db->insert($this->tableName, $traveler->jsonSerialize());

        return (int)$this->db->lastInsertId();
    }

    public function updateRecord(Travelers $traveler): int
    {
        $this->db->update(
            $this->tableName,
            $traveler->jsonSerialize(),
            ['id' => $traveler->getId()]
        );

        return $traveler->getId();
    }

    public function loadTraveler(array $traveler): Travelers
    {
        $travelerModel = new Travelers();
        $travelerModel->load($traveler);

        return $travelerModel;
    }
}
