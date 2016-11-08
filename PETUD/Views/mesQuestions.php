<?php 
$titlePage="mesQuestions";
include_once('fonction/form.php');
ob_start();
?>
	<h2>Voici vos questions</h2>
<center>
	<?php
		$ux= new questionManager();
		$tabQuest=$ux->mesQuestions($_GET['login']);
		$nbs=$ux->nbsQuestions($_GET['login']);
		echo '<h3> Vous avez créez '.$nbs.' Question(s)</h3><ul>';
			foreach($tabQuest as $data)
			{
				echo '<li style="font-size:0px"><a href="index3.php?page=statEssai&question='.$data['idQuestion'].'" style="font-size:16px">'.$data['quest'].'</a></li><br>';
			}
		echo '</ul>';
	?>
</center>
<?php 
	$content=ob_get_clean();
	include('Views/layout.php');
 ?>
	
