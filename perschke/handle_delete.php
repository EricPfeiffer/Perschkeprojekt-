<?php
require_once("dbutil.class.php");

if(isset($_POST['id']) && !empty($_POST['id'])){

		DBUtil::deleteTask($_POST['id']);
}

?>
