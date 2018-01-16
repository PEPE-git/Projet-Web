<!DOCTYPE html>
<html lang="fr">

<head>
  <link rel="stylesheet" type="text/css" href="./form.css">
</head>

<?php
	session_start();
	$titre="EnzymSearch";
	include("./includes/identifiants.php");
	include("./includes/debut.php");

	if ($id>0) echo MENU;
	echo '
	<body class="first">
		<div id="corps">
			<h1>Bienvenue sur EnzymSearch</h1>
			<div id ="elem1">			
				<div class="zoom">
					Plus d\'informations<br>
					<a href="./info_fr.php"><img src="./img/enz3.jpg" alt="plus d\'information"/></a>
				</div>
							</div>
			<div id ="elem2">
				<div id="elem2_col1">
				<div class="zoom">
					Connexion<br>
					<a href="./connect_fr.php"><img src="./img/enz1.jpg" alt="connexion"/></a>
				</div>
				</div>
			<div id="elem2_col2">
					<div class="zoom">
						Inscription<br>
						<a href="./subscribe_fr.php"><img src="./img/enz2.jpg" alt="inscription"/></a>
					</div>
			</div>
			<p style="text-align:center"><table id="fiche"><tr><td><a href="ficheind_fr.php">Consulter les fiches enzymes</a></td></tr></table></p>'.PIED;
		?>
	</body>
</html>
