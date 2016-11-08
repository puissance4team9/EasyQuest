<?php 
$titlePage="Création de compte";
include_once('fonction/form.php');
ob_start();

?>
	<form method ="POST" action ="index3.php?page=creation" class="pavéInscription">
		<center>
			<h2> Inscription<strong class="notabena">*</strong> </h2>
			
			<center style="font-size:21px; color:red;">
			<?php 
				echo $prob;
			?>
			</center>
			
			<table border="0">
				<tr><td><b>Login: </b></td><td><input type="text" name="login"/></td></tr>
				<tr><td><b>Mot de passe :  </b></td><td><input type="password" name="mdp"/></td></tr>
				<tr><td><b>Confirmer le Mot de passe : </b></td><td><input  type="password" name="mdpBis"/></td></tr>
				<tr><td><b> Nom : </b></td><td><input type="text" name="nom"/></td></tr>
				<tr><td><b>Prenom :   </b></td><td><input type="text" name="prenom"/></td></tr>
				<tr><td><b>Sexe :  </b></td><td><SELECT name="listeSexe">
													<OPTION value="Homme" <?php keepSelected("Homme")?> >Homme</OPTION>
													<OPTION value="Femme" <?php keepSelected("Femme") ?> >Femme</OPTION>
												</SELECT></td></tr>
				<tr style="padding:0 0 7px;"><td><b>Age :  </b></td><td><select name="listeAge">
													<?php 
														for ($i=15;$i<=85;$i++)
														{
															echo '<option value="'.$i.'" '.keepSelected($i).'>'.$i.'</option>';
														}
													?>
												</select> <em>ans</em></td></tr></br>
				<tr><td><b>Categorie :  </b></td><td><SELECT name="listeCategorie">
														<OPTION value="Enseignant" <?php keepSelected("Enseignant")?> >Enseignant</OPTION>
														<OPTION value="Vacataire" <?php keepSelected("Vacataire") ?> >Vacataire</OPTION>
														<OPTION value="Etudiant" <?php keepSelected("Etudiant") ?> >Etudiant</OPTION>
														<OPTION value="Personnel" <?php keepSelected("Personnel") ?> >Personnel</OPTION>
													 </SELECT></td></tr>
				<tr><td><b>Code categorie<strong class="notabena">**</strong> : </b></td><td><input type="password" name="codeCate"/></td></tr>
			</table>
			
			<br>
			<p><input type="submit"	value="Valider l'inscription"/></p>
		</center>
		<p>
			* TOUT les champs sont obligatoires<br>
			** Il prouve que vous appartenez bien à la catégorie que vous avez selectionné
		</p>
		
	</form>

<?php  
	$content=ob_get_clean();
	include('Views/layout.php');
 ?>
	
