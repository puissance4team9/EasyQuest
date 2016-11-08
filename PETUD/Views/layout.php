<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<HTML xmlns="http://www.w3.org/1999/xhtml">
		<HEAD>
			<meta charset ="utf-8">
			<link rel="stylesheet" type="text/css" href="assets/style.css" />
			<link rel="stylesheet" type="text/css" href="assets/coin-slider.css" />
			<script type="text/javascript" src="js/cufon-yui.js"></script>
			<script type="text/javascript" src="js/cufon-georgia.js"></script>
			<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
			<script type="text/javascript" src="js/script.js"></script>
			<script type="text/javascript" src="js/coin-slider.min.js"></script>
			<TITLE><?php echo $titlePage ?></TITLE>
		</HEAD>
		<BODY>
			<div class="main">
				<div class="header">
					<div class="header_resize">
						<div class="menu_nav">
							<ul>
								<li class="active"><a href="index3.php"><span>Accueil</span></a></li>
								<?php
									if (isset($_SESSION['login']))
									{
										echo '<li><a href="index3.php?page=deconnexion"><span>Deconnexion</span></a></li>
											  <li><a href="index3.php?page=monCompte"><span>Mon Espace</span></a></li>';
									}
									else
									{
										echo '<li><a href="index3.php?page=connexion"><span>Connexion</span></a></li>
											  <li><a href="index3.php?page=creation"><span>Inscription</span></a></li>';
										
									}
								?>
							</ul>
							
						</div>
						<div class="logo">
							<h1><a href="index3.php"><span>Easy Quest</span></a></h1>
						</div>
						<div class="clr"></div>
						<div class="slider">
							<div id="coin-slider"> <a href="#"><img src="assets/images/sondages.jpg" width="960" height="360" alt="" /> </a> <a href="#"><img src="assets/images/sondages1.jpg" width="960" height="360" alt="" /> </a> <a href="#"><img src="assets/images/sondages3.jpg" width="960" height="360" alt="" /> </a> <a href="#"><img src="assets/images/sondages4.jpg" width="960" height="360" alt="" /> </a></div>
							<div class="clr"></div>
					    </div>
					    <div class="clr"></div>
					</div>	
				</div>	
				
				<div class="content">
					<div class="content_resize">
						<div class="mainbar">
							<div class="article">
								<?php echo $content ?>
								<div class="clr"></div>
							</div>
						</div>
						<div class="clr"></div>
					</div>
				 </div>
					
					
				<div class="fbg">
					<div class="fbg_resize">
					  <?php 
						if(isset($_SESSION['login'])) 
						{
							$pers = new QuestionManager();
							$info=$pers->infoUx($_SESSION['login']);
							echo '<p id="loglog">Connecté en tant que '.$info['nomUt'].' '.$info['prenomUt'].'</p>'; 
						}	
					  ?>
					  <div class="col c1">
						<h2><span>Partagez sur les réseaux sociaux !</span></h2>
						<a href="http://www.facebook.com/sharer.php?u=http://iutdoua-webetu.univ-lyon1.fr/~p1422662/PETUD/index3.php" target="_blank"><img width="75" height="75" class="gal" src="assets/images/logoFacebook.png" alt="logo Facebook"/></a>
						<a href="https://twitter.com/share?url=https://iutdoua-webetu.univ-lyon1.fr/~p1422662/PETUD/index3.php" target="_blank"><img width="75" height="75" class="gal" src="assets/images/logoTwitter.png" alt="logo Twitter"/></a>
						<a href="https://plus.google.com/share?url=https://iutdoua-webetu.univ-lyon1.fr/~p1422662/PETUD/index3.php" target="_blank"><img width="75" height="75" class="gal" src="assets/images/logoGoogle.png" alt="logo Google +"/></a>
						
					  </div>
					  <div class="col c2">
						<h2><span>Qui</span> Sommes-nous ?</h2>
						<p>Etudiants en deuxiéme années dans le cursus de DUT Informatique, nous avons réalisé ce site web de sondage dans le cadre de notre projet tuteuré final (S3 - S4).<br />Il a pour but de répondre aux besoins de toute personne rataché au departement informatique (enseignant, vacataire, etudiant, ...) au travers d'enquêtes, de sondages menées sur celui-ci. </p>
						<ul class="fbg_ul">
						  <span>tuteur : </span>M.BARAMGHI
						</ul>
					  </div>
					  <div class="col c3">
						<h2><span>Nous</span> Contactez</h2>
						<p>Depuis sa création en 1967, l'IUT Lyon 1 a su construire un dispositif de formation cohérent, réactif et adapté aux besoins d'emplois des différents secteurs économiques.<br />Entrer à l'IUT Lyon 1, c'est viser avec nous l’objectif : « un étudiant = un diplômé = un emploi ».</p>
						<p class="contact_info"> <span>Address:</span>1 rue de la Technologie, 69100 Villeurbanne<br />
						  <span>Telephone:</span> +33 (0)4 72 69 20 00<br />
						  <span>FAX:</span> +33 (0)4 72 69 20 39<br />
						  <span>E-mail :</span> <a href="#">easyquest@EasyQuest.com</a> </p>
					  </div>
					  <div class="clr"></div>
					</div>
				</div>
				<div class="footer">
					<div class="footer_resize">
					  <p class="lf">COPYRIGHT © 2016</p>
					  <p class="rf">T.Nacereddine - B.Samy - L.Yohan</p>
					  <div style="clear:both;"></div>
					</div>
				</div>
			</div>
		</BODY>
	</HTML>