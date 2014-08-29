<?php

$classes = array(
	'Loader/FileLoaderInterface.php',
	'Loader/DefaultConditionalFileLoader.php',
	'Loader/DirectoryCacheFileLoader.php',
	'Rule/AutoLoadRuleInterface.php',
	'Rule/NamespaceDirectoryMap.php',
	'AutoLoaderInterface.php',
	'SPLAutoLoader.php'
);
foreach ( $classes as $class ) {
	require_once dirname( __DIR__ ) . '/src/Requisite/' . $class;
}