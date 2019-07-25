<link rel="stylesheet" type="text/css" href="styleNoFooter.css">
<script type="text/javascript">
	jQuery(function(){
		jQuery('#submitbtn420').click(function(){
			jQuery.post(
				'handle_edittask.php',
				jQuery('#anmeldedaten3').serialize(),
				function(data){
					if(data == 1) {
						jQuery('main').load('tasklist1.php');
					} else {
						jQuery('#listwriteerror').empty();
						jQuery('#listwriteerror').append("Fehler bei der Taskerstellung. Versuchen Sie es noch einmal.");
					}
				},
				'html'
			);
			
		});
		
	});
</script>




<?php 
require_once("dbutil.class.php");
SESSION_START();
$TaskID = $_SESSION['taskid'];

$login = DBUtil::getTaskEdit($TaskID);




	
		$Taskid = $login->id;
		$nameTask = $login->titel;
		$beschreibungTask = $login->beschreibung;
		$prioTask = $login->prio;
		$enddatumTask = $login->enddate;
		$statusTask = $login->status;
		






echo '<div class="inhalt">

	
	<form id="anmeldedaten3" action="handle_addtask.php" accept-charset="utf-8">
		<br>
		<div class="input-group">
        <div id="loginheader">
		<h2 id="logintitle">Aufgabe bearbeiten</h2>
		</div>
		<div id="loginbody"><br><br>
		<input type="text" required="" name="titel" id="inputField" value="' . $nameTask . '" size="30"><br>
		<label alt="Titel" placeholder="Titel"></label>
		
		<input type="text" required="" name="beschreibung" id="inputField" value="' . $beschreibungTask . '" size="30"><br>
		<label alt="Beschreibung" placeholder="Beschreibung"></label>
		
		Prio:<br>';
		
		
		if ($prioTask == 1){
			echo '<select name="prio" id="prio" >
			<option value="1" selected>unwichtig</option>
             <option value="2">weniger wichtig</option>
             <option value="3">bedingt wichtig</option>
             <option value="4">wichtig</option>
		<option value="5">sehr wichtig</option>    </select><br>';};
		
		
		if ($prioTask == 2){
			echo '<select name="prio" id="prio" >
			<option value="1" >unwichtig</option>
             <option value="2" selected>weniger wichtig</option>
             <option value="3">bedingt wichtig</option>
             <option value="4">wichtig</option>
		<option value="5">sehr wichtig</option>    </select><br>';};
		
		if ($prioTask == 3){
             echo '<select name="prio" id="prio" >
			<option value="1" >unwichtig</option>
             <option value="2" >weniger wichtig</option>
             <option value="3" selected>bedingt wichtig</option>
             <option value="4">wichtig</option>
		<option value="5">sehr wichtig</option>    </select><br>';};
		
		
		if ($prioTask == 4){
              echo '<select name="prio" id="prio" >
			<option value="1" >unwichtig</option>
             <option value="2" >weniger wichtig</option>
             <option value="3" >bedingt wichtig</option>
             <option value="4" selected>wichtig</option>
		<option value="5">sehr wichtig</option></select><br>';};
		
		if ($prioTask == 5){
              echo '<select name="prio" id="prio" >
			<option value="1" >unwichtig</option>
             <option value="2" >weniger wichtig</option>
             <option value="3" >bedingt wichtig</option>
             <option value="4" >wichtig</option>
		<option value="5" selected>sehr wichtig</option>
        </select><br>';};
		
		if($enddatumTask=="leer"){
		echo 'End Zeitpunkt:<br>
		
		<input type="date" name="date" value="" id="date" size="30"><br>
		Status:<BR>';}
		
		if($enddatumTask!="leer"){
		echo 'End Zeitpunkt:<br>
		
		<input type="date" name="date" value="'.$enddatumTask.'" id="date" size="30"><br>
		Status:<BR>';}
		
		if ($statusTask == "offen"){
              echo '<select name="status" id="status">
             <option value="offen" selected>offen</option>
             <option value="inBearbeitung">in Bearbeitung</option>
             <option value="erledigt">erledigt</option>
             <option value="verspaeteterledigt">verspätet erledigt</option>
			 <option value="abgebrochen">abgebrochen</option>
        </select><BR>';};
		if ($statusTask == "inBearbeitung"){
              echo '<select name="status" id="status">
             <option value="offen">offen</option>
             <option value="inBearbeitung" selected>in Bearbeitung</option>
             <option value="erledigt">erledigt</option>
             <option value="verspaeteterledigt">verspätet erledigt</option>
			 <option value="abgebrochen">abgebrochen</option>
        </select><BR>';};
		if ($statusTask == "erledigt"  ){
              echo '<select name="status" id="status">
             <option value="offen">offen</option>
             <option value="inBearbeitung">in Bearbeitung</option>
             <option value="erledigt" selected>erledigt</option>
             <option value="verspaeteterledigt">verspätet erledigt</option>
			 <option value="abgebrochen">abgebrochen</option>
        </select><BR>';};
		if ($statusTask == "verspäteterledigt"){
              echo '<select name="status" id="status">
             <option value="offen">offen</option>
             <option value="inBearbeitung">in Bearbeitung</option>
             <option value="erledigt">erledigt</option>
             <option value="verspaeteterledigt" selected>verspätet erledigt</option>
			 <option value="abgebrochen">abgebrochen</option>
        </select><BR>';};
		if ($statusTask == "abgebrochen"){
              echo '<select name="status" id="status">
             <option value="offen">offen</option>
             <option value="inBearbeitung">in Bearbeitung</option>
             <option value="erledigt">erledigt</option>
             <option value="verspaeteterledigt">verspätet erledigt</option>
			 <option value="abgebrochen" selected>abgebrochen</option>
        </select><BR>';};
		
		echo'
		<input id="submitbtn420" type="button" value="Aufgabe aktualisieren" style="margin-top:20px">

	</form>
	
	<div id="listwriteerror" class="error"></div>


</div>';
	

?>
