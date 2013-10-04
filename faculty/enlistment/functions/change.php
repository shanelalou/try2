<?php include '../../../config.php' ?>
<?php
	mysql_query("update renlistmentschedule set ay='".filt($_POST['academicyear'])."',sem='".filt($_POST['semester'])."',start='".filt(date("Y-m-d",strtotime($_POST['start'])))."',end='".filt(date("Y-m-d",strtotime($_POST['end'])))."'");
?>