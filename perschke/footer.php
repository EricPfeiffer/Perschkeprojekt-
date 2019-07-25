
<link rel="stylesheet" type="text/css" href="stylefooter5.css">


<script type="text/javascript">
	jQuery(function(){
		jQuery('#Seite7').click(function(){
			jQuery.post(
				'handle_addlist.php',
				jQuery('#anmeldedaten5').serialize(),
				function(data){
					if(data == 1) {
						jQuery('main').load('addList.php');
						jQuery('footer').load('footer.php');
					} 
					
					else {
					
				
						jQuery('#listwriteerror').empty();
						jQuery('#listwriteerror').append("Fehler bei der Listenerstellung. Versuchen Sie es noch einmal.");
					}
				},
				'html'
			);
			
		});
		
	});
</script>

<div class="footer">


    <?php
	require_once("dbutil.class.php");
	$logins = DBUtil::getTasklists();
	
	if($logins == "Fehler"){
		echo '<p id="warnung">Melden Sie sich an um Ihre Listen zu sehen<p>';
	}

      else{ if(isset($_SESSION['login']) || $_SESSION['login'] != 0) { ?>
	   <form id="anmeldedaten5" action="handle_addlist.php"><br>
	   <input type="text" required="" name="tasklistname"  class="tasklistname3" id="inputField" >
		<label alt='Titel ihrer neuen Taskliste' placeholder='Titel' id="placeholderfooter"></label>
    <input id="Seite7" type="button" value="+" >


  <?php 
  
  }} ?>
</div>

   