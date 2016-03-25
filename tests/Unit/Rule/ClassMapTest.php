<?php # -*- coding: utf-8 -*-

namespace Requisite\Test\Unit\Rule;

use
	Requisite\Rule,
	Requisite\Loader,
	Requisite\Test;

/**
 * Class ClassMapTest
 *
 * @since 2.0.0
 * @package Requisite\Test\Unit\Rule
 */
class ClassMapTest extends Test\TestCase\BootstrapedTestCase {

	public function setUp() {

		self::maybeBootstrap();
		parent::setUp();
	}

	/**
	 * @dataProvider loadClassData
	 *
	 * @param array $class_map
	 * @param string $class
	 * @param string $file
	 */
	public function testLoadClass( array $class_map, $class, $file ) {

		$loader_mock = $this
			->getMockBuilder( Loader\FileLoader::class )
			->getMock();
		$loader_mock->method( 'loadFile' )
			->with( $file )
			->willReturn( TRUE );

		$testee = new Rule\ClassMap( $class_map, $loader_mock );
		$this->assertTrue(
			$testee->loadClass( $class )
		);
	}

	/**
	 * @see testLoadClass
	 */
	public function loadClassData() {

		$data      = [ ];
		$class_map = [
			'Foo\Bar\ClassName'                 => '/dir/vendor/package/src/Foo/Bar/ClassName.class.php',
			'Foo\\Bazz\\Class'                  => '/dir/vendor/package.copy/src/Foo/Bazz/Class.inc.php',
			'Foo\Bar\Baz\Dib\Zim\Gir\ClassName' => '/vendor/foo.bar.baz.dib.zim.gir/src/ClassName.php',
			'Requisite\\Loader\\ClassMap'       => '/vendor/dnaber/requisite/Loader/ClassMap.php',
			'PHPUnit_TestCase'                  => '/opt/phpunit/TestCase.php'
		];

		foreach ( $class_map as $class => $file ) {
			$test_name          = str_replace( '\\', '_', $class );
			$data[ $test_name ] = [
				# 1.Parameter $class_map
				$class_map,
				# 2. Parameter $class
				$class,
				# 3. Parameter $file
				$file
			];
		}

		return $data;
	}

	/**
	 * @dataProvider loadClassNoMatchingClassData
	 *
	 * @param array $class_map
	 * @param string $class
	 */
	public function testLoadClassNoMatchingClass( array $class_map, $class ) {

		$loader_mock = $this
			->getMockBuilder( Loader\FileLoader::class )
			->getMock();
		$loader_mock->expects( $this->never() )
			->method( 'loadFile' );

		$testee = new Rule\ClassMap( $class_map, $loader_mock );

		$this->assertFalse(
			$testee->loadClass( $class )
		);
	}

	/**
	 * @see testLoadClassNoMatchingClass
	 */
	public function loadClassNoMatchingClassData() {

		$data      = [ ];
		$class_map = [
			'Foo\Bar\ClassName',
			'Foo\Bazz\Class',
			'Foo\Bar\Baz\Dib\Zim\Gir\ClassName',
			'Requisite\Loader\ClassMap',
			'PHPUnit_TestCase'
		];

		$data[ 'test_1' ] = [
			# 1. Parameter $class_map
			$class_map,
			# 2. Parameter $class
			'Some\Class'
		];

		$data[ 'test_2' ] = [
			# 1. Parameter $class_map
			$class_map,
			# 2. Parameter $class
			'Some\OtherClass'
		];

		$data[ 'test_3' ] = [
			# 1. Parameter $class_map
			$class_map,
			# 2. Parameter $class
			'PHPUnit_Framework_MockObject_Invocation'
		];

		$data[ 'test_4' ] = [
			# 1. Parameter $class_map
			$class_map,
			# 2. Parameter $class
			'Requisite\Loader\ClassMaps' // note the 's' at the end
		];

		return $data;
	}
}
