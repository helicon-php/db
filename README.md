# Helicon/Db

A Database Object mapping library for PHP.

## How To Use

```php
<?php

use Helicon\Db\HeliconDb;

require __DIR__ . '/vendor/autoload.php';

class User {
    public readonly int $id;

    public readonly string $email;
    public readonly string $name;
}

$heliconDb = HeliconDb::create('mysql:host=127.0.0.1;port=3307;dbname=helicon', 'docker', 'docker');

$selectTarget = $heliconDb->select(User::class);
$query = $selectTarget->createQuery()->where()->equals('id', 1)->end();

$users = $selectTarget->execute($query);
var_dump($users);

```
