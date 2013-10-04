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

	function Students($a){
		$qry = mysql_query("select * from class_schedule_student where  class_code='$a' and academicyear='".enlistment('academicyear')."' and semester='".enlistment('semester')."'");
		return mysql_num_rows($qry);
	}
	
	$qry = mysql_query("
		select class_code,subject_code,day,start_time,end_time,room,instructor_code,time
		from class_schedule 
		where  course='".filt($_GET['course'])."' and year='".filt($_GET['year'])."' and block='".filt($_GET['block'])."' and academicyear='".enlistment('academicyear')."' and semester='".enlistment('semester')."'");
	
	echo '
	<div style="width:800px;margin:auto;">
		<div><h1 style="font-size:20px;">SUBJECTS OF '.$_GET['course'].' '.$_GET['year'].'-'.$_GET['block'].'</h1></div>
		<div>
		<table border="1" style="border-collapse:collapse;">
			<tr>
				<th></th>
				<th>CLASS CODE</th>
				<th>SUBJECT CODE</th>
				<th>DAY</th>
				<th>START</th>
				<th>END</th>
				<th>ROOM</th>
				<th>INSTRUCTOR</th>
				<th>STUDENTS</th>
			</tr>
	';
	$i = 0;
	while($r=mysql_fetch_array($qry)){
		$i+=1;
		echo "
		<tr>
			<td style=\"width:30px;text-align:center;\">".$i."</td>
			<td style=\"width:100px;text-align:center;\">".$r[0]."</td>
			<td style=\"width:120px;text-align:center;\">".$r[1]."</td>
			<td style=\"width:40px;text-align:center;\">".$r[2]."</td>
			<td style=\"width:80px;text-align:center;\">".$r[3]."</td>
			<td style=\"width:80px;text-align:center;\">".$r[4]."</td>
			<td style=\"width:40px;text-align:center;\">".$r[5]."</td>
			<td style=\"width:200px;text-align:center;\">".$r[6]."</td>
			<td style=\"width:100px;text-align:center;\">".Students($r[0])."</td>
		</tr>
		";
	}
	echo '
		</table>
		</div>
	</div>
	<script>
		window.print();
	</script>
	';
?>

