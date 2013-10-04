<?php include '../../../../config.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	
	$student = filt($_POST['student']);
	$subjects = explode(',',substr($_POST['subjects'],0,-1));
	
	foreach($subjects as $i){
		mysql_query("delete from renlistments where student='$student' and course_code='$i' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."'");
	}
?>