<?php

abstract class Controller extends MyObject{

	protected $request;
	protected $methodName;


	public function __construct($request){
		$this->request = $request;
		$this->methodName = (Request::getActionName()).'Action';
	}

	abstract public function defaultAction($request);

	function execute(){
		if(method_exists($this, $this->methodName))
			$m = $this->methodName;
		else
			$m = 'error';
		$this->$m($this->request);
	}
	
	public function error($request){
		$view = new ErrorView($this, 'error', array('errorText' => "Vous n'avez pas accès à cette page"));
		$view->render();
	}


}

?>