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
	<div style="text-align:center;font-size:15px;"><?php echo course($_GET['course'],'course_title')?></div>
</div>
<div style="margin-left:15px;font-size:18px;margin-bottom:10px;">APPROVED STUDENTS PER SUBJECTS</div>
<?php
	function Approved($a){
		$qry = mysql_query("select * from enlistment where course_code='$a' and course='".filt($_GET['course'])."' and curriculum='".$_GET['curriculum']."' and status='Approved'");
		return mysql_num_rows($qry);
	}
	
	function Morning($a){
		$qry = mysql_query("select * from enlistment where course_code='$a' and course='".filt($_GET['course'])."' and curriculum='".$_GET['curriculum']."' and status='Approved' and time='MORNING'");
		return mysql_num_rows($qry);
	}
	function Afternoon($a){
		$qry = mysql_query("select * from enlistment where course_code='$a' and course='".filt($_GET['course'])."' and curriculum='".$_GET['curriculum']."' and status='Approved' and time='AFTERNOON'");
		return mysql_num_rows($qry);
	}
	function Evening($a){
		$qry = mysql_query("select * from enlistment where course_code='$a' and course='".filt($_GET['course'])."' and curriculum='".$_GET['curriculum']."' and status='Approved' and time='EVENING'");
		return mysql_num_rows($qry);
	}	
	
	
	function Subjects($yr,$sem){
		global $json;

		$qry = mysql_query("select subject_code,subject_title,units,lab,prerequisite,year,semester
							from subject 
							where year='$yr' and semester='$sem' and curriculum='".filt($_GET['curriculum'])."' and course='".filt($_GET['course'])."'") or die(mysql_error());
		
		echo '
		<table border="1" style="border-collapse:collapse;margin-bottom:15px;">
			<tr>
				<th>SUBJECT CODE</th>
				<th>YEAR</th>
				<th>SEMESTER</th>
				<th>STUDENTS</th>
				<th>MORNING</th>
				<th>AFTERNOON</th>
				<th>EVENING</th>
			</tr>
		';
		while($r=mysql_fetch_array($qry)){
			echo '
			<tr>
				<td style="width:120px;">'.$r[0].'</td>
				<td style="width:90px;">'.$r[5].'</td>
				<td style="width:90px;">'.$r[6].'</td>
				<td style="width:90px;">'.Approved($r[0]).'</td>
				<td style="width:90px;">'.Morning($r[0]).'</td>
				<td style="width:90px;">'.Afternoon($r[0]).'</td>
				<td style="width:90px;">'.Evening($r[0]).'</td>
			</tr>
			';
		}
	}
	
		echo '<div style="width:660px;margin:auto;">';
		Subjects('1st','1st');
		Subjects('1st','2nd');
		Subjects('1st','summer');
		
		Subjects('2nd','1st');
		Subjects('2nd','2nd');
		
		Subjects('3rd','1st');
		Subjects('3rd','2nd');
		Subjects('3rd','summer');
		
		Subjects('4th','1st');
		Subjects('4th','2nd');
		echo '</div>';
?>
<script>
	window.print();
</script>