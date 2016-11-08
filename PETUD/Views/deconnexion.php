<?php 
	$titlePage="deconnexion";
	ob_start(); 
	
	//$ux = new UtilisateurManager();
	//$ux->delogUser();
	$_SESSION=array();
	session_destroy();
	
	echo '<p id="revoir" style="font-size:36px; text-align:center;"> Merci et à bientôt sur notre site :) </p><br>
	<a href="#"><img src="assets/images/merci.jpg" width="916" height="260" alt="" /> </a>';
	$content=ob_get_clean();
	include('Views/layout.php');
 ?>
	
