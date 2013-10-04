<?php include '../../../../table.class.php' ?>
<?php
	$students = explode(',',substr($_POST['students'],0,-1));
	$class = $_POST['classcode'];
	foreach($students as $student){
		mysql_query("delete from rclassstudents where student='$student' and class='$class' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."'");
		mysql_query("delete from rgrades where student='$student' and class='$class' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."'");
	}
	
?>
