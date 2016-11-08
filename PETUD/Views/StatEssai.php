<?php 
$titlePage="Statistique a un sondage";
ob_start();
?>
	<label>
		<?php 
			$QuestionLab= $adm->questionLabel($_GET['question']);
			echo '<h2 class="titreDeLaQuestion">'.$QuestionLab['quest'].'</h2> <h4>posée le '.$QuestionLab['date'].'</h4></label>';
			$nbsTotalReponses=$adm->ToutesLesReponses($_GET['question']);
			if($nbsTotalReponses!=0)
			{
				$resultatTypeReponse= $adm->questionTypeRep($_GET['question']);
				$nbsTypesRep=count($resultatTypeReponse);
				$lesTypes=array();
				$lesRes=array();
				foreach ($resultatTypeReponse as $data)
				{
					array_push($lesTypes,$data['typeReponse']);
					$resultatSondage=$adm->resultatDuSondage($_GET['question'],$data['typeReponse']);
					array_push($lesRes,$resultatSondage);
					//echo '<div class="resultatSondage"><strong>'.$data['typeReponse'].'</strong> : '.$resultatSondage.' voix ('.round($pourc,2).'%)</div>';
				}
				
				echo '
				<div id="res">Resultat du sondage</div>
				<div id="chart_div"></div>	
				<div id="touteLesStatsPossibles">
				
					<form id="choixStats1" method ="POST" action ="index3.php?page=statEssai&question='.$_GET['question'].'">
						<h4>Statistiques pour les Questions</h3>
						<label>choix par :</label>
						<select name="opt1">
							<option id="ageStats1" value="ageUt"> Age</option>
							<option id="sexeStats1" value="sexeUt"> Sexe</option>
							<option id="catStats1" value="idCategorie"> Categorie</option>
						</select>
						<input type="submit" value="ok">
						
					</form>
					
					<form id="choixStats2" method ="POST" action ="index3.php?page=statEssai&question='.$_GET['question'].'">
						<h4>Statistiques sur les participants</h3>
						<label>choix par :</label>
						<select name="opt2">
							<option id="ageStats2" value="ageUt"> Age</option>
							<option id="sexeStats2" value="sexeUt"> Sexe</option>
							<option id="catStats2" value="idCategorie"> Categorie</option>
						</select>
						<input type="submit" value="ok">
					</form>
				
				</div>';				    
				?>
				<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
				<script type="text/javascript">
				    google.charts.load('current', {'packages':['corechart']});
				    google.charts.setOnLoadCallback(drawChart);
				    function drawChart() {

					// Create the data table.					
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Topping');
					data.addColumn('number', 'Slices');
					data.addRows([
						<?php
							$i=0;
							for($i=0;$i<count($lesRes);$i++)
							{
								echo '[\''.$lesTypes[$i].'\','.$lesRes[$i].'],';
							}
						?>
					]);

					// Set chart options
					var options = {'title':'',
								   'is3D': true,
								   'width':500,
								   'height':400};

					// Instantiate and draw our chart, passing in some options.
					var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
					chart.draw(data, options);
				  }
				</script>
				<div id="essaiPour"></div>
				<div id="essaiPour2"></div>
					
				<?php
				}
				else
				{
					echo '<h3 class="AucuneReponse">Pour le moment, <strong>AUCUNE</strong> personne n\'a repondu au sondage</h3>';
				}
				?>

<?php 
	$content=ob_get_clean();
	include('Views/layout.php');
 ?>