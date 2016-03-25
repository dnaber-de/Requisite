<?php # -*- coding: utf-8 -*-

namespace Requisite\Test\Unit\Rule;

use
	Requisite\Test\TestCase,
	Requisite\Rule;

/**
 * Class NamespaceDirectoryMapperTest
 *
 * @package Requisite\Test\Unit
 */
class NamespaceDirectoryMapperTest extends TestCase\BootstrapedTestCase {

	public function setUp() {

		$this->maybeBootstrap();
	}

	/**
	 * @dataProvider namespaceDirectoryProvider
	 * @param string $base_ns
	 * @param string $base_dir
	 * @param string $class
	 * @param string $expected_file
	 */
	public function testLoadClass( $base_ns, $base_dir, $class, $expected_file ) {

		$mock_loader = $this
			->getMockBuilder( '\Requisite\Loader\DefaultConditionalFileLoader' )
			->getMock();
		$loadFile_expectation = empty( $expected_file )
			? $this->never()
			: $this->atLeast( 1 );
		$mock_loader->expects( $loadFile_expectation )
			->method( 'loadFile' )
			->will(
				$this->returnCallback( function( $file ) use( $expected_file ) {
					/**
					 * the test will fail if FALSE is returned here
					 */
					return $file === $expected_file;
				} )
			);
		$testee = new Rule\NamespaceDirectoryMapper( $base_dir, $base_ns, $mock_loader );

		// load class will return true, if the class could actually mapped
		$this->assertSame(
			! empty( $expected_file ),
			$testee->loadClass( $class )
		);
	}

	/**
	 * dataProvider for NamespaceDirectoryMapperTest::testLoadClass()
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
			),
			// try base pathes with trailing slash
			array(
				'Requisite\Test',
				'/var/www/php/',
				'\Requisite\Test\Model\SampleClass',
				'/var/www/php/Model/SampleClass.php'
			),
			// try absolute namespace
			array(
				'\Requisite\Test',
				'/var/www/php/',
				'\Requisite\Test\Model\SampleClass',
				'/var/www/php/Model/SampleClass.php'
			),
			// try global namespace
			array(
				'',
				'/var/www/php',
				'\Psr\Logger\LoggerInterface',
				'/var/www/php/Psr/Logger/LoggerInterface.php'
			),
			// try non matching namespace
			array(
				'Symfony\Component',
				'/var/www/php',
				'\Psr\Logger\LoggerInterface',
				'', // means the rule cannot resolve the class name
			),
			// try non matching namespace
			array(
				'\Foo\Bar\\',
				'/var/www/php/',
				'\Foo\Bazz',
				'', // means the rule cannot resolve the class name
			)
		);
	}
}
