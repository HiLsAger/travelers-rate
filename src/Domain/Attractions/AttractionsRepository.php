<?php

declare(strict_types=1);

namespace App\Domain\Attractions;

use App\Domain\Model;
use App\Domain\Repository;
use Doctrine\DBAL\Query\QueryBuilder;

class AttractionsRepository extends Repository
{
    protected string $tableName = 'attraction';

    protected string $modelClassName = Attractions::class;

    /**
     * @return Model[]
     */
    public function findAll(array $filters = []): array
    {
        $query = $this->db->createQueryBuilder()
            ->select('*')
            ->from($this->tableName);

        foreach ($filters as $property => $value) {
            if ($property === 'min_rating' && is_numeric($value)) {
                $query = $this->setMinRatning($query, (int)$value);
            }

            if (!$condition = $this->modelClassName::getCondition($property)) {
                continue;
            }
            $query->andWhere($condition)
                ->setParameter($property, $value);
        }

        $records = $query->fetchAllAssociative();
        $items = [];
        foreach ($records as $record) {
            $items[] = $this->load($record);
        }

        return $items;
    }

    protected function setMinRatning(QueryBuilder $query, int $value): QueryBuilder
    {
        $subQuery = $this->db->createQueryBuilder()
            ->select('AVG(r.score)')
            ->from('rating', 'r')
            ->where("r.attraction_id = $this->tableName.id");

        $query->andWhere($query->expr()->gte('(' . $subQuery->getSQL() . ')', ':minRating'))
            ->setParameter('minRating', $value);

        return $query;
    }
}
