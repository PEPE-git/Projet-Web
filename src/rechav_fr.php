<!DOCTYPE html>

<html lang="fr">
	
	<head>
		<link rel="stylesheet" type="text/css" href="./form.css">
	</head>
	<body class = "principal">	

	<?php
		session_start();
		$titre="Recherche avancée";
		include("./includes/identifiants.php");
		include("./includes/debut.php");

		if ($id==0)	erreur(ERR_IS_NOT_CO.REDIRECT);
		else echo MENU;

		$var_opt="<option>EC1<option>EC2<option>EC3<option>EC4<option>titre article<option>année publication<option>auteur(s) article (séparés par des espaces)<option>activité chimique (composés)<option>cofacteurs<option>commentaires<option>historique<option>notes";
		
		//~ $sign = '<input type="radio" id="radio1" name="radio_0_0" value="<"><label for="radio1">></label>';
		//~ $sign .= '<input type="radio" id="radio2" name="radio_0_0" value="="><label for="radio2">=</label>';
		//~ $sign .= '<input type="radio" id="radio3" name="radio_0_0" value=">"><label for="radio3"><</label> ';
		$sign = '<select name="sign_0_0"><option value="egal">Egal à</option><option value="diff">Différent de</option><option value="sup">Supérieur à</option><option value="<">Inférieur à</option></select>';
		 
		echo '<div id="corps">
					<h1>'.$titre.'</h1>
					<div id="form">
						<form method="post" action="traitementav_fr.php" enctype="multipart/form-data" target=_blank>
						
						<fieldset><legend>Formulaire</legend>
								
							<label for="select">Informations que vous désirez<br/><br/></label>
							<select multiple >
								<option value="tous">Toutes les informations disponibles</option>
								<optgroup label="Enzyme">
								<option value="ec">Numéro EC</option>
								<option value="enzyme">Enzyme - Nom(s)</option>
								<option value="synonym">Enzyme - Synonyme(s)</option>
								<option value="activity">Activité(s) enzymatique(s)</option>
								</optgroup>
								<optgroup label="Références">
								<option value="titre">swissprot</option>
								<option value="titre">prosite</option>
								</optgroup>
								<optgroup label="Littérature">
								<option value="titre">titre</option>
								<option value="auteurs">auteur</option>
								<option value="année de publication">année</option>
								</optgroup>
								<optgroup label="Notes">
								<option value="comments">Commentaires</option>
								<option value="note">Notes</option>
								</optgroup>
							</select> <br \>
							<br \>
							
							<select name="list_0" size="1">'.$var_opt.'</select> '.$sign.' <input type="input" name="name_0_0" /> <span id="champs_0_1"><a href="javascript:create_champOR(0,1)">OU</a><br/>
							<span id="champs_1_0"><a href="javascript:create_champAND(1,0)">ET</a>
						</fieldset>
						<input type="submit" value="Rechercher">
						</form></div></div>';
	?>
	</body>
</html>

