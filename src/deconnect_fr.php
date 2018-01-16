<!DOCTYPE html>

<html lang="fr">
	<head>
	  <meta charset="UTF-8">
	  <title>EnzymSearch</title>
	  <link rel="stylesheet" type="text/css" href="./form.css">
	</head>
	
	<body class = "first">	
		<?php
			session_start();
			session_destroy();
			$titre="Déconnexion";
			include("./includes/debut.php");

			if ($id==0)	erreur(ERR_IS_NOT_CO.REDIRECT);
			else {
				header('Location: index.php');
				exit();
			}
		?>
	</body>
</html>
