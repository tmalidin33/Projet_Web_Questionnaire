<div class="container">
  <h2>Liste des réponses</h2>
	<p>&#128269;</span>Rechercher parmis les réponses</p>
  <input class="form-control" id="myInput" type="text" placeholder="Recherche..">
  <br>
  <table class="table text-light">
    <thead>
      <tr>
        <th>ID</th>
        <th>Contenu</th>
        <th>Est Juste</th>
				<th>Colonne</th>
        <th>Question associée</th>
      </tr>
    </thead>
    <tbody id="myTable">
			<?php $reponses = $args['reponses'];
			foreach ($reponses as $r) {
				require('reponseTemplate.php');
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
