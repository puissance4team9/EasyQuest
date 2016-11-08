<?php 
$titlePage="connexion";
ob_start();
?>
<center>
<form method ="POST" action ="index3.php?page=connexion">
	
	<h2>Connexion</h2>
	<?php echo '<br><a href="index3.php?page=creation">Pas encore inscrit ?</a><br><br>' ?>
	<center style="font-size:21px; color:red;">
	<?php echo $affich; ?>
	</center>
		<table border="0">
			<tr><td><b>Login: </b></td><td><input type="text" name="login"/></td></tr>
			<tr><td><b>Mot de passe :  </b></td><td><input type="password" name="mdp"/></td></tr>
		</table>
		<p><input type="submit"	value="Valider"/></p>
</form>
</center>

<?php 
	$content=ob_get_clean();
	include('Views/layout.php');
 ?>
	
