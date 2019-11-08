<div class="col-lg-6 col-md-12 q" style="margin-bottom: 20px;">
	<div class="unQuestionnaire">
		<div class="separtionDansQuesitonnaire">
			<span><h4><?php echo $q->titre(); ?></h4></span>
			<span><?php echo $q->description_questionnaire(); ?></span><br>
			<i>
				Destiné à
				<?php
				if(!is_null($q->promo()))
					echo ' la promo '.$q->promo();
				else
					echo 'tous';
				if(!is_null($q->groupe()))
					echo ', demi promo '.$q->groupe();
				if(!is_null($q->td()))
					echo ', groupe de td '.$q->td();
				?>
			</i>
		</div>
		<div class="separtionDansQuesitonnaire">
			<span><?php echo "Ouverture : ".Questionnaire::afficheDate($q->date_ouverture()); ?></span><br>
			<span><?php echo "Fermeture : ".Questionnaire::afficheDate($q->date_fermeture()); ?></span><br>
			<span>Etat : <b id=<?php echo "'etat".$q->id()."'"; ?>><?php echo $q->etat(); ?></b></span>
		</div>
		<div style="padding: 10px;">
			<?php 
			$role = $this->args['user']->getRole();
			if($role == 'Etudiant' || $role == 'Enseignant' )
				require("optionQuestionnaire".$role.".php");
			?>
		</div>
	</div>
</div>