<link rel="stylesheet" type="text/css" href="topprio2.css">

<h1>Ihre wichtigsten Aufgaben:</h1>
<script>
function back() {
	jQuery('main').load('taskfilter.php');
}

</script>

<?php

	require_once("dbutil.class.php");
	
	
	
   
	$logins = DBUtil::highPrio();
	$Zähler = 1;

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
		
		if($taskdate == "leer"){
			$taskdate="";
		}
		
           if($statusTask != "erledigt" && $statusTask != "verspaeteterledigt"){
            
			if($Zähler<=5){
			
			echo '
			
			<div class = "task">
			      <div class ="Reihenfolge"><h2>'.$Zähler.'.</h2></div>
		          <div class="tasktitel"><h2 class="tasktitelname">' .$nameTask. ' </h2></div>
				    <div class="taskstreifen"></div>
				  <div class="taskbeschreibung"> <p class="Footertitel">BESCHREIBUNG:</p>' . $beschreibungTask. '</div>
				  <div class="taskaside">
				    <div class="taskprio"><p class="Footertitel">PRIORITÄT:</p>'. $prioTask .'</div>
					<div class="taskdate"><p class="Footertitel">ENDDATUM:</p>'. $taskdate.'</div>
		            <div class="taskstatus"><p class="Footertitel">STATUS:</p>'. $statusTask .'</div>
			
				  </div>
				  
				</div>';
			$Zähler++;}
			
			else{echo '
			
			<div class = "task">
			      
		          <div class="tasktitel"><h2 class="tasktitelname">' .$nameTask. ' </h2></div>
				    <div class="taskstreifen"></div>
				  <div class="taskbeschreibung"> <p class="Footertitel">BESCHREIBUNG:</p>' . $beschreibungTask. '</div>
				  <div class="taskfooter">
				    <div class="taskprio"><p class="Footertitel">PRIORITÄT:</p>'. $prioTask .'</div>
					<div class="taskdate"><p class="Footertitel">ENDDATUM:</p>'. $taskdate.'</div>
		            <div class="taskstatus"><p class="Footertitel">STATUS:</p>'. $statusTask .'</div>
			
				  </div>
				  
				</div>';}
		   }
	}
?>
