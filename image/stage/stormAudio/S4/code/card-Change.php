<?php
 	require_once 'includes/functions.inc.php';
	$header = 'card-Control.php';
	// this is the page that make change
	if(isset($_POST["CardNum"]) && isset($_POST["id"]) && isset($_POST["name"])){
		// GET VAR
		$NewSN = $_POST["CardNum"];
		$id = $_POST["id"];
		$name = $_POST["name"];

		// COMMAND
		exec("sudo /root/ISP_CU/bin/ISP_CU_AP_D -e ".$id." 0 '".$NewSN."'");

		// BDD
		$SN = substr($NewSN, -20, 9);
		setVersionsSN($name, $SN);

		$num = substr($NewSN, -6, 2);
		$value = "p/n ".$num." rev 1";
		setVersionsH($name, $value);
	}
	// return to control
	header('Location: card-Control.php'); 
?>