<?php # -*- coding: utf-8 -*-

namespace Requisite\Rule;

use
	Requisite\Loader;

/**
 * Class ClassMap
 *
 * @since 2.0.0
 * @package Requisite\Rule
 */
class ClassMap implements AutoLoadRule {

	/**
	 * @var array
	 */
	private $class_map;

	/**
	 * @var Loader\FileLoader
	 */
	private $loader;

	/**
	 * Class names must be provided as full-qualified class names (FQCN)
	 * without leading backslash. e.g. 'Requisite\Rule\ClassMap' => '/vendor/requisite/Rule/ClassName.php'
	 *
	 * @param array $class_map [ $FQCN => $file ]
	 * @param Loader\FileLoader $loader (Optional)
	 */
	public function __construct( array $class_map, Loader\FileLoader $loader = NULL ) {

		$this->class_map = $class_map;
		$this->loader    = $loader
			? $loader
			: new Loader\DefaultConditionalFileLoader;
	}

	/**
	 * @param string $class
	 *
	 * @return bool
	 */
	public function loadClass( $class ) {

		if ( ! isset( $this->class_map[ $class ] ) )
			return FALSE;

		return $this->loader->loadFile( $this->class_map[ $class ] );
	}
}
