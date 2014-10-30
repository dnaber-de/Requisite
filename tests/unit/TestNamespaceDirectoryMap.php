<?php

namespace Requisite\Test\Unit;
use Requisite\Rule;

class TestNamespaceDirectoryMap extends \PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider namespaceDirectoryProvider
	 * @param string $base_ns
	 * @param string $base_dir
	 * @param string $class
	 * @param string $expected_file
	 */
	public function testLoadClass( $base_ns, $base_dir, $class, $expected_file ) {

		$mock_loader    = $this->getMockBuilder(
			'\Requisite\Loader\DefaultConditionalFileLoader'
		)->getMock();
		$mock_loader->expects( $this->any() )
			->method( 'loadFile' )
			->will(
				$this->returnCallback( function( $file ) use( $expected_file ) {
					return $file === $expected_file;
				} )
			);
		$testee = new Rule\NamespaceDirectoryMap( $base_dir, $base_ns, $mock_loader );

		$this->assertTrue(
			$testee->loadClass( $class )
		);
	}

	/**
	 * dataProvider for TestNamespaceDirectoryMap::testLoadClass()
	 *
	 * @return array
	 */
	public function namespaceDirectoryProvider() {

		return array(
			array(
				'Requisite\Test',                    // base namespace
				__DIR__,                             // base dir
				'\Requisite\Test\Model\SampleClass', // class to load
				__DIR__ . '/Model/SampleClass.php'   // expected resolved filename
			)
		);
	}
}
 