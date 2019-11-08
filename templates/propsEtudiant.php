<?php 
$user = $args['user'];
$questionnaires = Questionnaire::getQuestionnaireByEtudiant($user->promo(),$user->grp_demiPromo(),$user->td());
$aRepondre = 0;
foreach ($questionnaires as $q) {
	$aParticipe = Questionnaire::aParticipe($user->id(), $q->id());
	if($aParticipe == false && $q->etat() == 'En cours')
		$aRepondre++;
}

?>


<div class="container">
	<div class="row">
		<div class="col-sm-5">
			<h1>
				<a class="badge badge-dark" href="?action=Questionnaires"><?php echo sizeof($questionnaires);?></a>
			</h1>
			<h3>questionnaires concernés</h3>
		</div>
		<div class="col-sm-2"></div>
		<div class="col-sm-5">
			<h1>
				<a class="compteur badge badge-dark" href="?action=questionnaires&afaire"><?php echo $aRepondre; ?></a>
			</h1>
			<h3>en attente de réponse</h3>
		</div>
	</div>
</div>