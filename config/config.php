<?php 

$tables = array('User', 'Question', 'Questionnaire', 'Reponse');
	//ajout des queries
foreach ($tables as $table) {
	require_once(__ROOT_DIR.'/sql/'.$table.'.sql.php');
}

Model::exec('UPDATE_ETAT_QUESTIONNAIRES');

?>