<div class="newQuestionnaire">

	<?php
	//Gestion des erreurs dans le validateQuestionnaire à faire...
	// if(isset($args['questaireErrorText']))
	// 	echo '<span class="error">' . $args['questaireErrorText'] . '</span>';
	if(isset($args['dateErrorText']))
		echo '<span class="error">' . $args['dateErrorText'] . '</span>';
	$user = $args['user'];
	$promos= $args['promos'];
	?>
	<form action="index.php" method="post">
		<div class="entete">
			<table>
				<tr>
					<td><h2>Nouveau Questionnaire</h2></td>
					<td><input type="submit" value="Créer" /></td>
				</tr>
			</table>
		</div>
		<div class="titreVisi">
			<div class="titre">
				<table>
					<tr>
						<td>Titre</td>
					</tr>
					<tr>
						<td><input type="text" name="titreQuestaire" required maxlength="100" placeholder="Titre" autofocus /></td>
					</tr>
					<tr>
						<td>Description</td>
					</tr>
					<tr>
						<td><textarea name="descripQuestaire" required rows="3" cols="40" placeholder="Description" onkeyup="adjust_textarea(this)"></textarea></td>
					</tr>
				</table>
			</div>
			<div class="visi">
				<table>
					<tr>
						<td>Promo*</td>
						<td>
							<select name="Promo" style="width: 80px">
								<option value="tous">Tous</option>
								<?php  foreach ($promos as $p)
								{
									$prom=$p->promo();
									echo "<option value=\"$prom\">$prom</option>";
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td width="30">
							<input type="checkbox" name="tous" onclick="pourToutePromo();">
						</td>
						<td>
							Toute la promo
						</td>
					</tr>
					<tr>
						<td><input id="radioGpe" type="radio" name="visibilite" value="groupe"
							onclick="SupprimerPourTD();"></td>
						<td>Groupe</td>
						<td><input class="groupe" type="text" name="groupe"
							disabled placeholder="Groupe 1 ou 2" style="background-color: #ddd"></td>
						</tr>
						<tr>
							<td><input id="radioTd" type="radio" name="visibilite" value="td"
								onclick="SupprimerPourGroupe();"></td>
							<td>TD</td>
							<td><input  class="td" type="text" name="td"
								disabled placeholder="TD 1,2,3,..." style="background-color: #ddd"></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="dispo">
					<table>
						<tr id="titre">
							<td id="ouv">Ouverture</td>
							<td id="ferm">Fermeture</td>
						</tr>
						<tr id="date">
							<td>Date</td>
							<td><input type="date" name="date_ouverture" required placeholder="Date ouverture"/></td>
							<td><input type="date" name="date_fermeture" required placeholder="Date fermeture"/></td>
						</tr>
						<tr id="date">
							<td>Heure</td>
							<td><input type="time" name="time_ouverture" required placeholder="Heure ouverture"/></td>
							<td><input type="time" name="time_fermeture" required placeholder="Heure fermeture"/></td>
						</tr>
					</table>
				</div>
			</form>
		</div>
		<script type="text/javascript">
//auto expand textarea
function adjust_textarea(h) {
	h.style.height = "20px";
	h.style.height = (h.scrollHeight)+"px";
}
</script>
