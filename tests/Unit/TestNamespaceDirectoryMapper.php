<?php

namespace Requisite\Test\Unit;
use \Requisite\Test\TestCase;
use Requisite\Rule;

class TestNamespaceDirectoryMapper extends TestCase\BootstrapedTestCase {

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
		$testee = new Rule\NamespaceDirectoryMapper( $base_dir, $base_ns, $mock_loader );

		if ( ! empty( $expected_file ) ) {
			$this->assertTrue(
				$testee->loadClass( $class )
			);
		} else {
			$this->assertFalse(
				$testee->loadClass( $class )
			);
		}
	}

	/**
	 * dataProvider for TestNamespaceDirectoryMapper::testLoadClass()
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
				'', // will lead to an assertFalse() assertion
			),
			// try non matching namespace
			array(
				'\Foo\Bar\\',
				'/var/www/php/',
				'\Foo\Bazz',
				'', // will lead to an assertFalse() assertion
			)
		);
	}
}