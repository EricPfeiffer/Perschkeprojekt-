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
<button class="btnfilter" onclick="sortTable(0)">Titel</button>
<button class="btnfilter" onclick="sortTable(1)">Beschreibung</button>
<button class="btnfilter" onclick="sortTable(2)">Prio</button>
<button class="btnfilter" onclick="sortTable(3)">Enddatum</button>
<button class="btnfilter" onclick="sortTable(4)">Status</button>
<button class="btnfilter" onclick="sortTable(5)">Taskliste</button>