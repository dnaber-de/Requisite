<?php # -*- coding: utf-8 -*-

namespace Requisite\Rule;

/**
 * Interface AutoLoadRule
 *
 * AutoLoad rules are responsible to locate concrete files by a given,
 * fully qualified class names and load this class, if exists.
 * In a typical Requisite implementation they use Instances of
 * Requisite\Loader\FileLoader for that.
 *
 * @package Requisite\Rule
 */
interface AutoLoadRule {

	/**
	 * @param string $class
	 * @return bool
	 */
	public function loadClass( $class );
}
