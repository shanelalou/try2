<?php include '../../../../config.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	
	$student = filt($_POST['student']);
	$reason = filt($_POST['reason']);
	$subjects = explode(',',substr($_POST['subjects'],0,-1));
	
	foreach($subjects as $i){
		mysql_query("insert into renlistments(student,course_code,curriculum,course,ay,sem,time,enlistment_date,status,notes) 
							values('$student','$i','".student($student,'curriculum')."','".student($student,'course')."','".enlistment('ay')."','".sem('1',enlistment('sem'))."','".enlistment_status($student,'time')."','".enlistment_status($student,'enlistment_date')."','Approved','$reason')");
	}
?>