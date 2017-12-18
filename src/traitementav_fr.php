<!DOCTYPE html>
<html lang="fr">

	<head>
		<link rel="stylesheet" type="text/css" href="./form.css">
	</head>
	
	<body class = "principal">
		
		<?php
			session_start();
			$titre = "Recherche Avancée - Résultats";
			include("./includes/identifiants.php");
			include("./includes/debut.php");

			if ($id==0)	erreur(ERR_IS_NOT_CO.REDIRECT);
			else echo MENU;
		?>

		<div id="corps">
			<h1><?php echo $titre ?></h1>
			
			<form method="post" action="dwl.php">
				<input type="submit" style = "display: block; margin : auto;" name="export" value="Exporter" />
			</form>
			
			<?php
			foreach (var_dump($_POST) as $key => $value) {
				echo $key;
				echo "\n";
				echo $value;
				echo "\n";
			}
			?>
		</div>
	</body>
</html>
