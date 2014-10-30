<?php

namespace Requisite\Test\Unit;
use Requisite\Rule;

class TestNamespaceDirectoryMap extends \PHPUnit_Framework_TestCase {

	public function testLoadClass() {

		$base_namespace = 'Requisite\Test';
		$base_dir       = __DIR__;
		$class          = '\Requisite\Test\Model\SampleClass';
		$file           = __DIR__ . '/Model/SampleClass.php';
		$mock_loader    = $this->getMockBuilder(
			'\Requisite\Loader\DefaultConditionalFileLoader'
		)->getMock();
		$mock_loader->expects( $this->any() )
			->method( 'loadFile' )
			->will(
				$this->returnCallback( function( $f ) use( $file ) {
					return $f === $file;
				} )
			);
		$testee = new Rule\NamespaceDirectoryMap( $base_dir, $base_namespace, $mock_loader );

		$this->assertTrue(
			$testee->loadClass( $class )
		);
	}
}
 