<!DOCTYPE html>
<html>
	
	<head>
	  <link rel="stylesheet" type="text/css" href="./form.css">
	</head>

	<body class = "first">				
		<?php
		session_start();
		$titre="Informations";
		include("./includes/identifiants.php");
		include("./includes/debut.php");

		if ($id != 0) {	echo MENU; }
		echo "<h1>$titre</h1>";

		echo '<div id="corps">
			<div id="elem50_col1">
				<div class="zoom">
					Connexion<br>
					<a href="./connect_fr.php"><img src="./img/enz1.jpg" alt="connexion"/></a>
				</div>
			</div>
			<div id="elem50_col2">
				<div class="zoom">
					Inscription<br>
					<a href="./subscribe.php"><img src="./img/enz2.jpg" alt="inscription"/></a>
				</div>
			</div><br>'.INFO; ?>

		</div>
		<div id="pied">
			<br><br><br>
			<a class="bottom" href="./connect_fr.php">connexion - </a>
			<a class="bottom" href="./subcribe_fr.php">inscription - </a>
			<a class="bottom" href="./info_fr.php">informations - </a>
			<a class="bottom" href="./credit.html">crédits - </a>
			<a class="bottom" href="./legal.html">mentions légales - </a>
			<a class="bottom" href="./blabla.html">blabla</a>
		</div>
	</body>
</html>

