<?php

class UserController extends Controller{

	protected $user;

	public function __construct($request){
		parent::__construct($request);
		if(!isset($_SESSION))
			session_start();

		$userId = NULL;
		if(isset($_SESSION['ID_USER'])){
			$this->user = User::getUserById($_SESSION['ID_USER']);
		} else {
			$userId = $request->readGet('userId');
			$this->user = User::getUserById($userId);
			$_SESSION['ID_USER'] = $this->user->id();
		}

		// sécurité
		if ($this->user->getRole() != ucfirst(Request::getController()))
			$this->methodName = 'error';
	}


	public function defaultAction($request){
		$view = new UserView($this, 'userBienvenue', array('user' => $this->user));
		$view->render();
	}

	public function profilAction($request){
		$view = new UserView($this, 'userProfil', array('user' => $this->user ));
		$view->render();
	}
	public function questionsEtreponsesAction($request){
		$idQuestionnaire = $request->readGet('idQuestionnaire');
		$questions = Question::getQuestionsDeQuestionnaireId($idQuestionnaire);
		$reponses = Reponse::getReponseByIdQuestionnaire($idQuestionnaire);
		$view = new UserView($this, 'questionsEtreponses',
			array('user' => $this->user, 
				'questions' => $questions, 
				'reponses' => $reponses));
		$view->render();
	}


}

?>
