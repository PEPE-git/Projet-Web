<?php
	try{
		$db = new PDO('mysql:host=localhost;dbname=test', 'root', 'hamtaro');
	}
	catch (Exception $e){
			die('Erreur : ' . $e->getMessage());
	}
?>
