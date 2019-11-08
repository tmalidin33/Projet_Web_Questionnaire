<?php 

class RelieeA extends Model {

	static $table_name = 'reliee_a';
	// utilisation de variable pour éviter d'avoir à changer plusieurs fois si on
	// change le nom d'une colonne
	static $colIdRepProp = 'ID_REPONSESP';
	static $colRepIdRepProp = 'REP_ID_REPONSESP';

	//getters
	public function idRep() { return $this->props[self::$colIdRepProp]; }
	public function idRepAss() { return $this->props[self::$colRepIdRepProp]; }


// la requête sql est dans reponse.sql
	static function getReponsesLieesByQuestion($idQuestion){
		$coupleReps = parent::exec('GET_COUPLE_REPONSES_BY_IDQUESTION', 
			array('id_question' => $idQuestion));
		return $coupleReps->fetchAll();
	}

}

?>