<script>
	// variables globales
	var ncol=3; var nrow=5;
	var var_opt="<option>EC1<option>EC2<option>EC3<option>EC4<option>titre article<option>année publication<option>auteur(s) article (séparés par des espaces)<option>activité chimique (composés)<option>cofacteurs<option>commentaires<option>historique<option>notes";
	// sortir uniquement les résultats qui ont toutes les informations, code swissprot/prosite,
	
	function create_sign(x,y) {
		 //~ // Radio button
		 //~ sign = '<input type="radio" id="radio1" name="radio_'+x+'_'+y+'" value="<"><label for="radio1">></label>';
		 //~ sign += '<input type="radio" id="radio2" name="radio_'+x+'_'+y+'" value="="><label for="radio2">=</label>';
		 //~ sign += '<input type="radio" id="radio3'+x+'_'+y+'" name="radio_'+x+'_'+y+'" value=">"><label for="radio3"><</label> ';
		 
		 // Liste
		 sign = '<select name="sign_'+x+'_'+y+'"><option value="egal">Egal à</option><option value="diff">Différent de</option><option value="sup">Supérieur à</option><option value="<">Inférieur à</option></select>';
		 return sign;
	}
	
	// Ajout d'une colonne (condition OU)
	function create_champOR(i,j) {
		l=i+1; k=j+1;
		
		if(k<ncol) {
			// création du nouveau champ et du lien pour créer un nouveau champ OU
			if(j==0) {
				document.getElementById('champs_'+i+'_'+j).innerHTML = 'OU '+create_sign(i,j)+'<input type="input" name="name_'+i+'_'+j+'"></span>';
				document.getElementById('champs_'+i+'_'+j).innerHTML+='<span id="champs_'+i+'_'+k+'"><a href="javascript:create_champOR('+i+','+k+')">OU</a><br/>';
			}
			else {
				if(document.getElementById('champs_'+l+'_0') !== null) {
					chp = document.getElementById('champs_'+i+'_'+j).innerHTML;
					ex = '<span id="champs_'+l+'_0">';
					tmp = chp.split(ex);
					document.getElementById('champs_'+i+'_'+j).innerHTML = 'OU '+create_sign(i,j)+'<input type="input" name="name_'+i+'_'+j+'"></span>'+'<span id="champs_'+i+'_'+k+'"><a href="javascript:create_champOR('+i+','+k+')">OU</a><br/>'+ex+tmp[1];
				}
				else document.getElementById('champs_'+i+'_'+j).innerHTML = 'OU '+create_sign(i,j)+'<input type="input" name="name_'+i+'_'+j+'"></span>'+'<span id="champs_'+i+'_'+k+'"><a href="javascript:create_champOR('+i+','+k+')">OU</a>';
			}
		} 
		else {
			// création du nouveau champ		
			if(document.getElementById('champs_'+l+'_0') !== null) {
				chp = document.getElementById('champs_'+i+'_'+j).innerHTML;
				ex = '<span id="champs_'+l+'_0">';
				tmp = chp.split(ex);
				document.getElementById('champs_'+i+'_'+j).innerHTML = 'OU '+create_sign(i,j)+'<input type="input" name="name_'+i+'_'+j+'"></span><br/>'+ex+tmp[1];
			}
			else document.getElementById('champs_'+i+'_'+j).innerHTML = 'OU '+create_sign(i,j)+'<input type="input" name="name_'+i+'_'+j+'"></span>';
		}
	} // fin fonction create_champOR	
	
	// Fonction d'ajout d'une ligne (condition ET)
	function create_champAND(i,j) {
		l=i+1; k=j+1;
		
		if(l<nrow) {
			// création du nouveau champ et du lien pour créer un nouveau champ ET
			document.getElementById('champs_'+i+'_'+j).innerHTML = 'ET <select name="list_'+i+'" size="1">'+var_opt+'</select>'+create_sign(i,j)+' <input type="input" name="name_'+i+'_'+j+'"></span>';
			document.getElementById('champs_'+i+'_'+j).innerHTML+='<span id="champs_'+i+'_'+k+'"><a href="javascript:create_champOR('+i+','+k+')">OU</a><br/><span id="champs_'+l+'_0"><a href="javascript:create_champAND('+l+',0)">ET</a></span>';
		} else {
			// création du nouveau champ
			document.getElementById('champs_'+i+'_'+j).innerHTML = 'ET <select name="list_'+i+'" size="1">'+var_opt+'</select>'+create_sign(i,j)+' <input type="input" name="name_'+i+'_'+j+'"></span>';
			document.getElementById('champs_'+i+'_'+j).innerHTML+='<span id="champs_'+i+'_'+k+'"><a href="javascript:create_champOR('+i+','+k+')">OU</a><br/>';
		}
	} // fin fonction creation_champAND
</script>
