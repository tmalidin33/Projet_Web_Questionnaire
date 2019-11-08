<div class="container">
  <h2>Liste des questions</h2>
	<p>&#128269;</span>Rechercher parmis les questions</p>
  <input class="form-control" id="myInput" type="text" placeholder="Recherche..">
  <br>
  <table class="table text-light">
    <thead>
      <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Tag</th>
				<th>Description</th>
        <th>Nombre de réponses</th>
      </tr>
    </thead>
    <tbody id="myTable">
			<?php $questions = $args['questions'];
			foreach ($questions as $q) {
				require('questionTemplate.php');
			}
			?>
    </tbody>
  </table>
</div>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
