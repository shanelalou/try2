<?php include '../../../../../table.class.php' ?>
<?php include '../../../../../csv.class.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	$json = null;
	
	$csv = new CSV();
	$prelimGrade = $csv->open('../files/'.$_SESSION['faculty'].'-midterm.csv');
	$rows = 0;

	function isStudent($student){
		$qry = mysql_query("select student from rstudents where student='$student'");
		if(mysql_num_rows($qry)>0){
			return true;
		}
	}

	function isStudentInClass($student){
		$qry = mysql_query("select student from rclassstudents where student='$student' and class='".$_GET['class']."' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."'");
		if(mysql_num_rows($qry)>0){
			return true;
		}
	}

	if($prelimGrade['cols']==4){
		foreach($prelimGrade['rows'] as $i){
			if(!isStudent($i[0])){ $status= 'Student is not in the master list.'; }
			elseif(!isStudentInClass($i[0])){ $status= 'Student is not enrolled in this class.'; }
			else { $status = 'OK'; }
			
			if(is_numeric($i[0])){
				$json .= "{ cell: ['".$i[0]."','".student($i[0],'lastname').', '.student($i[0],'firstname').' '.student($i[0],'middlename')."','".$i[2]."','".$i[3]."','$status']},\n";
				$rows +=1;
			}
			
		}
	}

	echo "{total: ".$rows.", rows: [";
		echo $json;
	echo "]}";
	
?>