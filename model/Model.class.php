<?php

class Model extends MyObject{

	static $queries;
	protected $props;

	protected static function db(){
		return DatabasePDO::getPDO();
	}
	protected static function query($sql){
		$st = static::db()->query($sql) or die("sql query error ! request : " . $sql);
		$st->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class());
		return $st;
	}

	static function exec($key,$values=NULL){
		$sql = self::$queries[$key];
		// var_dump($key);
		// var_dump($sql);
		// var_dump($values);
		if(!is_null($values)){
			$requete = static::db()->prepare($sql);
			// foreach ($values as $key => &$value) {
			// 	$requete->bindParam($key, $value);
			// }
			$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class());
			$requete->execute($values);
			// mettre values en paramètre effectue les mêmes opérations que ce qui est commenté l.22 à 24
			return $requete;
		} else {
			return static::query($sql);
		}
	}

	public static function addSqlQuery($key, $value){
		self::$queries[$key] = $value;
	}


	public function __construct() {
		parent::__construct();
	}
	public function __get($key) {
		return $this->props[$key];
	}
	public function __set($query, $val) {
		$this->props[$query] = $val;
	}
}

?>
