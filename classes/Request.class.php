<?php

class Request {

	protected static $request = NULL;

	public static function getCurrentRequest(){
		if(is_null(self::$request)){
			self::$request = new Request();
		}
		return self::$request;
	}

	static function getController(){
		if(isset($_GET['controller'])){
			return $_GET['controller'];
		} else {
			if(!isset($_SESSION))
				session_start();
			if(isset($_SESSION['ID_USER'])){
				$user = User::getUserById($_SESSION['ID_USER']);
				return $user->getRole(); //renvoie si le user est Superuser, Etudiant ou Enseignant
			}
			return 'Anonymous';
		}
	}

	static function getActionName(){
		if(isset($_GET['action'])){
			return $_GET['action'];
		} else {
			return 'default';
		}
	}

	function readPost($code){
		return $_POST[$code];
	}

	function readGet($code){
		return $_GET[$code];
	}

	function writeGet($code, $value){
		$_GET[$code] = $value;
	}

	function writePost($code, $value){
		$_POST[$code] = $value;
	}

}


?>
