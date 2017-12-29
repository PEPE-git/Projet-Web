<!DOCTYPE html>
<html lang="fr">

	<head>
		<link rel="stylesheet" type="text/css" href="./form.css">
	</head>
	
	<body class = "principal">
		
		<?php
			session_start();
			$titre = "Recherche Bibliographique - Résultats";
			include("./includes/identifiants.php");
			include("./includes/debut.php");

			if ($id==0)	erreur(ERR_IS_NOT_CO.REDIRECT);
			else echo MENU;
		

			echo '<div id="corps">
				<h1><?php echo $titre ?></h1>
				
				<form method="post" action="dwl.php">
					<input type="submit" style = "display: block; margin : auto;" name="export" value="Exporter" />
				</form>';
				
			
				$res="Auteurs\tTitre\tAnnée\tVolume\tPremière page\tDernière Page\tPubmed\tMedline\n";
				//~ Requete sur le numéro EC d'un enzyme
				if(!empty($_POST['rech_aut'])) {
					if(isset($_POST['aut_art'])) {
						$aut=$_POST['aut_art'];
						$q="SELECT * FROM article WHERE authors LIKE '%$aut%';";
						
						echo $q."</br></br>";
						$query = $db->query($q);
						echo '<table> 
						<tr>
							<th>Auteurs</th>
							<th>Titre</th>
							<th>Année</th>
							<th>Volume</th>
							<th>Première page</th>
							<th>Dernière Page</th>
							<th>Pubmed</th>		
							<th>Medline</th>			
						</tr>';

						while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
							$res=$res.$row['authors']."\t".$row['title']."\t".$row['year']."\t".$row['volume']."\t".$row['first_page']."\t".$row['last_page']."\t".$row['pubmed'].$row['medline'].'\n';
							echo '
							<tr>
							   <td>'.$row['authors'].'</td>
							   <td>'.$row['title'].'</td>
							   <td>'.$row['year'].'</td>
							   <td>'.$row['volume'].'</td>
							   <td>'.$row['first_page'].'</td>
							   <td>'.$row['last_page'].'</td>
							   <td>'.$row['pubmed'].'</td>
							   <td>'.$row['medline'].'</td>
						   </tr>';			
						}
						echo '</table>';
					}
				}
				else {
					//~ Requete sur le nom d'un enzyme
					if(!empty($_POST['rech_tit'])) {
						if(isset($_POST['tit_art'])) {
							$tit=$_POST['tit_art'];
							$q="SELECT * FROM article WHERE title LIKE '%$tit%';";
							
							echo $q."</br></br>";
							$query = $db->query($q);
							echo '<table> 
							<tr>
								<th>Auteurs</th>
								<th>Titre</th>
								<th>Année</th>
								<th>Volume</th>
								<th>Première page</th>
								<th>Dernière Page</th>
								<th>Pubmed</th>		
								<th>Medline</th>			
							</tr>';

							while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
								$res=$res.$row['authors']."\t".$row['title']."\t".$row['year']."\t".$row['volume']."\t".$row['first_page']."\t".$row['last_page']."\t".$row['pubmed'].$row['medline'].'\n';
								echo '
								<tr>
								   <td>'.$row['authors'].'</td>
								   <td>'.$row['title'].'</td>
								   <td>'.$row['year'].'</td>
								   <td>'.$row['volume'].'</td>
								   <td>'.$row['first_page'].'</td>
								   <td>'.$row['last_page'].'</td>
								   <td>'.$row['pubmed'].'</td>
								   <td>'.$row['medline'].'</td>
							   </tr>';			
							}
							echo '</table>';
						}
					}
					else {
						//~ Requete sur un composé chimique réagissant dans une réaction enzymatique
						if(!empty($_POST['rech_year'])) {
							if(isset($_POST['year_art'])) {
								$year=$_POST['year_art'];
								$q="SELECT * FROM article WHERE year LIKE '%$year%';";
								
								echo $q."</br></br>";
								$query = $db->query($q);
								echo '<table> 
								<tr>
									<th>Auteurs</th>
									<th>Titre</th>
									<th>Année</th>
									<th>Volume</th>
									<th>Première page</th>
									<th>Dernière Page</th>
									<th>Pubmed</th>		
									<th>Medline</th>			
								</tr>';

								while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
									$res=$res.$row['authors']."\t".$row['title']."\t".$row['year']."\t".$row['volume']."\t".$row['first_page']."\t".$row['last_page']."\t".$row['pubmed'].$row['medline'].'\n';
									echo '
									<tr>
									   <td>'.$row['authors'].'</td>
									   <td>'.$row['title'].'</td>
									   <td>'.$row['year'].'</td>
									   <td>'.$row['volume'].'</td>
									   <td>'.$row['first_page'].'</td>
									   <td>'.$row['last_page'].'</td>
									   <td>'.$row['pubmed'].'</td>
									   <td>'.$row['medline'].'</td>
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
				echo PIED;
			?>
		</div>
	</body>
</html>