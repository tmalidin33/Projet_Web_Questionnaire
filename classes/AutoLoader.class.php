<?php
// Load my root class
require_once(__ROOT_DIR . '/classes/MyObject.class.php');

class AutoLoader extends MyObject {

	public function __construct() {
		spl_autoload_register(array($this, 'load'));
	}
	// This method will be automatically executed by PHP whenever it encounters
	// an unknown class name in the source code
	private function load($className) {
	// TODO
		$folders = ['classes', 'model', 'controller', 'view'];
		foreach ($folders as $f) {
			if(is_readable(__ROOT_DIR.'/'.$f.'/'.ucfirst($className).'.class.php'))
			{
				require_once(__ROOT_DIR.'/'.$f.'/'.ucfirst($className).'.class.php');
				// echo 'AutoLoader /'.$f.'/'.ucfirst($className).'.class.php<br>';
			}
		}
	}
}

$__LOADER = new AutoLoader();

?>
