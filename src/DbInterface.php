<?php

declare(strict_types=1);

namespace Helicon\Db;

use Helicon\Db\Query\QueryExecutorInterface;

interface DbInterface
{
    /**
     * @param class-string $entity
     */
    public function select(string $entity, ?string $tableName = null): QueryExecutorInterface;
}
