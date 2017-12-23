<?php
	//~ define('VISITEUR',1);
	//~ define('INSCRIT',2);
	//~ define('ADMIN',3);

	define('ERR_IS_CO','Déjà connecté <br><a href=accueil_fr.php> Accédez à l\'accueil</a>');
	define('ERR_IS_NOT_CO','Accès interdit si non connecté <br>');
	define('REDIRECT','<br><a href=fpage_fr.php>Retour sur la page principale</a>');
	define('MENU','<div id="entete">
		<div id = "param">
			<a class="a_entete" href="./deconnect_fr.php">Déconnexion</a><br>
			<b>fr</b> - <a class="a_entete" href="./accueil_en.php">en</a>
		</div>
		<div id="menu">
			<div class="menu_item">
				<a class="a_entete" href="./accueil_fr.php">Accueil</a>
			</div>
			<div class="menu_item">
				<a class="a_entete" href="./rechsp_fr.php">Recherche Simple</a>
			</div>
			<div class="menu_item">
				<a class="a_entete" href="./rechav_fr.php">Recherche Avancée</a>
			</div>
			<div class="menu_item">
				<a class="a_entete" href="./rechbib_fr.php">Recherche Bibliographique</a>
			</div>
		</div>
	</div>
	<br><br><br>');
?>

