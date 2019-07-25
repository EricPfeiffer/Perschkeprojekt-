
<link rel="stylesheet" type="text/css" href="stylefooter5.css">
<script type="text/javascript">
	jQuery(function(){
		jQuery('#addtask2').click(function(){
			jQuery('main').load('addtask.php');
			
		});
		jQuery('#closedtask2').click(function(){
			jQuery('main').load('tasklist1.php');
			jQuery('footer').load('footer2.php');
			
		});
		
	});
</script>
<button id="closedtask2">Offene Aufgaben</button>

<button id="addtask2">Neue Aufgabe</button>
