# ![Kinedu](https://raw.githubusercontent.com/Kinedu/cfdi-pac/gh-pages/assets/img/logo.png)

[![Travis](https://img.shields.io/travis/Kinedu/cfdi-pac.svg?style=flat-square)](https://travis-ci.org/Kinedu/cfdi-pac)
[![StyleCI](https://styleci.io/repos/121293481/shield?branch=master)](https://styleci.io/repos/121293481)
[![Total Downloads](https://poser.pugx.org/kinedu/cfdi-pac/downloads?format=flat-square)](https://packagist.org/packages/kinedu/cfdi-pac)
[![License](https://img.shields.io/github/license/kinedu/cfdi-pac.svg?style=flat-square)](https://packagist.org/packages/kinedu/cfdi-pac)

## Instalación

Instalar el paquete mediante [Composer](https://getcomposer.org/).

```shell
composer require kinedu/cfdi-pac
```

## Uso
```php
use Kinedu\CfdiPac\PAC;

$username = 'Kinedu';
$password = '123456789A';
$xml      = file_get_contents('./K279101.xml');
$isTest   = true;

$pac = new PAC($username, $password, $xml, $isTest);
$pac->useInvoiceOne()
    ->save('./cfdi/K279101.xml');
```

Proveedores Autorizados disponibles:

PAC          | Método
------------ | -----------------
Invoice One  | `useInvoiceOne()`

## Licencia

CFDI PAC esta bajo la Licencia MIT, si quieres saber más al respecto puedes ver el archivo de [Licencia](LICENSE) que se encuentra en este mismo repositorio.
