<?php
	Session_name('p1422662');
	session_start();
	//Appel fonctions
	include('Model/Model.php');
	include('Model/questionManager.php');
	//include('Model/CategorieManager.php');
	include('Model/UtilisateurManager.php');
	//include('Model/aimePhoto.php');
	
	if(isset( $_GET['page']))
	{
		if($_GET['page'] == 'connexion')
		{
			if (isset($_POST['login']) || isset($_POST['mdp']))
			{
				if($_POST['login'] == '') $affich='<p id="erreur">Entrez votre Login</p>'; // isset inverse marche pas
				else 
				{
					if($_POST['mdp'] == '') $affich='<p id="erreur">Entrez votre mot de passe</p>';
					else
					{
						$um1 = new UtilisateurManager();
						$res1=$um1->logUser($_POST['login'],$_POST['mdp']);
						if ($res1 != 1) $affich='<p id="erreur">Login ou mode passe incorrect</p>';
						else
						{
							$affich='';
							$_SESSION['login']=$_POST['login'];
							if($verifieConnexion == 1)
							{
								header('Location: index3.php?page=creationQuestion');
								exit(0);
							}
							else
							{
								header('Location: index3.php');
								exit(0);
							}
						}
					}					
				}
			}
			else $affich='';
			include('Views/connexion.php');	
		}
		else
		{
			if($_GET['page'] == 'creationQuestion')
			{
				if (isset($_POST['nomQuestion']))
				{
					if($_POST['nomQuestion'] == '') $probQuest='<p id="erreur">Entrez un Nom pour votre question</p>';
					else
					{
						if($_POST['rep1'] == '') $probQuest='<p id="erreur">La première reponse doit être obligatoirement renseignée </p>';
						else
						{
							if(!isset($_POST["Etudiant"]) && !isset($_POST["Enseignant"]) && !isset($_POST["Vacataire"]) && !isset($_POST["Personnel"])) $probQuest='<p id="erreur">Aucune catégorie selectionée </p>';
							else
							{
								//inserer la question 
								$qm = new questionManager();
								$dateQuestion=date("d/m/y");
								$questionId=$qm->creerQuestion($_SESSION['login'],$_POST['nomQuestion'],$dateQuestion);
								
								//inserer la date du jour dans l'autre sens pour le tri
								$existDate=$qm->verifExistDate($dateQuestion);
								if($existDate==1)
								{
									$qm->insertDateTri($dateQuestion,date("y/m/d"));
								}
								
								//inserer les categories de la question
								if(isset($_POST["Etudiant"])) $qm->inserQuestion($questionId,"Etudiant");
								if(isset($_POST["Enseignant"])) $qm->inserQuestion($questionId,"Enseignant");
								if(isset($_POST["Vacataire"])) $qm->inserQuestion($questionId,"Vacataire");
								if(isset($_POST["Personnel"])) $qm->inserQuestion($questionId,"Personnel");
								
								//inserer les types de réponses de la question
								$qm->inserTypeReponse($questionId,$_POST['rep1'],1);
								$x=2;
								if($_POST['rep2'] != '') 
								{
									$qm->inserTypeReponse($questionId,$_POST['rep2'],$x);
									$x++;
								}
								if($_POST['rep3'] != '') 
								{
									$qm->inserTypeReponse($questionId,$_POST['rep3'],$x);
									$x++;
								}
								if($_POST['rep4'] != '') 
								{
									$qm->inserTypeReponse($questionId,$_POST['rep4'],$x);
									$x++;
								}
								if($_POST['rep5'] != '') 
								{
									$qm->inserTypeReponse($questionId,$_POST['rep5'],$x);
									$x++;
								}
								
								header('Location: index3.php?page=monCompte');
								exit(0);
							}
						}
					}
				}
				else
				{
					$probQuest='';
				}
				include('Views/creationQuestion.php');	
			}
			else
			{
				if($_GET['page'] == 'repondreQuestion' && isset($_GET['login']))
				{
					if(isset($_POST['reponse']))
					{
						$utm=new questionManager();
						$utm->insertReponse($_GET['login'],$_GET['question'],$_POST['reponse']);
						header('Location: index3.php?page=monCompte');
						exit(0);
					}
					include('Views/repondreQuestion.php');
				}
				else
				{
					if($_GET['page'] == 'mesQuestions' && isset($_GET['login']))
					{
						include('Views/mesQuestions.php');
					}
					else
					{
						if($_GET['page'] == 'Arepondre')
						{
							include('Views/Arepondre.php');
						}
						else
						{
							if($_GET['page'] == 'monCompte')
							{
								include('Views/monCompte.php');
							}
							else
							{
								if($_GET['page'] == 'creation')
								{						
									if (isset($_POST['login']) || isset($_POST['mdp']) || isset($_POST['nom']) || isset($_POST['prenom']) || isset($_POST['mdpBis']) || isset($_POST['listeSexe']) || isset($_POST['listeAge']) || isset($_POST['listeCategorie']) )
									{
										if($_POST['login'] == '') $prob='<p id="erreur">Entrez votre Login</p>';
										else 
										{
											if($_POST['mdp'] == '') $prob='<p id="erreur">Entrez votre mot de passe</p>';
											else 
											{
												if(($_POST['mdpBis'] == '')) $prob='<p id="erreur">Veuillez confirmez votre mot de passe</p>';
												else
												{
													if($_POST['nom'] == '') $prob='<p id="erreur">Entrez votre nom</p>';
													else 
													{
														if($_POST['prenom'] == '') $prob='<p id="erreur">Entrez votre Prénom</p>';
														else
														{
															if($_POST['codeCate'] == '') $prob='<p id="erreur">Entrez le code correspondant à votre catégorie>/p>';
															else
															{
																if ($_POST['mdp'] != $_POST['mdpBis']) $prob='<p id="erreur">Mot de passe incorrect</p>';
																else
																{
																	$utix= new UtilisateurManager();
																	$leVraiCodeCategorie=$utix->verifCodeCategorie($_POST['listeCategorie']);
																	if($_POST['codeCate'] == $leVraiCodeCategorie['codeCate'])
																	{			
																		$um = new UtilisateurManager();
																		$res=$um->createUser($_POST['login'],$_POST['mdp'],$_POST['nom'],$_POST['prenom'],$_POST['listeSexe'],$_POST['listeAge'],$_POST['listeCategorie']);
																		if ($res != 1)
																		{
																			$prob='<p id="erreur">Erreur ('.$res.') déjà existant</p>';
																		}
																		else
																		{
																			header('Location: index3.php');
																			exit(0);
																		}
																	}
																	else
																	{
																		$prob='<p id="erreur">Le code soumis ne correspond pas à la categorie selectionnée</p>';
																	}
																}
															}
														}
													}
												}
											}
										}
									}
									else
									{
										$prob='<br>';
									}
									include('Views/creation.php');	
								}
								else
								{
									if($_GET['page'] == 'statEssai')
									{
										$adm= new questionManager();
										if(isset($_POST['opt1']))
										{
											//A voir
											$lesTypesStats=array();
											$lesResStats=array();
											
											$res=$adm->questionTypeRep($_GET['question']);
											$lesResultatsPossibleStats=array();
											foreach ($res as $data)
											{
												array_push($lesResultatsPossibleStats,$data['typeReponse']);
											}
											
											if($_POST['opt1']=="ageUt")
											{
												$leTitre="Statistiques sur l\'âge des personnes par réponse ayant répondu à la question";
												$legende1="Age";
												array_push($lesTypesStats,"-18 ans");
												array_push($lesTypesStats,"18-22 ans");
												array_push($lesTypesStats,"23-30 ans");
												array_push($lesTypesStats,"31-50 ans");
												array_push($lesTypesStats,"50+ ans");
												
												for($i=0;$i<count($lesTypesStats);$i++)
												{
													$tempo=array();
													foreach($res as $data)
													{
														$res2=$adm->statParTypeRep($_GET['question'],$data['typeReponse'],"ageUt",$lesTypesStats[$i]);
														array_push($tempo,$res2);
													}
													array_push($lesResStats,$tempo);
												}
											}
											else
											{
												if($_POST['opt1']=="sexeUt")
												{
													$leTitre="Statistiques sur le sexe des personnes par réponse ayant répondu à la question";
													$legende1="Sexe";
													array_push($lesTypesStats,"Homme");
													array_push($lesTypesStats,"Femme");
													
													for($i=0;$i<count($lesTypesStats);$i++)
													{
														$tempo=array();
														foreach($res as $data)
														{
															$res2=$adm->statParTypeRep($_GET['question'],$data['typeReponse'],"sexeUt",$lesTypesStats[$i]);
															array_push($tempo,$res2);
														}
														array_push($lesResStats,$tempo);
													}										
												}
												else
												{
													$leTitre="Statistiques sur la catégorie des personnes par réponse ayant répondu à la question";
													$legende1="Catégorie";
													array_push($lesTypesStats,"Etudiant");
													array_push($lesTypesStats,"Enseignant");
													array_push($lesTypesStats,"Vacataire");
													array_push($lesTypesStats,"Personnel");
													
													for($i=0;$i<count($lesTypesStats);$i++)
													{
														$tempo=array();
														foreach($res as $data)
														{
															$res2=$adm->statParTypeRep($_GET['question'],$data['typeReponse'],"idCategorie",$lesTypesStats[$i]);
															array_push($tempo,$res2);
														}
														array_push($lesResStats,$tempo);
													}										
												}
											}
?>
											<!--Partie stats -->
											<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
											<script type="text/javascript">
											  google.charts.load('current', {'packages':['corechart']});
											  google.charts.setOnLoadCallback(drawVisualization);


											  function drawVisualization() {
												// Some raw data (not necessarily accurate)
												var data = google.visualization.arrayToDataTable([
												 [<?php echo '\''.$legende1.'\''; ?>,
												 <?php 
													for($i=0;$i<count($lesResultatsPossibleStats)-1;$i++)
													{
														echo '\''.$lesResultatsPossibleStats[$i].'\',';
													}
													echo '\''.$lesResultatsPossibleStats[count($lesResultatsPossibleStats)-1].'\'';										
												 ?>],
												 
												 <?php
												 for($j=0;$j<count($lesTypesStats)-1;$j++)
												 {
													echo '[\''.$lesTypesStats[$j].'\'';
													for($k=0;$k<count($lesResultatsPossibleStats);$k++)
													{
														echo ', '.$lesResStats[$j][$k];
													}
													echo '],';
												 }
												 echo '[\''.$lesTypesStats[count($lesTypesStats)-1].'\'';
												 for($k=0;$k<count($lesResultatsPossibleStats);$k++)
												 {
												 	echo ', '.$lesResStats[count($lesTypesStats)-1][$k];
												 }
												?>
											  ]]);

											var options = {
											  title : '<?php echo $leTitre; ?>',
											  vAxis: {title: 'nbs de voix'},
											  hAxis: {title: <?php echo '\''.$legende1.'\''; ?>},
											  seriesType: 'bars',
											  series: {5: {type: 'line'}},
											  'is3D': true,
											  'width':900,
											  'height':400
											};

											var chart = new google.visualization.ComboChart(document.getElementById('essaiPour2'));
											chart.draw(data, options);
										  }
										  </script>
<?php
	
										}
										else
										{
											if(isset($_POST['opt2']))
											{
												$res=$adm->statParticipant($_POST['opt2'],$_GET['question']);
												$lesTypesStats=array();
												$lesResStats=array();
												if($_POST['opt2']=="ageUt")
												{	
													$leTitre="Statistiques sur l\'âge des personnes ayant répondu à la question";
													array_push($lesTypesStats,"-18 ans");
													array_push($lesTypesStats,"18-22 ans");
													array_push($lesTypesStats,"23-30 ans");
													array_push($lesTypesStats,"31-50 ans");
													array_push($lesTypesStats,"50+ ans");
													
													array_push($lesResStats,0);
													array_push($lesResStats,0);
													array_push($lesResStats,0);
													array_push($lesResStats,0);
													array_push($lesResStats,0);
													foreach ($res as $data)
													{
														$temp=$data['ageUt'];
														if($temp<18) $lesResStats[0]++;
														else
														{
															if($temp>=18 && $temp<=22) $lesResStats[1]++;
															else
															{
																if($temp>=23 && $temp<=30) $lesResStats[2]++;
																else
																{
																	if($temp>=31 && $temp<=50) $lesResStats[3]++;
																	else $lesResStats[4]++;
																}
															}
														}
													}
												}
												else
												{
													if($_POST['opt2']=="sexeUt")
													{	
														$leTitre="Statistiques sur le sexe des personnes ayant répondu à la question";
														array_push($lesTypesStats,"Homme");
														array_push($lesTypesStats,"Femme");
														
														array_push($lesResStats,0);
														array_push($lesResStats,0);
														
														foreach ($res as $data)
														{
															$temp=$data['sexeUt'];
															if($temp=="Homme") $lesResStats[0]++;
															else $lesResStats[1]++;
														}
													}
													else
													{
														$leTitre="Statistiques sur la catégorie des personnes ayant répondu à la question";
														array_push($lesTypesStats,"Etudiant");
														array_push($lesTypesStats,"Enseignant");
														array_push($lesTypesStats,"Vacataire");
														array_push($lesTypesStats,"Personnel");

														array_push($lesResStats,0);
														array_push($lesResStats,0);
														array_push($lesResStats,0);
														array_push($lesResStats,0);
														
														foreach ($res as $data)
														{
															$temp=$data['idCategorie'];
															if($temp=="Etudiant") $lesResStats[0]++;
															else
															{
																if($temp=="Enseignant") $lesResStats[1]++;
																else
																{
																	if($temp=="Vacataire") $lesResStats[2]++;
																	else $lesResStats[3]++;
																}
															}
														}
													}
												}
?>												
												
												<!--Partie stats -->
												
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
															for($i=0;$i<count($lesResStats);$i++)
															{
																echo '[\''.$lesTypesStats[$i].'\','.$lesResStats[$i].'],';
															}
														?>
													]);

													// Set chart options
													var options = {'title':'<?php echo $leTitre; ?>',
																	'is3D': true,
																   'width':500,
																   'height':400};

													// Instantiate and draw our chart, passing in some options.
													var chart = new google.visualization.PieChart(document.getElementById('essaiPour'));
													chart.draw(data, options);
												  }
												</script>
												
<?php												
											}
										}
										include('Views/StatEssai.php');
									}
									else
									{
										if($_GET['page'] == 'deconnexion')
										{
											include('Views/deconnexion.php');
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	else
	{
		if(!empty($_POST['creerSondage']))
		{
			if (isset($_SESSION['login']))
			{
				header('Location: index3.php?page=creationQuestion');
				exit(0);
			}
			else
			{
				$verifieConnexion=1;
				header('Location: index3.php?page=connexion');
				exit(0);
			}
		}
		include('Views/pageAccueil.php');	
	}
	
	
?>