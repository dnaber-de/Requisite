<?php # -*- coding: utf-8 -*-

namespace Requisite\Test\Unit;

use
	Requisite,
	PHPUnit_Framework_TestCase;

/**
 * Class TestRequisite
 *
 * @package Requisite\Test\Unit
 */
class TestRequisite extends PHPUnit_Framework_TestCase {

	public static function setUpBeforeClass() {

		if ( ! class_exists( '\Requisite\Requisite' ) )
			require_once dirname( dirname( __DIR__ ) ) . '/src/Requisite/Requisite.php';
	}

	public function test_init() {

		$classes = array(
			'Loader\FileLoaderInterface',
			'Loader\DefaultConditionalFileLoader',
			'Loader\DirectoryCacheFileLoader',
			'Rule\AutoLoadRuleInterface',
			'Rule\NamespaceDirectoryMapper',
			'AutoLoaderInterface',
			'SPLAutoLoader'
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
				class_exists( $base_ns . $class ) ||  interface_exists( $base_ns . $class ),
				'Class/Interface: ' . $base_ns . $class
			);
		}
	}
}
