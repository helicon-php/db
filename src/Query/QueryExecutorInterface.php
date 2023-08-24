<?php

declare(strict_types=1);

namespace Helicon\Db\Query;

use NilPortugues\Sql\QueryBuilder\Manipulation\QueryInterface;

interface QueryExecutorInterface
{
    public function createQuery(): QueryInterface;

    public function execute(QueryInterface $query): array;
}
