# Requisite – a modular, extensible PHP autoloader

Inspired by [Tom Buttler](https://r.je/) and [Thomas Scholz](http://toscho.de).

This library requires PHP version `5.5.0`. If you're looking for older support, use the `1.0` release branch,
that still supports PHP `5.3.0`.

## Concept
The main idea behind this autoloader is the separation of the file locating (`Requisite\Rule`) and file loading
(`Requisite\Loader`) process.

One can register several rules on a main autoloader instance of `Requisite\SplAutoloader`. The included rule
`Rule\NamespaceDiretoryMapper` matches namespaces to directory names (which actually implements Psr-4).

### Rules

**Psr4**  
Maps namespaces to filesystem directories relative to a base directory and base namespace as
described in [Psr-4](http://www.php-fig.org/psr/psr-4/).

**ClassMap**  
Provides a static map of full qualified class names to file names.

## Usage examples

```php

/**
 * Load the Requisite library. Alternatively you can use composer's
 * autoloader via include vendor/autoload.php
 */
require_once 'src/Requisite/Requisite.php';
Requisite\Requisite::init();

$autoloader = new Requisite\SplAutoLoader;
//load the Monolog lib from the vendor/Monolog directory
$autoloader->addRule(
	new Requisite\Rule\Psr4(
		__DIR__ . '/vendor/Monolog', // base directory
		'Monolog'                    // base namespace
	)
);
// configure a ClassMap
$autoloader->addRule(
	new Requisite\Rule\ClassMap(
		[
			'Foo\Bar'  => '/vendor/package/src/Foo/Bar.php',
			'Foo\Bazz' => '/vendor/package/src/Foo/Bazz.php'
		]
	)
);
```

## Roadmap

 See [issues labeled with »enhancement«](https://github.com/dnaber-de/Requisite/issues?q=is%3Aissue+is%3Aopen+label%3Aenhancement)
