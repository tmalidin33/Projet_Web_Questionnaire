<tr>
	<th>Matricule :</th>
	<td><?php echo $user->matricule(); ?></td>
</tr>
<tr>
	<th>Intervenant externe :</th>
	<td>
<?php if($user->int_ext() == 1){
		echo "Oui";
	}else {
			echo "Non";
		}		
?>
</td>
</tr>
<tr>
	<th>Matiere :</th>
	<td><?php echo $user->matiere(); ?></td>
</tr>
