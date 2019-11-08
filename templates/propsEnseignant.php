<?php 
$user = $args['user'];
$questionnaires = Questionnaire::getQuestionnairesByUserId($user->id());
$nbPartTot = 0;
$nbQuestionsTot = 0;
$moyenne = 0;
$nbPasDeParticipation = 0;
foreach ($questionnaires as $q) {
	$resultats = User::getResultatsByQuestionnaire($q->id());
	$nbParticipants = sizeof($resultats);
	if($nbParticipants == 0)
		$nbPasDeParticipation++;
	$nbPartTot += $nbParticipants;
	$nb = Questionnaire::getNbQuestionsQuestionnaire($q->id())->nb_q();
	$nbQuestionsTot += $nb;

	$m = 0;
	foreach ($resultats as $r) {
		$m += $r->note();
	}
	$m = ($nbParticipants == 0)?0:$m/$nbParticipants;
	$m = $m*20/$nb;
	$moyenne += $m;

}

?>


<div class="container">
	<div class="row">
		<div class="col-sm-5">
			<h1><span class="badge badge-dark"><?php echo sizeof($questionnaires);?></span></h1>
			<h3>questionnaires créés</h3>
		</div>
		<div class="col-sm-2"></div>
		<div class="col-sm-5">
			<h1>
				<span class="compteur badge badge-dark"><?php echo $nbQuestionsTot; ?></span>
			</h1>
			<h3>questions</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-5">
			<h1><span class="badge badge-dark">
				<?php echo substr($moyenne/(sizeof($questionnaires)-$nbPasDeParticipation),0,4);?>/20
			</span></h1>
			<h3>Moyenne totale</h3>
		</div>
		<div class="col-sm-2"></div>
		<div class="col-sm-5">
			<h1>
				<span class="compteur badge badge-dark"><?php echo $nbPartTot; ?></span>
			</h1>
			<h3>Participants cumulés</h3>
		</div>
	</div>
</div>