<!DOCTYPE html>
<html lang="fr">

	<head>
		<link rel="stylesheet" type="text/css" href="./form.css">
	</head>
	
	<body class = "principal">
		
		<?php
			session_start();
			$titre = "Recherche Simple - Résultats";
			include("./includes/identifiants.php");
			include("./includes/debut.php");

			if ($id==0)	erreur(ERR_IS_NOT_CO.REDIRECT);
			else echo MENU;
		 

			echo '<div id="corps">
				<h1><?php echo $titre ?></h1>
				
				<form method="post" action="dwl.php">
					<input type="submit" style = "display: block; margin : auto;" name="export" value="Exporter" />
				</form>';
				
			
				$res="EC Number\tAccepted Names\tSystematic Names\tSynonyms\tCofactors\tActivity\tHistory\n";
				//~ Requete sur le numéro EC d'un enzyme
				if(!empty($_POST['rech_ec'])) {
					if(isset($_POST['ec1'])) {
						$q="SELECT * FROM enzyme ";
						$ec1 =$_POST['ec1'];
						$q=$q."WHERE ec1='$ec1' ";
						if(isset($_POST['ec2'])) {
							$ec2=$_POST['ec2'];
							$q=$q+"AND ec2='$ec2' ";
							if(isset($_POST['ec3'])) {
								$ec2=$_POST['ec3'];
								$q=$q+"AND ec3='$ec3' ";
								if(isset($_POST['ec4'])) {
									$ec2=$_POST['ec4'];
									$q=$q+"AND ec4='$ec4' ";
								}
							}
						}
					}
					else {
						echo 'Requête non conforme : veuillez indiquer un numéro pour le premier champ EC';
					}
				}
				else {
					//~ Requete sur le nom d'un enzyme
					if(!empty($_POST['rech_name'])) {
						if(isset($_POST['name_type'])) {
							$name_type=$_POST['name_type'];
							$name=$_POST['name'];
							if($name_type == "1") {
								$q=$q."SELECT * FROM enzyme WHERE accepted_name LIKE '%$name%';";
							}
							else {
								if($name_type == "2") {
									$q=$q."SELECT * FROM enzyme WHERE systematic_name LIKE'%$name%';";
								}
								else {
									if($name_type == "3") {
										$q=$q."SELECT * FROM enzyme,synonym WHERE synonym.synonyme LIKE'%$name%' AND synonym.id_enzyme=enzyme.id_enzyme;";
									}
									else {
										$q=$q."SELECT * FROM enzyme,synonym WHERE synonym.id_enzyme=enzyme.id_enzyme AND (accepted_name LIKE '%$name%' OR systematic_name LIKE '%$name%' OR synonym.synonyme LIKE '%$name%');";
									}
								}
							}
							echo $q."</br>";
							$query = $db->query($q);
							echo '<table> 
							<tr>
								<td>EC Number</td>
								<td>Accepted Names</td>
								<td>Systematic Names</td>
								<td>Synonyms</td>
								<td>Cofactors</td>
								<td>Activity</td>
								<td>History</td>			
							</tr>';
							
							while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
								$file=$file.$row['ec']."\t".$row['accepted_name']."\t".$row['systematic_name']."\t".$row['synonym']."\t".$row['cofactors']."\t".$row['activity']."\t".$row['history'].'\n';
								echo '
								<tr>
								   <td>'.$row['ec'].'</td>
								   <td>'.$row['accepted_name'].'</td>
								   <td>'.$row['systematic_name'].'</td>
										   <td>'.$row['synonym'].'</td>
								   <td>'.$row['cofactors'].'</td>
								   <td>'.$row['activity'].'</td>
								   <td>'.$row['history'].'</td>
							   </tr>';			
							}
							echo '</table>';
						}
						
					}
					else {
						//~ Requete sur un composé chimique réagissant dans une réaction enzymatique
						if(!empty($_POST['rech_act'])) {
							if(isset($_POST['act'])) {
								$act=$_POST['act'];
								$q="SELECT * FROM enzyme WHERE activity LIKE '%$act%';";
								
								echo $q."</br></br>";
								$query = $db->query($q);
								echo '<table> 
								<tr>
									<td>EC Number</td>
									<td>Accepted Names</td>
									<td>Systematic Names</td>
									<td>Synonyms</td>
									<td>Cofactors</td>
									<td>Activity</td>
									<td>History</td>			
								</tr>';

								while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
									$res=$res.$row['ec']."\t".$row['accepted_name']."\t".$row['systematic_name']."\t".$row['synonym']."\t".$row['cofactors']."\t".$row['activity']."\t".$row['history'].'\n';
									echo '
									<tr>
									   <td>'.$row['ec'].'</td>
									   <td>'.$row['accepted_name'].'</td>
									   <td>'.$row['systematic_name'].'</td>
										   <td>'.$row['synonym'].'</td>
									   <td>'.$row['cofactors'].'</td>
									   <td>'.$row['activity'].'</td>
									   <td>'.$row['history'].'</td>
								   </tr>';			
								}
								echo '</table>';
							}
				
						}
						else {
							//~ Requete sur un cofacteur
							if(!empty($_POST['rech_co'])) {
								if(isset($_POST['cofactors'])) {
									$co=$_POST['cofactors'];
									$q="SELECT * FROM enzyme WHERE cofactors LIKE'%$co%';";
									
									echo $q."</br></br>";
									$query = $db->query($q);
									echo '<table> 
									<tr>
										<td>EC Number</td>
										<td>Accepted Names</td>
										<td>Systematic Names</td>
										<td>Synonyms</td>
										<td>Cofactors</td>
										<td>Activity</td>
										<td>History</td>			
									</tr>';
									
									while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
										$res=$res.$row['ec']."\t".$row['accepted_name']."\t".$row['systematic_name']."\t".$row['synonym']."\t".$row['cofactors']."\t".$row['activity']."\t".$row['history'].'\n';
										echo '
										<tr>
										   <td>'.$row['ec'].'</td>
										   <td>'.$row['accepted_name'].'</td>
										   <td>'.$row['systematic_name'].'</td>
										   <td>'.$row['synonym'].'</td>
										   <td>'.$row['cofactors'].'</td>
										   <td>'.$row['activity'].'</td>
										   <td>'.$row['history'].'</td>
									   </tr>';			
									}
									echo '</table>';
								}
							}
						}
					}
					$_SESSION['res'] = $res;
				}
			?>
		</div>
	</body>
</html>
