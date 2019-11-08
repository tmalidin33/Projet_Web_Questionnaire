<?php

class View extends MyObject {

	protected $templateNames;
	protected $args;

	public function __construct($controller, $templateName,$args = array()) {
		parent::__construct();

		$this->templateNames = array();
		$this->templateNames['head'] = 'head';
		$this->templateNames['top'] = 'top';
		$this->templateNames['bandeauMenu'] = 'bandeauMenu';
		$this->templateNames['menu'] = 'menu';
		$this->templateNames['foot'] = 'foot';
		$this->templateNames['content'] = $templateName;
		$this->args = $args;
		$this->args['controller'] = $controller;
	}

	public function setArg($key, $val) {
		$this->args[$key] = $val;
	}

	public function render() {
		$this->loadTemplate($this->templateNames['head'], $this->args);

		echo "<ul class='bandeauMenu'>";
		echo "<span onclick='openNav()'>&#9776; MENU</span>";
		$this->loadTemplate($this->templateNames['bandeauMenu'], $this->args);
		echo "</ul>";
		
		echo "<header>";
		$this->loadTemplate($this->templateNames['top'], $this->args);
		echo "</header>";

		echo "<ul class='menu' id='mySidenav'>";
		echo "<a href='javascript:void(0)' class='closebtn' onclick='closeNav()'>
		&times;</a>";
		$this->loadTemplate($this->templateNames['menu'], $this->args);
		echo "</ul>";

		echo "<div class='content'>";
		$this->loadTemplate($this->templateNames['content'], $this->args);
		echo "</div>";

		$this->loadTemplate($this->templateNames['foot'], $this->args);
	}

	public function loadTemplate($name,$args=NULL) {
		$templateFileName = __ROOT_DIR 	. '/templates/'. $name . 'Template.php';
		if(is_readable($templateFileName)) {
			if(isset($args))
				foreach($args as $key => $value)
					$key = $value;
				require_once($templateFileName);
			}
			else
				throw new Exception('undefined template "' . $name .'"');
		}
	}


?>