<?php include '../../../../config.php' ?>
<?php
	$file = fopen("../files/ENLISTMENT ".strtoupper(enlistment('semester'))." ".enlistment('academicyear').".csv",'w');
	$json = null;
	
	function Approved($a){
		$qry = mysql_query("select * from enlistment where course_code='$a' and course='".filt($_GET['course'])."' and curriculum='".$_GET['curriculum']."' and status='Approved'");
		return mysql_num_rows($qry);
	}
	
	function Morning($a){
		$qry = mysql_query("select * from enlistment where course_code='$a' and course='".filt($_GET['course'])."' and curriculum='".$_GET['curriculum']."' and status='Approved' and time='MORNING'");
		//$qry = mysql_query("select * from enlistment where subject_code='$a'");
		return mysql_num_rows($qry);
	}
	function Afternoon($a){
		$qry = mysql_query("select * from enlistment where course_code='$a' and course='".filt($_GET['course'])."' and curriculum='".$_GET['curriculum']."' and status='Approved' and time='AFTERNOON'");
		//$qry = mysql_query("select * from enlistment where subject_code='$a'");
		return mysql_num_rows($qry);
	}
	function Evening($a){
		$qry = mysql_query("select * from enlistment where course_code='$a' and course='".filt($_GET['course'])."' and curriculum='".$_GET['curriculum']."' and status='Approved' and time='EVENING'");
		//$qry = mysql_query("select * from enlistment where subject_code='$a'");
		return mysql_num_rows($qry);
	}	
	
	
	function Subjects($yr,$sem){
		global $json;

		$qry = mysql_query("select subject_code,subject_title,units,lab,prerequisite,year,semester
							from subject 
							where year='$yr' and semester='$sem' and curriculum='".filt($_GET['curriculum'])."' and course='".filt($_GET['course'])."'") or die(mysql_error());
		
		while($r=mysql_fetch_array($qry)){
			$json .= "\"".$r[0]."\",\"".$r[1]."\",\"".$r[2]."\",\"".$r[3]."\",\"".$r[4]."\",\"".$r[5]."\",\"".$r[6]."\",\"".Approved($r[0])."\",\"".Morning($r[0])."\",\"".Afternoon($r[0])."\",\"".Evening($r[0])."\"\n";
		}
	}
	
		$json .= "SUBJECT CODE,SUBJECT TITLE,UNITS,LAB,PREREQUISITE,YEAR,SEMESTER,STUDENTS,MORNING,AFTERNOON,EVENING\n";
		echo Subjects('1st','1st');
		echo Subjects('1st','2nd');
		echo Subjects('1st','summer');
		
		echo Subjects('2nd','1st');
		echo Subjects('2nd','2nd');
		
		echo Subjects('3rd','1st');
		echo Subjects('3rd','2nd');
		echo Subjects('3rd','summer');
		
		echo Subjects('4th','1st');
		echo Subjects('4th','2nd');
		
		fwrite($file,$json);
		fclose($file);
?>