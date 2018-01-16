<?php
	try{
		$db = new PDO('mysql:host=localhost;dbname=test', 'root', 'v303?U');
		// $db->setAttribute(PDO::MYSQL_ATTR_MAX_BUFFER_SIZE, 1024*1024*50);
		// $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		// $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (Exception $e){
			die('Erreur : ' . $e->getMessage());
	}
?>
