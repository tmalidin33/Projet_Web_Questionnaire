<?php 

class AjaxView extends View{

	public function __construct($controller, $templateName, $args=array()){
		parent::__construct($controller, $templateName, $args);
	}


	public function render(){
		$this->loadTemplate($this->templateNames['content'], $this->args);
	}

}


 ?>