<link rel="stylesheet" type="text/css" href="styleList6.css">

<script type="text/javascript">
	jQuery(function(){
		jQuery('#submitbtn2').click(function(){
			jQuery.post(
				'handle_addlist.php',
				jQuery('#anmeldedaten2').serialize(),
				function(data){
					if(data == 1) {
						jQuery('main').load('addList.php');
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
<script type="text/javascript">
	jQuery(function(){
		jQuery('#submitbtn5').click(function(){
			jQuery.post(
				'handle_taskfilter.php',
				jQuery('#anmeldedaten2').serialize(),
				function(data){
					if(data == 1) {
						jQuery('main').load('taskfilter.php');
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


<script type="text/javascript">
	jQuery(function(){
		jQuery('.submitbtn4').click(function(){
			
			var title= jQuery(this).attr('id');
			$.ajax({
    url:"handle_tasklist.php",
    type: "POST", 
	data: {taskname : title},
    success:function(){
    jQuery('main').load('tasklist1.php');
	jQuery('footer').load('footer2.php');
    }
  });
		
			
		});
		
	});
</script>

<script type="text/javascript">
	jQuery(function(){
		
		jQuery('.loeschenbtn').click(function(){
			var id = jQuery(this).attr('id');
			jQuery.post(
				'handle_deleteList.php?',
				{ id: id
				},
				function(data){
					jQuery('main').load('addList.php');
				},
				'html'
			);
		});
		
	});
</script>	



<?php

	
	require_once("dbutil.class.php");
    
	$logins = DBUtil::getTasklists();
	
	if($logins == "Fehler" || $_SESSION['name'] == ''){
		echo 'Melden Sie sich an um Ihre Listen zu sehen';
	}
else{
	foreach($logins as $login){
		$nameTasklist = $login->name;
		$idTasklist = $login->id;
	    
echo  '

<div class="taskliste">
  <div class="tasklistheader">
    <h2 class="tasklisttitle">'.$nameTasklist.'</h2>
  </div>
  <div class="streifen"></div>
  <div class="tasklistfooter">
    <button  class="submitbtn4" type="button"  id="' .$nameTasklist. '">Taskliste ansehen</button>
	<button  id="' .$idTasklist. '" class="loeschenbtn" type="button" >Löschen</button>
  </div>
</div>';			
}
echo'<div class="taskliste">
  <div class="tasklistheader2">
    
		<h2 class="tasklisttitle">Neue Liste erstellen</h2>
		
		
  </div>
  <div class="streifen2"></div>
  <div class="tasklistfooter">
  <form id="anmeldedaten2" action="handle_addlist.php">
  <input type="text" name="tasklistname" id="tasklistname2" ><br>
    <input id="submitbtn2" type="button" value="+" >
	</form>
  </div>
</div>';

};
?>




<div id="listwriteerror" class="error"></div>
