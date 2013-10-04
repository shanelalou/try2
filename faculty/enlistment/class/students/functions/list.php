<?php include '../../../../../config.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	$json = null;

	function Subjects($a,$b,$c,$d){
		$qry = mysql_query("SELECT a.student_number from class_schedule_student as a inner join class_schedule as b using (class_code)  
							WHERE b.course='$a' and b.year='$b' and b.block='$c' and a.student_number='$d' and b.academicyear='".enlistment('academicyear')."' and b.semester='".enlistment('semester')."'");
		return mysql_num_rows($qry);
	}
	
	
	$qry = mysql_query("SELECT a.student_number from class_schedule_student as a inner join class_schedule as b using (class_code)
						WHERE b.course='".filt($_GET['course'])."' and b.year='".filt($_GET['year'])."' and b.block='".filt($_GET['block'])."' and b.academicyear='".enlistment('academicyear')."' and b.semester='".enlistment('semester')."'
						GROUP BY a.student_number");

	while($r=mysql_fetch_array($qry)){
			$json .= "	{id:'',cell:['".$r[0]."','".student($r[0],'lastname')."','".student($r[0],'firstname')."','".student($r[0],'middlename')."','".student($r[0],'course')."','".student($r[0],'year')."','".Subjects($_GET['course'],$_GET['year'],$_GET['block'],$r[0])."']},\n";
	}	
	
			

	
	echo "{total: ".mysql_num_rows($qry)." ,rows:[\n";
		echo $json;
	echo "]}\n";

?>
