<?php

declare(strict_types=1);

namespace Helicon\Db\Query;

use NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder;
use NilPortugues\Sql\QueryBuilder\Manipulation\QueryInterface;

interface QueryExecutorInterface
{
    public function createQueryBuilder(): GenericBuilder;

    public function execute(QueryInterface $query): array;
}
