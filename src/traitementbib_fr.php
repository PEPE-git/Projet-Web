<!DOCTYPE html>
<html lang="fr">

	<head>
		<link rel="stylesheet" type="text/css" href="./form.css">

		<!-- Import des fichiers de DataTables en local -->
		<script type="text/javascript" charset="utf8" src="DataTables/jQuery-3.2.1/jquery-3.2.1.js"></script>
		<link rel="stylesheet" type="text/css" href="DataTables/datatables.css">
		<script type="text/javascript" charset="utf8" src="DataTables/datatables.js"></script>	

	</head>
	
	<body class = "principal">
		
		<?php
			session_start();
			$titre = "Recherche Bibliographique - Résultats";
			include("./includes/identifiants.php");
			include("./includes/debut.php");

			if ($id==0)	erreur(ERR_IS_NOT_CO.REDIRECT);
			else echo MENU;
		
			$pb="https://www.ncbi.nlm.nih.gov/pubmed/";
			$md="";
			
		
				
				//~ INSERTION DEBUT
				//~ Requete sur le numéro EC d'un enzyme
				if(!empty($_POST['rech_ec'])) {
					if(!empty($_POST['ec1'])) {
						// ATTENTION j'ai mis id-enzyme, pas id-enz (pareil pour id_article)
						$q="SELECT * FROM enzyme LEFT JOIN publie ON enzyme.id_enzyme=publie.id_enzyme LEFT JOIN article ON article.id_article=publie.id_article LEFT JOIN swissprot ON swissprot.id_enzyme=enzyme.id_enzyme WHERE ";
						$ec1 =$_POST['ec1'];
						$q=$q."ec1=$ec1 ";
						if(!empty($_POST['ec2'])) {
							$ec2=$_POST['ec2'];
							$q=$q."AND ec2=$ec2 ";
							if(!empty($_POST['ec3'])) {
								$ec3=$_POST['ec3'];
								$q=$q."AND ec3=$ec3 ";
								if(!empty($_POST['ec4'])) {
									$ec4=$_POST['ec4'];
									//~ $q=$q."AND ec4 LIKE '%$ec4'; ";
									$q=$q."AND (ec4 REGEXP '[a-zA-Z]$ec4$' OR ec4=$ec4)";
								}
							}
						}
					
						echo $q."</br>";
						$query = $db->query($q);
						// Si le résultat de la query n'est pas vide, execute la fonction d'affichage du tableau pour le site et pour l'export (VOIR DANS /includes/functions.php)
						if ($query->rowCount() == 0) { 
								echo 'Query returned nothing, please try again.';
						}
						else{
							// $file = echo_resultats_bib($query);
							echo_resultats_bib($query);
						}
					}

					else {
						echo 'Requête non conforme : veuillez remplir les numéros EC de la gauche vers la droite';
					}
				}
				else {
				//~ INSERTION FIN
				
					//~ Requete sur le nom d'auteur
					if(!empty($_POST['rech_aut'])) {
						if(isset($_POST['aut_art'])) {
							$aut=$_POST['aut_art'];
							$q="SELECT * FROM enzyme LEFT JOIN publie ON enzyme.id_enzyme=publie.id_enzyme LEFT JOIN article ON article.id_article=publie.id_article LEFT JOIN swissprot ON swissprot.id_enzyme=enzyme.id_enzyme WHERE authors LIKE '%$aut%';";
							
							echo $q."</br></br>";
							$query = $db->query($q);
							// Si le résultat de la query n'est pas vide, execute la fonction d'affichage du tableau pour le site et pour l'export (VOIR DANS /includes/functions.php)
							if ($query->rowCount() == 0) { 
									echo 'Query returned nothing, please try again.';
							}
							else{
								// $file = echo_resultats_bib($query);
								echo_resultats_bib($query);
							}
						}
					}
					else {
						//~ Requete sur les mots clés de titre d'article
						if(!empty($_POST['rech_tit'])) {
							if(isset($_POST['tit_art'])) {
								$tit=$_POST['tit_art'];
								$q="SELECT * FROM enzyme LEFT JOIN publie ON enzyme.id_enzyme=publie.id_enzyme LEFT JOIN article ON article.id_article=publie.id_article LEFT JOIN swissprot ON swissprot.id_enzyme=enzyme.id_enzyme WHERE title LIKE '%$tit%';";
								
								echo $q."</br></br>";
								$query = $db->query($q);

								// Si le résultat de la query n'est pas vide, execute la fonction d'affichage du tableau pour le site et pour l'export (VOIR DANS /includes/functions.php)
								if ($query->rowCount() == 0) { 
										echo 'Query returned nothing, please try again.';
								}
								else{
									// $file = echo_resultats_bib($query);
									echo_resultats_bib($query);
								}
							}
						}
						else {
							//~ Requete sur année de publication
							if(!empty($_POST['rech_year'])) {
								if(isset($_POST['year_art'])) {
									$year=$_POST['year_art'];
									$q="SELECT * FROM enzyme LEFT JOIN publie ON enzyme.id_enzyme=publie.id_enzyme LEFT JOIN article ON article.id_article=publie.id_article LEFT JOIN swissprot ON swissprot.id_enzyme=enzyme.id_enzyme WHERE year = '$year' ;";
									
									echo $q."</br></br>";
									$query = $db->query($q);

									// Si le résultat de la query n'est pas vide, execute la fonction d'affichage du tableau pour le site et pour l'export (VOIR DANS /includes/functions.php)
									if ($query->rowCount() == 0) { 
											echo 'Query returned nothing, please try again.';
									}
									else{
										// $file = echo_resultats_bib($query);
										echo_resultats_bib($query);
									}
									
								}
							}
						}
					}
				}
				echo PIED;
				// $_SESSION['res_bib'] = $file;
			?>
		</div>
	</body>
</html>
