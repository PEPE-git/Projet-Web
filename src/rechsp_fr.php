<!DOCTYPE html>
<html lang="fr">

	<head>
		<link rel="stylesheet" type="text/css" href="./form.css">

		<!-- <link rel="stylesheet" type="text/css" href="DataTables/datatables.css"> -->
		<script type="text/javascript" src="DataTables/jQuery-3.2.1/jquery-3.2.1.js"></script>
		
	</head>
	
	<!-- Affichage des popups -->
	<script language="javascript">
		function popup(x,h,w) {
			window.open(x,'./rechsp_fr.php','height='+h+',width='+w+',resizable=yes');
		}
	</script>

	<body class = "principal">			
		<?php
			session_start();
			$titre = "Recherche Simple";
			include("./includes/identifiants.php");
			include("./includes/debut.php");

			if ($id==0)	erreur(ERR_IS_NOT_CO.REDIRECT);
			else echo MENU;
		?>

		<div id="corps">
			<h1><?php echo $titre ?></h1>

			<div id="form">
				<!-- Décoche "Tout" si une autre checkbox est cohée
					 Décoche les autres checkbox si "Tout" est cochée -->
				<script type="text/javascript">
					// $(document).ready(function(){
					//     $(".rest").click(function(){
					//         $("#ch_all").prop("checked", false);
					//     });
					//     $(".all").click(function(){
					//         $("#ch_ec").prop("checked", false);
					//         $("#ch_systematic").prop("checked", false);
					//         $("#ch_accepted").prop("checked", false);
					//         $("#ch_synonym").prop("checked", false);
					//         $("#ch_cofactors").prop("checked", false);
					//         $("#ch_activity").prop("checked", false);
					//         $("#ch_history").prop("checked", false);
					//         $("#ch_swissprot").prop("checked", false);
					//     });
					// });
				</script>

				<form method="post" action="traitementsp_fr.php" enctype="multipart/form-data" target="_blank">

					<!-- <fieldset>
						<legend>Caractéristiques d'intérêt</legend>
						<input type="checkbox" name="display_tab[]" class="rest" id="ch_ec" value="ch_ec"><label>EC Number</label> 
						<input type="checkbox" name="display_tab[]" class="rest" id="ch_systematic" value="ch_systematic"><label>Nom Systématique</label>     
						<input type="checkbox" name="display_tab[]" class="rest" id="ch_accepted" value="ch_accepted"><label>Nom Accepté</label>   
						<input type="checkbox" name="display_tab[]" class="rest" id="ch_synonym" value="ch_synonym"><label>Synonyme</label>   
						<input type="checkbox" name="display_tab[]" class="rest" id="ch_cofactors" value="ch_cofactors"><label>Cofacteurs</label>      
						<input type="checkbox" name="display_tab[]" class="rest" id="ch_activity" value="ch_activity"><label>Activité</label>      
						<input type="checkbox" name="display_tab[]" class="rest" id="ch_history" value="ch_history"><label>Historique</label>  
						<input type="checkbox" name="display_tab[]" class="rest" id="ch_swissprot" value="ch_swissprot"><label>Swissprot</label><br>  
						<input type="checkbox" name="display_tab[]" class="all" id="ch_all" value="ch_all" checked><label>Tout</label>
					</fieldset> -->


					<div>
						<!--Rechercher les informations associées à un unique numéro EC -->
						<fieldset>
							<legend>Recherche sur le code enzyme<SUP><a id="pop_info" href="rechsp_fr.php" onClick="popup('./popup/info_enz_ec.html')">?</a></SUP></legend>
<!--
							<label for="ec">EC Number</label> </br>
