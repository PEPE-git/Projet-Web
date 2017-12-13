<?php
	session_start();	
	header('Content-Type: text/plain');
	header('Content-Disposition: attachment; filename="testfile.php"');
	header('Content-Transfer-Encoding: binary');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	echo $_SESSION['res'];
	exit;
?>
