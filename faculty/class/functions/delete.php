<?php include '../../../table.class.php' ?>
<?php
	$ay = $_POST['ay'];
	$sem = $_POST['sem'];
	$classes = explode(",",substr($_POST['classes'],0,-1));
	
	//delete classes
	foreach($classes as $i){
		mysql_query("delete from rclass where class='$i' and ay='$ay' and sem='$sem'");
	}
	
	//delete students
		mysql_query("delete from rclassstudents where class='$i' and ay='$ay' and sem='$sem'");
	
	//delete grades
		mysql_query("delete from rgrades where class='$i' and ay='$ay' and sem='$sem'");
?>