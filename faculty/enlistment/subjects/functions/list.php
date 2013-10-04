<?php include '../../../../config.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	$rows = 0;
	
	function Approved($a){
		$qry = mysql_query("select * from renlistments where course_code='$a' and course='".filt($_GET['course'])."' and curriculum='".$_GET['curriculum']."' and status='Approved'");
		//$qry = mysql_query("select * from enlistment where subject_code='$a'");
		return mysql_num_rows($qry);
	}
	
	function Morning($a){
		$qry = mysql_query("select * from renlistments where course_code='$a' and course='".filt($_GET['course'])."' and curriculum='".$_GET['curriculum']."' and status='Approved' and time='MORNING'");
		//$qry = mysql_query("select * from enlistment where subject_code='$a'");
		return mysql_num_rows($qry);
	}
	
	function Afternoon($a){
		$qry = mysql_query("select * from renlistments where course_code='$a' and course='".filt($_GET['course'])."' and curriculum='".$_GET['curriculum']."' and status='Approved' and time='AFTERNOON'");
		//$qry = mysql_query("select * from enlistment where subject_code='$a'");
		return mysql_num_rows($qry);
	}
	function Evening($a){
		$qry = mysql_query("select * from renlistments where course_code='$a' and course='".filt($_GET['course'])."' and curriculum='".$_GET['curriculum']."' and status='Approved' and time='EVENING'");
		//$qry = mysql_query("select * from enlistment where subject_code='$a'");
		return mysql_num_rows($qry);
	}
	
	function Subjects($yr,$sem){
		$json = null;
		if($_POST['query']==""){
			$query = "";
		}else{
			$query = "(subject like '%".$_POST['query']."%' or title like '%".$_POST['query']."%') and";
		}
		$qry = mysql_query("select subject,title,lec,lab,prereq,year,sem
							from rsubjects 
							where ".$query." year='$yr' and sem='$sem' and curriculum='".filt($_GET['curriculum'])."' and course='".filt($_GET['course'])."'") or die(mysql_error());
		
		
		while($r=mysql_fetch_array($qry)){
			$json .= "	{id:'".$r[0]."',cell:['".$r[0]."','".$r[1]."','".$r[2]."','".$r[3]."','".$r[4]."','".$r[5]."','".$r[6]."','".Approved($r[0])."','".Morning($r[0])."','".Afternoon($r[0])."','".Evening($r[0])."']},\n";
		}
		
		if($_POST['query']==""){
			$json = "{id:'',cell:['','".strtoupper(switch_year($yr))." ".strtoupper(sem('first semester',$sem))."','','','','','','','','','']},\n" . $json ."{id:'',cell:['','','','','','','','','','','']},\n";
		}
		return $json;
	}
	
	function Total($yr,$sem){
		$json = null;
		if($_POST['query']==""){
			$query = "";
		}else{
			$query = "(subject like '%".$_POST['query']."%' or title like '%".$_POST['query']."%') and";
		}
		$qry = mysql_query("select subject,title,lec,lab,prereq,year,sem
							from rsubjects 
							where ".$query." year='$yr' and sem='$sem' and curriculum='".filt($_GET['curriculum'])."' and course='".filt($_GET['course'])."'") or die(mysql_error());
		
		
		return mysql_num_rows($qry);
	}
	
	$total = Total('1st','1st') + Total('1st','2nd') + Total('1st','summer') + Total('2nd','1st') + Total('2nd','2nd') + Total('3rd','1st') + Total('3rd','2nd') + Total('3rd','summer') + Total('4th','1st') + Total('4th','2nd');
	
	echo "{total: '".$total."',rows:[\n";
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
	echo "]}\n";
?>