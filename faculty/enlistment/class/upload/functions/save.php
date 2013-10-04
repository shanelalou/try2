<?php include '../../../../../config.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	$json = null;
	$file=fopen("../files/students.csv","r");
	$row = 0;
	function isCourse($a){
		$qry = mysql_query("select * from subject where course='".filt($a)."'");
		if(mysql_num_rows($qry)>0){
			return true;
		}
	}
	
	function isCurriculum($a){
		$qry = mysql_query("select * from subject where curriculum='".filt($a)."'");
		if(mysql_num_rows($qry)>0){
			return true;
		}
	}
	
	function isSubject($a){
		$qry = mysql_query("select * from subject where subject_code='".filt($a)."'");
		if(mysql_num_rows($qry)>0){
			return true;
		}
	}
	
	mysql_query("delete from class_schedule where academicyear='".enlistment('academicyear')."' and semester='".enlistment('semester')."'");
	
	while($r=fgetcsv($file,1000,",")){
		if(isCourse($r[0]) and isCurriculum($r[1]) and isSubject($r[5]) and $r[0] != "" and $r[1] != "" and $r[2] != "" and $r[3] != "" and $r[4] != "" and $r[5] != "" and $r[6] != "" and $r[7] != "" and $r[8] != "" and $r[9] != "" and $r[10] != "" and $r[11] != ""){
			mysql_query("insert into class_schedule(course,curriculum,year,block,time,class_code,subject_code,day,start_time,end_time,room,instructor_code,academicyear,semester) 
						values('".$r[0]."','".$r[1]."','".$r[2]."','".$r[3]."','".$r[11]."','".$r[4]."','".$r[5]."','".$r[6]."','".$r[7]."','".$r[8]."','".$r[9]."','".$r[10]."','".enlistment('academicyear')."','".enlistment('semester')."')");
			$json .= "	{id:'".$r[0]."',cell:['".$r[0]."','".$r[1]."','".$r[2]."','".$r[3]."','".$r[4]."','".$r[5]."','".$r[6]."','".$r[7]."','".$r[8]."','".$r[9]."','".$r[10]."','".$r[11]."']},\n";
			$row +=1;
		}
	}
	
	echo "{total: ".$row." ,rows:[\n";
		echo $json;
	echo "]}\n";
	
	fclose($file);
	unlink("../files/students.csv");
?>
