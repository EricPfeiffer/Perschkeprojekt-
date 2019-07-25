
<link rel="stylesheet" type="text/css" href="stylefooter5.css">
<script type="text/javascript">
	jQuery(function(){
		jQuery('#addtask2').click(function(){
			jQuery('main').load('addtask.php');
			
		});
		jQuery('#closedtask2').click(function(){
			jQuery('main').load('closedtask.php');
			jQuery('footer').load('footer3.php');
			
		});
		
	});
</script>
<button id="closedtask2">Fertige Aufgaben</button>

<button id="addtask2">Neue Aufgabe</button>
