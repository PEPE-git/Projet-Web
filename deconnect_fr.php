<!DOCTYPE html>

<html>
	<body class = "first">	
		<?php
			session_start();
			session_destroy();
			$titre="Déconnexion";
			include("./includes/debut.php");

			if ($id==0) erreur(ERR_IS_NOT_CO);

			echo '<p>Déconnecté<br />
			<a href="'.htmlspecialchars($_SERVER['HTTP_REFERER']).'">Page précédente</a><br />
			<a href="./fpage_fr.php">Page principale</a> pour revenir à la page principale</p>';
			echo '</div></body></html>';
		?>
	</body>
</html>
