<?php

function erreur($err='') {
	$mess=($err!='')? $err:'Une erreur inconnue s\'est produite';
	exit('<p>'.$mess.'</p>');
}



// Affichage des informations pertinentes dans le tableau en fonction de la checkbox (display_tab)
// IN : la query SQL
// OUT : $file pour l'export (+ echo du tableau sur la page)
function echo_resultats_sp($query){
	// $file="";
	echo '<table id="traitementsp_fr" class="display" width="100%" cellspacing="0">
			<thead>
				<tr>';
	// Noms des colonnes du tableau
	// Si la box "tout" est cochée ou si aucune ne sont cochées, affiche toutes les colonnes
		echo '
				<th>EC Number</th>
				<th>Systematic Names</th>
				<th>Accepted Names</th>
				<th>Synonyms</th>
				<th>Cofactors</th>
				<th>Activity</th>
				<th>History</th>
				<th>Swissprot</th>	
			</tr>
		</thead>
	<tbody>';

	$n = $query->rowCount();
	$i=0;
	$all = $query->fetchAll(PDO::FETCH_ASSOC);
	while ($i<$n) {
		$row = $all[$i];
	    echo '<tr>';
	    // if(in_array("ch_all", $_REQUEST['display_tab']) || empty($_REQUEST['display_tab'])) {
	    echo '<td>'.$row['ec'].'</td>
	        <td>'.$row['systematic_name'].'</td>
	        <td>'.$row['accepted_name'].'</td>
	        <td>'.$row['synonyme'].'</td>
	        <td>'.$row['cofactors'].'</td>
	        <td>'.$row['activity'].'</td>
	        <td>'.$row['history'].'</td>';
	        // $file=$file.$row['ec']."\t".$row['accepted_name']."\t".$row['systematic_name']."\t".$row['synonyme']."\t".$row['cofactors']."\t".$row['activity']."\t".$row['history']."\t";
	        echo '<td>';
	        if (!empty($row['code_swissprot'])) {
		        echo '
		        <a target="_blank" href="http://www.uniprot.org/uniprot/'.$row['num_swissprot'].'">'.$row['code_swissprot'].'</a>'.', ';
		        // $file=$file.$row['code_swissprot'].', ';
		        $j=$i+1;
		        if (!empty($all[$j]['code_swissprot'])) {
		            $row_swiss = $all[$j];
		            while ($row['id_enzyme']==$row_swiss['id_enzyme']) {
		                echo '<a target="_blank" href="http://www.uniprot.org/uniprot/'.$row_swiss['num_swissprot'].'">'.$row_swiss['code_swissprot'].'</a>'.', ';
		                // $file=$file.$row_swiss['code_swissprot'].', ';
		                $j=$j+1;
		                $row_swiss = $all[$j];
		            }
		            $i=$j;
		        }
		        else{
		        	$i=$i+1;
		        }
		    }
		    else{
		    	$i=$i+1;
		    }
		echo '</td>';
		echo '</tr>';			
	}
	echo '</tbody>
	</table>';

	echo "
		<script type=\"text/javascript\">
			$(document).ready(function() {
				$('#traitementsp_fr').DataTable({
					dom: 'Bfrtip',
					lengthMenu: [
			            [ 10, 25, 50, -1 ],
			            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
			        ],
			        columnDefs: [
			            {
			                targets: -1,
			                visible: false
			            } 
       				],

					buttons: [

					 	{
							extend: 'collection',
			                text: 'Export',
			                buttons: [
			                	{
					                extend: 'copyHtml5',
					                exportOptions: {
					                    columns: ':visible'
					                }
					            },
					            {
					                extend: 'csvHtml5',
					                exportOptions: {
					                    columns: ':visible'
					                }
					            },
					            {
					                extend: 'excelHtml5',
					                exportOptions: {
					                    columns: ':visible'
					                }
					            },
					            {
					                extend: 'pdfHtml5',
					                orientation: 'landscape',
               						pageSize: 'LEGAL',
					                exportOptions: {
					                    columns: ':visible'
					                }
					            },
					            {
					                extend: 'print',
					                exportOptions: {
					                    columns: ':visible'
					            	}
					            }
			                ]
						},
						'pageLength',
						{
							extend: 'colvis'
						}
					]
				});
			} );
		</script>";

	// return $file;
}




