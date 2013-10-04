<?php include '../../../../../config.php' ?>
<style>
	* {
		font-family:Trebuchet MS;font-size:12px;
	}
	td {text-align:center;}
	.left {
		float:left;
	}
	.sec {
		border-bottom:1px solid gray;border-left:1px solid gray;border-right:1px solid gray;
		height:25px;
		width:650px;
	}
</style>
<div style="width:690px;margin:auto;">
<div style="width:700px;height:50px;">
	<div style="border:1px solid gray;width:400px;margin:auto;">
		<div style="text-align:center">GODON COLLEGE</div>
		<div style="text-align:center">Registration Form</div>
	</div>
	
</div>
<div>Please fill in completely, processing may be delayed on incomplete forms.</div>
<table border="1" style="border-collapse:collapse">
	<tr>
		<td style="width:175px;text-align:left;">Program:<?php echo student($_GET['student'],"course")?></td>
		<td style="width:165px;text-align:left;">Academic Year:<?php echo enlistment("academicyear")?></td>
		<td style="width:105px;text-align:left;">Semester:</td>
		<td style="width:234px;text-align:left;"><?php echo enlistment("semester")?></td>
	</tr>
</table>

<table border="1" style="border-collapse:collapse">
	<tr>
		<td style="width:175px;text-align:left;">Last Name: <?php echo student($_GET['student'],"lastname")?></td>
		<td style="width:179px;text-align:left;">First Name: <?php echo student($_GET['student'],"firstname")?></td>
		<td style="width:160px;text-align:left;">Middle Name: <?php echo student($_GET['student'],"middlename")?></td>
		<td style="width:165px;text-align:left;">Student Number: <?php echo student($_GET['student'],"number")?></td>
	</tr>
</table>

<table border="1" style="border-collapse:collapse">
	<tr>
		<td style="width:330px;text-align:left;">Date of Registration:</td>
		<td style="width:330px;text-align:left;">Scholar Type:</td>
	</tr>
	<tr>
		<td style="width:340px;text-align:left;">Signature of Student:</td>
		<td style="width:345px;text-align:left;">OSS Vice President's Signature/Date:</td>
	</tr>
</table>

<table border="1" style="border-collapse:collapse">
	<tr>
		<td colspan="2">FOR REGISTRAR'S USE ONLY</td>
	</tr>
	<tr>
		<td style="width:340px;">Resident Non-Resident</td>
		<td style="width:345px;">REMARKS:</td>
	</tr>
	<tr>
		<td>Total # of Units:</td>
		<td></td>
	</tr>
</table>

