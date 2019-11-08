<a class="btn btn-light btnRep" role="button"
id='<?php echo "repondre".$q->id(); ?>'
href='<?php echo "index.php?action=repondreQuestionnaire&idQuestionnaire=".$q->id(); ?>'>Répondre</a>
<a class="btn btn-outline-light" role="button"
id='<?php echo "voirRes".$q->id(); ?>'
href=<?php echo "'index.php?action=resultatUserQuestionnaire&idQuestionnaire=".$q->id()."'"; ?>>Voir mes résultats</a>
<span id="nonRep<?php echo $q->id(); ?>" class="btn btn-secondary disabled" style="display: none;">Non répondu</span>

<script type="text/javascript">
	var etat = $(<?php echo "'#etat".$q->id()."'"; ?>);
	var btnRep = $('<?php echo "#repondre".$q->id(); ?>');
	var btnVoirRes = $('<?php echo "#voirRes".$q->id(); ?>');
	var aParticipe = <?php echo (Questionnaire::aParticipe($args['user']->id(), $q->id()))?'true':'false'; ?>;
	var c = 0; // if c = 2, aucun bouton de disponible -> n'a pas répondu
	if(etat.html() != 'En cours' || aParticipe){ 
	// cacher le bouton repondre si le questionnaire n'est pas en cours ou a été répondu
		btnRep.hide();
		c++;
	}
	if(!aParticipe){
		btnVoirRes.hide();
		c++;
	}
	if(c==2){
		$("#nonRep<?php echo $q->id(); ?>").show();
	}
</script>