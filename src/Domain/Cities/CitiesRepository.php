<?php

declare(strict_types=1);

namespace App\Domain\Cities;

use App\Domain\Ratings\Ratings;
use App\Domain\Repository;

class CitiesRepository extends Repository
{
    protected string $tableName = 'city';

    protected string $modelClassName = Cities::class;

    public function getTravelersVisitedCities(int $id): array
    {
        $records = $this->db->createQueryBuilder()
            ->select($this->tableName.'.*')
            ->innerJoin($this->tableName, 'attraction', 'a', "a.city_id = $this->tableName.id")
            ->innerJoin('a', 'rating', 'r', "r.attraction_id = a.id")
            ->innerJoin('r', 'traveler', 't', "r.traveler_id = t.id")
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
