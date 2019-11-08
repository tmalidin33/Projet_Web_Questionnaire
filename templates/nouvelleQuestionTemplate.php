<div class="newQuestion">

  <?php
  //Gestion des erreurs dans le validateQuestionnaire à faire...
  // if(isset($args['questaireErrorText']))
  // 	echo '<span class="error">' . $args['questaireErrorText'] . '</span>';
  $types= $args['types'];
  $num = $args['num'];
  ?>
  <div class="entete">
    <table>
      <tr>
        <td><h2>Nouvelle Question #<?php echo $num; ?></h2></td>
      </tr>
    </table>
  </div>
  <div class="">
    <div class="form-row">
      <div class="form-group col-sm-3">
        <label for="inputType<?php echo "__".$num; ?>">Type de question*</label>
        <select name="TypeQuestion<?php echo "__".$num; ?>" class="form-control" id="inputType<?php echo "__".$num; ?>" onchange="changeType(this, <?php echo $num; ?>);">
          <?php  foreach ($types as $t)
          {
            echo "<option value=\"$t\">$t</option>";
          }
          ?>
        </select>
      </div>
      <div class="form-group col-sm-6">
        <label for="inputDescription<?php echo "__".$num; ?>">Description</label>
        <!-- <input type="text" name="descripQuestion"  id="inputDescription" placeholder="Groupe"> -->
        <textarea id="inputDescription<?php echo "__".$num; ?>" name="descripQuestion<?php echo "__".$num; ?>" class="form-control" required rows="3" cols="40" placeholder="Description"></textarea>
      </div>
      <div class="form-group col-sm-3">
        <label for="inputTag<?php echo "__".$num; ?>">Tag*</label>
        <input class="form-control" id="inputTag<?php echo "__".$num; ?>" type="text" name="Tag<?php echo "__".$num; ?>" placeholder="Maths, Physique, ..." required>
      </div>
    </div>
  </div>
  <div class="QCM<?php echo "__".$num; ?>">
    <div class="form-row">
      <div class="col-sm-9">
        <label for="inputReponse<?php echo "__".$num; ?>">Réponse</label>
        <input type="text" id="inputReponse<?php echo "__".$num; ?>" name="QCM_1<?php echo "__".$num; ?>" class="form-control" required>
      </div>
      <div class="form-check col-sm-2">
        <label for="inputEstJuste<?php echo "__".$num; ?>">Est Juste</label>
        <br>
        <input type="checkbox" class="form-check-input" id="inputEstJuste<?php echo "__".$num; ?>" name="EstJusteQCM_1<?php echo "__".$num; ?>">
      </div>
      <button type="button" class="close">&times;</button>
    </div>
  </div>
  <div class="QCU<?php echo "__".$num; ?>" style="display:none;">
    <div class="form-row">
      <div class="col-sm-9">
        <label for="inputReponse<?php echo "__".$num; ?>">Réponse</label>
        <input type="text" id="inputReponse<?php echo "__".$num; ?>" name="QCU_1<?php echo "__".$num; ?>" class="form-control">
      </div>
      <div class="form-check col-sm-2">
        <label for="inputEstJuste<?php echo "__".$num; ?>">Est Juste</label>
        <br>
        <input type="radio" class="form-check-input" id="inputEstJuste<?php echo "__".$num; ?>" name="EstJusteQCU<?php echo "__".$num; ?>" value="1">
      </div>
      <button type="button" class="close">&times;</button>
    </div>
  </div>
  <div class="Libre<?php echo "__".$num; ?>" style="display:none;">
    <div class="form-row">
      <label for="inputReponse<?php echo "__".$num; ?>">Réponse</label>
      <input type="text" id="inputReponse<?php echo "__".$num; ?>" name="LIBRE<?php echo "__".$num; ?>" class="form-control">
    </div>
  </div>
  <div class="Assignement<?php echo "__".$num; ?>" style="display:none;">
    <div class="form-row">
      <div class="col-sm-5">
        <label for="inputReponse<?php echo "__".$num; ?>">Réponse</label>
        <input type="text" id="inputReponse<?php echo "__".$num; ?>" name="ASSIGNE_1_1<?php echo "__".$num; ?>" class="form-control">
      </div>
      <div class="col-sm-1">
        <label for="icon"></label>
        <h3 id="icon">&#10234;</h3>
      </div>
      <div class="col-sm-5">
        <label for="inputReponse<?php echo "__".$num; ?>">Réponse</label>
        <input type="text" id="inputReponse<?php echo "__".$num; ?>" name="ASSIGNE_1_2<?php echo "__".$num; ?>" class="form-control">
      </div>
      <button type="button" class="close">&times;</button>
    </div>
  </div>
  <button type="button" class="btn btn-success QCMbtn<?php echo "__".$num; ?>" value="add new QCM" style="">+</button>
  <button type="button" class="btn btn-success QCUbtn<?php echo "__".$num; ?>" value="add new QCU" style="display:none;" >+</button>
  <button type="button" class="btn btn-success Assignementbtn<?php echo "__".$num; ?>" value="add new Assignement" style="display:none;">+</button>
