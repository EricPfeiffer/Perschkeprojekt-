<?php
	session_start();

  $db = new mysqli('localhost','root','','perschkeprojekt');
	if($db->connect_error):
  echo $db->connect_error;
endif;

  $tasklistname = $_POST['tasklistname'];
  $creator = $_SESSION['name'];
  
 
  
  $search_user = $db->prepare("SELECT id FROM tasklist WHERE name= ? AND creator = ?");
  $search_user->bind_param('ss',$tasklistname,$creator);
  $search_user->execute();
  $search_result = $search_user->get_result();



  if($search_result->num_rows == 0 && preg_match("#^[a-zA-Z0-9äöüÄÖÜ ]+$#", $tasklistname) ){
		
		 $insert = $db->prepare("INSERT INTO tasklist (name, creator) VALUES (?,?)");
         $insert->bind_param('ss',$tasklistname,$creator);
         $insert->execute();
		
		echo 1;
	
  }
  else{echo 0;}

?>