// Affichage des informations pertinentes dans le tableau en fonction de la checkbox (display_tab)
// IN : la query SQL
// OUT : $file pour l'export (+ echo du tableau sur la page)
function echo_resultats_bib($query){
	// $file="";
	$pb="https://www.ncbi.nlm.nih.gov/pubmed/";
	echo '<table id="traitementbib_fr" class="display" width="100%" cellspacing="0">
			<thead>
				<tr>';
	// Noms des colonnes du tableau
	// Si la box "tout" est cochée ou si aucune ne sont cochées, affiche toutes les colonnes
	// if(in_array("ch_all", $_REQUEST['display_tab']) || empty($_REQUEST['display_tab'])) {
		echo '
		<th>EC Number</th>
		<th>Auteur</th>
		<th>Titre</th>
		<th>Année</th>
		<th>Volume</th>
		<th>Première page</th>
		<th>Dernière Page</th>
		<th>Pubmed</th>		
		<th>Medline</th>
		<th>Swissprot</th>

	</tr>
	</thead>
	<tbody>';

	$n = $query->rowCount();
	$i=0;
	$all = $query->fetchAll(PDO::FETCH_ASSOC);
	while ($i<$n) {
		$row = $all[$i];
		echo '<tr>';
		// if(in_array("ch_all", $_REQUEST['display_tab']) || empty($_REQUEST['display_tab'])) {
			echo '
				<td>'.$row['ec'].'</td>
				<td>'.$row['authors'].'</td>
				<td>'.$row['title'].'</td>
			 	<td>'.$row['year'].'</td>
			 	<td>'.$row['volume'].'</td>
			 	<td>'.$row['first_page'].'</td>
			 	<td>'.$row['last_page'].'</td>
				<td><a target="_blank" href="'.$pb.$row['pubmed'].'">'.$row['pubmed'].'</a></td>
				<td><a target="_blank" href="https://www.ncbi.nlm.nih.gov/pubmed?cmd=PureSearch&term='.$row['ec1'].'.'.$row['ec2'].'.'.$row['ec3'].'.'.$row['ec4'].'"[EC%2FRN Number]>'.$row['medline'].'</a></td>';
				
			echo '<td>';
	        if (!empty($row['code_swissprot'])) {
		        echo '
		        <a target="_blank" href="http://www.uniprot.org/uniprot/'.$row['num_swissprot'].'">'.$row['code_swissprot'].'</a>'.', ';
		        $j=$i+1;
		        if (!empty($all[$j]['code_swissprot'])) {
		            $row_swiss = $all[$j];
		            while ($row['id_enzyme']==$row_swiss['id_enzyme']) {
		                echo '<a target="_blank" href="http://www.uniprot.org/uniprot/'.$row_swiss['num_swissprot'].'">'.$row_swiss['code_swissprot'].'</a>'.', ';
		                $j=$j+1;
		                $row_swiss = $all[$j];
		            }
		            $i=$j;
		        }
		        else{
		        	$i=$i+1;
		        }
		    }
		    else{
		    	$i=$i+1;
		    }
		    echo '</td>';
		echo '</tr>';			
	}
	echo '</tbody>
	</table>';

	echo "
		<script type=\"text/javascript\">
			$(document).ready(function() {
				$('#traitementbib_fr').DataTable({
					dom: 'Bfrtip',
					lengthMenu: [
			            [ 10, 25, 50, -1 ],
			            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
			        ],
			        columnDefs: [
			            {
			                targets: -1,
			                visible: false
			            } 
       				],

					buttons: [
					 	{
							extend: 'collection',
			                text: 'Export',
			                buttons: [
			                	{
					                extend: 'copyHtml5',
					                exportOptions: {
					                    columns: ':visible'
					                }
					            },
					            {
					                extend: 'csvHtml5',
					                exportOptions: {
					                    columns: ':visible'
					                }
					            },
					            {
					                extend: 'excelHtml5',
					                exportOptions: {
					                    columns: ':visible'
					                }
					            },
					            {
					                extend: 'pdfHtml5',
					                orientation: 'landscape',
               						pageSize: 'LEGAL',
					                exportOptions: {
					                    columns: ':visible'
					                }
					            },
					            {
					                extend: 'print',
					                exportOptions: {
					                    columns: ':visible'
					            	}
					            }
			                ]
						},
						'pageLength',
						{
							extend: 'colvis'
						}
					]
				});
			} );
		</script>";

	// return $file;
}



?>
