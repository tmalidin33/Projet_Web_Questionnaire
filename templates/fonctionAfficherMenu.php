<?php 

foreach ($array as $key => $value) {
	if($key == 'deconnexion'){
		echo "<a href='logout.php'><li>Déconnexion</li></a>";
	} else {
		echo "<a ";
		if($key == Request::getActionName())
			echo "id='selected-element' ";
		echo "href='index.php?controller=";
		echo Request::getController();
		echo "&action=".$key."'><li>";
		echo $value;
		echo "</li></a>";
	}
}

?>