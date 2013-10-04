<?php include '../../../../config.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	$student = $_POST['student'];
	$subjects = explode(',',substr($_POST['subjects'],0,-1));
	
	foreach($subjects as $i){
		mysql_query("update renlistments set status='Approved',notes='' where student='$student' and course_code='".$i."' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."'");
	}
?>