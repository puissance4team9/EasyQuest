<?php 
$titlePage="mesQuestions";
include_once('fonction/form.php');
ob_start();
?>
	<h2>Voici vos questions</h2>
	<?php
		$ux= new questionManager();
		$categ=$ux->categorieUx($_GET['login']);
		$tabQuest=$ux->vosQuestions($categ['idCategorie']);
		$nbs1=0;
		foreach($tabQuest as $data) //Nombre de questions restantes 
		{
			$reponse=$ux->aRepondu($_GET['login'],$data['idQuestion']);
			if ($reponse == 0)
			{
				$nbs1++;
			}
		}
		
		
		echo '<h3> '.$nbs1.' Question concernant les '.$categ['idCategorie'].'</h3><br>
			<table>
				<tr><td class="celluleQuest2"><label class ="titreTab">Question</label></td><td class="celluleTableauQuestion2"><label class ="titreTab">posé par </label></td><td class="celluleTableauQuestion2"><label class ="titreTab">le</label></td></tr>';
				foreach($tabQuest as $data)
				{
					$reponse=$ux->aRepondu($_GET['login'],$data['idQuestion']);
					$admin=$ux->infoUx($data['loginUt']);
					if ($reponse == 0)
					{
						echo '<tr>
								<td class="celluleQuest"><a href="index3.php?page=repondreQuestion&login='.$_GET['login'].'&question='.$data['idQuestion'].'" class="aQuest">'.$data['quest'].'</a></td>
								<td class="celluleTableauQuestion"><label class="uneDeMesQuestions">'.$admin['nomUt'].' '.$admin['prenomUt'].'</label></td>
								<td class="celluleTableauQuestion"><label class="uneDeMesQuestions">'.$data['date'].'</label>
							  </tr>';
					}
				}
		echo '</table>';
	?>

<?php 
	$content=ob_get_clean();
	include('Views/layout.php');
 ?>
	
