# advans/php-api-catalogos-cfdi

[![Latest Stable Version](https://img.shields.io/packagist/v/advans/php-api-catalogos-cfdi?style=flat-square)](https://packagist.org/packages/advans/php-api-catalogos-cfdi)
[![Total Downloads](https://img.shields.io/packagist/dt/advans/php-api-catalogos-cfdi?style=flat-square)](https://packagist.org/packages/advans/php-api-catalogos-cfdi)

## Instalación usando Composer

```sh
$ composer require advans/php-api-catalogos-cfdi
```

## Ejemplo

````
$config = new \Advans\Api\CatalogosCFDI\Config([
    'base_url' => '**************************',
    'key' => '**********************'
]);

$servicio = new \Advans\Api\CatalogosCFDI\CatalogosCFDI($config);

$item = $servicio->getItem('c_CodigoPostal', '97000', '2022-01-01');

````

## Configuración

| Parámetro | Valor por defecto | Descripción |
| :--- | :--- | :--- |
| base_url | null | URL de la API |
| key | null | API Key |

