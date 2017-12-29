<!DOCTYPE html>
<html lang="fr">
	
	<head>
	  <link rel="stylesheet" type="text/css" href="./form.css">
	</head>
	
	<body class="first">
	<?php
		session_start();
		$titre="Connexion";
		include("./includes/identifiants.php");
		include("./includes/debut.php");

		if ($id != 0) {
			echo MENU;
			echo '<body class="first">
					<div id="corps">
					<h1>'.$titre.'</h1>';
			erreur(ERR_IS_CO.PIED);
		}

		if (!isset($_POST['pseudo'])){ //On est dans la page de formulaire
			echo
			'<div id="corps">
				<h1>'.$titre.'</h1>

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
			</div>'.PIED;
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
			echo $message.'<p><a href="./connect_fr.php">Réessayer</a></p>'.PIED.'</div></body></html>';
		}
	?>
	<input type="hidden" name="page" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />

	<?php
		if($_SESSION['id']>0){
			header('Location: accueil_fr.php');
			echo 'Si la redirection n\'est pas automatique, cliquez <a class="bottom" href=accueil_fr.php>ICI</a>';
			exit();
		}
	?>		
	</body>
</html>

	

