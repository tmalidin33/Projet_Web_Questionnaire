<?php

class AnonymousController extends Controller{

	public function __construct($request){
		parent::__construct($request);

		if(isset($_POST['inscLogin'])){
			$this->methodName = "validateInscription";
		}
		elseif (isset($_POST['connLogin'])) {
			$this->methodName = "validateConnexion";
		}
	}

	//pour un utilisateur anonyme, on affichera toujours le menu connexion/inscription
	public function afficherAnoMenu($request){
		$view = new AnonymousView($this, 'menu');
		$view->render();
	}

	public function defaultAction($request) {
		$view = new AnonymousView($this, 'bienvenue');
		$view->render();
	}

	public function inscriptionAction($request){
		$view = new AnonymousView($this, 'inscription');
		$view->render();
	}

	public function connexionAction($request){
		$view = new AnonymousView($this, 'connexion');
		$view->render();
	}

	public function validateInscription($request) {
		$login = $request->readPost('inscLogin');
		if(User::isLoginUsed($login)) {
			$view = new AnonymousView($this, 'inscription');
			$view->setArg('inscErrorText','Login déjà utilisé');
			$view->render();
		} else {
			$mdp = $request->readPost('inscPassword');
			$nom = $request->readPost('nom');
			$prenom = $request->readPost('prenom');
			$mail = $request->readPost('email');
			$role= $request->readPost('role');
			if($role=='Etudiant'){
				$promo=$request->readPost('Promo');
				$groupe=$request->readPost('Groupe');
				$td=$request->readPost('td');
				$user = User::create($login, $mdp, $mail, $nom, $prenom,$role,$promo, $groupe, $td, $matricule=null, $matiere_enseignee=null, $int_ext=null);
			} else if ($role == 'Enseignant'){
				$matricule=$request->readPost('Matricule');
				$matiere_enseignee=$request->readPost('Mat_enseignee');
				$int_ext=$request->readPost('Int_Ext');
				$user = User::create($login, $mdp, $mail, $nom, $prenom,$role,$promo=null, $groupe=null, $td=null, $matricule, $matiere_enseignee, $int_ext);

			}
			if(!$user) {
				$view = new AnonymousView($this,'inscription');
				$view->setArg('inscErrorText', 'Impossible de finaliser l\'inscription');
				$view->render();
			} else {
				$this->connexion($user);
			}
		}
	}

	public function validateConnexion($request){
		$login = $request->readPost('connLogin');
		$mdp = $request->readPost('connPassword');
		$user = User::tryLogin($login, $mdp);
		if(!$user){
			$view = new AnonymousView($this, 'bienvenue');
			$view->setArg('connErrorText', 'Utilisateur introuvable');
			$view->render();
		} else {
			$this->connexion($user);
		}
	}

	public function connexion($user){
		$newRequest = new Request();
		$newRequest->writeGet('controller', strtolower($user->getRole()));
		$newRequest->writeGet('userId',$user->id());
		$controller = Dispatcher::dispatch($newRequest);
		$controller->execute();
	}


}

?>
