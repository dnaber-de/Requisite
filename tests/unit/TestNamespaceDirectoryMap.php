<?php

namespace Requisite\Test\Unit;
use Requisite\Rule;

class TestNamespaceDirectoryMap extends \PHPUnit_Framework_TestCase {

	public function testLoadClass() {

		$base_namespace = 'Requisite\Test';
		$base_dir       = __DIR__;
		$class          = '\Requisite\Test\Model\SampleClass';
		$file           = __DIR__ . '/Model/SampleClass.php';
		$mock_loader = $this->getMock( '\Requisite\Loader\DefaultConditionalFileLoader' );
		$mock_loader->expects( $this->once() )
			->method( 'loadClass' )
			->with( $this->equalTo( $file ) )
			->willReturn( TRUE );

		$testee = new Rule\NamespaceDirectoryMap( $base_dir, $base_namespace, $mock_loader );

		//$this->markTestIncomplete( 'Todo' );
		$this->assertTrue(
			$testee->loadClass( $class )
		);
	}
}
 