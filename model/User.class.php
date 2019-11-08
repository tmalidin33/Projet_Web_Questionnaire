<?php

class User extends Model{

	static $table_name = 'user';
	// utilisation de variable pour éviter d'avoir à changer plusieurs fois si on
	// change le nom d'une colonne
	static $colId = 'ID_USER';
	static $colLogin = 'LOGIN';
	static $colMdp = 'PASSWORD';
	static $colNom = 'NOM';
	static $colPrenom = 'PRENOM';
	static $colMail = 'EMAIL';
	static $colRole = 'ROLE';
	static $colMatricule = 'MATRICULE';
	static $colIntExt = 'INTERN_EXT';
	static $colMatiere = 'MATIERE';
	static $colPromo = 'PROMO';
	static $colTD = 'TD';
	static $colGroupe = 'GROUPE';
// pour la récuperation des notes pour un questionnaire
	static $colNote = 'NOTE';
	static $colEstJuste = 'JUSTE';

	//getters
	public function id() { return $this->props[self::$colId]; }
	public function login() { return $this->props[self::$colLogin]; }
	public function mdp() { return $this->props[self::$colMdp]; }
	public function nom() { return $this->props[self::$colNom]; }
	public function prenom() { return $this->props[self::$colPrenom]; }
	public function mail() { return $this->props[self::$colMail]; }
	public function role() { return $this->props[self::$colRole]; }
	// on définit le super admin comme le user avec id 3 (= Thomas Malidin)
	public function getRole() {
		if ($this->id()==3){
			return "Superuser";
		}
		return $this->role();
	}
	public function matricule() { return $this->props[self::$colMatricule]; }
	public function int_ext() { return $this->props[self::$colIntExt]; }
	public function matiere() { return $this->props[self::$colMatiere]; }
	public function promo() { return $this->props[self::$colPromo]; }
	public function td() { return $this->props[self::$colTD]; }
	public function grp_demiPromo() { return $this->props[self::$colGroupe]; }
	
	public function note() { return $this->props[self::$colNote]; }
	public function estJuste() { return ($this->props[self::$colEstJuste]==1)?true:false; }







	public function __construct(){
		parent::__construct();
	}

	// récupération de toutes les users
	public static function getList() {
		$users = parent::exec('USER_LIST');
		return $users->fetchAll();
	}

//renvoi un boolean pour savoir si un login est déjà utilisé
	public static function isLoginUsed($login){
		$r = parent::exec('USER_IS_LOGIN_USED',
			array(':login' => $login));
		$us = $r->fetch();

		// si le login existe, $us est une instance de user, donc pas un boolen
		// si le login n'existe pas, $us = false
		if($us != false)
			return true;
		else
			return false;
	}

//ajout d'un nouvel utilisateur, et connexion directe
	public static function create($login, $mdp, $mail, $nom, $prenom, $role, $promo, $groupe, $td, $matricule, $matiere_enseignee, $int_ext){
		$array = array( ':login' => $login,
			':email' => $mail,
			':mdp' => $mdp,
			':nom' => $nom,
			':prenom' => $prenom,
			':role' => $role,
			':promo' => $promo,
			':groupe' => $groupe,
			':td' => $td,
			':matricule' => $matricule,
			':matiere' => $matiere_enseignee,
			':intern_ext' => $int_ext);
		$sth = parent::exec('USER_CREATE',$array);
		$user = static::tryLogin($login, $mdp);
		return $user;
	}

//connexion d'un utilisateur
	public static function tryLogin($login, $mdp){
		$r = parent::exec('USER_CONNECT',
			array(':login' => $login,
				':mdp' => $mdp));
		$user = $r->fetch();
		return $user;
	}

//récupération d'un utilisateur par son id
	public static function getUserById($id){
		$r = parent::exec('USER_GET_BY_ID',
			array(':id' => $id));
		$user = $r->fetch();
		return $user;
	}

	public static function getAllPromo(){
		$r=parent::exec('USER_GET_ALL_PROMO');
		return $r->fetchAll();
	}

	public static function getResultatsByQuestionnaire($idQuestionnaire){
		$r = parent::exec('GET_RESULTATS_BY_QUESTIONNAIRE', array('id_questionnaire' => $idQuestionnaire));
		return $r->fetchAll();
	}

	public static function getResUneQuestion($idQuestionnaire, $idQuestion){
		$r = parent::exec('GET_RESULTATS_BY_QUESTION',
				array(':idQuestionnaire' => $idQuestionnaire,
							':idQuestion' => $idQuestion));
		return $r->fetchAll();
	}

}
?>
