<!DOCTYPE html>
<html>
	
	<head>
	  <link rel="stylesheet" type="text/css" href="./form.css">
	</head>

	<body class = "first">				
		<?php
		session_start();
		$titre="Inscription";
		include("./includes/identifiants.php");
		include("./includes/debut.php");

		if ($id != 0) {
			echo MENU;
			echo "<h1>$titre</h1>";
			erreur(ERR_IS_CO);
		}

		if (empty($_POST['pseudo'])){ // vide --> sur page formulaire
			echo '<div id="entete">
				<h1>EnzymSearch</h1>
				</div>
				</div>
				
				<div id="corps">
					<div id="form">
						<form method="post" action="subscribe_fr.php" enctype="multipart/form-data">
						<fieldset><legend>Identifiants</legend>
						<label for="pseudo">Identifiant :</label>  <input name="pseudo" type="text" id="pseudo" /> (3 à 15 caractères)<br />
						<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" /><br />
						<label for="confirm">Confirmer le mot de passe :</label><input type="password" name="confirm" id="confirm" />
						</fieldset>
						<fieldset><legend>Contact</legend>
						<label for="email">Votre adresse Mail :</label><input type="email" name="email" id="email" /><br />
						</fieldset>
						<input type="checkbox" name="case"> Je ne suis pas un robot.<br>
						<p><input type="submit" value="S\'inscrire" /></p></form>
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
			$pseudo_erreur1 = NULL;
			$pseudo_erreur2 = NULL;
			$mdp_erreur = NULL;
			$email_erreur1 = NULL;
			$email_erreur2 = NULL;
			$case_erreur = NULL;

			//Récupération des variables
			$i = 0;
			$pseudo=$_POST['pseudo'];
			$email = $_POST['email'];
			$pass = md5($_POST['password']);
			$confirm = md5($_POST['confirm']);
			$case_coche = $_POST['case'];
			
			//Vérification du pseudo
			$query=$db->prepare('SELECT COUNT(*) AS nbr FROM members WHERE membre_pseudo =:pseudo');
			$query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
			$query->execute();
			$pseudo_free=($query->fetchColumn()==0)?1:0;
			$query->CloseCursor();
			if(!$pseudo_free) {
				$pseudo_erreur1 = "Identifiant déjà utilisé";
				$i++;
			}
			if (strlen($pseudo) < 3 || strlen($pseudo) > 15) {
				$pseudo_erreur2 = "Votre pseudo est soit trop grand, soit trop petit";
				$i++;
			}
			//Vérification du mdp
			if ($pass != $confirm || empty($confirm) || empty($pass)) {
				$mdp_erreur = "Votre mot de passe et votre confirmation diffèrent, ou sont vides";
				$i++;
			}
			//Vérification de l'adresse email
			$query=$db->prepare('SELECT COUNT(*) AS nbr FROM members WHERE membre_email =:mail');
			$query->bindValue(':mail',$email, PDO::PARAM_STR);
			$query->execute();
			$mail_free=($query->fetchColumn()==0)?1:0;
			$query->CloseCursor();
			
			if(!$mail_free) {
				$email_erreur1 = "email déjà utilisé";
				$i++;
			}
			if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email) || empty($email)) {
				$email_erreur2 = "Formet email invalide";
				$i++;
			}
			//Vérification case cochée
			if(!$case_coche) {
				$case_erreur = "Case non cochée";
				$i++;
			}

			if ($i==0) {
				echo'<h1>Inscription terminée</h1>';
				echo'<p>Bienvenue '.stripslashes(htmlspecialchars($_POST['pseudo'])).'</p>
			<p>Cliquez <a href="./accueil_fr.php">Accédez au site</a> </p>';
			
				$query=$db->prepare('INSERT INTO members (membre_pseudo, membre_mdp, membre_email)
				VALUES (:pseudo, :pass, :email)');
				$query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
				$query->bindValue(':pass', $pass, PDO::PARAM_INT);
				$query->bindValue(':email', $email, PDO::PARAM_STR);
				$query->execute();

				//Et on définit les variables de sessions
				$_SESSION['pseudo'] = $pseudo;
				$_SESSION['id'] = $db->lastInsertId(); ;
				$query->CloseCursor();
			}
			else {
				echo'<h1>Inscription interrompue</h1>';
				echo'<p>'.$i.' erreur(s) au cours de l\'inscription</p>';
				echo'<p>'.$pseudo_erreur1.'</p>';
				echo'<p>'.$pseudo_erreur2.'</p>';
				echo'<p>'.$mdp_erreur.'</p>';
				echo'<p>'.$email_erreur1.'</p>';
				echo'<p>'.$email_erreur2.'</p>';
				echo'<p>'.$case_erreur.'</p>';
				
				echo'<p><a href="./subscribe_fr.php">Recommencer</a></p>';
			}
		}
	?>
	</body>
</html>

	
