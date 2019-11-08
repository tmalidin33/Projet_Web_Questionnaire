<?php

class EnseignantController extends UserController{

	static $types_question;

	public function __construct($request){
		parent::__construct($request);
		//ValidateQuestionnaire
		if(isset($_POST['titreQuestaire'])){
			$this->methodName = "validateQuestionnaire";
		}

		// self::$types_question=Question::getTypes();
		self::$types_question=array('QCM', 'QCU', 'ASSIGNE', 'LIBRE');


		if(isset($_POST['addQuestions'])){
			$this->validateQuestions($request);
		}

		if(isset($_POST['suppression'])){
			$this->supprimerQuestionnaire($request);
		}
	}


	// ACTIONS

	public function questionnairesAction($request){
		$questionnaires = Questionnaire::getQuestionnairesByUserId($this->user->id());
		$view = new UserView($this, 'questionnaires',
			array('user' => $this->user,
				'questionnaires' => $questionnaires));
		$view->render();
	}
	public function nouveauQuestionnaireAction($request){
		$view = new UserView($this, 'nouveauQuestionnaire',
			array('user' => $this->user,
				'promos' => User::getAllPromo()));
		$view->render();
	}

	public function modifierQuestionnaireAction($request){
		$view = new UserView($this, 'todo', array('user' => $this->user));
		$view->render();
	}

	public function voirQuestionnaireAction($request){
		$idQuestionnaire = $request->readGet('idQuestionnaire');
		$questions = Question::getQuestionsDeQuestionnaireId($idQuestionnaire);
		$reponses = Reponse::getReponseByIdQuestionnaire($idQuestionnaire);
		$view = new UserView($this, 'questionsEtreponses',
			array('user' => $this->user, 'reponses' => $reponses, 'questions' => $questions));
		$view->render();
	}

	public function voirResultatsQuestionnaireAction($request){
		$idQuestionnaire = $request->readGet('idQuestionnaire');
		$resultats = User::getResultatsByQuestionnaire($idQuestionnaire);
		$nbQuestions = Questionnaire::getNbQuestionsQuestionnaire($idQuestionnaire)->nb_q();
		$view = new UserView($this, 'notesQuestionnaire',
			array('user' => $this->user,
				'nbQuestions' => $nbQuestions,
				'resultats' => $resultats));
		$view->render();
	}

	public function repUneQuestionAction($request){
		$idQuestion = $request->readGet('idQuestion');
		$idQuestionnaire = $request->readGet('idQuestionnaire');
		$res = User::getResUneQuestion($idQuestionnaire, $idQuestion);
		$view = new UserView($this, 'resUneQuestion', array('user' => $this->user, 'resultats' => $res));
		$view->render();
	}



	// AUTRES FONCTIONS

	public function validateQuestionnaire($request){
		$titreQ = $request->readPost('titreQuestaire');
		$descriptionQ = $request->readPost('descripQuestaire');
		$dateO = $request->readPost('date_ouverture');
		$heureO = $request->readPost('time_ouverture');
		$dateF = $request->readPost('date_fermeture');
		$heureF = $request->readPost('time_fermeture');
		$consigne = 1; //ajout d'une selection d'une consigne à faire
		$userID = $this->user->id();
		$promo=$request->readPost('Promo');
		if($promo == "tous"){
			$questionnaire = Questionnaire::create($consigne, $userID, $titreQ, $descriptionQ, $dateO, $heureO, $dateF,$heureF,$promo=null,$groupe=null,$TD=null);
		} else {
			$tous=$request->readPost('tous');
			if($tous == 'on'){
				$questionnaire = Questionnaire::create($consigne, $userID, $titreQ, $descriptionQ, $dateO, $heureO, $dateF,$heureF,$promo,$groupe=null,$TD=null);
			} else {
				if($request->readPost('groupe') != ''){
					$groupe=$request->readPost('groupe');
					$questionnaire = Questionnaire::create($consigne, $userID, $titreQ, $descriptionQ, $dateO, $heureO, $dateF,$heureF,$promo,$groupe,$TD=null);
				} else {
					$TD=$request->readPost('td');
					$questionnaire = Questionnaire::create($consigne, $userID, $titreQ, $descriptionQ, $dateO, $heureO, $dateF,$heureF,$promo,$groupe=null,$TD);
				}
			}
		}
		$idQuestionnaire = DatabasePDO::getPDO()->lastInsertId();
		$_SESSION['id_questionnaire']=$idQuestionnaire;
		// var_dump("questionnaireeeeeee=",self::$id_questaire);
		// if(!$questionnaire) {
		// 	$view = new UserView($this,'nouveauQuestionnaire');
		// 	$view->setArg('questaireErrorText', 'Impossible de finaliser la création du questionnaire');
		// 	$view->render();
		// } else {
		$view = new UserView($this, 'remplirQuestion',
			array('user' => $this->user,
				'types'=>self::$types_question,
				'idQuestionnaire' => $idQuestionnaire,
				'num' => 1,
				'questions' => Question::getList()));
		$view->render();
		// }
	}
//Inutile pour le moment...
	public function nouvelleQuestionAction($request){
		$view = new UserView($this, 'remplirQuestion', array('user' => $this->user));
		$view->render();
	}

