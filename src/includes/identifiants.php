<?php
	try{
		$db = new PDO('mysql:host=localhost;dbname=EnzymeSearch', 'root', 'v303?U');
	}
	catch (Exception $e){
			die('Erreur : ' . $e->getMessage());
	}
?>
