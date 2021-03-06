<?php # -*- coding: utf-8 -*-

namespace Requisite\Test\TestCase;

/**
 * Class BootstrapedTestCase
 *
 * @package Requisite\Test\TestCase
 */
class BootstrapedTestCase extends \PHPUnit_Framework_TestCase {

	/**
	 * @var bool
	 */
	private static $bootstraped = FALSE;

	/**
	 * @var string
	 */
	private static $testDir;

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
				'Loader/FileLoader.php',
				'Loader/DefaultConditionalFileLoader.php',
				'Loader/DirectoryCacheFileLoader.php',
				'Rule/AutoLoadRule.php',
				'Rule/Psr4.php',
				'Rule/ClassMap.php',
				'Rule/NamespaceDirectoryMapper.php',
				'AutoLoader.php',
				'SplAutoLoader.php'
			);
			foreach ( $classes as $class ) {
				require_once dirname( dirname( __DIR__ ) ) . '/src/Requisite/' . $class;
			}
			self::$bootstraped = TRUE;
		}
	}

	/**
	 * @return string
	 */
	public static function testDir() {

		if ( ! self::$testDir ) {
			self::$testDir = dirname( __DIR__ );
		}

		return self::$testDir;
	}
}
