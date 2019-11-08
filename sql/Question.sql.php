<?php

Model::addSqlQuery('QUESTION_LIST',
	'SELECT * FROM '.Question::$table_name.' ORDER BY '.Question::$colTag);

Model::addSqlQuery('QUESTION_TYPES',
	'SELECT DISTINCT '.Question::$colType.' FROM '.Question::$table_name);

Model::addSqlQuery('QUESTION_CREATE',
	'INSERT INTO '.Question::$table_name.' ('.Question::$colId.', '.Question::$colIdConsigne.', '.Question::$colTag.', '.Question::$colType.', '.Question::$colNbRep.', '.Question::$colDesQu.') VALUES (NULL, :id_c, :tag, :type, :nb_r, :des_ques)');

Model::addSqlQuery('GET_QUESTION_BY_ID',
	'SELECT * FROM '.Question::$table_name.' WHERE '.Question::$colId.' = :id_q');

Model::addSqlQuery('GET_QUESTIONS_BY_QUESTIONNAIRE',
	'SELECT Q.* FROM '.Question::$table_name.' Q JOIN est_compose EC ON Q.'.Question::$colId.'=EC.ID_QUESTION WHERE ID_QUESTIONNAIRE = :id_q');

Model::addSqlQuery('ASSOCIER_QUESTIONS_QUESTIONNAIRE',
	'INSERT INTO est_compose ('.Question::$colId.', '.Questionnaire::$colId.') VALUES (:QuestionId,:QuestionnaireId);');

Model::addSqlQuery('GET_RESULTAT_USER_QUESTIONNAIRE',
	'SELECT q.*, rc.EST_JUSTE_C'.
	' FROM reponse_choisie rc'.
	' JOIN est_compose ec ON rc.'.Question::$colId.' = ec.'.Question::$colId.
	' JOIN '.Question::$table_name.' q ON rc.'.Question::$colId.' = q.'.Question::$colId.
	' WHERE ec.'.Questionnaire::$colId.' = :idQuestionnaire'.
	' AND rc.'.User::$colId.' = :idUser'.
	' AND rc.'.Questionnaire::$colId.' = :idQuestionnaire');


	?>
