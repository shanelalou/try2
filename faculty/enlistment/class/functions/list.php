<?php include '../../../../config.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	$json = "";
	
	function Subjects($a,$b,$c,$d){
		$qry = mysql_query("SELECT * FROM class_schedule WHERE curriculum='$a' and course='$b' and year='$c' and block='$d'");
		return mysql_num_rows($qry);
	}
	
	function Students($a,$b,$c,$d){
		$qry = mysql_query("SELECT a.student_number from class_schedule_student as a inner join class_schedule as b using (class_code)  
							WHERE b.curriculum='$a' and b.course='$b' and b.year='$c' and b.block='$d' and b.academicyear='".enlistment('academicyear')."' and b.semester='".enlistment('semester')."' GROUP BY a.student_number");
		return mysql_num_rows($qry);
	}
	
	$qry = mysql_query("SELECT a.curriculum,a.course,a.year,a.block ,a.time, a.academicyear, a.semester
						FROM class_schedule as a
						WHERE a.academicyear='".enlistment('academicyear')."' and a.semester='".enlistment('semester')."' 
						GROUP BY a.curriculum,a.course,a.year,a.block
						ORDER BY a.course asc,a.year asc,a.block asc");
	
	while($r=mysql_fetch_array($qry)){
		$json.="{cell:['".$r[1]."','".$r[2]." - ".$r[3]."','".$r[4]."','".Subjects($r[0],$r[1],$r[2],$r[3])."','".Students($r[0],$r[1],$r[2],$r[3])."']},\n";
	}
	
	echo "{total: ".mysql_num_rows($qry).", rows: [\n";
		echo $json;
	echo "]}";
?>