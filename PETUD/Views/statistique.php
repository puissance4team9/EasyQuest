<?php 
$titlePage="Statistique a un sondage";
ob_start();
?>
	<label>
		<?php 
			$QuestionLab= $adm->questionLabel($_GET['question']);
			echo '<h2 class="titreDeLaQuestion">'.$QuestionLab['quest'].'</h2> <h4>posée le '.$QuestionLab['date'].'</h4>';
		?> 
	</label>
	</p>
	<div>
		<?php
			$nbsTotalReponses=$adm->ToutesLesReponses($_GET['question']);
			if($nbsTotalReponses!=0)
			{
				echo '<div class="nbsReponsesTotal">Au total, il y a eu <strong id="high">'.$nbsTotalReponses.'</strong> réponse(s)</div>';
				
				$resultatTypeReponse= $adm->questionTypeRep($_GET['question']);
				echo '<div class="toutLesResulatsDuSondage">';
					foreach ($resultatTypeReponse as $data)
					{
						$resultatSondage=$adm->resultatDuSondage($_GET['question'],$data['typeReponse']);
						$pourc=($resultatSondage/$nbsTotalReponses)*100;
						echo '<div class="resultatSondage"><strong>'.$data['typeReponse'].'</strong> : '.$resultatSondage.' voix ('.round($pourc,2).'%)</div>';
					}
				echo '</div>';
			}
			else
			{
				echo '<h3 class="AucuneReponse">Pour le moment, <strong>AUCUNE</strong> personne n\'a repondu au sondage</h3>';
			}
		?>
	</div>

<?php 
	$content=ob_get_clean();
	include('Views/layout.php');
 ?>