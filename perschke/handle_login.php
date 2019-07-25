<?php

	session_start();

	require_once("dbutil.class.php");
    $passwort = $_POST['pwd'];
	$passwort = md5($passwort);
	//POST-Parameter überprüfen (Schritt 1)
	if(   isset($_POST['name']) && !empty($_POST['name'])
		&& isset($_POST['pwd']) && !empty($_POST['pwd'])){
		
		$ld = DBUtil::checkLogin($_POST['name'], $passwort);
		
		//Login ok? Ausgabe!
		if($ld != null && $ld->id > 0){
			//...ja!
			$_SESSION['login'] = 1;
			$_SESSION['name'] = $_POST['name'];
			echo 1;
		} else {
			//...nein!
			echo 0;
			$_SESSION['login'] = 0;
			$_SESSION['name'] = '';
			
		}
		
	} else {
		//POST-Parameter sind teilweise gar nicht vorhanden oder leer!
		echo 0;
	}

?>