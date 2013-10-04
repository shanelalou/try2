<?php include '../../config.php'?>
<?php
	$code=(filt($_GET['code']));
	$lastname=ucwords(filt($_GET['lastname']));
	$firstname=ucwords(filt($_GET['firstname']));
	$middlename=ucwords(filt($_GET['middlename']));
	$position=(filt($_GET['position']));
	$password=(filt($_GET['password']));
	
	mysql_query("insert into raccounts(username,email,`password`,type,status)values('$code','$code','$password','Faculty','0')") or die(mysql_error());
	mysql_query("insert into rinstructors(instr,lastname,firstname,middlename,position) values('$code','$lastname','$firstname','$middlename','$position')") or die(mysql_error());
?>