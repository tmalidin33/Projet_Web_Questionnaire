<?php

Model::addSqlQuery('USER_LIST',
	'SELECT * FROM '.User::$table_name.' ORDER BY '.User::$colLogin);

Model::addSqlQuery('USER_GET_WITH_LOGIN_AND_PASSWORD',
	'SELECT * FROM '.User::$table_name.' WHERE '.User::$colLogin.'=:login');

Model::addSqlQuery('USER_CREATE',
	'INSERT INTO '.User::$table_name.' ('.User::$colId.', '.User::$colLogin.', '.User::$colMdp.', '.User::$colMail.', '.User::$colNom.', '.User::$colPrenom.', '.User::$colRole.', '.User::$colPromo.', '.User::$colGroupe.', '.User::$colTD.', '.User::$colMatricule.', '.User::$colMatiere.', '.User::$colIntExt.') VALUES (NULL, :login, :mdp, :email, :nom, :prenom, :role, :promo, :groupe, :td, :matricule, :matiere, :intern_ext)');

Model::addSqlQuery('USER_CONNECT',
	'SELECT * FROM '.User::$table_name.'
	WHERE '.User::$colLogin.'=:login collate utf8_bin
	and '.User::$colMdp.'=:mdp');

Model::addSqlQuery('USER_GET_BY_ID',
	'SELECT * FROM '.User::$table_name.' WHERE '.User::$colId.'=:id');

Model::addSqlQuery('USER_IS_LOGIN_USED',
	'SELECT * FROM '.User::$table_name.' WHERE '.User::$colLogin.'=:login');

Model::addSqlQuery('USER_GET_ALL_PROMO',
	'SELECT DISTINCT '.User::$colPromo.' FROM '.User::$table_name.' WHERE '.User::$colRole.'="Etudiant" ORDER BY '.User::$colPromo);

Model::addSqlQuery('GET_RESULTATS_BY_QUESTIONNAIRE',
	'SELECT u.'.User::$colNom.', u.'.User::$colPrenom.', u.'.User::$colId.',SUM(rc.EST_JUSTE_C) '.User::$colNote.
	'	FROM '.User::$table_name.' u'.
	' JOIN reponse_choisie rc ON u.'.User::$colId.' = rc.'.User::$colId.
	'	JOIN est_compose ec ON rc.'.Question::$colId.' = ec.'.Question::$colId.
	'	WHERE ec.'.Questionnaire::$colId.' = :id_questionnaire'.
	' AND rc.'.Questionnaire::$colId.' = :id_questionnaire'.
	' GROUP BY rc.'.User::$colId.
	' ORDER BY '.User::$colNote.' DESC');

Model::addSqlQuery('GET_RESULTATS_BY_QUESTION',
	'SELECT u.'.User::$colNom.', u.'.User::$colPrenom.', rc.EST_JUSTE_C '.User::$colEstJuste.'
	FROM '.User::$table_name.' u 
	JOIN reponse_choisie rc ON u.'.User::$colId.' = rc.'.User::$colId.' 
	WHERE rc.'.Questionnaire::$colId.' = :idQuestionnaire 
	AND rc.'.Question::$colId.' = :idQuestion');

?>
