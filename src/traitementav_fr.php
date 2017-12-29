<!DOCTYPE html>
<html lang="fr">

	<head>
		<link rel="stylesheet" type="text/css" href="./form.css">
	</head>
	
	<body class = "principal">
		
		<?php
			session_start();
			$titre = "Recherche Avancée - Résultats";
			include("./includes/identifiants.php");
			include("./includes/debut.php");

			if ($id==0)	erreur(ERR_IS_NOT_CO.REDIRECT);
			else echo MENU;



			echo '<div id="corps">
				<h1><?php echo $titre ?></h1><br>
				
				<form method="post" action="dwl_av.php">
					<input type="submit" style = "display: block; margin : auto;" name="export" value="Exporter" />
				</form>';


			// REQUETE AVANCEE - CONSTRUCTION
			$cdt="";
			$select="";
			$q="";
					
			//~ echo var_dump($_POST);
			
			
			foreach($_POST as $key => $val) {
				// Création de la sélection sur gros tableau (clauses SELECT+FROM)
				if(preg_match("#^selection#", $key)) {
					$select= "SELECT DISTINCT ";
					$f=true;
					foreach($val as $i => $j) {
						if($f) {
							$f=false;
							$select.= $j;
						}
						else $select.= ", $j";
					}
					$select.=" FROM enzyme LEFT JOIN comments ON enzyme.id_enzyme=comments.id_enz LEFT JOIN note ON note.id_enzyme=enzyme.id_enzyme LEFT JOIN prosite ON prosite.id_enzyme=enzyme.id_enzyme LEFT JOIN swissprot ON swissprot.id_enzyme=enzyme.id_enzyme LEFT JOIN synonym ON synonym.id_enzyme=enzyme.id_enzyme LEFT JOIN publie ON publie.id_enzyme=enzyme.id_enzyme LEFT JOIN article ON article.id_article=publie.id_article LEFT JOIN edition ON edition.id_article=article.id_article";
					$select.=" WHERE ";
				}
				else {
					// Création des conditions de requete (clause WHERE)
					if(preg_match("#^list#", $key)) {
						if ($cdt == "") $cdt="(";
						else $cdt.=") AND (";
						
						$var=$val; // on garde en mémoire la variable d'intérêt pour tester par la suite la conformité des données founies 
						$or=true; // flag de condition OU			
						$cdt.=$val;
					}
					else {
						// On récupère les informations sur le signe
						if(preg_match("#^sign#", $key)) {
							if($or) {
								$or=false;
								$cdt.=$val;
							}
							else $cdt.= " OR $var$val";
									
						}
						else {
							if(preg_match("#^name#", $key)) {
								if($var=="enzyme.ec1") {
									if (!($val>0 & $val < 6)) exit("ERREUR : EC1 doit être compris entre 1 et 6");
							}
								else {
									if ($var=="enzyme.ec2"||$val=="enzyme.ec3"||$val=="enzyme.ec4") {
										if (!($val>0)) exit("ERREUR : EC2 et/ou EC3 et/ou EC4 doivent être des entiers positifs");
									}
									else {
										if($var=="article.year") {
											if (!($val>1980)) exit("ERREUR : L'année de publication est un entier supérieur à 1980");
										}
										else {
											if($var=="notes.type") {
												if (!($val=="deleted")&&!($val=="#transferred#")) exit("ERREUR : Les notes ne sont que de 2 types : \"deleted\" ou \"transferred\". Merci de préciser l'un des deux.");
											}
											else {
												if($var=="article.title") {
													//~ if(condition de validité);
													$cdt=substr($cdt, 0, -1);
													$val= " LIKE '%$val%'";
												}
												else {
													if($var=="enzyme.cofactors") {
														$cdt=substr($cdt, 0, -1);
														$val= " LIKE '%$val%'";
													}
													else {
														if($var=="enzyme.activity") {
															$cdt=substr($cdt, 0, -1);
															$val= " LIKE '%$val%'";
														}
													}
												}
											}	
										}
									}
								}
							}
							$cdt.=$val;
						}
					}
				}
			}
			$cdt.=");";
			$q=$select.$cdt;
			echo $q;
			
			//~ $key_select=array();
			//~ foreach($_POST["selection"] as $key) {
				//~ $tmp=preg_split("#,#",$key);
				//~ $key_select=array_merge($key_select,$tmp);
			//~ }
			//~ echo var_dump($key_select);
								
			//~ $t = array("a1" => "b1","a2" => "b2","a3" => "b3");					
			//~ for ($i=0;$i<sizeof($key_select);$i++) {
				//~ echo $t[$i];
			//~ }
			
			
			
			//REQUETE AVANCEE - AFFICHAGE DES RESULTATS
			//~ $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
			$query=$db->query($q);			
			$res="";
			echo '<table>';
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				//~ echo '<tr>';
				$tmp='<tr>';
				foreach ($row as $key => $val ) {
					$res=$res."\t".$val;
					//~ echo '<td>'.$val.'</td>';					
					$t='<td>'.$val.'</td>';					
					$tmp.=$t;					
				}
				//~ echo '</tr>';
				$tmp.='</tr>';
				echo $tmp;
				$res.="\n";
			}
			echo '</table>';
			echo PIED;
		?>
	</body>
</html>
