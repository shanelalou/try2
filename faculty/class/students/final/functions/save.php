<?php include '../../../../../table.class.php' ?>
<?php include '../../../../../csv.class.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	$json = null;
	
	$csv = new CSV();
	$prelimGrade = $csv->open('../files/'.$_SESSION['faculty'].'-final.csv');
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
	
	function rowExist($student,$class){
		$qry = mysql_query("select student from rgrades where student='$student' and class='".$_GET['class']."' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."'");
		if(mysql_num_rows($qry)>0){
			return true;
		}
	}

	if($prelimGrade['cols']==4){
		foreach($prelimGrade['rows'] as $i){
			if(is_numeric($i[0]) and isStudent($i[0]) and isStudentInClass($i[0])){
				$json .= "{ cell: ['".$i[0]."','".student($i[0],'lastname').', '.student($i[0],'firstname').' '.student($i[0],'middlename')."','".$i[2]."','".$i[3]."','$status']},\n";
				if(rowExist($i[0],$_GET['class'])){
					mysql_query("update rgrades set final='".$i[2]."',f_absent='".$i[3]."' where student='".$i[0]."' and class='".$_GET['class']."' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."'");
				}else{
					mysql_query("insert into rgrades(student,class,subject,ay,sem,final,f_absent) values('".filt($i[0])."','".filt($_GET['class'])."','".classe($_GET['class'],'subject')."','".enlistment('ay')."','".sem('1',enlistment('sem'))."','".$i[2]."','".$i[3]."')");
				}
			}
			
		}
	}

	unlink('../files/'.$_SESSION['faculty'].'-final.csv');
	
?>