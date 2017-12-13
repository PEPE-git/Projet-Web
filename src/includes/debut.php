<?php	
	echo (!empty($titre))?'<title>'.$titre.'</title>':'<title> EnzymSearch </title>';

	//Attribution des variables de session
	$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
	$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
		
	// Includes
	include("functions.php");
	include("constants.php");
?>
