<!DOCTYPE html>
<html lang="fr">

	<head>
		<link rel="stylesheet" type="text/css" href="./form.css">

		<!-- Import de jquery via les fichiers en local. pour le dynamisme des checkbox. -->
		<script type="text/javascript" src="DataTables/jQuery-3.2.1/jquery-3.2.1.js"></script>
	</head>
	
	<!-- Affichage des popups -->
	<script language="javascript">
		function popup(x,h,w) {
			window.open(x,'./rechbib_fr.php','height='+h+',width='+w+',resizable=yes');
		}

		// Décoche "Tout" si une autre checkbox est cohée
		// Décoche les autres checkbox si "Tout" est cochée 
		// $(document).ready(function(){
		//     $(".rest").click(function(){
		//         $("#ch_all").prop("checked", false);
		//     });
		//     $(".all").click(function(){
		//         $("#ch_ec").prop("checked", false);
		//         $("#ch_author").prop("checked", false);
		//         $("#ch_title").prop("checked", false);
		//         $("#ch_year").prop("checked", false);
		//         $("#ch_volume").prop("checked", false);
		//         $("#ch_fpage").prop("checked", false);
		//         $("#ch_lpage").prop("checked", false);
		//         $("#ch_pubmed").prop("checked", false);
		//         $("#ch_medline").prop("checked", false);
		//         $("#ch_swissprot").prop("checked", false);
		//     });
		// });
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
				


				<form method="post" action="traitementsp_fr.php" enctype="multipart/form-data" target="_blank">

					<div>
						<!--Rechercher les articles associées à un numéro EC -->
						<fieldset>
							<legend>Recherche sur le code enzyme<SUP><a id="pop_info" href="rechbib_fr.php" onClick="popup('./popup/info_enz_ec.html',600,500)">?</a></SUP></legend>
							<input class="form_ec" type="number" min="1" name="ec1" id="ec1" list="ec1"  maxlength="15" size="6" value="<?php echo isset($_POST['ec1']) ? $_POST['ec1'] : '' ?>" autofocus>
							- <input class="form_ec" type="number" min="1"  name="ec2" id="ec2" list="ec2" maxlength="15" size="6" value="<?php echo isset($_POST['ec2']) ? $_POST['ec2'] : '' ?>">
							- <input class="form_ec" type="number" min="1" name="ec3" id="ec3" list="ec3" maxlength="15" size="6" value="<?php echo isset($_POST['ec3']) ? $_POST['ec3'] : '' ?>" >
							- <input class="form_ec" type="varchar"  name="ec4" id="ec4" list="ec4" maxlength="15" size="6" value="<?php echo isset($_POST['ec4']) ? $_POST['ec4'] : '' ?>" >
							<br><br>
							<input type="submit" name="rech_ec" value="Recherche" />
						</fieldset>
					</div>
					<br>								
					<div>
						<!--Rechercher les informations associés aux articles par noms d'auteur -->
						<fieldset>
							<legend>Recherche par les auteurs d'articles<SUP><a id="pop_info" href="rechbib_fr.php" onClick="popup('./popup/auteur.html',320,500)">?</a></SUP></legend>
							<input class="form" name="aut_art" list="aut_art" maxlength="15" size="6" value="<?php echo isset($_POST['aut_art']) ? $_POST['aut_art'] : '' ?>">
							<br><br>
							<input type="submit" value="Recherche" name="rech_aut" />
						</fieldset>
					</div>
					<br>
					<div>
						<!--Rechercher les articles suivant les mots clés du titre -->
						<fieldset>
							<legend>Recherche par les titres d'articles<SUP><a id="pop_info" href="rechbib_fr.php" onClick="popup('./popup/titre.html',350,500)">?</a></SUP></legend>
							<input class="form" name="tit_art" list="tit_art" maxlength="15" size="6" value="<?php echo isset($_POST['tit_art']) ? $_POST['tit_art'] : '' ?>">
							<br><br>
							<input type="submit" value="Recherche" name="rech_tit" />
						</fieldset>
					</div>
					<br>
					<div>
						<!--Rechercher les articles suivant leur année de publication -->
						<fieldset>
							<legend>Recherche selon les années de publication<SUP><a id="pop_info" href="rechbib_fr.php" onClick="popup('./popup/annee.html',150,500)">?</a></SUP></legend>

							<input class="form" name="year_art" list="year_art" maxlength="15" size="6" value="<?php echo isset($_POST['year_art']) ? $_POST['year_art'] : '' ?>">
							<br><br>

							<input type="submit" value="Recherche" name="rech_year" />

						</fieldset>
					</div>
				</form>
				<?php echo PIED; ?>
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
			?>
		</div>
	</body>
</html>
