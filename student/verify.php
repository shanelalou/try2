<?php include '../config.php';?>
<?php
	mysql_query("update account set status='1' where verification_code='".filt($_GET['code'])."' and username='".filt($_GET['verify'])."'");
	$_SESSION['student'] = $_GET['verify'];
	header("Location:../student");
?>