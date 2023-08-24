<?php

declare(strict_types=1);

namespace Helicon\Db\Functions;

function classToTableName(string $class): string
{
    $class_parts = explode('\\', get_class());
    echo end($class_parts);
}
