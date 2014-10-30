<?php
/**
 * Unit test for \Requisite\Loader\DefaultConditionalFileLoader
 */

namespace Requisite\Test\Unit;
use \Requisite\Test\TestCase;
use \Requisite\Loader;

class TestDefaultConditionalFileLoader extends TestCase\BootstrapedTestCase {

	/**
	 * @type Loader\DefaultConditionalFileLoader
	 */
	private $testee;

	public function setUp() {

		$this->maybeBootstrap();
		$this->testee = new Loader\DefaultConditionalFileLoader;
	}

	public function testLoadFile() {

		$testfile = dirname( __DIR__ ) . '/Samples/LoadMe.php';

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
 