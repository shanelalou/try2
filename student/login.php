<?php include '../../config.php';?>
<?php
	$qry=mysql_query("select username,password from raccounts where username='".filt($_GET['username'])."' and password='".filt($_GET['password'])."' and type='Student' and status='1'");
	$qry2=mysql_query("select username from raccounts where username='".filt($_GET['username'])."' and type='Student' and status='1'");
	$qry3=mysql_query("select username from raccounts where username='".filt($_GET['username'])."' and type='Student' and status='0'");
	
	$now = strtotime(date('Y-m-d'));
	$start = strtotime(enlistment('start'));
	$end = strtotime(enlistment('end'));
	
	if($now < $start){
		echo 4;
	}elseif($now > $end){
		echo 5;
	}else{
		if(mysql_num_rows($qry)>0){
			$_SESSION['student']=$_GET['username'];
			echo 1;
		}elseif(mysql_num_rows($qry2)>0){
			echo 2;
		}elseif(mysql_num_rows($qry3)>0){
			echo 3;
	}
	
	
	
	}
?>