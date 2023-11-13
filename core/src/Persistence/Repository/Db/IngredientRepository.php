<?php

namespace Persistence\Repository\Db;

use Persistence\Entity\CombineIngredient\IngredientEntity;

class IngredientRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getIdsAndType(): array
    {
        $sql = <<<SQL
select i.id, t.code 
from test_task.ingredient i
join test_task.ingredient_type t on t.id = i.type_id
SQL;

        return $this->connection->getConnection()->fetchAllAssociative(
            $sql
        );
    }

    /**
     * @return IngredientEntity[]
     */
    public function getAll(): array
    {
        $sql = <<<SQL
select i.id, t.title as type, i.title, i.price
from test_task.ingredient i
join test_task.ingredient_type t on t.id = i.type_id
SQL;

        $result = $this->connection->getConnection()->fetchAllAssociative($sql);

        return array_map(
            fn(array $row): IngredientEntity => $this->makeEntity($row),
            $result
        );
    }

    private function makeEntity(array $row): IngredientEntity
    {
        return new IngredientEntity(
            $row['id'],
            $row['type'],
            $row['title'],
            $row['price'],
        );
    }
}