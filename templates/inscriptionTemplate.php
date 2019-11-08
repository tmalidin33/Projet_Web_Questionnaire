<div class="inscription col-lg-8 col-md-12">
  <h2>Inscription</h2>
  <?php
  if(isset($args['inscErrorText']))
  echo '<span class="error">' . $args['inscErrorText'] . '</span>';
  ?>
  <form action="index.php" method="post">
    <div class="form-group">
      <input class="form-control" id="loginInscription" type="text" name="inscLogin" placeholder="Login" required maxlength="50" autofocus>
    </div>
    <div class="form-group">
      <input class="form-control" id="PwdInscription" type="password" name="inscPassword" placeholder="Mot de passe" required minlength="8" maxlength="50">
    </div>
    <div class="form-group">

      <input class="form-control" id="nomInscription" type="text" name="nom" placeholder="Nom" required maxlength="30">
    </div>
    <div class="form-group">
      <input class="form-control" id="prenomInscription" type="text" name="prenom" placeholder="Prenom" required maxlength="30">
    </div>
    <div class="form-group">
      <input class="form-control" id="mailInscription" type="email" name="email" placeholder="Email" required maxlength="100">
    </div>
    <div class="form-groupe">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="role" id="etudiant" value="Etudiant" onclick="afficherPourEtudiant(); enleverPourEnseignant();" checked="checked">
        <label class="form-check-label" for="etudiant">Etudiant</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="role" id="enseignant" value="Enseignant" onclick="afficherPourEnseignant(); enleverPourEtudiant();">
        <label class="form-check-label" for="enseignant">Enseignant</label>
      </div>
    </div>
    <div class="eleve form-group ">
      <input class="form-control eleveInput" type="number" name="Promo" placeholder="Promo" required>
    </div>
    <div class="eleve form-group">
      <input class="form-control eleveInput" type="number" name="Groupe" placeholder="Groupe" required>
    </div>
    <div class="eleve form-group">
      <input class="form-control eleveInput" type="number" name="td" placeholder="TD" required>
    </div>
    <div class="enseignant form-group" >
      <input class="form-control enseignantInput" type="number" name="Matricule" maxlength="10" placeholder="Matricule">
    </div>
    <div class="enseignant form-group">
      <input class="form-control enseignantInput" type="text" name="Mat_enseignee" maxlength="30" placeholder="Matière enseignée">
    </div>
    <div class="enseignant form-group">
      <label class="form-check-label" for="inlineCheckbox1">Intervenant Extérieur :</label>
      <input type="hidden" value="0" name="Int_Ext">
      <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1" name="Int_Ext">
    </div>
    <button type="submit" class="btn btn-primary">Creer mon compte</button>
  </form>
</div>
