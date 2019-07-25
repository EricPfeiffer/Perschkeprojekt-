<link rel="stylesheet" type="text/css" href="styleNoFooter.css">

<script type="text/javascript">
	jQuery(function(){
		jQuery('#submitbtn3').click(function(){
			jQuery.post(
				'handle_addtask.php',
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


<form id="anmeldedaten3" action="handle_addtask.php" accept-charset="utf-8">
	<br>
		<div class="input-group">
        <div id="loginheader">
		<h2 id="logintitle">Neue Aufgabe erstellen</h2>
		</div>
		<div id="loginbody"><br><br>
		<input type="text" required='' name="titel" id="inputField">
		<label alt='Titel' placeholder='Titel'></label>
		
		<input type="text" required='' name="beschreibung" id="inputField">
		<label alt='Beschreibung' placeholder='Beschreibung'></label>
	
	
		
		Prio:<br>
		<select name="prio" id="prio">
             <option value="1">unwichtig</option>
             <option value="2">weniger wichtig</option>
             <option value="3">bedingt wichtig</option>
             <option value="4">wichtig</option>
			 <option value="5">sehr wichtig</option>
        </select><br>
		
		
		End Zeitpunkt:<br>
		<input type="date" name="date" id="date" size="30"><br>
		Status:<BR>
		<select name="status" id="status">
             <option value="offen">offen</option>
             <option value="inBearbeitung">in Bearbeitung</option>
             <option value="erledigt">erledigt</option>
             <option value="verspaeteterledigt">verspätet erledigt</option>
			 <option value="abgebrochen">abgebrochen</option>
        </select><BR>
		
	<input id="submitbtn3" type="button" value="Task erstellen" style="margin-top:20px">
	</form>
	


	
	<div id="listwriteerror" class="error"></div>



	