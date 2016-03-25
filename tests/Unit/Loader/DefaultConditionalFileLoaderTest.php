<?php # -*- coding: utf-8 -*-

namespace Requisite\Test\Unit\Loader;

use
	Requisite\Test\TestCase,
	Requisite\Loader;

/**
 * Class DefaultConditionalFileLoaderTest
 *
 * @package Requisite\Test\Unit
 */
class DefaultConditionalFileLoaderTest extends TestCase\BootstrapedTestCase {

	/**
	 * @type Loader\DefaultConditionalFileLoader
	 */
	private $testee;

	public function setUp() {

		$this->maybeBootstrap();
		$this->testee = new Loader\DefaultConditionalFileLoader;
	}

	public function testLoadFile() {

		$testfile = self::testDir() . '/Samples/LoadMe.php';

		$this->assertTrue(
			$this->testee->loadFile( $testfile )
		);
		$this->assertTrue(
			defined( '\Requisite\Test\TESTFILE_LOADED' )
		);
	}

	public function tearDown() {

		unset( $this->testee );
	}
}
