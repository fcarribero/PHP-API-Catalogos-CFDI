<?php

use Advans\Api\CatalogosCFDI\CustomWhere;

require __DIR__ . '/../vendor/autoload.php';

$config = new \Advans\Api\CatalogosCFDI\Config([
    'base_url' => $argv[1],
    'key' => $argv[2]
]);

$catalogos = new \Advans\Api\CatalogosCFDI\CatalogosCFDI($config);

$items = $catalogos->getItemList('c_Impuesto', ['traslado=:value', ['value' => 'Si']]);

var_dump($items);
