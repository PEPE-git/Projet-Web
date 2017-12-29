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
		
			$pb="https://www.ncbi.nlm.nih.gov/pubmed/";
			$md="";
			
			echo '<div id="corps">
				<h1><?php echo $titre ?></h1><br>
				
				<form method="post" action="dwl_bib.php">
					<input type="submit" style = "display: block; margin : auto;" name="export" value="Exporter" />
				</form>';
			
				$res="Auteurs\tTitre\tAnnée\tVolume\tPremière page\tDernière Page\tPubmed\tMedline\n";
				//~ Requete sur le nom d'auteur
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
							$res=$res.$row['authors']."\t".$row['title']."\t".$row['year']."\t".$row['volume']."\t".$row['first_page']."\t".$row['last_page']."\t".$row['pubmed'].$row['medline']."\n";
							echo '
							<tr>
							   <td>'.$row['authors'].'</td>
							   <td>'.$row['title'].'</td>
							   <td>'.$row['year'].'</td>
							   <td>'.$row['volume'].'</td>
							   <td>'.$row['first_page'].'</td>
							   <td>'.$row['last_page'].'</td>
							   <td><a href="'.$pb.$row['pubmed'].'">'.$row['pubmed'].'</a></td>
							   <td>'.$row['medline'].'</td>
						   </tr>';			
						}
						echo '</table>';
					}
				}
				else {
					//~ Requete sur les mots clés de titre d'article
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
								$res=$res.$row['authors']."\t".$row['title']."\t".$row['year']."\t".$row['volume']."\t".$row['first_page']."\t".$row['last_page']."\t".$row['pubmed'].$row['medline']."\n";
								echo '
								<tr>
								   <td>'.$row['authors'].'</td>
								   <td>'.$row['title'].'</td>
								   <td>'.$row['year'].'</td>
								   <td>'.$row['volume'].'</td>
								   <td>'.$row['first_page'].'</td>
								   <td>'.$row['last_page'].'</td>
								   <td><a href="'.$pb.$row['pubmed'].'">'.$row['pubmed'].'</a></td>
								   <td>'.$row['medline'].'</td>
							   </tr>';			
							}
							echo '</table>';
						}
					}
					else {
						//~ Requete sur année de publication
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
									$res=$res.$row['authors']."\t".$row['title']."\t".$row['year']."\t".$row['volume']."\t".$row['first_page']."\t".$row['last_page']."\t".$row['pubmed'].$row['medline']."\n";
									echo '
									<tr>
									   <td>'.$row['authors'].'</td>
									   <td>'.$row['title'].'</td>
									   <td>'.$row['year'].'</td>
									   <td>'.$row['volume'].'</td>
									   <td>'.$row['first_page'].'</td>
									   <td>'.$row['last_page'].'</td>
									   <td><a href="'.$pb.$row['pubmed'].'">'.$row['pubmed'].'</a></td>
									   <td>'.$row['medline'].'</td>
								   </tr>';			
								}
								echo '</table>';
							}
						}
					}
					$_SESSION['res_bib'] = $res;
				}
				echo PIED;
			?>
		</div>
	</body>
</html>