<table border="1" style="border-collapse:collapse">
	<tr>
		<th>Class Code</th>
		<th>Course Code</th>
		<th>Units</th>
		<th>Description</th>
		<th>Day</th>
		<th>Time</th>
		<th>Room</th>
	</tr>
	<?php
		$qry = mysql_query("
			SELECT  a.class_code,b.subject_code,b.day,b.start_time,b.end_time,b.room
			FROM class_schedule_student as a INNER JOIN class_schedule as b using (class_code)
			WHERE a.student_number='".filt($_GET['student'])."' and b.academicyear='".enlistment('academicyear')."' and b.semester='".enlistment('semester')."'");

		while($r=mysql_fetch_array($qry)){
			echo '
				<tr>
					<td class="cell" style="width:80px;">'.$r[0].'</td>
					<td class="cell" style="width:90px;">'.$r[1].'</td>
					<td class="cell" style="width:50px;">'.subj($r[1],"units").'</td>
					<td class="cell" style="width:245px;">'.subj($r[1],"subject_title").'</td>
					<td class="cell" style="width:50px;">'.$r[2].'</td>
					<td class="cell" style="width:120px;">'.$r[3].' - '.$r[4].'</td>
					<td class="cel"  style="width:35px;">'.$r[5].'</td>
				</tr>
			';
		}
	?>
</table>
<br>
<div>
	<div>
		<span>___________________________</span>
		<span style="margin-left:60px;">Evaluated By:_______________________</span>
		<span style="margin-left:80px;">___________________________</span>
	</div>
	<div>
		<span>Signature Over Printed Name</span>
		<span style="margin-left:180px;">Dean</span>
		<span style="margin-left:180px;">Registrar</span>	
	</div>

</div>
</div>


<div style="width:690px;margin:auto;margin-top:50px;">
<div style="width:700px;height:50px;">
	<div style="border:1px solid gray;width:400px;margin:auto;">
		<div style="text-align:center">GODON COLLEGE</div>
		<div style="text-align:center">Registration Form</div>
	</div>
	
</div>
<div>Please fill in completely, processing may be delayed on incomplete forms.</div>
<table border="1" style="border-collapse:collapse">
	<tr>
		<td style="width:175px;text-align:left;">Program:<?php echo student($_GET['student'],"course")?></td>
		<td style="width:165px;text-align:left;">Academic Year:<?php echo enlistment("academicyear")?></td>
		<td style="width:105px;text-align:left;">Semester:</td>
		<td style="width:234px;text-align:left;"><?php echo enlistment("semester")?></td>
	</tr>
</table>

<table border="1" style="border-collapse:collapse">
	<tr>
		<td style="width:175px;text-align:left;">Last Name: <?php echo student($_GET['student'],"lastname")?></td>
		<td style="width:179px;text-align:left;">First Name: <?php echo student($_GET['student'],"firstname")?></td>
		<td style="width:160px;text-align:left;">Middle Name: <?php echo student($_GET['student'],"middlename")?></td>
		<td style="width:165px;text-align:left;">Student Number: <?php echo student($_GET['student'],"number")?></td>
	</tr>
</table>

<table border="1" style="border-collapse:collapse">
	<tr>
		<td style="width:330px;text-align:left;">Date of Registration:</td>
		<td style="width:330px;text-align:left;">Scholar Type:</td>
	</tr>
	<tr>
		<td style="width:340px;text-align:left;">Signature of Student:</td>
		<td style="width:345px;text-align:left;">OSS Vice President's Signature/Date:</td>
	</tr>
</table>

<table border="1" style="border-collapse:collapse">
	<tr>
		<td colspan="2">FOR REGISTRAR'S USE ONLY</td>
	</tr>
	<tr>
		<td style="width:340px;">Resident Non-Resident</td>
		<td style="width:345px;">REMARKS:</td>
	</tr>
	<tr>
		<td>Total # of Units:</td>
		<td></td>
	</tr>
</table>

<table border="1" style="border-collapse:collapse">
	<tr>
		<th>Class Code</th>
		<th>Course Code</th>
		<th>Units</th>
		<th>Description</th>
		<th>Day</th>
		<th>Time</th>
		<th>Room</th>
	</tr>
	<?php
		$qry2 = mysql_query("
			SELECT  a.class_code,b.subject_code,b.day,b.start_time,b.end_time,b.room
			FROM class_schedule_student as a INNER JOIN class_schedule as b using (class_code)
			WHERE a.student_number='".filt($_GET['student'])."' and b.academicyear='".enlistment('academicyear')."' and b.semester='".enlistment('semester')."'");

		while($r2=mysql_fetch_array($qry2)){
			echo '
				<tr>
					<td class="cell" style="width:80px;">'.$r2[0].'</td>
					<td class="cell" style="width:90px;">'.$r2[1].'</td>
					<td class="cell" style="width:50px;">'.subj($r2[1],"units").'</td>
					<td class="cell" style="width:245px;">'.subj($r2[1],"subject_title").'</td>
					<td class="cell" style="width:50px;">'.$r2[2].'</td>
					<td class="cell" style="width:120px;">'.$r2[3].' - '.$r2[4].'</td>
					<td class="cel"  style="width:35px;">'.$r2[5].'</td>
				</tr>
			';
		}
	?>
</table>
<br>
<div>
	<div>
		<span>___________________________</span>
		<span style="margin-left:60px;">Evaluated By:_______________________</span>
		<span style="margin-left:80px;">___________________________</span>
	</div>
	<div>
		<span>Signature Over Printed Name</span>
		<span style="margin-left:180px;">Dean</span>
		<span style="margin-left:180px;">Registrar</span>	
	</div>

</div>
</div>


<script>
window.print();
</script>
