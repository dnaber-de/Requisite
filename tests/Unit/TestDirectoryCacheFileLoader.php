<?php


namespace Requisite\Test\Unit;
use \Requisite\Test\TestCase;
use Requisite\Loader;

class TestDirectoryCacheFileLoader extends TestCase\BootstrapedTestCase {

	/**
	 * @type Loader\DirectoryCacheFileLoader
	 */
	private $testee;

	/**
	 * @type string
	 */
	private $test_dir;

	/**
	 * @type array
	 */
	private $test_files;

	/**
	 * @type string
	 */
	private $extension;

	public function setUp() {

		$this->maybeBootstrap();
		$this->test_dir = dirname( __DIR__ ) . '/samples';
		$this->extension = '.php';

		$this->testee = new Loader\DirectoryCacheFileLoader(
			$this->test_dir,
			$this->extension
		);

		$basedir = $this->test_dir . '/';
		$test_files = array(
			'LoadMe',
			'Example/FrontController',
			'Example/Domain/Model',
			'Example/Domain/Subdomain/Repository'
		);

		foreach ( $test_files as $file )
			$this->test_files[] = $basedir . $file . $this->extension;
	}

	public function testReadDirRecursive() {

		$pattern = '*' . $this->extension;
		$files = $this->testee->readDirRecursive( $this->test_dir, $pattern );

		foreach ( $this->test_files as $file )
			$this->assertTrue( in_array( $file, $files ) );
	}

	public function tearDown() {

		unset( $this->testee );
	}
}
 