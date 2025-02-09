<?php

declare(strict_types=1);

namespace App\Domain\Cities;

use App\Domain\Ratings\Ratings;
use App\Domain\Repository;

class CitiesRepository extends Repository
{
    protected string $tableName = 'cities';

    protected string $modelClassName = Cities::class;

    public function getTravelersVisitedCities(int $id): array
    {
        $records = $this->db->createQueryBuilder()
            ->select($this->tableName.'.*')
            ->innerJoin($this->tableName, 'attractions', 'a', "a.city_id = $this->tableName.id")
            ->innerJoin('a', 'ratings', 'r', "r.attraction_id = a.id")
            ->innerJoin('r', 'travelers', 't', "r.traveler_id = t.id")
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
