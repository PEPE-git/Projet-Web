<!DOCTYPE html>
<html lang="fr">

	<head>
		<link rel="stylesheet" type="text/css" href="./form.css">

		
		<!-- Import des fichiers de DataTables en local -->
		<script type="text/javascript" charset="utf8" src="DataTables/jQuery-3.2.1/jquery-3.2.1.js"></script>
		<link rel="stylesheet" type="text/css" href="DataTables/datatables.css">
		<script type="text/javascript" charset="utf8" src="DataTables/datatables.js"></script>	
		
	</head>
	
	<?php
		session_start();
		$titre = "Fiche enzyme ".$_GET['ec'];
		include("./includes/identifiants.php");
		include("./includes/debut.php");

		if ($id==0){
			$co="first";
			echo'
			<body class="first">
				<div id="corps">
					<div id ="elem1">			
						<div class="zoom">
							Connexion<br>
							<a href="./connect_fr.php"><img src="./img/enz1.jpg" alt="connexion"/></a>
						</div>
					</div>
					<div id ="elem2">
						<div id="elem2_col1">
							<div class="zoom">
								Inscription<br>
								<a href="./subscribe_fr.php"><img src="./img/enz2.jpg" alt="inscription"/></a>
							</div>
						</div>
					<div id="elem2_col2">
						<div class="zoom">
							Plus d\'informations<br>
							<a href="./info_fr.php"><img src="./img/enz3.jpg" alt="plus d\'information"/></a>
						</div>
					</div>';

		}	
		else {
			echo MENU;
			$co="principal";
		}
	?>

	<body class = <?php echo $co ?> >		

	<?php	

		if ($co="principal") echo '<div id="corps">';

			echo '<h1>'.$titre.'</h1>';

		
			$query = $db->query('SELECT DISTINCT ec FROM enzyme');
			
			//~ echo '<table id="ficheind_fr" class="display" width="100%" cellspacing="0"><thead><tr><th>EC Number</th></tr></thead><tbody>';
			//~ while ($row = $query->fetch(PDO::FETCH_ASSOC)) echo '<tr><td><a target="_blank" href="traitementfiche_fr.php?ec='.$row['ec'].'">'.$row['ec'].'</a></td></tr>';
			//~ echo '</tbody></table>';
			
			echo '<table id="ficheind_fr" class="display" width="100%" cellspacing="0"><thead><tr><th>Numéro EC</th><th>Numéro EC</th><th>Numéro EC</th><th>Numéro EC</th><th>Numéro EC</th></tr></thead><tbody>';
			$i=0;
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				if($i==4) {
					echo '<td><a target="_blank" href="traitementfiche_fr.php?ec='.$row['ec'].'">'.$row['ec'].'</a></td></tr>';
					$i=0;
				}
				else {
					if ($i==0) echo '<tr>';
					echo '<td><a target="_blank" href="traitementfiche_fr.php?ec='.$row['ec'].'">'.$row['ec'].'</a></td>';
					$i++;
				}
			}
			if($i<5) {
				while ($i<5) {
					echo '<td> </td>';
					$i++;
				}
				echo '</tr>';
			}
			
			echo '</tbody></table>';
			
			echo "
		<script type=\"text/javascript\">
			$(document).ready(function() {
				$('#ficheind_fr').DataTable({
					dom: 'Bfrtip',
					lengthMenu: [
			            [ 10, 25, 50, -1 ],
			            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
			        ],

					buttons: [
						'pageLength'
					]
				});
			} );
		</script>";
		
		echo PIED;
		?>
		
		
		</div>
	</body>
</html>
