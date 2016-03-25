<?php # -*- coding: utf-8 -*-

namespace Requisite\Test\Unit;

use
	Requisite\Test\TestCase,
	Requisite;

/**
 * Class SplAutoLoaderTest
 *
 * @package Requisite\Test\Unit
 */
class SplAutoLoaderTest extends TestCase\BootstrapedTestCase {

	/**
	 * @type Requisite\SplAutoLoader
	 */
	private $testee;

	/**
	 * set the object before each test
	 */
	public function setUp() {

		$this->maybeBootstrap();
		$this->testee = new Requisite\SplAutoLoader;
	}

	/**
	 * test the correct appending to the spl stack
	 */
	public function testAppendConstructor() {

		$callbacks = spl_autoload_functions();
		$callback = current( $callbacks );
		$this->checkCallback( $callback, $this->testee, 'load' );
	}

	/**
	 * test the correct appending to the spl stack
	 */
	public function testPrependConstructor() {

		$testee = new Requisite\SplAutoLoader( FALSE );
		$callbacks = spl_autoload_functions();
		$callback = array_pop( $callbacks );
		$this->checkCallback( $callback, $testee, 'load' );

		$testee->unregister();
	}

	/**
	 * test the unregistration
	 */
	public function testUnregister() {

		$this->testee->unregister();
		// bring up a second instance in the stack to be
		// sure the instance-comparison is correct
		$testee = new Requisite\SplAutoLoader;
		$this->checkNotExist( spl_autoload_functions(), $this->testee );

		$testee->unregister();
		$this->checkNotExist( spl_autoload_functions(), $testee );
	}

	/**
	 * check the spl stack for non-existing of the testee
	 *
	 * @param array $spl_stack
	 * @param Requisite\SplAutoLoader $testee,
	 * @param string $class
	 */
	public function checkNotExist( $spl_stack, Requisite\SplAutoLoader $testee = NULL, $class = '' ) {

		foreach ( (array) $spl_stack as $callback ) {
			if ( is_array( $callback ) && is_object( $callback[ 0 ] ) )
				if ( $testee )
					$this->assertFalse( $callback[ 0 ] === $testee  );
				else
					$this->assertFalse( is_a( $callback[ 0 ], $class ) );
		}
	}

	/**
	 * compares the callback from spl_autoload_functions list
	 * with the correct class and method
	 *
	 * @param array $callback
	 * @param Requisite\SplAutoLoader $testee
	 * @param string $method
	 */

	public function checkCallback( $callback, Requisite\SplAutoLoader $testee, $method ) {

		$this->assertTrue(
			is_array( $callback )
		);
		$this->assertTrue(
			is_a( $callback[ 0 ], get_class( $testee ) )
		);
		$this->assertEquals(
			$method,
			$callback[ 1 ]
		);
	}
	/**
	 * unregister the before tested instance
	 */
	public function tearDown() {

		$this->testee->unregister();
	}
}
