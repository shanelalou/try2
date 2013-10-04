<?php include '../../../../../../config.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	$json = null;


	$qry = mysql_query("SELECT  a.class_code,b.subject_code,b.day,b.start_time,b.end_time,b.room
						FROM class_schedule_student as a INNER JOIN class_schedule as b using (class_code)
						WHERE a.student_number='".filt($_GET['student'])."' and b.academicyear='".enlistment('academicyear')."' and b.semester='".enlistment('semester')."'");

	while($r=mysql_fetch_array($qry)){
			$json .= "	{id:'',cell:['".$r[0]."','".$r[1]."','".subj($r[1],'subject_title')."','".subj($r[1],'units')."','".subj($r[1],'lab')."','".$r[2]."','".$r[3]." - ".$r[4]."','".$r[5]."']},\n";
	}	
	
			

	
	echo "{total: ".mysql_num_rows($qry)." ,rows:[\n";
		echo $json;
	echo "]}\n";

?>
