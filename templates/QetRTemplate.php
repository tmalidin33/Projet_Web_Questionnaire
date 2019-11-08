<div class='panel panel-default'>
	<div class='enteteQuestion'>
		<h4 class='panel-title'>
			<?php
			echo $q->description_question();
			if(Request::getController() == 'Enseignant'){
				echo "<a href=\"?action=repUneQuestion&idQuestion=";
				echo $q->id();
				echo "&idQuestionnaire=";
				echo $_GET['idQuestionnaire'];
				echo "\" class=\"btn btn-outline-light\" style='margin-left:10px;'>R</a>";
			}
			?>
		</h4>
		<?php  ?>
	</div>
	<div class='panel panel-body'>
		<table class="table table-striped table-light">
			<tbody>
				<?php
				switch ($q->type()) {
					case 'QCM':
					foreach ($reps_associees as $r) {
						echo "<tr>
						<td>
						<input type='hidden' 
						name='QCM_qId:".$q->id().
						"_nbRep:".$q->nombre_reponses().
						"_rId:".$r->id().
						"_juste:".$r->estJuste().
						"'
						value='off'>";
						echo "<input type='checkbox' 
						name='QCM_qId:".$q->id().
						"_nbRep:".$q->nombre_reponses().
						"_rId:".$r->id().
						"_juste:".$r->estJuste().
						"'
						value='on'>
						</td>";

				// Mettre deux input qui ont le même nom :
				// Si l'élément est checked : value sera 'on' dans le post
				// Si unchecked, value sera off
				// Sans le hidden, il n'y aura rien dans le post pour cet élément si l'élément est unchecked 

						echo "<td>".$r->contenu()."</td>";
						echo "</tr>";
					}
					break;

					case 'QCU':
					foreach ($reps_associees as $r) {
						echo "<tr><td><input type='radio' 
						value='rId:".$r->id().
						"_juste:".$r->estJuste()."' 
						name='QCU_qId:".$q->id()."'></td> ";
						echo "<td>".$r->contenu()."</td>";
						echo "</tr>";
					}
					break;

					case 'LIBRE':	
					echo "<tr><td>";
					echo "<input type='text' class='form-control' style='margin:5px;'
					name='LIBRE_qId:".$q->id().
					"_rep:".$reps_associees[0]->contenu()."'>";
					echo "</td></tr>";
					break;

					case 'ASSIGNE':
					$rep_gauche = array();
					$rep_droite = array();
					foreach ($reps_associees as $r) {
						if($r->colonne() == '0'){
							array_push($rep_gauche, $r);
						}
						else			
							array_push($rep_droite, $r);
					}
					shuffle($rep_droite);
					for($i = 0; $i<count($rep_droite); $i++){
						echo "<tr>";
						echo "<td>".$rep_gauche[$i]->contenu()."</td>";
						// echo "<td>".$rep_gauche[$i]->id()."</td>";
						// echo "<td><input type='number' 
						// name='ASSIGNE_qId:".$q->id().
						// "_nbRep:".$q->nombre_reponses().
						// "_rDrId:".$rep_droite[$i]->id()."' style='width:40px;'></td>";

						echo "<td>".($i+1)."</td>";
						echo "<td><select name='ASSIGNE_qId:".$q->id()."_nbRep:".$q->nombre_reponses()."_rDrId:".$rep_droite[$i]->id()." class='form-control'>";
						for($j = 1 ; $j < count($rep_droite) + 1 ; $j++){
							echo "<option value='".$rep_gauche[$j-1]->id()."'>$j</option>";
						}
						echo "</select>";
						echo "<td>".$rep_droite[$i]->contenu()."</td>";
						echo "</tr>";
					}
					break;
				}
				?>
			</tbody>
		</table>
	</div>
</div>