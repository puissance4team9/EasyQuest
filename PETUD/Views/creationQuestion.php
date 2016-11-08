<?php 
$titlePage="Création d'une Question";
include_once('fonction/form.php');
ob_start();
?>
	<h2>Créer VOTRE Sondage</h2>
	<form method ="POST" action ="index3.php?page=creationQuestion" id="formulaireQuestion">
		<center style="font-size:21px; color:red;">
		<?php 
			echo $probQuest; 
		 ?>
		</center>
		<label>* Nom de votre Question : </label>
		<center>
		<table border="0">
			
				<tr><tr><td><b>* Intituler  : </b></td><td><input type="text" name="nomQuestion"/></td></tr></tr>
				
		</table>
		</center>
		<label> Reponse(s) possible(s) : </label><br><br>
		<center>
			<table border="0">
			
				<tr><tr><td><b>* Réponse 1 : </b></td><td><input type="text" name="rep1"/></td></tr></tr>
				<tr><tr><td><b>Réponse 2 : </b></td><td><input type="text" name="rep2"/></td></tr></tr>
				<tr><tr><td><b>Réponse 3 : </b></td><td><input type="text" name="rep3"/></td></tr></tr>
				<tr><tr><td><b>Réponse 4 : </b></td><td><input type="text" name="rep4"/></td></tr></tr>
				<tr><tr><td><b>Réponse 5 : </b></td><td><input type="text" name="rep5"/></td></tr></tr>
				
			</table>
		</center>
		
		<label>* A Quel catégorie est-elle destinée : </label>
		<center>
			<INPUT type="checkbox" name="Enseignant" value="Enseignant"> Enseignant 
			<INPUT type="checkbox" name="Vacataire" value="Vacataire"> Vacataire
			<INPUT type="checkbox" name="Etudiant" value="Etudiant"> Etudiant
			<INPUT type="checkbox" name="Personnel" value="Personnel"> Personnel
		</center><br><br>
		<center>
		<p><input type="submit"	value="Valider"/></p>
		<p>* Champ obligatoire</p>
		</center>
		
	</form>	

<?php 
	echo $probQuest; 
	$content=ob_get_clean();
	include('Views/layout.php');
 ?>
	
