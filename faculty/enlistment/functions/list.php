<?php include '../../../config.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	$json = null;
	
	function Pending($a,$b){
		$qry = mysql_query("select * from renlistments where course='$a' and curriculum='$b' and status='Pending' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."' group by student");
		return mysql_num_rows($qry);
	}
	
	function Approved($a,$b){
		$qry = mysql_query("select * from renlistments where course='$a' and curriculum='$b' and status='Approved' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."' group by student");
		return mysql_num_rows($qry);
	}
	$pos = explode(' ',faculty($_SESSION['faculty'],'position'));
	$qry = mysql_query("select a.course,b.course_title,a.curriculum from rsubjects as a inner join rcourses as b on a.course=b.course where a.course='".$pos[0]."' group by a.course,a.curriculum") or die(mysql_error());
	
	$row = 0;
	while($r=mysql_fetch_array($qry)){
		$json.="{cell:['".$r[0]."','".$r[1]."','".$r[2]."','".Pending($r[0],$r[2])."','".Approved($r[0],$r[2])."','".(Pending($r[0],$r[2])+Approved($r[0],$r[2]))."']},\n";
		$row+=1;
	}
	
	echo "{total: ".$row.", rows: [\n";
		echo $json;
	echo "]}";
?>