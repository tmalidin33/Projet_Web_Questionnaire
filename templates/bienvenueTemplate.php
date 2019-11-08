<!-- <img class="displayed" src="assets/Fichier3.png" alt="sabres"> -->
<h1 style="text-align: center;">BIENVENUE</h1>


<?php 
$nbQuestions = count(Question::getList());
$nbQuestionnaires = count(Questionnaire::getList());
$nbUsers = count(User::getList());
$nbReponse = count(Reponse::getList());


?>

<div class="container">
	<div class="row">
		<div class="col-sm-5">
			<h1><span class="badge badge-dark"><?php echo $nbUsers;?></span></h1>
			<h3>utilisateurs</h3>
		</div>
		<div class="col-sm-2"></div>
		<div class="col-sm-5">
			<h1>
				<span class="compteur badge badge-dark"><?php echo $nbQuestionnaires; ?></span>
			</h1>
			<h3>questionnaires</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-5">
			<h1>
				<span class="compteur badge badge-dark"><?php echo $nbQuestions; ?></span>
			</h1>
			<h3>questions</h3>
		</div>    
		<div class="col-sm-2"></div>
		<div class="col-sm-5">
			<h1>
				<span class="compteur badge badge-dark"><?php echo $nbReponse; ?></span>
			</h1>
			<h3>réponses</h3>
		</div>
	</div>
</div>

	<h4 style="margin-top: 30px;"><a href="#" onclick="openNav();">Connectez-vous</a href="#"> ou <a href="?action=inscription">inscrivez-vous</a> pour commencer</h4>
