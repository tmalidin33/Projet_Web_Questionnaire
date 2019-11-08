<?php

class EtudiantController extends UserController{

	public function __construct($request){
		parent::__construct($request);

		if(isset($_POST['ValiderReponses'])){
			$this->validerReponses($request);
		}
	}

	public function questionnairesAction($request){
		$questionnaires = Questionnaire::getQuestionnaireByEtudiant($this->user->promo(),$this->user->grp_demiPromo(),$this->user->td());
		$view = new UserView($this, 'questionnaires', array('user' => $this->user, 'questionnaires' => $questionnaires));
		$view->render();
	}


	public function repondreQuestionnaireAction($request){
		$idQuestionnaire = $request->readGet('idQuestionnaire');
		$aParticipe = Questionnaire::aParticipe($this->user->id(), $idQuestionnaire);
		$q = Questionnaire::getQuestionnaireById($idQuestionnaire);
		if($q->etat() != 'En cours'){ 
			// sécurité
			$view = new UserView($this, 'error', 
				array('user' => $this->user, 'errorText' => 'Etat de ce questionnaire : '.$q->etat()));
		} elseif ($aParticipe != false) {
			// false si le user n'a pas encore repondu
			// donc si pas de false, cela signifie qu'il y a un élément et donc que l'utilisateur a déjà répondu
			$view = new UserView($this, 'error', 
				array('user' => $this->user, 'errorText' => 'Vous avez déjà répondu à ce questionnaire.'));
		}	else {
			$questions = Question::getQuestionsDeQuestionnaireId($idQuestionnaire);
			$reponses = Reponse::getReponseByIdQuestionnaire($idQuestionnaire);
			$view = new UserView($this, 'repondreQuestionnaire', 
				array('user' => $this->user, 
					'questions' => $questions, 
					'reponses' => $reponses,
					'idQu' => $idQuestionnaire
				));
		}
		$view->render();
	}

	public function resultatUserQuestionnaireAction($request){
		$res = Question::getResultatUserQuestionnaire($this->user->id(), $request->readGet('idQuestionnaire'));
		// var_dump($res);
		if(sizeof($res) == 0){
			$view = new UserView($this, 'error', 
				array('user' => $this->user, 'errorText' => "Vous n'avez pas répondu à ce questionnaire."));
		} else {
			$view = new UserView($this, 'resUnQuestionnaire', array('user' => $this->user, 'res' => $res));
		}
		$view->render();
	}

	public function validerReponses($request){

		$idQuestionnaire = (integer) $request->readPost('idQuestionnaire');

		$QCM = false;
		$repQCM= array();
		$nbQuestionsQCM = 0;
		$compteurQCM = 0;

		$ASSIGNE = false;
		$repASSIGNE= array();
		$nbQuestionsASSIGNE = 0;
		$compteurASSIGNE = 0;
		$qId_ASSIGNE = -1;

		foreach ($_POST as $key => $value) {
			$explode = explode("_", $key);
			$type = $explode[0];


			// pour les questions de type différent de QCM on peut savoir directement si la question a été repondue juste dans son intégralité
			// pour un QCM, il faut récupérer tous les éléments, cochés ou non, pour savoir si l'élève a bien coché toutes les bonnes réponses

			if($type == 'QCM'){
				$qId = explode(":", $explode[1])[1];

				$repQCM[$key] = $value;
				$compteurQCM++;
				if($QCM){
					if($compteurQCM == $nbQuestionsQCM){
						$r = $this->correctionQCM($repQCM);
						$compteurQCM = 0;
						$repQCM = array();
						$QCM = false;


						$estJuste;
						if($r){ $estJuste=1; } else { $estJuste=0; }
						Reponse::setRepForQuestion($this->user->id(), $qId, $idQuestionnaire, $estJuste);
					}
				} else {
					$nbQuestionsQCM = explode(":",$explode[2])[1];
					$QCM = true;
				}

			} elseif ($type == 'ASSIGNE') {
				$qId = explode(":", $explode[1])[1];

				$repASSIGNE[$key] = $value;
				$compteurASSIGNE++;
				if($ASSIGNE){
					if($compteurASSIGNE == $nbQuestionsASSIGNE){
						$r = $this->correctionASSIGNE($repASSIGNE, $qId_ASSIGNE);
						$compteurASSIGNE = 0;
						$repASSIGNE = array();
						$ASSIGNE = false;
						$qId_ASSIGNE = -1;


						$estJuste;
						if($r){ $estJuste=1; } else { $estJuste=0; }
						Reponse::setRepForQuestion($this->user->id(), $qId, $idQuestionnaire, $estJuste);
					}
				} else {
					$nbQuestionsASSIGNE = (explode(":",$explode[2])[1])/2; 
					// on divise par deux car par exemple, 6 reponses peuvent être liées à la quetion mais le post n'aura que 3 réponses pour cette question
					$ASSIGNE = true;
					$qId_ASSIGNE = explode(":",$explode[1])[1];
				}				

			} elseif ($type == 'QCU' || $type == 'LIBRE') { 
				// si ce n'est pas un QCM ou un assignme, on va directement chercher la réponse
				$qId = explode(":", $explode[1])[1];
				$r = $this->correctionSimple($key, $value);


				$estJuste;
				if($r){ $estJuste=1; } else { $estJuste=0; }
				Reponse::setRepForQuestion($this->user->id(), $qId, $idQuestionnaire, $estJuste);
			}

			Questionnaire::setParticipation($this->user->id(), $idQuestionnaire);

		}


	}


	public function correctionQCM($reponses){
		$r = true;
		foreach ($reponses as $key => $value) {
			// valeur dans le post :
			// 'QCM_qId:1_nbRep:4_rId:1_juste:1' => string 'off' (length=3)
  		// 'QCM_qId:1_nbRep:4_rId:2_juste:0' => string 'on' (length=2)
			$juste = explode(":",explode("_", $key)[4])[1];
			if( ($juste == 1 && $value == 'off') || ($juste == 0 && $value == 'on') )
				$r = false; 
		}
		return $r;
	}


	public function correctionASSIGNE($reponses, $qId){
		$r = true;
		// 'ASSIGNE_qId:10_nbRep:6_rDrId:8' => string '7' (length=1)
		$coupleReps = RelieeA::getReponsesLieesByQuestion($qId);
		foreach ($coupleReps as $unAssignement) {
			$idRep = $unAssignement->idRep();
			$idRepAss = $unAssignement->idRepAss();
			foreach ($reponses as $key => $value) {
				$idRepAssDonnee = explode(":",explode("_", $key)[3])[1];
				if($idRepAss == $idRepAssDonnee){
					if($idRep != $value)
						$r = false;
				}
			}
		}
		return $r;
	}


	// retourne si la/les réponse(s) pour la question est/sont juste(s)
	// retourne id question
	// permettra l'insertion dans la table reponse choisie
	public function correctionSimple($key, $value){
		$explode = explode("_", $key);
		$type = $explode[0];

		$r = true;
		switch ($type) {

			case 'QCU':
			// 'QCU_qId:13' => string 'rId:18_juste:1' (length=14)
			$r = (explode(":", $value)[2] == 1);
			break;

			case 'LIBRE':
	  	// 'LIBRE_qId:14_rep:Pythagore' => string 'Py' (length=2)
	  	$rep = explode(":", $key)[2];
	  	$rep = str_replace("_"," ",$rep);
			$r = (strtolower($rep) == strtolower($value));
			break;
		}
		return $r;
	}



}


?>
