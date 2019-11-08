<?php if(Request::getController()=='Enseignant'){
	echo "<h1>Réponses de ".$args['user']->prenom()."</h1>";

} ?>
<table class="table text-light">
	<thead>
		<tr>
			<th scope="col">Intitutlé de la question</th>
			<th scope="col">Correction</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$total = 0;
		$justes = 0;
		foreach ($this->args['res'] as $r) {
			$total++;
			echo '<tr>';
			echo '<td>'.$r->description_question().'</td>';
			if($r->estJuste() == 1){
				echo '<td>&#10004;</td>';
				$justes++;
			}
			else
				echo '<td>&#10006;</td>';
			echo '</tr>';
		}
		?>
	</tbody>
</table>
<h4>
	<span class="compteur badge badge-dark"><?php echo $justes."/".$total; ?></span>
</h4>
<h1>
	<span class="compteur badge badge-light"><?php echo substr($justes*20/$total,0,4)."/20"; ?></span>
</h1>
<button class="btn btn-light" onclick="history.go(-1);">Retour</button>
