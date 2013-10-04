<?php include '../../../../config.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	$json = "";
	
	$qry = mysql_query("select a.course_code,a.time,a.status from renlistments as a where a.student='".filt($_GET['student'])."'");
	
	while($r=mysql_fetch_array($qry)){
		$json.="{cell:['".$r[0]."','".subject($r[0],'title')."','".subject($r[0],'lec')."','".subject($r[0],'lab')."','".subject($r[0],'prereq')."','".$r[1]."','".$r[2]."']},\n";
	}
	
	echo "{total: ".mysql_num_rows($qry).", rows: [\n";
		echo $json;
	echo "]}";
?>