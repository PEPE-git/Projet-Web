<!DOCTYPE html>

<html lang="fr">
	<head>
	  <meta charset="UTF-8">
	  <title>EnzymSearch</title>
	  <link rel="stylesheet" type="text/css" href="./form.css">
	</head>


	<body class="first">
		
		<div id="entete">
			<h1>Bienvenue sur EnzymSearch</h1>
			<?php
				if($id > 0) echo'<a href=accueil_fr.php>Accueil</a><br><a href=deconnect_fr.php>Déconnexion</a>';
			?>
		</div>
		<br><br><br>
		<div id="corps">
			<div id ="elem1">			
				<div class="zoom">
					Connexion<br>
					<a href="./connect_fr.php"><img src="./img/enz1.jpg" alt="connexion"/></a>
				</div>
			</div>
			<div id ="elem2">
				<div id="elem2_col1">
					<div class="zoom">
						Inscription<br>
						<a href="./subscribe_fr.php"><img src="./img/enz2.jpg" alt="inscription"/></a>
					</div>
				</div>
			<div id="elem2_col2">
				<div class="zoom">
					Plus d'informations<br>
					<a href="./info_fr.php"><img src="./img/enz3.jpg" alt="plus d'information"/></a>
				</div>
			</div>
		</div>
		
		<div id="pied">
			<br><br><br>
			<a class="bottom" href="./connect_fr.php">connexion - </a>
			<a class="bottom" href="./subscribe_fr.php">inscription - </a>
			<a class="bottom" href="./info_fr.php">informations - </a>
			<a class="bottom" href="./credit.html">crédits - </a>
			<a class="bottom" href="./legal.html">mentions légales - </a>
			<a class="bottom" href="./blabla.html">blabla</a>
		</div>
	</body>
</html>




<!--
<?php
				
			?>-->
