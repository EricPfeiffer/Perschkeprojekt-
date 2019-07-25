<?php
require_once("dbutil.class.php");

if(isset($_POST['id']) && !empty($_POST['id'])){

		DBUtil::deleteTasklist($_POST['id']);
		
		DBUtil::deleteTasklistEntry($_POST['id']);
}

?>