<?php

namespace App\Application\Validators;

use Doctrine\DBAL\Connection;
use Respect\Validation\Rules\Core\Simple;
use Slim\Factory\AppFactory;

class IdExist extends Simple
{
    protected Connection $db;

    protected string $tableName;

    public function __construct(string $tableName)
    {
        $app = AppFactory::create();
        $this->db = $app->getContainer()->get(Connection::class);
        $this->tableName = $tableName;
    }

    public function validate($input): bool
    {
        return (bool)$this->db->createQueryBuilder()
            ->select(1)
            ->from($this->tableName)
            ->where('id = :id')
            ->setParameter('id', $input)
            ->fetchOne();
    }

    public function isValid($input): bool
    {
        return (bool)$this->db->createQueryBuilder()
            ->select(1)
            ->from($this->tableName)
            ->where('id = :id')
            ->setParameter('id', $input)
            ->fetchOne();
    }
}