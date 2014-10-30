<?php
/**
 * Mapping a namespace structure to a directory structure
 */

namespace Requisite\Rule;
use Requisite\Loader;

class NamespaceDirectoryMap implements AutoLoadRuleInterface {

	/**
	 * @type Loader\FileLoaderInterface
	 */
	private $file_loader;

	/**
	 * @type string
	 */
	private $base_ns;

	/**
	 * @type string
	 */
	private $base_dir;

	/**
	 * @param string $base_dir
	 * @param string $base_ns
	 */
	function __construct( $base_dir, $base_ns = '', Loader\FileLoaderInterface $file_loader = NULL ) {

		$this->base_dir = (string) $base_dir;
		$base_ns  = trim( $base_ns, '\\ ' );
		$base_ns = '\\' . $base_ns . '\\';

		$this->base_ns = $base_ns;

		if ( ! $file_loader )
			$this->file_loader = new Loader\DirectoryCacheFileLoader( $this->base_dir );
		else
			$this->file_loader = $file_loader;
	}

	/**
	 * @param string $class
	 * @return bool
	 */
	public function loadClass( $class ) {

		// check if the namespace matches the class
		if ( 0 !== strpos( $class, $this->base_ns ) )
			return FALSE;

		$class = str_replace( $this->base_ns, '', $class );
		$class = ltrim( $class, '\\' );
		$class = str_replace( '\\', '/', $class );
		$file = $this->base_dir . '/' . $class . '.php';

		return $this->file_loader->loadFile( $file );
	}

}