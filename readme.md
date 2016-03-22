# Requisite – a modular, extensible PHP autoloader

Inspired by [Tom Buttler](https://r.je/) and [Thomas Scholz](http://toscho.de).

## Concept
The main idea behind this autoloader is the separation of the file locating (`Requisite\Rule`) and file loading
(`Requisite\Loader`) process.

One can register several rules on a main autoloader instance of `Requisite\SPLAutoloader`. The included rule
`Rule\NamespaceDiretoryMapper` matches namespaces to directory names (which actually implements Psr-4).

## Usage examples

```php

// init Requisite
require_once 'src/Requisite/Requisite.php';
Requisite\Requisite::init();

$autoloader = new Requisite\SPLAutoLoader;
//load the Monolog lib from the vendor/Monolog directory
$autoloader->addRule(
	new Requisite\Rule\NamespaeDirectoryMapper(
		__DIR__ . '/vendor/Monolog',
		'Monolog'
	)
);
```

## Roadmap

 See [issues labeled with »enhancement«](https://github.com/dnaber-de/Requisite/issues?q=is%3Aissue+is%3Aopen+label%3Aenhancement)