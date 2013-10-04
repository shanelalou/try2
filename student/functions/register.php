<?php include '../../config.php';?>
<?php
	$qry=mysql_query("update raccounts set password='".filt($_GET['password'])."' where username='".filt($_GET['username'])."'") or die(mysql_error());
	
	$message = '
		<html>
			<body>
			<div style="width:500px;height:500px;background:orange;">
				<a href="http://www.ccs.boxhost.me">Verify</a>
			</div>
			</body>
		</html>
	';


	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

	// More headers
	$headers .= 'From: <GC-CCS-Course-Enlistment@gcccs-enlistment.com>' . "\r\n";
	//$headers .= 'Cc: myboss@example.com' . "\r\n";
		
	mail($_GET['username'].'@gordoncollegeccs.edu.ph',"GC CCS ENLISTMENT ACCOUNT",$message,$headers);
?>