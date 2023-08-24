<?php

declare(strict_types=1);

namespace Helicon\Db\Functions;

function classToTableName(string $class): string
{
    $names = explode('\\', $class);
    return strtolower(array_pop($names));
}
