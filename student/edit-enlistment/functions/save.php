<?php include '../../../config.php' ?>
<?php
	$student = filt($_SESSION['student']);
	$subjects = explode(',',substr($_POST['subjects'],0,-1));
	$curriculum = filt(student($_SESSION['student'],'curriculum'));
	$course = filt(student($_SESSION['student'],'course'));
	$year = filt(switch_year(student($_SESSION['student'],'year')));
	$academicyear = filt(enlistment('ay'));
	$semester = filt(sem('1',enlistment('sem')));
	$time = filt($_POST['time']);
	$status = "Pending";

	
	mysql_query("update renlistments set time='$time' where student='$student' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."' and status='Approved'");
	mysql_query("delete from renlistments where student='$student' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."' and status!='Approved'");
	foreach($subjects as $subject){
		mysql_query("insert into renlistments(student,course_code,curriculum,course,year,ay,sem,time,status)
					values('$student','$subject','$curriculum','$course','$year','$academicyear','$semester','$time','$status')
		") or die(mysql_error());
	}
	
	mysql_query("update rstudents set status='$status' where student='$student'")
?>
