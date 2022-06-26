<?php

include dirname(__DIR__, 2). "/vendor/autoload.php";
include  __DIR__ . '/core/Components/Builder/QueryBuilder.php';

$builder = new \core\Components\Builder\QueryBuilder();
$query = $builder->table('users')->select(['first_name', 'age'])->build();

echo (string) $query;
