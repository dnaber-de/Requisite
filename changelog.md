# Requisite

## 2.0.0-development
 * Drop PHP 5.3 support. At least PHP 5.5.0 is required
 * Rename `Requisite\AutoLoaderInterface` to `Requisite\AutoLoader`
 * Rename `Requisite\Loader\FileLoaderInterface` to `Requisite\Loader\FileLoader`
 * Rename `Requisite\Rule\AutoLoadRuleInterface` to `Requisite\Rule\AutoLoadRule`
 * Introduce `Requisite\Rule\ClassMap`
 * Rename `Requisite\SPLAutoLoader` to `Requisite\SplAutoLoader`

## 1.0.0
 * Introducing `Rule\Psr4`
 * Improving tests
 * Supports PHP 5.3

## 0.9.0

 * First (pre-)release
 * Providing all Interfaces for Loader and Rules 
 * Psr4 implementation as `NamespaceDirectoryMapper`
