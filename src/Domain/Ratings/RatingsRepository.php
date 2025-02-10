<?php

declare(strict_types=1);

namespace App\Domain\Ratings;

use App\Domain\Repository;

class RatingsRepository extends Repository
{
    protected string $tableName = 'rating';

    protected string $modelClassName = Ratings::class;

    public function getRatingByAttractions(int $id): array
    {
        $records = $this->db->createQueryBuilder()
            ->select($this->tableName.'.*')
            ->innerJoin($this->tableName, 'attraction', 'a', "a.id = $this->tableName.attraction_id")
            ->from($this->tableName)
            ->where('a.id = :id')
            ->setParameter('id', $id)
            ->fetchAllAssociative();

        $items = [];
        foreach ($records as $record) {
            $items[] = $this->load($record);
        }

        return $items;
    }

    public function getRatingByTravelers(int $id)
    {
        $records = $this->db->createQueryBuilder()
            ->select($this->tableName.'.*')
            ->innerJoin($this->tableName, 'traveler', 't', "t.id = $this->tableName.traveler_id")
            ->from($this->tableName)
            ->where('t.id = :id')
            ->setParameter('id', $id)
            ->fetchAllAssociative();

        $items = [];
        foreach ($records as $item) {
            $items[] = $this->load($item);
        }

        return $items;
    }
}
