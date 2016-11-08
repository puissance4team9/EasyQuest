<?php 
	$titlePage="mon Compte";
	ob_start(); 
	$pers2 = new QuestionManager();
	$info2=$pers2->infoUx($_SESSION['login']);
?>
	<h2 class="titremonCompte">Compte de <?php echo $info2['nomUt'].' '.$info2['prenomUt']; ?></h2>
	<div id="les2bouttonsMonCompte">
	<br><br>
		<center>
		<span style="padding-right: 21%"><a href="index3.php?page=mesQuestions&login=<?php echo $_SESSION['login']; ?>"><input type="submit" value="Mes questions"/></a></span>
		<span><a href="index3.php?page=Arepondre&login=<?php echo $_SESSION['login']; ?>" class="bouttonMonCompteDroite"><input type="submit" value="Question à répondre"/></a></span>
		</center>
	<br>
	</div>
<?php
	$content=ob_get_clean();
	include('Views/layout.php');
 ?>
	
