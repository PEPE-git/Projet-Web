<!DOCTYPE html>

<html lang="fr">
	
	<head>
	  <meta charset="UTF-8">
	  <title>Enzym search - Connexion</title>
	  <link rel="stylesheet" type="text/css" href="./form.css">
	</head>
	
	<body class="principal">
	<?php
		session_start();
		$titre="Accueil";
		include("./includes/identifiants.php");
		include("./includes/debut.php");

		if ($id==0)	erreur(ERR_IS_NOT_CO.REDIRECT);
		echo MENU;
	?>
		
	

	<div id="corps">
		<h1>Bienvenue <?php echo $_SESSION['pseudo'] ?></h1>
	
		<h2>EnzymSearch</h2>
		<p>
			<b>EnzymSearch</b> blablabla <br>
			Dernière mise à jour : 01/2018
			
		</p>
		
		<h2>Informations sur les données</h2>
		<p>
			blablabla
		</p>
		
		<h2>Informations sur la base de données</h2>
		<p>
			blablabla sur les différentes recherches<br>
			--> version mySQL utilisée <br>
			--> schéma relationel --> du coup, possibilité de rentrer une commande SQL ?? <br>
		</p>
		
		<h2>Aide</h2>
		<p>
			Pour toute demande d'aide, contactez : <br>
			pierre.mkt7@gmail.com <br>
			oph.dasilva@gmail.com <br>
			<b>[--> voir comment mettre un lien de création direct' d'email]
			[Logo upsud]</b>
	</div>
	
	<div id="pied">
	
	</div>

	</body>
</html>


<!--
		<div id="menu">
			<div class="element_menu">
				<p>
					<option>Accueil</option>
					<option>Requête simple</option>
					<option>Requête avancée</option>
					<option>Contact</option>
				</p>
			</div>
		</div>
-->

