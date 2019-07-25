<?php
require_once("dbutil.class.php");
	session_start();

		$db = new mysqli('localhost','root','','perschkeprojekt');
	if($db->connect_error):
  echo $db->connect_error;
endif;
  $nametasklist = trim($_SESSION['tasklistenname']); 
  $datum = date("Y-m-d");
  $taskid = $_SESSION['taskid'];
  $titel = $_POST['titel'];
  $beschreibung =$_POST['beschreibung'];
  $status = $_POST['status'];
  $prio = $_POST['prio'];
  $enddate =$_POST['date'];
  $creator = $_SESSION['name'];

  if($datum == $enddate && $enddate!=""){
  $nextDay = strtotime("+1 day", strtotime($enddate)); 
  $nextDay2= date("Y-m-d", $nextDay); }
  else{$nextDay2=$enddate;}
  
  
   $ID = DBUtil::searchTasklistId($nametasklist,$creator);
    if($enddate == ""){$enddate="leer";}
	
	
   if($datum>$nextDay2 && $status == 'erledigt' && $enddate!="leer"){
		  $status = 'verspaeteterledigt';
		}
		else{
			  $status = $_POST['status'];
		}
  
  $search_user = $db->prepare("SELECT id FROM task WHERE titel = ? AND tasklistid = ? AND id NOT LIKE ?");
  $search_user->bind_param('sss',$titel,$ID,$taskid);
  $search_user->execute();
  $search_result = $search_user->get_result();
  

if($search_result->num_rows == 0 && $titel != ""){
 DBUtil::editTask($taskid,$titel,$beschreibung,$prio,$enddate,$status);
	echo 1;
}
  

		
	
 
	

?>

 