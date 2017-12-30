<!DOCTYPE html>
<html lang="fr">

	<head>
		<link rel="stylesheet" type="text/css" href="./form.css">
	</head>
	
	<!-- Affichage des popups -->
	<script language="javascript">
		function popup(x,h,w) {
			window.open(x,'./rechbib_fr.php','height='+h+',width='+w+',resizable=yes');
		}
	</script>
	
	<body class = "principal">			
		<?php
			session_start();
			$titre = "Recherche Bibliographique";
			include("./includes/identifiants.php");
			include("./includes/debut.php");

			if ($id==0)	erreur(ERR_IS_NOT_CO.REDIRECT);
			else echo MENU;
		?>

		<div id="corps">
			<h1><?php echo $titre ?></h1>
			<div id="form">
				<form method="post" action="traitementbib_fr.php" enctype="multipart/form-data" target="_blank">
					<div>
						<!--Rechercher les informations associés aux articles -->
						<fieldset>
							<legend>Recherche par les auteurs d'articles<SUP><a id="pop_info" href="rechsp_fr.php" onClick="popup('./popup/auteur.html',200,500)">?</a></SUP></legend>

							<input class="form" name="aut_art" list="aut_art" maxlength="15" size="6" value="<?php echo isset($_POST['aut_art']) ? $_POST['aut_art'] : '' ?>">
							<br><br>

							<input type="submit" value="Recherche" name="rech_aut" />

						</fieldset>

						<fieldset>
							<legend>Recherche par les titres d'articles<SUP><a id="pop_info" href="rechsp_fr.php" onClick="popup('./popup/titre.html',200,500)">?</a></SUP></legend>

							<input class="form" name="tit_art" list="tit_art" maxlength="15" size="6" value="<?php echo isset($_POST['tit_art']) ? $_POST['tit_art'] : '' ?>">
							<br><br>

							<input type="submit" value="Recherche" name="rech_tit" />

						</fieldset>

						<fieldset>
							<legend>Recherche selon les années de publication<SUP><a id="pop_info" href="rechsp_fr.php" onClick="popup('./popup/annee.html',200,500)">?</a></SUP></legend>

							<input class="form" name="year_art" list="year_art" maxlength="15" size="6" value="<?php echo isset($_POST['year_art']) ? $_POST['year_art'] : '' ?>">
							<br><br>

							<input type="submit" value="Recherche" name="rech_year" />

						</fieldset>
					</div>
				</form>
			</div>
			<?php
				//~ Liste active des auteurs d'articles
				echo '<datalist id="aut_art">';
				$query_aut = $db->prepare('SELECT DISTINCT authors FROM article');
				$query_aut->execute();
				$result_aut = $query_aut->fetchAll(PDO::FETCH_ASSOC);
				foreach ($result_aut as $row_aut) {
					echo "<option value='".$row_aut['authors']. "'>";
				}
				echo '</datalist></br></br>';

				//~ Liste active des titres d'articles
				echo '<datalist id="tit_art">';
				$query_tit = $db->prepare('SELECT DISTINCT title FROM article');
				$query_tit->execute();
				$result_tit = $query_tit->fetchAll(PDO::FETCH_ASSOC);
				foreach ($result_tit as $row_tit) {
					echo "<option value='".$row_tit['title']. "'>";
				}
				echo '</datalist></br></br>';

				//~ Liste active des années de publication
				echo '<datalist id="year_art">';
				$query_year = $db->prepare('SELECT DISTINCT year FROM article ORDER BY year ASC');
				$query_year->execute();
				$result_year = $query_year->fetchAll(PDO::FETCH_ASSOC);
				foreach ($result_year as $row_year) {
					echo "<option value='".$row_year['year']. "'>";
				}
				echo '</datalist></br></br>';
				echo PIED;
			?>
		</div>
	</body>
</html>
