<?php
	define('ERR_IS_CO','Déjà connecté : accédez à l\'accueil en cliquant <a href=accueil_fr.php>ici</a>');
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
	define('INFO','<div id="corps">
		<ul>
		<li>EnzymSearch</li>
		<b>EnzymSearch</b> est un site permettant de recueillir des informations sur les enzymes dont la nomenclatures suit les recommendations du Comité de Nomenclature de l\'Union Internationale de Biochimie et de Biologie Moléculaire (e.g. Nomenclature Committee of the International Union of Biochemistry and Molecular Biology, IUBMB).
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
		
		<li>Aide</li>
		<div id="col1">
		Pour toute demande d\'aide, contactez : <br>
		pierre.mkt7@gmail.com <br>
		oph.dasilva@gmail.com <br>
		<b>[--> voir comment mettre un lien de création direct\' d\'email]</b>
		</div>
		<div id="col2"><img src="img/upsaclay.png" alt="Paris Saclay University" width="400" height="150" /></div>
		</ul>
	</div>');
	define('PIED','</br><div id="pied"><br>
			<a class="bottom" href="./info_fr.php">Informations</a> | 
			<a class="bottom" href="./connect_fr.php">Connexion</a> | 
			<a class="bottom" href="./subscribe_fr.php">Inscription</a> | 
			<a class="bottom" href="./rechsp_fr.php">Recherche simple</a> | 
			<a class="bottom" href="./rechav_fr.php">Recherche avancée</a> | 
			<a class="bottom" href="./rechbib_fr.php">Recherche bibliographique</a> | 
			<a class="bottom" href="./deconnect_fr.php">Déconnexion</a>
		</div>');
?>

