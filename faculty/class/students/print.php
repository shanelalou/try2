<?php include '../../../config.php' ?>
<style>
	* {
		font-family: Trebuchet MS;
		font-size:14px;
	}
	td {
		text-align:center;
	}
</style>
<div style="text-align:right;"><?php echo date('F d, Y');?></div>
<div style="width:650px;margin:auto;height:100px;margin-bottom:20px;">
	<img src="../../../source/images/gc.png" style="float: left;"  width="100" height="100">
	<img src="../../../source/images/ccslogo.png" style="float: right;"  width="100" height="100">
	<div style="text-align:center;font-size:22px;margin-top:20px;">GORDON COLLEGE</div>
	<div style="text-align:center;font-size:16px;">College of Computer Studies</div>
</div>
<div style="width:650px;margin:auto;font-size:14px;margin-bottom:10px;">STUDENTS IN CLASS <?php echo $_GET['class'].' - '.classe($_GET['class'],'subject').' - '.classe($_GET['class'],'day').' - '.classe($_GET['class'],'start').' - '.classe($_GET['class'],'end').' - '.classe($_GET['class'],'room') ?></div>
<?php

	
	function Grades($a,$b,$c){
		$qry = mysql_query("select $c from rgrades where class='$a' and student='$b' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."'");
		if(mysql_num_rows($qry)>0){
			return mysql_result($qry,0,0);
		}
	}
	
	$qry = mysql_query("select a.student,b.lastname,b.firstname,b.middlename,b.course,b.curriculum,b.year
						from rclassstudents as a inner join rstudents as b on a.student=b.student 
						where a.class='".filt($_GET['class'])."' and a.ay='".enlistment('ay')."' and a.sem='".sem('1',enlistment('sem'))."'
						order by b.lastname asc,b.firstname asc") or die(mysql_error());

	echo '
	<div style="width:650px;margin:auto;">
	<table border="1" style="border-collapse:collapse;">
		<tr>
			<th></th>
			<th>STUDENT #</th>
			<th>NAME</th>
			<th>PRELIM</th>
			<th>MIDTERM</th>
			<th>FINAL</th>
			<th>REMARKS</th>
		</tr>
	';
	$i=0;
	while($r=mysql_fetch_array($qry)){
	$i+=1;
		echo '
		<tr>
			<td style="width:30px;">'.$i.'</td>
			<td style="width:100px;">'.$r[0].'</td>
			<td style="width:300px;">'.$r[1].', '.$r[2].' '.$r[3].'</td>
			<td style="width:50px;">'.Grades($_GET['class'],$r[0],'prelim').'</td>
			<td style="width:50px;">'.Grades($_GET['class'],$r[0],'midterm').'</td>
			<td style="width:50px;">'.Grades($_GET['class'],$r[0],'final').'</td>
			<td style="width:50px;">'.gradesToRemark(Grades($_GET['class'],$r[0],'final')).'</td>
		</tr>
		';
	}
	
	echo '</table></div>';
?>
<script>
	window.print();
</script>
