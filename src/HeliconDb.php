<?php

declare(strict_types=1);

namespace Helicon\Db;

use Helicon\Db\Query\SelectExecutor;
use Helicon\Db\Query\QueryExecutorInterface;
use Helicon\ObjectMapper\MapperInterface;
use Helicon\ObjectMapper\ObjectMapperFactory;
use Helicon\ObjectTypeParser\Parser;
use Helicon\ObjectTypeParser\ParserInterface;
use NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder;

use function Helicon\Db\Functions\classToTableName;
use function Helicon\Db\Functions\schemaToColumn;

final readonly class HeliconDb implements DbInterface
{
    public function __construct(
        private \PDO            $pdo,
        private MapperInterface $mapper,
        private ParserInterface $parser
    ) {
    }

    public function select(string $entity, ?string $tableName = null): QueryExecutorInterface
    {
        $schema = schemaToColumn(($this->parser)($entity));
        if ($tableName === null) {
            $tableName = classToTableName($entity);
        }
        return new SelectExecutor(
            $this->pdo,
            $this->mapper,
            new GenericBuilder(),
            $entity,
            $tableName,
            $schema
        );
    }

    public static function create(string $dsn, string $user, string $password): self
    {
        return new self(new \PDO($dsn, $user, $password), (new ObjectMapperFactory())(), new Parser());
    }
}
