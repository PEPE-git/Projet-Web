<!DOCTYPE html>

<html lang="fr">
	
	<head>
		<link rel="stylesheet" type="text/css" href="./form.css">
	</head>

	<body class = "principal">		
		
		<?php
		session_start();
		$titre="Recherche avancée";
		include("./includes/identifiants.php");
		include("./includes/debut.php");

		if ($id==0)	erreur(ERR_IS_NOT_CO.REDIRECT);
		else echo MENU;
		
		if (empty($_POST['select'])){
			echo '			
				<div id="corps">
					<h1>Recherche avancée</h1>
					<div id="form">
						<form method="post" action="rechav_fr.php" enctype="multipart/form-data">
						
						<label for="select">Variable(s) à sélectionner <br></label>
						<select multiple  class="form" >
							<option value="tous">Toutes les informations disponibles</option>
							<option value="ec">Numéro EC</option>
							<option value="enzyme">Enzyme - Nom(s)</option>
							<option value="synonym">Enzyme - Synonyme(s)</option>
							<option value="activity">Activité(s) enzymatique(s)</option>
							<option value="comments">Commentaires</option>
							<option value="articles">Littérature</option>
							<option value="note">Notes</option>
						</select> <br \>
						<br \>
						<label for="where1">Condition<br></label><input class="form" type="text" name="where1" id="where1" /><br />
						<br \>
						<input type="radio" name="cdt1" value="and" id="and" /> <label for="and">AND</label>
						<input type="radio" name="cdt1" value="or" id="or" /> <label for="or">OR</label><br>
						<br \>
						<label for="where1">Condition<br></label><input  class="form" type="text" name="where1" id="where1" /><br />
						<br \>
						<input type="radio" name="cdt2" value="and" id="and" /> <label for="and">AND</label>
						<input type="radio" name="cdt2" value="or" id="or" /> <label for="or">OR</label><br>
						<br \>
						<label for="where1">Condition<br></label><input  class="form" type="text" name="where1" id="where1" /><br />
						<br \>
						<input type="radio" name="cdt3" value="and" id="and" /> <label for="and">AND</label>
						<input type="radio" name="cdt3" value="or" id="or" /> <label for="or">OR</label><br>
						<br \>
						<label for="where1">Condition<br></label><input  class="form" type="text" name="where1" id="where1" /><br />
						<br \>
						<input type="radio" name="cdt4" value="and" id="and" /> <label for="and">AND</label>
						<input type="radio" name="cdt4" value="or" id="or" /> <label for="or">OR</label><br>
						<br \>
						<label for="where1">Condition<br></label><input  class="form" type="text" name="where1" id="where1" /><br />
						<br \>
						<br>

						<p><input  class="form" type="submit" value="Rechercher" /></p></form>
						<input type="checkbox" name="dld" id="dld" /> <label for="dld">Ne pas afficher et téléchager les résultats</label><br />						
						
					</form>
				</div>
			</div>
			
			<div id="pied">
				<br><br><br>
				<a class="bottom" href="./accueil_fr.php">accueil - </a>
				<a class="bottom" href="./deconnect_fr.php">déconnexion - </a>
				<a class="bottom" href="./info_fr.php">informations - </a>
				<a class="bottom" href="./credit.html">crédits - </a>
				<a class="bottom" href="./legal.html">mentions légales - </a>
				<a class="bottom" href="./blabla.html">blabla</a>
			</div>
			</body>
			</html>';
		}
	?>
	</body>
</html>

<!--
SELECT *
FROM enzyme,publie,article,edition,swissprot,prosite,comments,note
WHERE enzyme.id_enzyme = publie.id_enzyme
AND publie.id_article = article.id_article
AND edition.id_article = article.id_article
AND swissprot.id_enzyme = enzyme.id_enzyme
AND prosite.id_enzyme = enzyme.id_enzyme
AND comments.id_enz = enzyme.id_enzyme
AND note.id_enzyme = enzyme.id_enzyme
-->
