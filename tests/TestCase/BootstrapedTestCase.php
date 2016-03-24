<?php # -*- coding: utf-8 -*-

namespace Requisite\Test\TestCase;

/**
 * Class BootstrapedTestCase
 *
 * @package Requisite\Test\TestCase
 */
class BootstrapedTestCase extends \PHPUnit_Framework_TestCase {

	private static $bootstraped = FALSE;

	/**
	 * this function is necessary to separate the
	 * loading of classes from the initial bootstrap process.
	 *
	 * testing a self-loader for Requisite will only be possible if
	 * these classes are not loaded by default
	 */
	public function maybeBootstrap() {

		if ( ! self::$bootstraped ) {
			$classes = array(
				'Loader/FileLoaderInterface.php',
				'Loader/DefaultConditionalFileLoader.php',
				'Loader/DirectoryCacheFileLoader.php',
				'Rule/AutoLoadRuleInterface.php',
				'Rule/Psr4.php',
				'Rule/NamespaceDirectoryMapper.php',
				'AutoLoaderInterface.php',
				'SPLAutoLoader.php'
			);
			foreach ( $classes as $class ) {
				require_once dirname( dirname( __DIR__ ) ) . '/src/Requisite/' . $class;
			}
			self::$bootstraped = TRUE;
		}
	}
}
