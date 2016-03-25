<?php # -*- coding: utf-8 -*-

namespace Requisite\Test\Unit;

use
	Requisite\Rule,
	Requisite\Test\TestCase;

/**
 * Class Psr4Test
 *
 * @package Requisite\Test\Unit
 */
class Psr4Test extends TestCase\BootstrapedTestCase {

	public function setUp() {

		parent::setUp();
		$this->maybeBootstrap();
	}

	/**
	 * @dataProvider loadClassProvider
	 *
	 * @param array $data
	 */
	public function testLoadClass( array $data ) {

		$loader_mock = $this->getMockBuilder( '\Requisite\Loader\DefaultConditionalFileLoader' )
			->getMock();

		$loader_mock
			->expects( $this->atLeast( 1 ) )
			->method( 'loadFile' )
			->with( $data[ 'file' ] )
			->willReturn( TRUE );

		$testee = new Rule\Psr4(
			$data[ 'base_directory' ],
			$data[ 'base_namespace' ],
			$loader_mock
		);

		$this->assertTrue(
			$testee->loadClass( $data[ 'class' ] )
		);
	}

	/**
	 * @see testLoadClass()
	 * @return array
	 */
	public function loadClassProvider() {

		$data = array();

		$data[ 'test_1' ] = array(
			array(
				'base_namespace' => 'Foo\\Bar\\',
				'base_directory' => '/vendor/foo.bar/src',
				'class'          => 'Foo\\Bar\\ClassName',
				'file'           => '/vendor/foo.bar/src/ClassName.php'
			)
		);

		$data[ 'test_2' ] = array(
			array(
				'base_namespace' => 'Foo\Bar',
				'base_directory' => '/vendor/foo.bar/src',
				'class'          => 'Foo\Bar\DoomClassName',
				'file'           => '/vendor/foo.bar/src/DoomClassName.php'
			)
		);

		$data[ 'test_3' ] = array(
			array(
				'base_namespace' => 'Foo\Bar',
				'base_directory' => '/vendor/foo.bar/tests',
				'class'          => 'Foo\Bar\ClassNameTest',
				'file'           => '/vendor/foo.bar/tests/ClassNameTest.php'
			)
		);

		$data[ 'test_4' ] = array(
			array(
				'base_namespace' => 'Foo\Bar\Baz\Dib\Zim\Gir',
				'base_directory' => '/vendor/foo.bar.baz.dib.zim.gir/src',
				'class'          => 'Foo\Bar\Baz\Dib\Zim\Gir\ClassName',
				'file'           => '/vendor/foo.bar.baz.dib.zim.gir/src/ClassName.php'
			)
		);

		return $data;
	}
}
