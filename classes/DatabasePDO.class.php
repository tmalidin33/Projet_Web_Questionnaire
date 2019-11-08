<?php

class DatabasePDO{
	static $DB_HOST = 'localhost';
	static $DB_NAME = 'projet_web';
	static $DB_USER = 'root';
	static $DB_PWD = 'root';

	static $PDO = NULL;

	private function __construct(){}
	public static function getPDO(){
		if(is_null(self::$PDO)){
			try{
				self::$PDO = new PDO("mysql:
					host=".self::$DB_HOST.";dbname=".self::$DB_NAME,
				self::$DB_USER,
				self::$DB_PWD,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			} catch(Exception $e) {
				die('Error while connecting to MySQL.');
			};
		}

		return self::$PDO;
	}
}

?>
