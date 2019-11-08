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
		<div>
			<table class="table">
				<tr>
					<td><h2>Nouveau Questionnaire</h2></td>
					<td><input class="btn btn-light" type="submit" value="Créer"></td>
				</tr>
			</table>
		</div>
		<div class="form-row titre">
			<div class="form-group col-sm-6">
				<label for="inputTitre">Titre*</label>
				<input type="text" name="titreQuestaire" class="form-control" id="inputTitre" placeholder="Titre" required maxlength="100" autofocus>
			</div>
			<div class="form-group col-sm-6">
				<label for="inputDescription">Description*</label>
				<input type="text" name="descripQuestaire" class="form-control" id="inputDescription" placeholder="Description">
			</div>
		</div>
		<div class="promos">


			<div class="form-row">
				<div class="form-group col-sm-4">
					<label for="inputPromo">Promo*</label>
					<select name="Promo" class="form-control tous" id="inputPromo" onchange="disabledChamps();">
						<option value="tous">Tous</option>
						<?php  foreach ($promos as $p)
						{
							$prom=$p->promo();
							echo "<option value=\"$prom\">$prom</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group col-sm-4">
					<label for="inputGroupe">Groupe</label>
					<input type="text" name="groupe" class="form-control groupe" id="inputGroupe" placeholder="Groupe" onfocus="SupprimerPourTD();" disabled style="background: #ddd;">
				</div>
				<div class="form-group col-sm-4">
					<label for="inputTD">TD</label>
					<input type="text" name="td" class="form-control td" id="inputTD" placeholder="TD" onfocus="SupprimerPourGroupe();" disabled style="background: #ddd;">
				</div>
			</div>
			<div class="form-group allprom" style="display: none;">
				<div class="form-check">
						<label class="form-check-label" for="allPromos">
							Toute la promo
						</label>
						<input name="tous" type="hidden" id="allPromos" value="off">
						<input name="tous" type="checkbox" id="allPromos" onclick="pourToutePromo();" value="on">
				</div>
			</div>
		</div>
		<div class="dateTime">
			<div class="form-row">
				<div class="form-group col-sm-2">
				</div>
				<div class="form-group col-sm-5">
					<label for="inputOuverture">Ouverture</label>
				</div>
				<div class="form-group col-sm-5">
					<label for="inputFermeture">Fermeture</label>
				</div>
			</div>
			<?php 
			date_default_timezone_set('Europe/Paris'); 
			?>
			<div class="form-row">
				<label for="inputOuverture" class="col-sm-2 col-form-label">Date</label>
				<div class="col-sm-5">
					<input type="date" name="date_ouverture" class="form-control" id="inputOuverture" placeholder="Date ouverture" value="<?php echo date('Y-m-d'); ?>" />
				</div>
				<div class="col-sm-5">
					<input type="date" name="date_fermeture" class="form-control" id="inputFermeture" placeholder="Date fermeture" value="<?php echo date('Y-m-d'); ?>" />
				</div>
			</div>
			<div class="form-row">
				<label for="inputOuverture" class="col-sm-2 col-form-label">Heure</label>
				<div class="col-sm-5">
					<input type="time" name="time_ouverture" class="form-control" id="inputOuverture" placeholder="Heure ouverture" value="00:00">
				</div>
				<div class="col-sm-5">
					<input type="time" name="time_fermeture" class="form-control " id="inputFermeture" placeholder="Heure fermeture" value="23:00">
				</div>
			</div>
		</div>
	</form>
</div>
