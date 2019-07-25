<link rel="stylesheet" type="text/css" href="style_taskview.css">

<h1> Erledigte Aufgaben</h1>
<?php
	SESSION_START();
	require_once("dbutil.class.php");
	
	
	$creator = $_SESSION['name'];
	
	$nametasklist = trim($_SESSION['tasklistenname']);
	$ID = DBUtil::searchTasklistId($nametasklist,$creator);
    
	$logins = DBUtil::getTask($ID);
	

	foreach($logins as $login){
		$Taskid = $login->id;
		$nameTask = $login->titel;
		$beschreibungTask = $login->beschreibung;
		$prioTask = $login->prio;
		$enddatumTask = $login->enddate;
		$statusTask = $login->status;
	    
		if($prioTask == 1)
			$prioTask = "unwichtig" ;
		if($prioTask == 2)
			$prioTask = "weniger wichtig" ;
		if($prioTask == 3)
			$prioTask = "bedingt wichtig" ;
		if($prioTask == 4)
			$prioTask = "wichtig" ;
		if($prioTask == 5)
			$prioTask = "sehr wichtig" ;
	  $taskdate =$login->enddate;
		
	
		
		if($statusTask == "verspaeteterledigt"){
			$statusTask="verspätet erledigt";
		}
		
		if($taskdate == "leer"){
			$taskdate="";
		}
		if($statusTask == "erledigt" || $statusTask == "verspätet erledigt"){
           
            echo '<div class = "task">
		          <div class="tasktitel"><h2 class="tasktitelname">' .$nameTask. ' </h2></div>
				    <div class="taskstreifen"></div>
				  <div class="taskbeschreibung"> <p class="Footertitel">BESCHREIBUNG:</p>' . $beschreibungTask. '</div>
				  <div class="taskfooter">
				    <div class="taskprio"><p class="Footertitel">PRIORITÄT:</p>'. $prioTask .'</div>
					<div class="taskdate"><p class="Footertitel">ENDDATUM:</p>'. $taskdate.'</div>
		            <div class="taskstatus"><p class="Footertitel">STATUS:</p>'. $statusTask .'</div>
			
				  </div>
				  
				</div>';
	}	
		
	}
?>
<div class="addtaskbtn">
 <input type="button" id="opentask" value="Offene Aufgaben" >
</div>
<button class="Platzhalter"></button>

<script type="text/javascript">
	jQuery(function(){
		
		jQuery('#opentask').click(function(){
			jQuery('main').load('tasklist1.php');
			jQuery('footer').load('footer2.php');
		});
		
	});
</script>