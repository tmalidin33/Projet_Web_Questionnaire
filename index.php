<?php

// //gestion d'affichage des erreurs
// error_reporting(E_ERROR | E_WARNING | E_PARSE);
// ini_set("display_errors", 1);error_reporting(1);
// define __ROOT_DIR constant which contains the absolute path on disk
// of the directory that contains this file (index.php)
// e.g. for http://eden.imt-lille-douai.fr/~luc.fabresse/index.php
// __ROOT_DIR = /home/luc.fabresse/public_html
$rootDirectoryPath = realpath(dirname(__FILE__));
define ('__ROOT_DIR', $rootDirectoryPath );
// define __BASE_URL constant which contains the URL PATH of the index.php
// e.g. for http://eden.imt-lille-douai.fr/~luc.fabresse/index.php
// __BASE_URL = /web01
$base_url = explode('/',$_SERVER['PHP_SELF']);
array_pop($base_url);
define ('__BASE_URL', implode('/',$base_url) );
// Load the Loader class to automatically load classes when needed
require_once(__ROOT_DIR . '/classes/AutoLoader.class.php');
// Load all application config
require_once(__ROOT_DIR . "/config/config.php");
// Reify the current request
$request = Request::getCurrentRequest();
try {
	$controller = Dispatcher::dispatch($request);
	$controller->execute();
} catch (Exception $e) {
	echo 'Error : ' . $e->getMessage() . "<br>";
}
// var_dump($_POST);
// var_dump($_SESSION);)
?>
