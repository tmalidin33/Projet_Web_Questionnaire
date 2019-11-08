<?php 
$array = array('default' => 'Accueil', 'deconnexion' => 'Déconnexion', 'profil' => 'Mes informations');
require_once('menu'.$args['user']->role().'.php'); 
?>