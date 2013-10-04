<?php include '../../../../../table.class.php' ?>
<?php include '../../../../../csv.class.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	$json = null;
	
	$csv = new CSV();
	$classLoadStudents = $csv->open('../files/'.$_SESSION['faculty'].'-students.csv');
	$rows = 0;

	function studentAlready($student,$class){
		$qry = mysql_query("select * from rclassstudents where student='$student' and class='$class' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."'");
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
		foreach($classLoadStudents['rows'] as $i){
			if(!isStudent($i[0])){ $status= 'Student is not in the master list.'; }
			elseif(studentAlready($i[0],$_GET['class'])) { $status = 'Student is already added in this class.'; }
			elseif(!isNeed($i[0],$_GET['class'])) { $status = 'Subject is not in the curriculum of the student.'; }
			else { $status = 'OK'; }
			
			if(is_numeric($i[0])){
				$json .= "{ cell: ['".$i[0]."','".student($i[0],'lastname')."','".student($i[0],'firstname')."','".student($i[0],'middlename')."','".student($i[0],'course')."','".student($i[0],'year')."','$status']},\n";
				$rows +=1;
			}
			
		}
	}
	
	echo "{total: ".$rows.",rows:[\n";
		echo $json;
	echo "]}";
?>