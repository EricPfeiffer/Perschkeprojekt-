<link rel="stylesheet" type="text/css" href="styleFilter.css">
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, x1, y1, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("TaskTable");
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
	   if(x.innerHTML==""){
	x.innerHTML="leer";}
		
       if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase() ){
			
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
  table = document.getElementById("TaskTable");
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
function searchStatus() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchForStatus");
  filter = input.value.toUpperCase();
  table = document.getElementById("TaskTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
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


function test() {
	jQuery('main').load('highprioTask.php');
}
</script>


<h1>Liste</h1>

<input type="text" id="searchForTitle" onkeyup="searchTitle()" placeholder="Suche nach Titel.." title="Type in a name">
<input type="text" id="searchForStatus" onkeyup="searchStatus()" placeholder="Suche nach Status.." title="Type in a name">

<button type="button" id="mostImportant" onclick="test()" class="mostImportant">Nach Wichtigkeit sortieren</button>

<table   id="TaskTable">
	<tr class="taskheader">
		<th onclick="sortTable(0)" >Titel</th>
		<th onclick="sortTable(1)">Beschreibung</th>
		<th onclick="sortTable(2)">Prio</th>
		<th onclick="sortTable(3)" >Enddatum</th>
		<th onclick="sortTable(4)">Status</th>
		<th onclick="sortTable(5)" >Taskliste</th>
	</tr>

<?php
	require_once("dbutil.class.php");

$tasks = DBUtil::getAllTasks();

	foreach($tasks as $task){
		
			$prioTask =  $task->prio;
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
		
		$taskdate =$task->enddate;
		
		if($taskdate == "leer"){
			$taskdate="";
		}
		$taskstatus =$task->status;
		if($taskstatus == "inBearbeitung"){
			$taskstatus="in Bearbeitung";
		}
		if($taskstatus == "verspaeteterledigt"){
			$taskstatus="verspätet erledigt";
		}
		
		
	$tasklistid = 	$task->tasklistid;
	$tasklistname= DBUtil::searchTasklistName($tasklistid);
		
		
		echo "<tr class='tableinhalt' >";
		echo "  <td data-label='Titel: ' >" . $task->titel . "</td>";
		echo "  <td data-label='Beschreibung:'>" . $task->beschreibung. "</td>";
		echo "  <td data-label='Prio: '>" . $prioTask ."</td>";
		echo "  <td data-label='Enddatum: '>" . $taskdate ."</td>";
		echo "  <td data-label='Status: '>" . $taskstatus. "</td>";
		echo "  <td data-label='Taskliste: '>" . $tasklistname. "</td>";
		echo "</tr>";
			
	}
?>

</table>
<button class="Platzhalter"></button>