</div>



<script type="text/javascript">
 var nbreponsesQCM_<?php echo $num;?> = 1;
 var nbreponsesQCU_<?php echo $num;?> = 1;
 var nbreponsesAssignement_<?php echo $num;?> = 1;
 var num = <?php echo $num; ?>;

 function addReponsesQCM($elem){
  $elem.append($("<div class='form-row'><div class='col-sm-9'><label for='inputReponse__"+num+"'>Réponse</label><input type='text' id='inputReponse__"+num+"'' name='QCM_"+nbreponsesQCM_<?php echo $num;?>+"__"+num+"' class='form-control' required></div><div class='form-check col-sm-2'><label for='inputEstJuste__"+num+"'>Est Juste</label><br><input type='checkbox' class='form-check-input' id='inputEstJuste__"+num+"' name='EstJusteQCM_"+nbreponsesQCM_<?php echo $num;?>+"__"+num+"'></div><button type='button' class='close'>&times;</button></div>"));
}
function addReponsesQCU($elem){
  $elem.append($("<div class='form-row'><div class='col-sm-9'><label for='inputReponse__"+num+"'>Réponse</label><input type='text' id='inputReponse__"+num+"' name='QCU_"+nbreponsesQCU_<?php echo $num;?>+"__"+num+"' class='form-control' required></div><div class='form-check col-sm-2'><label for='inputEstJuste__"+num+"'>Est Juste</label><br><input type='radio' class='form-check-input' id='inputEstJuste__"+num+"' name='EstJusteQCU__"+num+"' value='"+nbreponsesQCU_<?php echo $num;?>+"' required></div><button type='button' class='close'>&times;</button></div>"));
}
function addReponsesAssignement($elem){
  $elem.append($("<div class='form-row'><div class='col-sm-5'><label for='inputReponse__"+num+"'>Réponse</label><input type='text' id='inputReponse__"+num+"' name='ASSIGNE_"+nbreponsesAssignement_<?php echo $num;?>+"_1__"+num+"' class='form-control' required></div><div class='col-sm-1'><label for'icon__"+num+"'></label><h3 id='icon__"+num+"'>&#10234;</h3></div><div class='col-sm-5'><label for='inputReponse__"+num+"'>Réponse</label><input type='text' id='inputReponse__"+num+"' name='ASSIGNE_"+nbreponsesAssignement_<?php echo $num;?>+"_2__"+num+"' class='form-control' required></div><button type='button' class='close'>&times;</button></div>"));
}

