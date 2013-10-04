<?php include '../../../../../table.class.php' ?>
<?php include '../../../../../csv.class.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	
	$csv = new CSV();
	$classLoadStudents = $csv->open('../files/'.$_SESSION['faculty'].'-students.csv');

	
	function studentAlready($student,$class){
		$qry = mysql_query("select * from rclass where student='$student' and class='$class'");
		if(mysql_num_rows($qry)>0){
			return true;
		}
	}
	
	function isStudent($student){
		$qry = mysql_query("select student from rstudents where student='$student'");
		if(mysql_num_rows($qry)>0){
			return true;
		}
	}
	
	function isNeed($student,$class){
		$subject = mysql_query("select subject from rsubjects where course='".student($student,'course')."' and curriculum='".student($student,'curriculum')."' and subject='".classe($class,'subject')."'");
		if(mysql_num_rows($subject)>0){
			return true;
		}
	}
	
	if($classLoadStudents['cols']==2){
		mysql_query("delete from rclassstudents where class='".filt($_POST['classcode'])."' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."'");
		mysql_query("delete from rgrades where class='".filt($_POST['classcode'])."' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."'");
		foreach($classLoadStudents['rows'] as $i){
			if(is_numeric($i[0]) and isStudent($i[0]) and isNeed($i[0],$_POST['classcode']) and !studentAlready($i[0],$_POST['classcode'])){
				mysql_query("insert into rclassstudents(student,class,ay,sem,instr) values('".$i[0]."','".$_POST['classcode']."','".enlistment('ay')."','".sem('1',enlistment('sem'))."','".$_SESSION['faculty']."')");
			}
		}
	}
	
	unlink('../files/'.$_SESSION['faculty'].'-students.csv');

?>