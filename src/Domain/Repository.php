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
    public function findAll(): array
    {
        $data = $this->db->createQueryBuilder()
            ->select('*')
            ->from($this->tableName)
            ->fetchAllAssociative();

        $items = [];
        foreach ($data as $item) {
            $items[] = $this->load($item);
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

    public function load(array $data): Model
    {
        $model = new $this->modelClassName();
        $model->load($data);

        return $model;
    }
}
