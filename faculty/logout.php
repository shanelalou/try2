<?php include '../config.php';?>
<?php
		if(isset($_SESSION['faculty'])){
			session_destroy();
			header('Location: ../faculty');
		}
?>