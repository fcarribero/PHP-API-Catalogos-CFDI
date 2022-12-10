<?php

use Advans\Api\CatalogosCFDI\CustomWhere;

require __DIR__ . '/../vendor/autoload.php';

$config = new \Advans\Api\CatalogosCFDI\Config([
    'base_url' => $argv[1],
    'key' => $argv[2]
]);

$catalogos = new \Advans\Api\CatalogosCFDI\CatalogosCFDI($config);

$item = $catalogos->getItem('c_CodigoPostal', '97000', '2022-01-01');

var_dump($item);

$item = $catalogos->getItem('c_CodigoPostal', new CustomWhere('value="9700"'));

var_dump($item);

$exists = $catalogos->exists('c_CodigoPostal', '97000', '2022-01-01');

var_Dump($exists);
