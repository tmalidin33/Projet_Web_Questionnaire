<?php $resultats = $this->args['resultats'];
$nbQ = $args['nbQuestions'];?>
<table class="table text-light">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nom</th>
			<th scope="col">Prénom</th>
			<th scope="col">Note sur <?php echo $nbQ; ?></th>
			<!-- <th scope="col">Résultats</th> -->

		</tr>
	</thead>
	<tbody>
		<?php
		$total = 0;
		$rang = 1;
		foreach ($resultats as $r) {
		//	echo "<a href=\"?action=resultatEleveQuestionnaire&idEleve=1\">";
			echo "<tr id=\"resultatEleve\" onclick=\"afficheResultats(".$r->id().",".$_GET['idQuestionnaire'].");\">";
			echo "<th scope='row'>".$rang."</th>";
			echo "<td>".$r->nom()."</td>";
			echo "<td>".$r->prenom()."</td>";
			echo "<td>".$r->note()."</td>";
			// echo "<td><button type=\"button\" class=\"btn btn-outline-info\">Voir Résultat</button></td>";
			$total += $r->note();
			echo "</tr>";
			$rang++;
		}
		 ?>
	</tbody>
</table>
<?php $moyenne = (sizeof($resultats)==0)?0:$total/sizeof($resultats); ?>
<h1>
	<span class="compteur badge badge-light">Moyenne : <?php echo ($nbQ==0)?0:substr($moyenne*20/$nbQ,0,4)."/20"; ?></span>
</h1>
<script type="text/javascript">
function afficheResultats(idEleve, idQuestionnaire){
	window.location.href = "?action=resultatEleveQuestionnaire&idEleve="+idEleve+"&idQuestionnaire="+idQuestionnaire;
}

</script>
