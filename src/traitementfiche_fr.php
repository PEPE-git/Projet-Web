<!DOCTYPE html>
<html lang="fr">

	<head>
		<link rel="stylesheet" type="text/css" href="./form.css">

		<!-- <link rel="stylesheet" type="text/css" href="DataTables/datatables.css"> -->
		<script type="text/javascript" src="DataTables/jQuery-3.2.1/jquery-3.2.1.js"></script>
		
	</head>

	
	<?php
		session_start();
		$titre = "Fiche enzyme ".$_GET['ec'];
		include("./includes/identifiants.php");
		include("./includes/debut.php");

		if ($id==0)	$co="first";
		else {
			echo MENU;
			$co="principal";
		}
	?>

	<body class = <?php echo $co ?> >	
	
		<div id="corps">
			<h1><?php echo $titre ?></h1>
			<div>
			<?php
				$ec=$_GET['ec'];
				//~ $ec=explode(".",$_GET['ec']);
				//~ $ec[0]=substr($ec[0], 3);
				//~ echo var_dump($ec);
				
				// Récupération de l'id court
				$q="SELECT systematic_name, accepted_name, cofactors, activity, history, id_enzyme, activity, history FROM enzyme WHERE ec='$ec'";
				//~ echo $q;
				$query=$db->query($q);
				if($query->rowCount()!=1) exit("Erreur. Veuillez recommencer");
				else $row=$query->fetch();
				$id=$row['id_enzyme'];
				
				echo '<div id="fichenz">';
				// NOM OFFICIEL
				echo '<div id="unit"><div id="tit">Nom officiel</div><div id="txt"><p>'.$row['systematic_name'].'</p></div></div>';
				
				// NOM ALTERNATIF
				echo '<div id="unit"><div id="tit">Nom alternatif</div><div id="txt"><p>'.$row['accepted_name'].'</p></div></div>';
				
				// SYNONYMES
				$q="SELECT synonyme FROM synonym WHERE id_enzyme='$id'";
				//~ echo $q;
				$query=$db->query($q);
				echo '<div id="unit"><div id="tit">Synonymes</div><div id="txt"><p>';
				while($syn=$query->fetch(PDO::FETCH_ASSOC)) echo $syn['synonyme']."<br>";
				echo '</p></div></div>';
				
				// ACTIVITE
				$act=explode(".",$row['activity']);
				echo '<div id="unit"><div id="tit">Activity</div><div id="txt"><p>';
				foreach($act as $a) if ($a!="") echo "$a<br>";
				echo '</p></div></div>';
				
				// COFACTEURS
				echo '<div id="unit"><div id="tit">Cofacteurs</div><div id="txt"><p>'.$row['cofactors'].'</p></div></div>';
				
				// HISTORIQUE
				echo '<div id="unit"><div id="tit">Historique</div><div id="txt"><p>'.$row['history'].'</p></div></div>';
				
				// COMMENTAIRES
				$q="SELECT comment FROM comments WHERE id_enz='$id'";
				//~ echo $q;
				$query=$db->query($q);
				echo '<div id="unit"><div id="tit">Commentaires</div><div id="txt"><p>';
				while($com=$query->fetch(PDO::FETCH_ASSOC)) echo $com['comment']."<br>";
				echo '</p></div></div>';
				
				// SWISSPROT
				$q="SELECT num_swissprot, code_swissprot FROM swissprot WHERE id_enzyme='$id'";
				//~ echo $q;
				$query=$db->query($q);
				echo '<div id="unit"><div id="tit">Swissprot</div><div id="txt"><p>';
				while($sw=$query->fetch(PDO::FETCH_ASSOC)) echo '<a target="_blank" style="color:black" href="http://www.uniprot.org/uniprot/'.$sw['num_swissprot'].'">'.$sw['code_swissprot'].'</a> ';
				echo '</p></div></div>';
				
				// PROSITE
				$q="SELECT num_prosite FROM prosite WHERE id_enzyme='$id'";
				//~ echo $q;
				$query=$db->query($q);
				echo '<div id="unit"><div id="tit">Prosite</div><div id="txt"><p>';
				while($pr=$query->fetch(PDO::FETCH_ASSOC)) echo '<a target="_blank" style="color:black" href="https://prosite.expasy.org/'.$pr['num_prosite'].'">'.$pr['num_prosite'].'</a> ';
				echo '</p></div></div>';
								
				// PUBLICATIONS
				$q="SELECT authors, title, year, volume, first_page, last_page, pubmed, medline, editorial_place, city, edition, editor FROM publie, article LEFT JOIN edition ON article.id_article=edition.id_article WHERE publie.id_enzyme='$id' AND publie.id_article=article.id_article";
				//~ echo $q;
				$query=$db->query($q);
				echo '<div id="unit"><div id="tit">Publications</div><div id="txt"><p>';
				echo '<table>';
				echo '<tr>';
					echo '<th>Auteurs</th>';
					echo '<th>Titre</th>';
					echo '<th>Année</th>';
					echo '<th>Volume</th>';
					echo '<th>Première page</th>';
					echo '<th>Dernière page</th>';
					echo '<th>Pubmed</th>';
					echo '<th>Medline</th>';				
					echo '<th>Lieu d\'édition</th>';
					echo '<th>Ville</th>';
					echo '<th>Edition</th>';
					echo '<th>Editeur</th>';
					echo '</tr>';
				while($pu=$query->fetch(PDO::FETCH_ASSOC)) {
					echo '<tr>';
					echo '<td>'.$pu['authors'].'</td>';
					echo '<td>'.$pu['title'].'</td>';
					echo '<td>'.$pu['year'].'</td>';
					echo '<td>'.$pu['volume'].'</td>';
					echo '<td>'.$pu['first_page'].'</td>';
					echo '<td>'.$pu['last_page'].'</td>';
					echo '<td>'.'<a target="_blank" style="color:black" href="https://www.ncbi.nlm.nih.gov/pubmed/'.$pu['pubmed'].'">'.$pu['pubmed'].'</a>'.'</td>';
					echo '<td>'.'<a target="_blank" style="color:black" href="https://www.ncbi.nlm.nih.gov/pubmed?cmd=PureSearch&term='.$ec.'"[EC%2FRN Number]>'.$pu['medline'].'</a>'.'</td>';				
					echo '<td>'.$pu['editorial_place'].'</td>';
					echo '<td>'.$pu['city'].'</td>';
					echo '<td>'.$pu['edition'].'</td>';
					echo '<td>'.$pu['editor'].'</td>';
					echo '</tr>';
				}
				echo '</table>';
				echo '</p></div></div>';
				
				// NOTES
				$q="SELECT note, note_type FROM note WHERE id_enzyme='$id'";
				//~ echo $q;
				$query=$db->query($q);
				echo '<div id="unit"><div id="tit">Notes</div><div id="txt"><p>';
				while($no=$query->fetch(PDO::FETCH_ASSOC)) echo $no['note']."(".$row['note_type'].")";
				echo '</p></div></div>';
				
				echo '</div></div></div>';
				
				echo PIED;
			?>
	</body>
</html>

