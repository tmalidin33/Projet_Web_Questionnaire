<h2>Connexion</h2>
<?php
if(isset($args['connErrorText'])){
	echo '<span class="error">' . $args['connErrorText'] . '</span>';
	echo "<script>openNav();</script>";
}
?>
<form action="index.php" method="post">
	<table>
		<tr>
			<td><input id="login" type="text" name="connLogin" placeholder="Login"/></td>
		</tr>
		<tr>
			<td><input type="password" name="connPassword" placeholder="Mot de passe"/></td>
		</tr>
		<tr>
			<td><input type="submit" value="Me connecter" /></td>
		</tr>
	</table>
</form>