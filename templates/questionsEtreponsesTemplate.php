<div class="container">
	<h2>Questions et réponses</h2>
	<h6>R : réponses des élèves</h6>
	<div class="panel-group" id="qEtr">
			<?php
			$question = $this->args['questions'];
			$reponses = $this->args['reponses'];
			foreach ($question as $q) {
				$q_id = $q->id();
				$reps_associees = array();
				foreach ($reponses as $r) {
					if($r->idQuestion() == $q_id){
						array_push($reps_associees, $r);
					}
				}
				require('QetRTemplate.php');
			}
			?>
		</table>
	</div>
</div>
<button class="btn btn-light" onclick="history.go(-1);">Retour</button>