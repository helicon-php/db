<?php

declare(strict_types=1);

namespace Helicon\Db\Query;

use Helicon\ObjectMapper\MapperInterface;
use NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder;
use NilPortugues\Sql\QueryBuilder\Manipulation\QueryInterface;
use PDO;

/**
 * @template T
 */
final class SelectExecutor implements QueryExecutorInterface
{
    /**
     * @param clsss-string<T> $entity
     * @param mixed[] $schema
     */
    public function __construct(
        private readonly PDO $pdo,
        private readonly MapperInterface $mapper,
        private readonly GenericBuilder $builder,
        private readonly string $entity,
        private readonly string $tableName,
        private readonly array $schema
    ) {
    }

    public function createQuery(): QueryInterface
    {
        $select = $this->builder->select();
        $select->setTable($this->tableName)->setColumns($this->schema);

        return $select;
    }

    /**
     * @param PDO $pdo
     * @param QueryInterface $query
     * @return array<T>
     */
    public function execute(QueryInterface $query): array
    {
        $sql = $this->builder->writeFormatted($query);
        $values = $this->builder->getValues();

        $sth = $this->pdo->prepare($sql);
        $sth->execute($values);
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        if ($result === false) {
            return [];
        }

        return array_map(fn (array $row) => $this->mapper->__invoke($row, $this->entity), $result);
    }

}
