<?php include '../../../../../config.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	$json = null;

	function Students($a){
		$qry = mysql_query("select * from class_schedule_student where  class_code='$a' and academicyear='".enlistment('academicyear')."' and semester='".enlistment('semester')."'");
		return mysql_num_rows($qry);
	}
	
	$qry = mysql_query("
		select class_code,subject_code,day,start_time,end_time,room,instructor_code,time
		from class_schedule 
		where  course='".filt($_GET['course'])."' and year='".filt($_GET['year'])."' and block='".filt($_GET['block'])."' and academicyear='".enlistment('academicyear')."' and semester='".enlistment('semester')."'");
	
	while($r=mysql_fetch_array($qry)){
		$json.="{cell:['".$r[0]."','".$r[1]."','".subj($r[1],'subject_title')."','".subj($r[1],'units')."','".subj($r[1],'lab')."','".$r[2]."','".$r[3]."','".$r[4]."','".$r[5]."','".$r[6]."','".strtoupper($r[7])."','".Students($r[0])."']},\n";
	}
	
	echo "{total: ".mysql_num_rows($qry)." ,rows:[\n";
		echo $json;
	echo "]}\n";

?>
