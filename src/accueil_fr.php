<!DOCTYPE html>

<html lang="fr">
	
	<head>
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
		<h1>Bienvenue <?php echo $_SESSION['pseudo'] ?><br/><?php echo $titre ?></h1>
	
		<ul>
		
		<li>EnzymSearch</li>
		<b>EnzymSearch</b> est un site permettant de recueillir des informations sur les enzymes dont la nomenclatures suit les recommendations du Comité de Nomenclature de l'Union Internationale de Biochimie et de Biologie Moléculaire (e.g. Nomenclature Committee of the International Union of Biochemistry and Molecular Biology, IUBMB).
		La dernière mise à jour a été réalisé en janvier 2018.
		
		<li>Informations sur les données</li>
		Les données sont issues de : <br/>
		- Intenz : Integrated relational Enzyme database<br/>
		- ENZYME : Enzyme nomenclature database<br/>
		Les enzymes possédent des numéros EC (Enzyme Classification) uniques  qui les identifient et fournissent des indications sur la nature des réactions catalisées <a style="color:gray" href="http://www.ebi.ac.uk/intenz/browse.jsp">(informations supplémentaires)</a>.
		
		
		<li>Informations sur la base de données</li>
		blablabla sur les différentes recherches<br>
		--> version mySQL utilisée <br>
		--> insertion image du schéma relationel --> du coup, possibilité de rentrer une commande SQL ?? <br>
		</p>
		
		<h2>Aide</h2>
		<p>
			Pour toute demande d'aide, contactez : <br>
			pierre.mkt7@gmail.com <br>
			oph.dasilva@gmail.com <br>
			<b>[--> voir comment mettre un lien de création direct' d'email]
			[Logo upsud]</b>
		
		</ul>
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

