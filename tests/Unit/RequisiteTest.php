<?php # -*- coding: utf-8 -*-

namespace Requisite\Test\Unit;

use
	Requisite,
	PHPUnit_Framework_TestCase;

/**
 * Class RequisiteTest
 *
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 *
 * @package Requisite\Test\Unit
 */
class RequisiteTest extends PHPUnit_Framework_TestCase {

	public static function setUpBeforeClass() {

		if ( ! class_exists( '\Requisite\Requisite' ) )
			require_once dirname( dirname( __DIR__ ) ) . '/src/Requisite/Requisite.php';
	}

	public function test_init() {

		$classes = array(
			'Loader\FileLoader',
			'Loader\DefaultConditionalFileLoader',
			'Loader\DirectoryCacheFileLoader',
			'Rule\AutoLoadRule',
			'Rule\Psr4',
			'Rule\ClassMap',
			'Rule\NamespaceDirectoryMapper',
			'AutoLoader',
			'SplAutoLoader'
		);
		$base_dir = dirname( dirname( __DIR__ ) ) . '/src/Requisite';
		$base_ns = '\Requisite\\';

		//check if no class exists here
		foreach ( $classes as $class ) {
			if ( class_exists( $base_ns . $class ) )
				$this->markTestSkipped( 'Class "' . $class .'" is already loaded!' );
		}

		Requisite\Requisite::init( $base_dir );

		foreach ( $classes as $class ) {
			$this->assertTrue(
				class_exists( $base_ns . $class ) || interface_exists( $base_ns . $class ),
				'Class/Interface: ' . $base_ns . $class
			);
		}
	}
}
