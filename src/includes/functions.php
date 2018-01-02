<?php
function erreur($err='')
{
   $mess=($err!='')? $err:'Une erreur inconnue s\'est produite';
   exit('<p>'.$mess.'</p>');
}



// Affichage des informations pertinentes dans le tableau en fonction de la checkbox (display_tab)
// IN : la query SQL
// OUT : $file pour l'export (+ echo du tableau sur la page)
function echo_resultats($query){	
	$file="";
	echo '<table id="traitementsp_fr" class="display">
			<thead>
				<tr>';
	// Noms des colonnes du tableau
	// Si la box "tout" est cochée ou si aucune ne sont cochées, affiche toutes les colonnes
	if(in_array("ch_all", $_REQUEST['display_tab']) || empty($_REQUEST['display_tab'])) {
		echo '
		<th>EC Number</th>
		<th>Systematic Names</th>
		<th>Accepted Names</th>
		<th>Synonyms</th>
		<th>Cofactors</th>
		<th>Activity</th>
		<th>History</th>	
	</tr>
	<tbody>';

	$file=$file."EC Number\tSystematic Names\tAccepted Names\tSynonyms\tCofactors\tActivity\tHistory\n";
	}
	// Sinon teste quelles box sont cohées et display la colonne en conséquence
	else{
		if(in_array("ch_ec", $_REQUEST['display_tab'])) {
			echo '<th>EC Number</th>';
			$file=$file."EC Number\t";}	
		if(in_array("ch_systematic", $_REQUEST['display_tab'])) {
			echo '<th>Systematic Names</th>';
			$file=$file."Systematic Names\t";}
		if(in_array("ch_accepted", $_REQUEST['display_tab'])) {
			echo '<th>Accepted Names</th>';
			$file=$file."Accepted Names\t";}
		if(in_array("ch_synonym", $_REQUEST['display_tab'])) {
			echo '<th>Synonyms</th>';
			$file=$file."Synonyms\t";}
		if(in_array("ch_cofactors", $_REQUEST['display_tab'])) {
			echo '<th>Cofactors</th>';
			$file=$file."Cofactors\t";}
		if(in_array("ch_activity", $_REQUEST['display_tab'])) {
			echo '<th>Activity</th>';	
			$file=$file."Activity\t";}
		if(in_array("ch_history", $_REQUEST['display_tab'])) {
			echo '<th>History</th>';
			$file=$file."History\t";}
		$file=$file."\n";
		echo ' </tr>
		<tbody>';
	}
	   						
	// Test pour chaque ligne ce qu'il faut afficher en fonction de la checkbox (display_tab)
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		echo '<tr>';
		if(in_array("ch_all", $_REQUEST['display_tab']) || empty($_REQUEST['display_tab'])) {
			echo '<td>'.$row['ec1'].$row['ec2'].$row['ec3'].$row['ec4'].'</td>
			   <td>'.$row['systematic_name'].'</td>
			   <td>'.$row['accepted_name'].'</td>
			   <td>'.$row['synonyme'].'</td>
			   <td>'.$row['cofactors'].'</td>
			   <td>'.$row['activity'].'</td>
			   <td>'.$row['history'].'</td>';

			$file=$file.$row['ec1'].$row['ec2'].$row['ec3'].$row['ec4']."\t".$row['accepted_name']."\t".$row['systematic_name']."\t".$row['synonyme']."\t".$row['cofactors']."\t".$row['activity']."\t".$row['history'];
		}
		else{
			if(in_array("ch_ec", $_REQUEST['display_tab'])) {
				echo '<td>'.$row['ec1'].$row['ec2'].$row['ec3'].$row['ec4'].'</td>';
				$file=$file.$row['ec1'].$row['ec2'].$row['ec3'].$row['ec4']."\t";
			}
			if(in_array("ch_systematic", $_REQUEST['display_tab'])) {
				echo '<td>'.$row['systematic_name'].'</td>';
				$file=$file.$row['systematic_name']."\t";
			}
			if(in_array("ch_accepted", $_REQUEST['display_tab'])) {
				echo '<td>'.$row['accepted_name'].'</td>';
				$file=$file.$row['accepted_name']."\t";
			}
			if(in_array("ch_synonym", $_REQUEST['display_tab'])) {
				echo '<td>'.$row['synonyme'].'</td>';
				$file=$file.$row['synonyme']."\t";
			}
			if(in_array("ch_cofactors", $_REQUEST['display_tab'])) {
				echo '<td>'.$row['cofactors'].'</td>';
				$file=$file.$row['cofactors']."\t";
			}
			if(in_array("ch_activity", $_REQUEST['display_tab'])) {
				echo '<td>'.$row['activity'].'</td>';
				$file=$file.$row['activity']."\t";
			}
			if(in_array("ch_history", $_REQUEST['display_tab'])) {
				echo '<td>'.$row['history'].'</td>';
				$file=$file.$row['history']."\t";
			}
			$file=$file."\n";
		}
		   echo '</tr>';			
	}
	echo '</tbody>
	</table>';

	echo "
		<script type=\"text/javascript\">
			$(document).ready(function() {
				$('#traitementsp_fr').DataTable();
			} );
		</script>";

	return $file;
}




?>