	public function validateQuestions($request){
		$idQuestionnaire = $request->readPost('idQuestionnaire');
		$num = 1;
		while (isset($_POST['TypeQuestion__'.$num])) {
			$type = $_POST['TypeQuestion__'.$num];
			if($type == 'OLD'){
				$id_question = (integer) $_POST['idQuestion__'.$num];
			} else {
				$description = $_POST['descripQuestion__'.$num];
				$tag = $_POST['Tag__'.$num];
				$consigne = 1;

				$rep = $this->recuperReponse($num, $type);
					// var_dump($rep);

				$NbReponses = $rep['NbReponses'];
				Question::create($consigne, $tag, $type, $NbReponses, $description);
				$id_question=DatabasePDO::getPDO()->lastInsertId();

				$this->enregistrerReponses($id_question, $type, $rep);
			}
			Question::associerQuestionQuestionnaire($idQuestionnaire, $id_question);
			$num++;
		}
	}

	public function recuperReponse($num, $type){
		$rep = array();
		switch ($type) {
			case 'LIBRE':
			$contenu = $_POST['LIBRE__'.$num];
			$rep['LIBRE'] = $contenu;
			$rep['NbReponses'] = 1;
			break;

			case 'ASSIGNE':
			$c = 1;
			$nb = 0;
			$ASSIGNE = array();
			$ASSIGNE_G = array();
			$ASSIGNE_D = array();
			while($c<50){
				if(isset($_POST['ASSIGNE_'.$c.'_1__'.$num])){
					$rG = $_POST['ASSIGNE_'.$c.'_1__'.$num];
					array_push($ASSIGNE_G, $rG);
					$rD = $_POST['ASSIGNE_'.$c.'_2__'.$num];
					array_push($ASSIGNE_D, $rD);
					$nb++;
				}
				$c++;
			}
			$ASSIGNE['ASSIGNE_G'] = $ASSIGNE_G;
			$ASSIGNE['ASSIGNE_D'] = $ASSIGNE_D;
			$rep['ASSIGNE'] = $ASSIGNE;
			$rep['NbReponses'] = $nb*2;
			break;

			// QCU et QCM
			default:
			$c = 1;
			$nb = 0;
			$QC = array();
			$contenuReps = array();
			$sontJustes = array();
			while($c<50){
				if(isset($_POST[$type.'_'.$c.'__'.$num])){
					$contenu = $_POST[$type.'_'.$c.'__'.$num];
					array_push($contenuReps, $contenu);
					if($type == 'QCM')
						$estJuste = isset($_POST['EstJuste'.$type.'_'.$c.'__'.$num]);
					else
						$estJuste = ($_POST['EstJuste'.$type.'__'.$num] == $c);
					array_push($sontJustes, $estJuste);
					$nb++;
				}
				$c++;
			}
			$QC['contenuReps'] = $contenuReps;
			$QC['sontJustes'] = $sontJustes;
			$rep[$type] = $QC;
			$rep['NbReponses'] = $nb;
			break;
		}
		return $rep;
	}

	public function enregistrerReponses($idQuestion, $type, $rep){
		switch ($type) {
			case 'LIBRE':
			$contenu =$rep['LIBRE'];
			Reponse::create($idQuestion, 1, NULL, $contenu);
			break;

			case 'ASSIGNE':
			$ASSIGNE = $rep['ASSIGNE'];
			$ASSIGNE_G = $ASSIGNE['ASSIGNE_G'];
			$ASSIGNE_D = $ASSIGNE['ASSIGNE_D'];
			for($i=0;$i<sizeof($ASSIGNE_G);$i++){
				Reponse::create($idQuestion, 1, 0, $ASSIGNE_G[$i]);
				$id_rG=DatabasePDO::getPDO()->lastInsertId();
				Reponse::create($idQuestion, 1, 1, $ASSIGNE_D[$i]);
				$id_rD=DatabasePDO::getPDO()->lastInsertId();

				Reponse::addInRelieeA($id_rG, $id_rD);
			}
			break;

			// QCU et QCM
			default:
			$QC = $rep[$type];
			$contenuReps = $QC['contenuReps'];
			$sontJustes = $QC['sontJustes'];
			for($i=0;$i<sizeof($contenuReps);$i++){
				if($sontJustes[$i])
					Reponse::create($idQuestion, 1, NULL, $contenuReps[$i]);
				else
					Reponse::create($idQuestion, 0, NULL, $contenuReps[$i]);
			}
			break;
		}
	}

	public function supprimerQuestionnaire($request){
		$idQuestionnaire = $request->readPost('idQuestionnaire');
		Questionnaire::supprimer($idQuestionnaire);
	}

	public function resultatEleveQuestionnaireAction($request){
		$res = Question::getResultatUserQuestionnaire($request->readGet('idEleve'), $request->readGet('idQuestionnaire'));
		// var_dump($res);
		if(sizeof($res) == 0){
			$view = new UserView($this, 'error',
				array('user' => $this->user, 'errorText' => "Vous n'avez pas répondu à ce questionnaire."));
		} else {
			$view = new UserView($this, 'resUnQuestionnaire', array('user' => $this->user, 'res' => $res));
		}
		$view->render();
	}



}


?>
