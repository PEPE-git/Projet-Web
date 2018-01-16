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
				<th>Prosite</th>
				<th>Swissprot</th>	
			</tr>
		</thead>
	<tbody>';

	$ec_courant="";
	$flag=false;
	
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

		if($row['ec']!=$ec_courant) {
			$ec_courant=$row['ec'];
			if($flag) {
				$syn.='</td>';
				$swi.='</td>';
				
				echo '<tr>'.$ec.$syst.$acc.$syn.$co.$act.$his.$pro.$swi.'</tr>';
			}
			else $flag=true;
			
			$syn_l=array();
			$swi_l=array();
			
			$ec='<td><a target="_blank" href="traitementfiche_fr.php?ec='.$row['ec'].'">'.$row['ec'].'</a></td>';
			$syst='<td>'.$row['systematic_name'].'</td>';
			$acc='<td>'.$row['accepted_name'].'</td>';
			$co='<td>'.$row['cofactors'].'</td>';
			$act='<td>'.$row['activity'].'</td>';
			$his='<td>'.$row['history'].'</td>';
			$pro='<td><a target="_blank" href="https://prosite.expasy.org/'.$row['num_prosite'].'">'.$row['num_prosite'].'</a></td>';
			$syn='<td>';
			$swi='<td>';
			
			
			if(!empty($row['synonyme'])) {
				if(!in_array($row['synonyme'],$syn_l)) {
					$syn=$syn.$row['synonyme']."\t ";
					$syn_l[]=$row['synonyme'];
				}
			}
			if(!empty($row['code_swissprot'])) {
				if(!in_array($row['code_swissprot'],$swi_l)) {
					$swi=$swi.'<a target="_blank" href="http://www.uniprot.org/uniprot/'.$row['num_swissprot'].'">'.$row['code_swissprot'].'</a>'."\t ";
					$swi_l[]=$row['code_swissprot'];
				}
			}
		}
		else {
			if(!empty($row['synonyme'])) {
				if(!in_array($row['synonyme'],$syn_l)) {
					$syn=$syn.$row['synonyme']."\t ";
					$syn_l[]=$row['synonyme'];
				}
			}
			if(!empty($row['code_swissprot'])) {
				if(!in_array($row['code_swissprot'],$swi_l)) {
					$swi=$swi.'<a target="_blank" href="http://www.uniprot.org/uniprot/'.$row['num_swissprot'].'">'.$row['code_swissprot'].'</a>'."\t ";
					$swi_l[]=$row['code_swissprot'];
				}
			}
		}
	}
	$syn.='</td>';
	$swi.='</td>';
				
	echo '<tr>'.$ec.$syst.$acc.$syn.$co.$act.$his.$pro.$swi.'</tr>';
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
}




// Affichage des informations pertinentes dans le tableau en fonction de la checkbox (display_tab)
// IN : la query SQL
// OUT : $file pour l'export (+ echo du tableau sur la page)
function echo_resultats_bib($query){
	echo '<table id="traitementbib_fr" class="display" width="100%" cellspacing="0">
			<thead>
				<tr>';
	// Noms des colonnes du tableau
	// Si la box "tout" est cochée ou si aucune ne sont cochées, affiche toutes les colonnes

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
		<th>Prosite</th>
		<th>Swissprot</th>

	</tr>
	</thead>
	<tbody>';

	$ec_courant="";
	$flag=false;
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		if($row['ec']!=$ec_courant) {
			$ec_courant=$row['ec'];
			if($flag) {
				$swi.='</td>';
				
				echo '<tr>'.$ec.$aut.$tit.$year.$vol.$fpa.$lpa.$pub.$med.$pro.$swi.'</tr>';
			}
			else $flag=true;
			
			$swi_l=array();
			
			$ec='<td><a target="_blank" href="traitementfiche_fr.php?ec='.$row['ec'].'">'.$row['ec'].'</a></td>';
			$aut='<td>'.$row['authors'].'</td>';
			$tit='<td>'.$row['title'].'</td>';
			$year='<td>'.$row['year'].'</td>';
			$vol='<td>'.$row['volume'].'</td>';
			$fpa='<td>'.$row['first_page'].'</td>';
			$lpa='<td>'.$row['last_page'].'</td>';
			$pub='<td><a target="_blank" href="https://www.ncbi.nlm.nih.gov/pubmed/'.$row['pubmed'].'">'.$row['pubmed'].'</a></td>';
			$med='<td><a target="_blank" href="https://www.ncbi.nlm.nih.gov/pubmed?cmd=PureSearch&term='.$row['ec1'].'.'.$row['ec2'].'.'.$row['ec3'].'.'.$row['ec4'].'"[EC%2FRN Number]>'.$row['medline'].'</a></td>';
			$pro='<td><a target="_blank" href="https://prosite.expasy.org/'.$row['num_prosite'].'">'.$row['num_prosite'].'</a></td>';
			$swi='<td>';
			
			
			if(!empty($row['code_swissprot'])) {
				if(!in_array($row['code_swissprot'],$swi_l)) {
					$swi=$swi.'<a target="_blank" href="http://www.uniprot.org/uniprot/'.$row['num_swissprot'].'">'.$row['code_swissprot'].'</a>'."\t ";
					$swi_l[]=$row['code_swissprot'];
				}
			}
		}
		else {
			if(!empty($row['code_swissprot'])) {
				if(!in_array($row['code_swissprot'],$swi_l)) {
					$swi=$swi.'<a target="_blank" href="http://www.uniprot.org/uniprot/'.$row['num_swissprot'].'">'.$row['code_swissprot'].'</a>'."\t ";
					$swi_l[]=$row['code_swissprot'];
				}
			}
		}
	}
	$swi.='</td>';
				
	echo '<tr>'.$ec.$aut.$tit.$year.$vol.$fpa.$lpa.$pub.$med.$pro.$swi.'</tr>';
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
}



?>
