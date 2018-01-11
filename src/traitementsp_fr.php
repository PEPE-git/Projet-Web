<!DOCTYPE html>
<html lang="fr">

	<head>
		<link rel="stylesheet" type="text/css" href="./form.css">

		<!-- Import des fichiers de DataTables en local -->
		<script type="text/javascript" charset="utf8" src="DataTables/jQuery-3.2.1/jquery-3.2.1.js"></script>
		<link rel="stylesheet" type="text/css" href="DataTables/datatables.css">
		<script type="text/javascript" charset="utf8" src="DataTables/datatables.js"></script>	

		<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.js"></script> -->
		<!-- <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script> -->
		
		
	</head>
	
	<body class = "principal">

		<?php
			session_start();
			$titre = "Recherche Simple - Résultats";
			include("./includes/identifiants.php");
			include("./includes/debut.php");

			if ($id==0)	erreur(ERR_IS_NOT_CO.REDIRECT);
			else echo MENU;
		
		

				//~ Requete sur le numéro EC d'un enzyme
				if(!empty($_POST['rech_ec'])) {
					if(!empty($_POST['ec1'])) {
						$q="SELECT * FROM enzyme LEFT JOIN synonym ON synonym.id_enzyme=enzyme.id_enzyme LEFT JOIN swissprot ON swissprot.id_enzyme=enzyme.id_enzyme WHERE ";
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
									$q=$q."AND ec4 LIKE '%$ec4%'; ";
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
							// $file=echo_resultats_sp($query);
							echo_resultats_sp($query);
						}
					}

					else {
						echo 'Requête non conforme : veuillez remplir les numéros EC de la gauche vers la droite';
					}
				}
				else {
					//~ Requete sur le nom d'un enzyme
					if(!empty($_POST['rech_name'])) {
						if(!empty($_POST['name_type'])) {
							$name_type=$_POST['name_type'];
							$name=$_POST['name'];
							if($name_type == "1") {
								$q=$q."SELECT * FROM enzyme LEFT JOIN synonym ON synonym.id_enzyme=enzyme.id_enzyme LEFT JOIN swissprot ON swissprot.id_enzyme=enzyme.id_enzyme WHERE accepted_name LIKE '%$name%';";
							}
							else {
								if($name_type == "2") {
									$q=$q."SELECT * FROM enzyme LEFT JOIN synonym ON synonym.id_enzyme=enzyme.id_enzyme LEFT JOIN swissprot ON swissprot.id_enzyme=enzyme.id_enzyme WHERE systematic_name LIKE'%$name%';";
								}
								else {
									if($name_type == "3") {
										$q=$q."SELECT * FROM enzyme LEFT JOIN synonym ON synonym.id_enzyme=enzyme.id_enzyme LEFT JOIN swissprot ON swissprot.id_enzyme=enzyme.id_enzyme WHERE synonym.synonyme LIKE'%$name%';";
									}
									else {
										$q=$q."SELECT * FROM enzyme LEFT JOIN synonym ON synonym.id_enzyme=enzyme.id_enzyme LEFT JOIN swissprot ON swissprot.id_enzyme=enzyme.id_enzyme WHERE (accepted_name LIKE '%$name%' OR systematic_name LIKE '%$name%' OR synonym.synonyme LIKE '%$name%');";
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
								// $file=echo_resultats_sp($query);
								echo_resultats_sp($query);
							}
						}
					}
					else {
						//~ Requete sur un composé chimique réagissant dans une réaction enzymatique
						if(!empty($_POST['rech_act'])) {
							if(isset($_POST['act'])) {
								$act=$_POST['act'];
								$q="SELECT * FROM enzyme LEFT JOIN synonym ON synonym.id_enzyme=enzyme.id_enzyme LEFT JOIN swissprot ON swissprot.id_enzyme=enzyme.id_enzyme WHERE activity LIKE '%$act%';";
								
								echo $q."</br>";
								$query = $db->query($q);

								// Si le résultat de la query n'est pas vide, execute la fonction d'affichage du tableau pour le site et pour l'export (VOIR DANS /includes/functions.php)
								if ($query->rowCount() == 0) {  
									echo 'Query returned nothing, please try again.';
								}
								else{
									// $file=echo_resultats_sp($query);
									echo_resultats_sp($query);
								}
							}
				
						}
						else {
							//~ Requete sur un cofacteur
							if(!empty($_POST['rech_co'])) {
								if(isset($_POST['cofactors'])) {
									$co=$_POST['cofactors'];
									$q="SELECT * FROM enzyme LEFT JOIN synonym ON synonym.id_enzyme=enzyme.id_enzyme LEFT JOIN swissprot ON swissprot.id_enzyme=enzyme.id_enzyme WHERE cofactors LIKE'%$co%';";
									
									echo $q."</br>";
									$query = $db->query($q);

									// Si le résultat de la query n'est pas vide, execute la fonction d'affichage du tableau pour le site et pour l'export (VOIR DANS /includes/functions.php)
									if ($query->rowCount() == 0) { 
										echo 'Query returned nothing, please try again.';
									}
									else{
										// $file=echo_resultats_sp($query);
										echo_resultats_sp($query);
									}
								}
							}
						}
					}
				}
				// $_SESSION['res_sp'] = $file;
				echo PIED;
			?>
		</div>
	</body>
</html>
							   
