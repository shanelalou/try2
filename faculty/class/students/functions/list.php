<?php include '../../../../table.class.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	$json = null;
	
	function Grades($a,$b,$c){
		$qry = mysql_query("select $c from rgrades where class='$a' and student='$b' and ay='".filt($_GET['ay'])."' and sem='".filt($_GET['sem'])."'");
		if(mysql_num_rows($qry)>0){
			return mysql_result($qry,0,0);
		}
	}
	

	$qry = mysql_query("select a.student,b.lastname,b.firstname,b.middlename,b.course,b.curriculum,b.year from rclassstudents as a inner join rstudents as b using (student) where a.class='".filt($_GET['class'])."' and a.ay='".filt($_GET['ay'])."' and sem='".filt($_GET['sem'])."' order by b.lastname asc,b.firstname");
	
	while($r=mysql_fetch_array($qry)){
		//$json .= "	{id:'',cell:['".$r[0]."','".$r[1].', '.$r[2].' '.$r[3]."','".$r[4]."','".$r[5]."','".$r[6]."','".."','".Grades($_GET['class'],$r[0],'p_absent')."','".Grades($_GET['class'],$r[0],'midterm')."','".Grades($_GET['class'],$r[0],'m_absent')."','".Grades($_GET['class'],$r[0],'final')."','".Grades($_GET['class'],$r[0],'f_absent')."','".grades_to_equiv(Grades($_GET['class'],$r[0],'final'))."','".grade_to_remarks(Grades($_GET['class'],$r[0],'final'))."']},\n";
		$json .= "{cell: ['".$r[0]."','".$r[1].', '.$r[2].' '.$r[3]."','".$r[4]."','".$r[5]."','".$r[6]."','".Grades($_GET['class'],$r[0],'prelim')."','".Grades($_GET['class'],$r[0],'p_absent')."','".Grades($_GET['class'],$r[0],'midterm')."','".Grades($_GET['class'],$r[0],'m_absent')."','".Grades($_GET['class'],$r[0],'final')."','".Grades($_GET['class'],$r[0],'f_absent')."','".gradesToEquiv(Grades($_GET['class'],$r[0],'final'))."','".gradesToRemark(Grades($_GET['class'],$r[0],'final'))."']},\n";
	}
	
	echo "{total: ".mysql_num_rows($qry).",rows:[\n";
		echo $json;
	echo "]}\n";
?>
