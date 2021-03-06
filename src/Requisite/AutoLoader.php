<?php # -*- coding: utf-8 -*-

namespace Requisite;

/**
 * Interface AutoLoader
 *
 * @package Requisite
 */
interface AutoLoader {

	/**
	 * @param Rule\AutoLoadRule $rule
	 *
	 * @return void
	 */
	public function addRule( Rule\AutoLoadRule $rule );
}
