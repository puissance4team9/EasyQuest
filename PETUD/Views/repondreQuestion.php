<?php 
$titlePage="repondre a un sondage";
ob_start();
?>
<br>
<form method ="POST" id="formulaireReponse" action ="index3.php?page=repondreQuestion&login=<?php echo $_GET['login'].'&question='.$_GET['question']; ?>">
	<div class="clr"></div>
	<p>
		<?php $lb = new QuestionManager(); ?>
		<label>
			<?php 
				$resultatlabel= $lb->questionLabel($_GET['question']);
				$valeur=$lb->nomPrenom($_GET['question']);
				echo '<h2 class="titreDeLaQuestion">'.$resultatlabel['quest'].'</h2>
					 <label class="nomDeLadmin">
						(Question posé par <strong>'.$valeur['nomUt'].' '.$valeur['prenomUt'].'</strong> le '.$resultatlabel['date'].')
					 </label>';
			?> 
		</label>
	</p>
	<div class="touteLesReponses">
		<?php 
			$resultat= $lb->questionTypeRep($_GET['question']);
			foreach ($resultat as $data)
				{
					echo '<INPUT type="radio" name="reponse" value="'.$data['typeReponse'].'"/>'.$data['typeReponse'].'<br><br>';
				}
		?>
	</div>
	<p>
		<input type="submit" value="Valider"/>
	</p>
	<p class="notabenaB">Attention, une fois voté vous ne pourrez plus revenir en arrière</label>
</form>

<?php 
	$content=ob_get_clean();
	include('Views/layout.php');
 ?>