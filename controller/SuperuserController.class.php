<?php 

class SuperuserController extends UserController{

	static $users;
	static $questions;
	static $questionnaires;
	static $reponses;

	public function __construct($request){
		parent::__construct($request);

		$userId = NULL;
		if(isset($_SESSION['ID_SUPERUSER'])){
			$this->user = User::getUserById($_SESSION['ID_SUPERUSER']);
		//var_dump($this->user);
		} else {
			if(isset($_GET['userId'])){
				$userId = $request->readGet('userId');
				$this->user = User::getUserById($userId);
				$_SESSION['ID_SUPERUSER'] = $this->user->id();
		//var_dump($this->user);
			} else
			// sécurité
				$this->methodName = 'error';
		}

	//chargement du contenu des tables dans les variables
		self::$users = User::getList();
		self::$questions = Question::getList();
		self::$questionnaires = Questionnaire::getList();
		self::$reponses = Reponse::getList();

	}

	public function defaultAction($request){
	// on peut utiliser le même template, mais on ne peut pas utliser la fonction du parent
	// car il faut appeler une superUserView
		$view = new SuperUserView($this, 'userBienvenue',
			array('user' => $this->user));
		$view->render();
	}

	public function profilAction($request){
	// idem
		$view = new SuperUserView($this, 'userProfil', array('user'=>$this->user));
		$view->render();
	}

	public function usersAction($request){
	//affichage du template userssTemplate dans le content
		$view = new SuperUserView($this, 'users',
			array('user' => $this->user, 'users' => self::$users));
		$view->render();
	}

	public function questionnairesAction($request){
	//affichage du template questionnairesTemplate dans le content
		$view = new SuperUserView($this, 'questionnaires',
			array('user' => $this->user, 'questionnaires' => self::$questionnaires));
		$view->render();
	}

	public function questionsAction($request){
	//affichage du template questionsTemplate dans le content
		$view = new SuperUserView($this, 'questions',
			array('user' => $this->user, 'questions' => self::$questions));
		$view->render();
	}

	public function reponsesAction($request){
	//affichage du template questionsTemplate dans le content
		$view = new SuperUserView($this, 'reponses',
			array('user' => $this->user, 'reponses' => self::$reponses));
		$view->render();
	}

	public function questionsEtreponsesAction($request){
		$view = new SuperUserView($this, 'questionsEtreponses',
			array('user' => $this->user, 'reponses' => self::$reponses, 'questions' => self::$questions));
		$view->render();
	}

}
?>
