<?php 

class SuperUserView extends UserView{

	public function __construct($controller,$templateName, $args) {
		parent::__construct($controller,$templateName,$args);
		$this->templateNames['menu'] = 'superUserMenu';
		$this->templateNames['top'] = 'superUserTop';
	}

}

?>