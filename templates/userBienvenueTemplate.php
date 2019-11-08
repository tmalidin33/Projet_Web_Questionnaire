<?php
$user = $args['user'];
?>
<p>Vous êtes connecté <?php echo $user->nom()." ".$user->prenom(); ?></p>
<?php require_once('props'.$user->getRole().'.php'); ?>