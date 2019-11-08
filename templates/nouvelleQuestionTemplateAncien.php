<div class="newQuestionnaire">

	<?php
	//Gestion des erreurs dans le validateQuestionnaire à faire...
	// if(isset($args['questaireErrorText']))
	// 	echo '<span class="error">' . $args['questaireErrorText'] . '</span>';
	$user = $args['user'];
  $type= $args['type'];
	?>
	<form action="index.php" method="post">
		<div class="entete">
			<table>
				<tr>
					<td><h2>Nouvelle Question</h2></td>
					<td><input type="submit" value="Créer" style="width:70%"/></td>
				</tr>
			</table>
		</div>
		<div class="titreVisi">
			<div class="titre">
				<table>
          <tr>
						<td>Type de question*</td>
						<td>
							<select name="TypeQuestion" style="width: 140px">
                <?php  foreach ($type as $t)
                {
                  $typ=$t->type();
                  echo "<option value=\"$typ\">$typ</option>";
                }
                ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Description</td>
					</tr>
					<tr>
						<td style="width:80%"><textarea name="descripQuestion" required rows="3" cols="40" placeholder="Description" onkeyup="adjust_textarea(this)" autofocus ></textarea></td>
					</tr>
				</table>
			</div>
			<div class="visi">
				<table>
					<tr>
						<td>Tag*</td>
            <td><input type="text" name="Tag" placeholder="Maths, Physique, ..."></td>
					</tr>
					<tr>
            <td>Nombre de réponses</td>
						<td><input type="text" name="NbrRep" placeholder="Rentrer un nombre..."></td>
          </tr>
						</table>
					</div>
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
