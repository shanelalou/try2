<?php include '../../../../config.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	$student = filt($_POST['student']);
	$subjects = explode(',',substr($_POST['subjects'],0,-1));
	$notes = filt($_POST['notes']);
	foreach($subjects as $i){
		mysql_query("update renlistments set status='Disapproved',notes='$notes' where student='$student' and course_code='".$i."' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."'");
	}
?>