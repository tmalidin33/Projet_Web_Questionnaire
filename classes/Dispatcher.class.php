<?php

class Dispatcher{

	public static function dispatch($request){
		$controller = $request->getController();
		$class = ucfirst($controller).'Controller';
		// var_dump($class);
		return new $class($request);
	}
}

?>
