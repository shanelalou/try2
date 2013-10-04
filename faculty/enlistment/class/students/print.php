<?php include '../../../../config.php' ?>
<style>
	* {
		font-family: Trebuchet Ms;
		font-size: 13px;
		
	}
	td {
		text-align:center;
	}
</style>
<div style="text-align:right;"><?php echo date('F d, Y');?></div>
<div style="width:650px;margin:auto;height:100px;">
	<img src="../../../../source/images/gc.png" style="float: left;"  width="100" height="100">
	<img src="../../../../source/images/ccslogo.png" style="float: right;"  width="100" height="100">
	<div style="text-align:center;font-size:22px;margin-top:20px;">GORDON COLLEGE</div>
	<div style="text-align:center;font-size:16px;">College of Computer Studies</div>
	<div style="text-align:center;font-size:15px;"><?php echo course($_GET['course'],'course_title')?></div>
</div>
<?php
	$json = null;

	function Subjects($a,$b,$c,$d){
		$qry = mysql_query("SELECT a.student_number from class_schedule_student as a inner join class_schedule as b using (class_code)  
							WHERE b.course='$a' and b.year='$b' and b.block='$c' and a.student_number='$d' and b.academicyear='".enlistment('academicyear')."' and b.semester='".enlistment('semester')."'");
		return mysql_num_rows($qry);
	}

	$qry = mysql_query("SELECT a.student_number from class_schedule_student as a inner join class_schedule as b using (class_code)
						WHERE b.course='".filt($_GET['course'])."' and b.year='".filt($_GET['year'])."' and b.block='".filt($_GET['block'])."' and b.academicyear='".enlistment('academicyear')."' and b.semester='".enlistment('semester')."'
						GROUP BY a.student_number");

	echo '
	<div style="width:650px;margin:auto;">
		<h1 style="font-size:16px;">Students of '.$_GET['course'].' '.$_GET['year'].'-'.$_GET['block'].'</h1>
	</div>
	<div style="width:650px;margin:auto;">
	<table border="1" style="border-collapse:collapse;">
		<tr>
			<th></th>
			<th>STUDENT #</th>
			<th>LAST NAME</th>
			<th>FIRST NAME</th>
			<th>MIDDLE NAME</th>
			<th>COURSE</th>
			<th>YEAR LEVEL</th>
			<th>SUBJECTS</th>
		</tr>
	';
	$i=0;
	while($r=mysql_fetch_array($qry)){
		$i+=1;
		echo '
		<tr>
			<td style="width:20px;">'.$i.'</td>
			<td style="width:90px;">'.$r[0].'</td>
			<td style="width:100px;">'.student($r[0],'lastname').'</td>
			<td style="width:150px;">'.student($r[0],'firstname').'</td>
			<td style="width:100px;">'.student($r[0],'middlename').'</td>
			<td style="width:70px;">'.student($r[0],'course').'</td>
			<td style="width:120px;">'.student($r[0],'year').'</td>
			<td style="width:70px;">'.Subjects($_GET['course'],$_GET['year'],$_GET['block'],$r[0]).'</td>
		</tr>
		';
	}	
	
	echo '
	</table>
	</div>
	';
?>
<script>
	window.print();
</script>
