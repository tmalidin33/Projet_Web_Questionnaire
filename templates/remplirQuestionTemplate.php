<script>
	var numQuestion = 1;
	$(document).ready(function(){
		$("#ajouterQuestion").click(function(){
			// URL en local
			url =window.location.origin+"/projet_web/?controller=ajax&action=questionNew&num="+numQuestion;
			// URL eden
			// url =window.location.origin+"/~thomas.malidin.delabriere?controller=ajax&action=questionNew&num="+numQuestion;
			$.ajax({
				url: url
			}).done(function(data) {
				$( "#questionsPourQuestionnaire" ).append( data );
				numQuestion++;
			});
		});

		$("#ajouterOld").click(function(){
			// local
			url = window.location.origin+"/projet_web/?controller=ajax&action=questionOld";
			// eden
			// url = window.location.origin+"/~thomas.malidin.delabriere?controller=ajax&action=questionOld";

			url += "&num="+numQuestion
			+"&idQ="+	$("#qSelect option:selected").val();
			$.ajax({
				url: url
			}).done(function(data) {
				$( "#questionsPourQuestionnaire" ).append( data );
				numQuestion++;
				afficheAncQ();
			});
		})

	});

	function afficheAncQ(){
		$("#ancienneQuestion").toggle();
		$("#btnAncQ").toggle();
	}
</script>

<button id="ajouterQuestion" class="btn btn-secondary sticky-top" style="z-index: 10000; top: 10px;">
	Ajouter une nouvelle question
</button>


<form action="index.php" method="post" style="margin-top: 15px;">
	<section id="questionsPourQuestionnaire">
	</section>

	<div class="form-group row" id="ancienneQuestion" style="display: none;">
		<select class="form-control col-8" id="qSelect">
			<?php
			$questions = $args['questions'];
			foreach ($questions as $q) {
				echo "<option value='".$q->id()."'>";
				echo $q->description_question();
				echo "</option>";
			}
			?>
		</select>
		<div class="col"></div>
		<a href='javascript:void(0)' id="ajouterOld" class="col btn btn-light">Ajouter</a>
		<a href='javascript:void(0)' class='closebtn col' onclick='afficheAncQ()'>
			&times;
		</a>
	</div>

	<a href='javascript:void(0)' class="btn btn-secondary form-group" id="btnAncQ" onclick="afficheAncQ();">
		Ajouter une question déjà existante
	</a>

	<div class="form-group">
		<input type="hidden" name="idQuestionnaire" value="<?php echo $args['idQuestionnaire']; ?>">
		<input class="btn btn-primary row" type="submit" name="addQuestions" value="Valider">
	</div>
</form>
