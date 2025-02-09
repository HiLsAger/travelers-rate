<?php

declare(strict_types=1);

namespace App\Domain\Travelers;

use App\Domain\Repository;

class TravelersRepository extends Repository
{
    protected string $tableName = 'travelers';

    protected string $modelClassName = Travelers::class;

    public function getTravelersByCities(int $id): array
    {
        $records = $this->db->createQueryBuilder()
            ->select($this->tableName.'.*')
            ->innerJoin($this->tableName, 'ratings', 'r', "r.traveler_id = $this->tableName.id")
            ->innerJoin('r', 'attractions', 'a', 'a.id = r.attraction_id')
            ->innerJoin('a', 'cities', 'c', "c.id = a.city_id")
            ->from($this->tableName)
            ->where('c.id = :id')
            ->setParameter('id', $id)
            ->fetchAllAssociative();

        $items = [];
        foreach ($records as $item) {
            $items[] = $this->load($item);
        }

        return $items;
    }
}