function changeType(selectBox, num){
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
  switch(selectedValue){

    case 'QCM':
    $('.QCM__'+num).attr('style','display: block;');
    $('.QCMbtn__'+num).attr('style','display: inline-block;');
    $('.QCM__'+num).find("input[type='text']").prop('required',true);

    $('.QCU__'+num).attr('style','display: none;');
    $('.QCUbtn__'+num).attr('style','display: none;');
    $('.QCU__'+num).find("input[type='text']").prop('required',false);

    $('.Libre__'+num).attr('style','display: none;');
    $('.Libre__'+num).find("input[type='text']").prop('required',false);

    $('.Assignement__'+num).attr('style','display: none;');
    $('.Assignementbtn__'+num).attr('style','display: none;');
    $('.Assignementbtn__'+num).find("input[type='text']").prop('required',false);
    break;
    case 'QCU':
    $('.QCU__'+num).attr('style','display: block;');
    $('.QCUbtn__'+num).attr('style','display: inline-block;');
    $('.QCU__'+num).find("input[type='text']").prop('required',true);

    $('.QCM__'+num).attr('style','display: none;');
    $('.QCMbtn__'+num).attr('style','display: none;');
    $('.QCM__'+num).find("input[type='text']").prop('required',false);

    $('.Libre__'+num).attr('style','display: none;');
    $('.Libre__'+num).find("input[type='text']").prop('required',false);

    $('.Assignement__'+num).attr('style','display: none;');
    $('.Assignementbtn__'+num).attr('style','display: none;');
    $('.Assignementbtn__'+num).find("input[type='text']").prop('required',false);
    break;
    case 'LIBRE':
    $('.Libre__'+num).attr('style','display: block;');
    $('.Libre__'+num).find("input[type='text']").prop('required',true);

    $('.QCU__'+num).attr('style','display: none;');
    $('.QCUbtn__'+num).attr('style','display: none;');
    $('.QCU__'+num).find("input[type='text']").prop('required',false);

    $('.QCM__'+num).attr('style','display: none;');
    $('.QCMbtn__'+num).attr('style','display: none;');
    $('.QCM__'+num).find("input[type='text']").prop('required',false);

    $('.Assignement__'+num).attr('style','display: none;');
    $('.Assignementbtn__'+num).attr('style','display: none;');
    $('.Assignementbtn__'+num).find("input[type='text']").prop('required',false);
    break;
    case 'ASSIGNE':
    $('.Assignement__'+num).attr('style','display: block;');
    $('.Assignementbtn__'+num).attr('style','display: inline-block;');
    $('.Assignementbtn__'+num).find("input[type='text']").prop('required',true);

    $('.QCU__'+num).attr('style','display: none;');
    $('.QCUbtn__'+num).attr('style','display: none;');
    $('.QCU__'+num).find("input[type='text']").prop('required',false);

    $('.Libre__'+num).attr('style','display: none;');
    $('.Libre__'+num).find("input[type='text']").prop('required',false);

    $('.QCM__'+num).attr('style','display: none;');
    $('.QCMbtn__'+num).attr('style','display: none;');
    $('.QCM__'+num).find("input[type='text']").prop('required',false);
    break;
  }
}
$(document).ready(function(){
  $('.QCMbtn<?php echo "__".$num; ?>').click(function(){
    nbreponsesQCM_<?php echo $num;?>++;
    addReponsesQCM($('.QCM<?php echo "__".$num; ?>'));
  });
  $('.QCUbtn<?php echo "__".$num; ?>').click(function(){
    nbreponsesQCU_<?php echo $num;?>++;
    addReponsesQCU($('.QCU<?php echo "__".$num; ?>'));
  });
  $('.Assignementbtn<?php echo "__".$num; ?>').click(function(){
    nbreponsesAssignement_<?php echo $num;?>++;
    addReponsesAssignement($('.Assignement<?php echo "__".$num; ?>'));
  });
  $('.QCM<?php echo "__".$num; ?>').on('click','.close',function(e){
    console.log(e);
    $(e.target.parentElement).remove();
  });
  $('.QCU<?php echo "__".$num; ?>').on('click','.close',function(e){
    console.log(e);
    $(e.target.parentElement).remove();
  });
  $('.Assignement<?php echo "__".$num; ?>').on('click','.close',function(e){
    console.log(e);
    $(e.target.parentElement).remove();
  });
});


</script>
