<?php include '../config.php';?>
<?php
		if(isset($_SESSION['student'])){
			session_destroy();
			header('Location: ../index.html');
		}
?>