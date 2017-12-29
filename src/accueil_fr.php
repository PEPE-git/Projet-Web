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

		echo '<div id="corps"><h1>Bienvenue <?php echo $_SESSION[\'pseudo\'] ?><br/><br/><?php echo $titre ?></h1>'.INFO.PIED;
	?>
	</body>
</html>


