<?php 

class AjaxController extends Controller{

	static $types;

	public function __construct($request){
		parent::__construct($request);

		// self::$types = Question::getTypes();
		self::$types = array('QCM', 'QCU', 'ASSIGNE', 'LIBRE');
	}

	public function defaultAction($request){
		$view = new ErrorView($this, 'error', array('errorText' => 'Absence de nom d\'action'));
		$view->render();
	}

	public function questionNewAction($request){
		$num = $request->readGet('num');
		$view = new AjaxView($this, 'nouvelleQuestion', array('types'=> self::$types, 'num' => $num));
		$view->render();
	}

	public function questionOldAction($request){
		$num = $request->readGet('num');
		$idQuestion = $request->readGet('idQ');
		$question = Question::getQuestionById($idQuestion);
		$view = new AjaxView($this, 'ancienneQuestion', 
			array('question' => $question, 'num' => $num));
		$view->render();
	}
}


?>