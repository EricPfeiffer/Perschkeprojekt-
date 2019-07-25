<?php
require_once("dbutil.class.php");
  $db = new mysqli('localhost','root','','perschkeprojekt');
	if($db->connect_error):
  echo $db->connect_error;
endif;

  $benutzername = $_POST['name'];
  $passwort = $_POST['pwd1'];
  $passwort_widerholen = $_POST['pwd2'];

  $search_user = $db->prepare("SELECT id FROM anmeldung WHERE name= ?");
  $search_user->bind_param('s',$benutzername);
  $search_user->execute();
  $search_result = $search_user->get_result();

  if($search_result->num_rows == 0 && $benutzername != "" && $passwort != ""){
	
    if($passwort == $passwort_widerholen){
      $passwort = md5($passwort);

		DBUtil::register($_POST['name'], $passwort);
		
		echo 1;
	
	} else {
		echo 0;
	}
	
  } else {
	echo 0;
}

?>

