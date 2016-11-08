<?php 
	$titlePage="Accueil";
	$title='Bienvenue sur notre site de sondage de l\'IUT Lyon 1';
	ob_start();
?>


<h2><span>Easy Quest simplifie l'enquête statistique </span></h2>
<center style="font-size:16px">
  <div class="post_content">
	<p>Vous êtes étudiant, professeur,... à l'IUT informatique Lyon 1 
	et vous avez une question précise à poser ?<br>
	Vous voulez répondre à un sondage fait par un de vos professeur pour décaler le cours de math ?<br><br>
	<strong>Vous êtes sur le bon site !</strong><br><br>
	<em>
		Grâce à EasyQuest, il est facile de connaître les statistiques et  
		la manière dont se répartissent les opinions individuelles à propos d'une question donnée.<br><br>
	</em>
	</p>
	<div class="clr"></div>
	</div>

<form action="index3.php" method="post">
	<input type="submit" value="Creer un Sondage" name="creerSondage" class="boutonCreerSondage" />
</form>
</center>

<?php 	
	$content=ob_get_clean();
	include('Views/layout.php');
 ?>