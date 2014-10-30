<?php
/**
 * Unit test for \Requisite\Loader\DefaultConditionalFileLoader
 */

namespace Requisite\Test\Unit;
use \Requisite\Loader;

class TestDefaultConditionalFileLoader extends \PHPUnit_Framework_TestCase {

	/**
	 * @type Loader\DefaultConditionalFileLoader
	 */
	private $testee;

	public function setUp() {

		$this->testee = new Loader\DefaultConditionalFileLoader;
	}

	public function testLoadFile() {

		$testfile = dirname( __DIR__ ) . '/samples/LoadMe.php';

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
 