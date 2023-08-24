<?php

declare(strict_types=1);

namespace Helicon\Db;

use Helicon\Db\Query\SelectExecutor;
use Helicon\Db\Query\QueryExecutorInterface;
use Helicon\ObjectMapper\MapperInterface;
use Helicon\ObjectTypeParser\ParserInterface;
use NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder;

use function Helicon\Db\Functions\classToTableName;

final class HeliconDb implements DbInterface
{
    public function __construct(
        private readonly \PDO $pdo,
        private readonly MapperInterface $mapper,
        private readonly ParserInterface $parser
    ) {
    }

    public function select(string $entity, ?string $tableName = null): QueryExecutorInterface
    {
        $schema = $this->parser->__invoke($entity);
        if ($tableName === null) {
            $tableName = classToTableName($entity);
        }
        return new SelectExecutor($this->pdo, $this->mapper, new GenericBuilder(), $entity, $tableName, $schema);
    }
}
