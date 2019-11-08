<?php 

class Reponse extends Model{

	static $table_name = 'reponse_proposee';

	static $colId = 'ID_REPONSESP';
	static $colIdQuestion = 'ID_QUESTION';
	static $colIdQuestionnaire = 'ID_QUESTIONNAIRE';
	static $colEstJuste = 'EST_JUSTE_P';
	static $colColonne = 'COLONNE';
	static $colContenu = 'CONTENU';


	// getters
	public function id() { return $this->props[self::$colId]; }
	public function idQuestion() { return $this->props[self::$colIdQuestion]; }
	public function idQuestionnaire() { return $this->props[self::$colIdQuestionnaire]; }
	public function estJuste() { return $this->props[self::$colEstJuste]; }
	public function colonne() { return $this->props[self::$colColonne]; }
	public function contenu() { return $this->props[self::$colContenu]; }

	public function __construct(){
		parent::__construct();
	}

	// récupération de toutes les reponses
	public static function getList(){
		$reponses = parent::exec('REPONSE_LIST');
		return $reponses->fetchAll();
	}

	// création d'une nouvelle reponses
	public static function create($idQuestion, $estJuste, $colonne, $contenu){
		$array = array(':id_question' => $idQuestion,
			':estJuste' => $estJuste,
			':colonne' => $colonne,
			':contenu' => $contenu);
		parent::exec('REPONSE_CREATE', $array);
	}

	//chercher une reponse avec son id
	public static function getReponseById($id){
		$q = parent::exec('GET_REPONSE_BY_ID', array(':id_r' => $id));
		return $q->fetch(); 
	}
	
	// récupérer toutes les questions d'un questionnaires
	public static function getReponseByIdQuestion($id_question){
		$questions = parent::exec('GET_REPONSE_BY_IDQUESTION',
			array(':id_question' => $id_question));
		return $questions->fetchAll();
	}

	public static function getReponseByIdQuestionnaire($id_questionnaire){
		$questions = parent::exec('GET_REPONSE_BY_IDQUESTIONNAIRE', array(':id_questionnaire' => $id_questionnaire));
		return $questions->fetchAll();
	}

	public static function setRepForQuestion($idUser, $idQuestion, $idQuestionnaire, $estJuste){
		$array = array(':idUser' => $idUser,
									':idQuestion' => $idQuestion,
									':idQuestionnaire' => $idQuestionnaire,
									':estJuste' => $estJuste);
		parent::exec('SET_REP_QUESTION_FOR_USER', $array);
	}

	public static function addInRelieeA($id_rG, $id_rD){
		parent::exec('ADD_IN_RELIEE_A', array(':id_rG' => $id_rG, ':id_rD' => $id_rD));
	}


}


?>