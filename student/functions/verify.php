<?php include '../config.php';?>
<?php
	mysql_query("select username from raccounts where username='".filt($_GET['username'])."' and type='Student' and status='1'");
	$_SESSION['student'] = $_GET['verify'];
	header("Location:../grades");
?>