-->
							<input class="form_ec" type="number" min="1" name="ec1" id="ec1" list="ec1"  maxlength="15" size="6" value="<?php echo isset($_POST['ec1']) ? $_POST['ec1'] : '' ?>" autofocus>
							- <input class="form_ec" type="number" min="1" name="ec2" id="ec2" list="ec2" maxlength="15" size="6" value="<?php echo isset($_POST['ec2']) ? $_POST['ec2'] : '' ?>">
							- <input class="form_ec" type="number" min="1" name="ec3" id="ec3" list="ec3" maxlength="15" size="6" value="<?php echo isset($_POST['ec3']) ? $_POST['ec3'] : '' ?>" >
							- <input class="form_ec" type="varchar"  name="ec4" id="ec4" list="ec4" maxlength="15" size="6" value="<?php echo isset($_POST['ec4']) ? $_POST['ec4'] : '' ?>" >
							<br><br>
							<input type="submit" name="rech_ec" value="Recherche" />
						</fieldset>
					</div>
					<br>								
					<div>
						<!--Rechercher les informations associées à un nom d'enzyme -->
						<fieldset>
							<legend>Recherche par le nom<SUP><a id="pop_info" href="rechsp_fr.php" onClick="popup('./popup/info_enz_name.html')">?</a></SUP></legend>
							<input class="form" name="name" list="name" maxlength="15" size="6" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
							<br>
							<input type="radio" name="name_type" value="1" id="acc" /> <label for="acc">Accepted name</label>
							<input type="radio" name="name_type" value="2" id="sys" /> <label for="sys">Systematic name</label>
							<input type="radio" name="name_type" value="3" id="syn" /> <label for="syn">Synonyme</label>
							<input type="radio" name="name_type" value="4" id="unk" checked /> <label for="unk">Je ne sais pas</label>
							<br><br>
							<input type="submit" value="Recherche" name="rech_name"/>
						</fieldset>
					</div>
					<br>
					<div>
						<!--Rechercher les informations associées à une activité enzymatique -->	
						<fieldset>
							<legend>Recherche d'enzymes faisant intervenir des composés chimiques pour leur activités<SUP><a id="pop_info" href="rechsp_fr.php" onClick="popup('./popup/info_enz_fct.html')">?</a></SUP></legend>
							<input class="form" name="act" list="act" maxlength="15" size="6" value="<?php echo isset($_POST['act']) ? $_POST['act'] : '' ?>">
							<br><br>
							<input type="submit" value="Recherche" name="rech_act"/>
						</fieldset>
					</div>
					<br>
					<div>
						<!--Rechercher les enzymes et informations associés à un unique cofacteur -->
						<fieldset>
							<legend>Recherche d'enzymes ayant comme cofacteur(s)<SUP><a id="pop_info" href="rechsp_fr.php" onClick="popup('./popup/info_enz_fct.html')">?</a></SUP></legend>
							<input class="form"name="cofactors" list="cofactors" maxlength="15" size="6" value="<?php echo isset($_POST['cofactors']) ? $_POST['cofactors'] : '' ?>">
							<br><br>
							<input type="submit" value="Recherche" name="rech_co" />
						</fieldset>
					</div>
				</form>
				<?php echo PIED; ?>
			</div>
			<?php
				//~ Liste active des noms
				echo '<datalist id="name">';
				$query_sn = $db->prepare('
					SELECT DISTINCT systematic_name AS name FROM enzyme
					WHERE systematic_name IS NOT NULL
					UNION ALL
					SELECT DISTINCT accepted_name AS name FROM enzyme
					WHERE accepted_name IS NOT NULL
					UNION ALL
					SELECT DISTINCT synonyme AS name FROM synonym
					WHERE synonyme IS NOT NULL
					');
				$query_sn->execute();
				$result_sn = $query_sn->fetchAll(PDO::FETCH_ASSOC);
				foreach ($result_sn as $row_sn) {
					echo "<option value='".$row_sn['name']. "'>";
				}
				echo '</datalist></br></br>';
				
				//~ Liste active d'activité
				echo '<datalist id="act">';
				$query_act = $db->prepare('SELECT DISTINCT activity FROM enzyme WHERE activity IS NOT NULL ');
				$query_act->execute();
				$result_act = $query_act->fetchAll(PDO::FETCH_ASSOC);
				foreach ($result_act as $row_act) {
					echo "<option value='".$row_act['activity']. "'>";
				}
				echo '</datalist></br></br>';
				
				//~ Liste active de cofacteurs
				echo '<datalist id="cofactors">';
				$query_co = $db->prepare('SELECT DISTINCT cofactors FROM enzyme WHERE cofactors IS NOT NULL');
				$query_co->execute();
				$result_co = $query_co->fetchAll(PDO::FETCH_ASSOC);
				foreach ($result_co as $row_co) {
					echo "<option value='".$row_co['cofactors']. "'>";
				}
				echo '</datalist></br></br>';
			?>
		</div>
	</body>
</html>
