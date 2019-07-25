<link rel="stylesheet" type="text/css" href="style_taskview.css">
<script type="text/javascript">
	jQuery(function(){
		
		jQuery('.loeschenbtn').click(function(){
			var id = jQuery(this).attr('id');
			jQuery.post(
				'handle_delete.php?',
				{ id: id
				},
				function(data){
					jQuery('main').load('tasklist1.php');
				},
				'html'
			);
		});
		
	});
</script>	
<script type="text/javascript">
	jQuery(function(){
		
		jQuery('.editbtn').click(function(){
			var id = jQuery(this).attr('id');
			jQuery.post(
				'handle_edit.php?',
				{ id: id
				},
				function(data){
					jQuery('main').load('editTask.php');
				},
				'html'
			);
		});
		
	});
</script>	
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  dir= "asc"; 
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];

      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
     
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;      
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
<script>
function searchTitle() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchForTitle");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
<?php
	SESSION_START();
	
	echo '<div class="tasklisttitel"><h1>'
		.$_SESSION['tasklistenname'].'</h1></div>';
?>
<!----<input type="text" id="searchForTitle" onkeyup="searchTitle()" placeholder="Suche nach Titel.." title="Type in a name">---->

<!---<table id="myTable">
	<tr>
		<th onclick="sortTable(0)">Titel</th>
		<th onclick="sortTable(1)">Beschreibung</th>
		<th onclick="sortTable(2)">Prio</th>
		<th onclick="sortTable(3)">Enddatum</th>
		<th onclick="sortTable(4)">Status</th>
	</tr>--->


<?php
	
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
		
		if($taskdate == "leer"){
			$taskdate="";
		}
	  
		if($statusTask != "erledigt" && $statusTask != "verspaeteterledigt"){
           
           echo '<div class = "task">
		          <div class="tasktitel"><h2 class="tasktitelname">' .$nameTask. '</h2> </div>
				  <div class="taskstreifen"></div>
				  <div class="taskbeschreibung"> <p class="Footertitel">BESCHREIBUNG</p>' . $beschreibungTask. '</div>
				  <div class="taskfooter">
				    <div class="taskprio"><p class="Footertitel">PRIORITÄT:</p>'. $prioTask .'</div>
					<div class="taskdate"><p class="Footertitel">ENDDATUM:</p>'. $taskdate .'</div>
		            <div class="taskstatus"><p class="Footertitel">STATUS:</p>'. $statusTask .'</div>
				  </div>
				  <div class="taskbtn">
				  <div class="edit"><button  id="' . $login->id . '" class="editbtn" type="button" ><i class="material-icons">create</i></button></div>
				  <div class="delete"><button  id="' . $login->id . '" class="loeschenbtn" type="button" ><i class="material-icons">delete_forever</i></button></div>
				  </div>
				</div>';
		    
		   
		   
			
	}
		

	}
?>


<div class="addtaskbtn">
 <input type="button" id="addtask" value="+" >
 <input type="button" id="closedtask" value="Erledigte Aufgaben" >
</div>


<script type="text/javascript">
	jQuery(function(){
		jQuery('#addtask').click(function(){
			jQuery('main').load('addtask.php');
			
		});
		jQuery('#closedtask').click(function(){
			jQuery('main').load('closedtask.php');
				jQuery('footer').load('footer3.php');
		});
		
	});
</script>
<button class="Platzhalter"></button>


