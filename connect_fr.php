<!DOCTYPE html>

<html lang="fr">
	
	<head>
	  <meta charset="UTF-8">
	  <title>Enzym search - Connexion</title>
	  <link rel="stylesheet" type="text/css" href="./form.css">
	</head>
	
	<body class="first">
		<?php
		session_start();
		$titre="Connexion";
		include("./includes/identifiants.php");
		include("./includes/debut.php");
	?>
	
	<?php
		echo '<h1>Connexion</h1>';
		if ($id != 0) erreur(ERR_IS_CO);
	?>
	
	<?php
		if (!isset($_POST['pseudo'])){ //On est dans la page de formulaire
			echo
			'<div id="entete">
				<h1>Bienvenue sur EnzymSearch
				<br><br><br>
				Connexion<br><br></h1>
			</div>
			<div id="corps">
				<div id="form">
					<form method="post" action="connect_fr.php">
						<fieldset>
						<legend>Connexion</legend>
						<p>
						<label for="pseudo">Pseudo :</label><input name="pseudo" type="text" id="pseudo" /><br />
						<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
						</p>
						</fieldset>
						<p><input type="submit" value="Connexion" /></p></form>
						<a href="./subscribe_fr.php">Pas encore inscrit ?</a>
					</form>
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
			</html>';
		}
		else {
			$message='';
			if (empty($_POST['pseudo']) || empty($_POST['password']) ){ //Oublie d'un champ
				$message = '<p>Erreur : champs incomplets';
			}
			else {
				$query=$db->prepare('SELECT membre_mdp, membre_id, membre_pseudo
				FROM members WHERE membre_pseudo = :pseudo');
				$query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
				$query->execute();
				$data=$query->fetch();
				
				if ($data['membre_mdp'] == md5($_POST['password'])) { // Acces OK !
					$_SESSION['pseudo'] = $data['membre_pseudo'];
					$_SESSION['id'] = $data['membre_id'];
					$message = '<p>Bienvenue '.$data['membre_pseudo'].'</p>';
				}
				else {
					$message = '<p>Erreur : identifiants incorrects</p>';
				}
				$query->CloseCursor();
			}
			echo $message.'</div></body></html>';
		}
	?>
	
	<input type="hidden" name="page" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />

	<?php
		if($_SESSION['id']>0){
			//~ $page = htmlspecialchars($_POST['page']);
			//~ echo '<a class="bottom" href=accueil_fr.php>Accueil</a><br>
			//~ <a class="bottom" href="'.$page.'">Page précédente</a><br>';
			echo '<a class="bottom" href=accueil_fr.php>Accueil</a>';
		}
	?>
		
	</body>
</html>

	

