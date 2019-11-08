<div class="container">
  <h2>
    Liste des questionnaires
    <?php 
      if(Request::getController() == 'Etudiant'){
        echo "<button class=\"btn btn-secondary\" id=\"btnFiltre\" onclick=\"filter();\">À FAIRE</button>";
      }
    ?>
  </h2>
  <p>&#128269;</span>Rechercher parmis les questionnaires</p>
  <input class="form-control" id="myInput" type="text" placeholder="Recherche..">
  <br>
  <div id="mesQuestionnaires">
    <div class="row justify-content-around">
      <?php $questionnaires = $args['questionnaires'];
      $user=$args['user'];
      $compteur = 0;
      foreach ($questionnaires as $q)
      {
        require('questionnaireTemplate.php');
        $compteur++;
        if($compteur%2==0){
          echo "</div><div class='row justify-content-around'>";
        }
      }
      ?>
      <?php if(Request::getController() == 'Enseignant'){
        echo "<div class='col-6'>
        <a href='?action=nouveauQuestionnaire' class='btn btn-secondary row' style='margin-top: 30px;'>
          Ajouter un questionnaire
        </a>
      </div>";
      } ?>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();

      $("#mesQuestionnaires .q").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });

  var filtre = false;
  function filter(){
    if(!filtre){
      $("#mesQuestionnaires .q").filter(function() {
        $(this).toggle($(this).find('.btnRep').css('display') == 'inline-block')
      });
      $('#btnFiltre').html('TOUS');
    } else {
      $("#mesQuestionnaires .q").css('display', 'block');
      $('#btnFiltre').html('À FAIRE');
    }
    filtre = !filtre;
  }

  var afaire = <?php echo (isset($_GET['afaire']))?'true':'false' ?>;
  if(afaire)
    $('#btnFiltre').click();
</script>
