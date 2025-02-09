<?php

declare(strict_types=1);

namespace App\Domain;

use Doctrine\DBAL\Connection;

class Repository
{
    protected string $tableName;

    protected string $modelClassName = Model::class;

    protected Connection $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * @return Model[]
     */
    public function findAll(array $filters = []): array
    {
        $query = $this->db->createQueryBuilder()
            ->select('*')
            ->from($this->tableName)
            ->where('1 = 1');


        $index = 1;

        foreach ($filters as $property => $value) {
            if (!$filter = $this->modelClassName::hasFilter($property)) {
                continue;
            }

            $query->andWhere("$filter = :value$index")
                ->setParameter("value$index", $value);
            $index++;
        }

        $records = $query->fetchAllAssociative();

        $items = [];
        foreach ($records as $record) {
            $items[] = $this->load($record);
        }

        return $items;
    }

    /**
     * @param int $id
     * @return Model
     */
    public function findUserOfId(int $id): Model
    {
        $records = $this->db->createQueryBuilder()
            ->select('*')
            ->from($this->tableName)
            ->where('id = :id')
            ->setParameter('id', $id)
            ->fetchAssociative();

        return $this->load($records);
    }

    public function insertRecord(Model $model): int
    {
        $this->db->insert($this->tableName, $model->jsonSerialize());

        return (int)$this->db->lastInsertId();
    }

    public function updateRecord(Model $model): int
    {
        $this->db->update(
            $this->tableName,
            $model->jsonSerialize(),
            ['id' => $model->getId()]
        );

        return $model->getId();
    }

    public function deleteRecord(int $id): bool
    {
        return (bool)$this->db->delete($this->tableName, ['id' => $id]);
    }

    public function load(array $data): Model
    {
        $model = new $this->modelClassName();
        $model->load($data);

        return $model;
    }
}
