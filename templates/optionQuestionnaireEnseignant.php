<form action="index.php?action=questionnaires" method="post" style="display: inline;" 
onsubmit="return confirm('Voulez vous supprimer cet élément ?');">
<input type="hidden" name="idQuestionnaire" value="<?php echo $q->id(); ?>">
<input class="btn btn-light btn-outline-danger" type="submit" name="suppression" value="Supprimer">
</form>
<a class="btn btn-light btn-outline-dark" role="button"
href=<?php echo "'index.php?action=voirQuestionnaire&idQuestionnaire=".$q->id()."'"; ?>>Voir</a>
<a class="btn btn-light btn-outline-success" role="button"
href="<?php echo "index.php?action=voirResultatsQuestionnaire&idQuestionnaire=".$q->id(); ?>">
Voir les résultats
</a>