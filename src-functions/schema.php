<?php

declare(strict_types=1);

namespace Helicon\Db\Functions;

function schemaToColumn(array $schema, bool $snakelize = true): array
{
    $snakelizer = static fn ($string) => strtolower(ltrim(preg_replace('/[A-Z]/', '_\0', $string), '_'));
    return array_map(static fn ($columnName) => $snakelize ? $snakelizer($columnName) : $columnName, array_keys($schema));
}
