<?php
require_once("dbutil.class.php");
	session_start();

  $db = new mysqli('localhost','root','','perschkeprojekt');
	if($db->connect_error):
  echo $db->connect_error;
endif;
  $nametasklist = trim($_SESSION['tasklistenname']); 
  $titel = $_POST['titel'];
  $beschreibung =$_POST['beschreibung'];
  $prio = $_POST['prio'];
  $enddate =$_POST['date'];
  $status = $_POST['status'];
  $creator = $_SESSION['name'];
  $ID = DBUtil::searchTasklistId($nametasklist,$creator);
  $search_user = $db->prepare("SELECT id FROM task WHERE titel = ? AND tasklistid = ?");
  $search_user->bind_param('ss',$titel,$ID);
  $search_user->execute();
  $search_result = $search_user->get_result();
  
  if($beschreibung ==""){
			$beschreibung="Keine Beschreibung vorhanden!";
		}
    if($enddate == ""){$enddate="leer";}


  if($search_result->num_rows == 0 && $titel != ""){
 
		
		 $insert = $db->prepare("INSERT INTO task (titel, beschreibung, prio, enddate,status,tasklistid,creator) VALUES (?,?,?,?,?,?,?)");
         $insert->bind_param('sssssss',$titel,$beschreibung,$prio,$enddate,$status,$ID,$creator);
         $insert->execute();
		
		echo 1;
  }
  else{echo 0;}
	

?>

