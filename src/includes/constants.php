<?php
	define('ERR_IS_CO','Déjà connecté : accédez à l\'accueil en cliquant <a href=accueil_fr.php>ici</a>');
	define('ERR_IS_NOT_CO','Accès interdit si non connecté <br>');
	define('REDIRECT','<br><a href=index.php>Retour sur la page principale</a>');
	define('MENU','
	<div id="entete">
		<div id = "param">
			<a class="a_entete" href="./deconnect_fr.php">Déconnexion</a><br>
		</div>
		<div id="menu">
			<a class="a_entete" href="./accueil_fr.php"><div class="menu_item">Accueil</div></a>
			<a class="a_entete" href="./ficheind_fr.php"><div class="menu_item">Fiches enzyme</div></a>
			<a class="a_entete" href="./rechsp_fr.php"><div class="menu_item">Recherche Simple</div></a>
			<a class="a_entete" href="./rechbib_fr.php"><div class="menu_item">Recherche Bibliographique</div></a>
			<a class="a_entete" href="./rechav_fr.php"><div class="menu_item">Recherche Avancée</div></a>
		</div>
	</div>
	<br><br><br>');
	define('INFO','<div id="corps">
		<p style="text-align:center"><table id="fiche"><tr><td><a href="ficheind_fr.php">Consulter les fiches enzymes</a></td></tr></table></p>
		<ul>
		<li>EnzymSearch</li>
		<b>EnzymSearch</b> est un site permettant de recueillir des informations sur les enzymes dont la nomenclatures suit les recommendations du Comité de Nomenclature de l\'Union Internationale de Biochimie et de Biologie Moléculaire (e.g. Nomenclature Committee of the International Union of Biochemistry and Molecular Biology, IUBMB).
		La dernière mise à jour a été réalisée en janvier 2018.
		
		<li>Informations sur les données</li>
		Les données sont issues de : <br/>
		- Intenz : Integrated relational Enzyme database<br/>
		- ENZYME : Enzyme nomenclature database<br/>
		Les enzymes possédent des numéros EC (Enzyme Classification) uniques  qui les identifient et fournissent des indications sur la nature des réactions catalisées <a style="color:gray" href="http://www.ebi.ac.uk/intenz/browse.jsp">(informations supplémentaires)</a>.
		
		
		<li>Informations sur la base de données</li>
		<p><img src="./img/schema_rel.png" alt="schema_rel" style="float:left;">
		EnzymeSearch donne la possibilité d\'effectuer 4 types de recherches :<br/>
		-La <b>Recherche Simple</b> correspond à une requête basée sur les caractéristiques enzymatiques de référence. Ces résultats sont présentés dans un tableau affiché dans un nouvel onglet. Différentes critères de recherche sont possibles tels que le Numéro EC, le Nom, l\'activité enzymatique ou les Cofacteurs associées.<br/>
		-La <b>Recherche Avancée</b> est très versatile et permet à l’utilisateur de spécifier plus librement ses critères de recherche, ainsi que les résultats souhaités. Les résultats de la recherche sont encore présentés dans un nouvel onglet sous forme de tableau.<br/>
		-La <b>Recherche Bibliographique</b> permet trier les enzymes en fonction de leur Numéro EC, Auteurs, Titre d\'article ou Année de publication et renvoie des informations sur les auteurs, titres, années, volumes, numéros de pages, codes PubMed et Medline associés à des articles.<br/>
		-La <b>Recherche des Fiches Enzyme</b> renvoie toutes les informations disponibles à propos d\'une seule enzyme sélectionnée.<br/>
		<br/>

		MySQL Ver 9.1 Distrib 10.1.30-MariaDB, for Linux on x86_64<br/>
		</p>
		<br/>
		<br/>
		<br/>
		<br/>
	
		<p>
		<li>Aide</li>
		<div id="col1">
		Pour toute demande d\'aide, contactez : <br>
		merckaert.pierre@gmail.com <br>
		oph.dasilva@gmail.com <br>
		<a href="mailto:oph.dasilva@gmail.com,merckaert.pierre@gmail.com?Subject=Hello" target="_top">Send Mail</a> <br> <br>
		</div>
		<div id="col2"><img src="img/upsaclay.png" alt="Paris Saclay University" width="400" height="150" /></div>
		</p>
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

