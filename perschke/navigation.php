<?php
  session_start();
?>
<div class="menu">
<button id="seite1" class="active" name="seite1">Startseite</button>

      <?php if(!isset($_SESSION['login']) || $_SESSION['login'] == 0) { ?>
<button id="seite5" name="seite5">Sign Up</button>
<button id="seite2" name="seite2">Login</button>

      <?php } else { ?>
<button id="seite3" name="seite3">Alle Tasks</button>
<button id="seite4" name="seite4">Abmelden</button>
<button id="seite6" name="seite6">Auswertung</button>
      <?php } ?>

</div>

   
