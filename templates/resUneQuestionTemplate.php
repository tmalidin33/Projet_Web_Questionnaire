<table class="table text-light">
	<thead>
		<tr>
			<th scope="col">Nom</th>
			<th scope="col">Prenom</th>
			<th scope="col">Réussi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($this->args['resultats'] as $r) {
			echo '<tr>';
			echo '<td>'.$r->nom().'</td>';
			echo '<td>'.$r->prenom().'</td>';
			if($r->estJuste()){
				echo '<td>&#10004;</td>';
			}
			else
				echo '<td>&#10006;</td>';
			echo '</tr>';
		}
		?>
	</tbody>
</table>

<button class="btn btn-light" onclick="history.go(-1);">Retour</button>