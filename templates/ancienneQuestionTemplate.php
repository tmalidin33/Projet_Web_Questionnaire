<div class="newQuestion">

  <?php
  //Gestion des erreurs dans le validateQuestionnaire à faire...
  // if(isset($args['questaireErrorText']))
  // 	echo '<span class="error">' . $args['questaireErrorText'] . '</span>';
  $question = $args['question'];
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
        <select class="form-control" id="inputType<?php echo "__".$num; ?>" disabled>
          <option><?php echo $question->type(); ?></option>
        </select>
      </div>
      <div class="form-group col-sm-6">
        <label for="inputDescription<?php echo "__".$num; ?>">Description</label>
        <textarea id="inputDescription<?php echo "__".$num; ?>" class="form-control" rows="3" cols="40" disabled>
          <?php echo $question->description_question(); ?>
        </textarea>
      </div>
      <div class="form-group col-sm-3">
        <label for="inputTag<?php echo "__".$num; ?>">Tag*</label>
        <input class="form-control" 
        disabled 
        style="background-color: #eee;"
        id="inputTag<?php echo "__".$num; ?>" 
        type="text" 
        value="<?php echo $question->tag(); ?>">
      </div>
    </div>
  </div>
  <input type="hidden" name="TypeQuestion__<?php echo $num; ?>" value="OLD">
  <input type="hidden" name="idQuestion__<?php echo $num; ?>" value="<?php echo $question->id(); ?>">
</div>
