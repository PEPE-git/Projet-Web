<?php
	try{
		$db = new PDO('mysql:host=localhost;dbname=test', 'root', 'v303?U');
	}
	catch (Exception $e){
			die('Erreur : ' . $e->getMessage());
	}
?>
