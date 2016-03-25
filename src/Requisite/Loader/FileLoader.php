<?php # -*- coding: utf-8 -*-

namespace Requisite\Loader;

/**
 * Interface FileLoader
 *
 * Loads a given file, if exists.
 *
 * @package Requisite\Loader
 */
interface FileLoader {

	/**
	 * @param string $file
	 *
	 * @return bool
	 */
	public function loadFile( $file );
}
