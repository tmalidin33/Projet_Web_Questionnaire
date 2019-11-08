<div class="container">
  <h2>Liste de utilisateurs</h2>
  <p>&#128269;</span> Rechercher parmis les utilisateurs</p>
  <input class="form-control" id="myInput" type="text" placeholder="Recherche..">
  <br>
  <table class="table text-light">
    <thead>
      <tr>
        <th>ID</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Login</th>
        <th>Mot de passe</th>
        <th>Email</th>
        <th>Role</th>
        <th>Promo</th>
        <th>Groupe</th>
        <th>TD</th>
        <th>Matricule</th>
        <th>Int. exterieur</th>
        <th>Matière enseignée</th>
      </tr>
    </thead>
    <tbody id="myTable">
     <?php $users = $args['users'];
     foreach ($users as $user) {
      echo "<tr>";
      echo "<td>". $user->id(). "</td>";
      echo "<td>". $user->prenom(). "</td>";
      echo "<td>". $user->nom(). "</td>";
      echo "<td>". $user->login(). "</td>";
      echo "<td>". $user->mdp(). "</td>";
      echo "<td>". $user->mail(). "</td>";
      echo "<td>". $user->role(). "</td>";
      echo "<td>". (($user->promo()==null)?'-':$user->promo()). "</td>";
      echo "<td>". (($user->td()==null)?'-':$user->td()). "</td>";
      echo "<td>". (($user->grp_demiPromo()==null)?'-':$user->grp_demiPromo()). "</td>";
      echo "<td>". (($user->matricule()==null)?'-':$user->matricule()). "</td>";
      $intE = $user->int_ext();
      if($intE == null)
        echo "<td>-</td>";
      else {
        if($user->int_ext() == 1)
          echo "<td>Oui</td>";
        else
          echo "<td>Non</td>";
      }
      echo "<td>". (($user->matiere()==null)?'-':$user->matiere()). "</td>";
      echo "</tr>";
    } ?>
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
