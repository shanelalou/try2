<?php include '../../config.php'?>
<?php
	$username = filt($_GET['username']);
	$password=	filt($_GET['password']);
	$q=mysql_query("select username,password,status from raccounts where username='$username' and password='$password' and status='1'") or die(mysql_error());
	$q2=mysql_query("select username,password,status from raccounts where username='$username' and status='0'") or die(mysql_error());
	$q3=mysql_query("select username,password,status from raccounts where username='$username'") or die(mysql_error());
	if(mysql_num_rows($q)==1){
		$_SESSION['faculty']=mysql_result($q,0,0);
		echo 1;
	}elseif(mysql_num_rows($q2)==1){
		echo 2;
	}elseif(mysql_num_rows($q3)==1){
		echo 3;
	}
?>