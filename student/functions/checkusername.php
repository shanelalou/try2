<?php include '../../config.php';?>
<?php
	$qry=mysql_query("select username from raccounts where username='".filt($_GET['username'])."' and type='Student' and status='0'");
	$qry2=mysql_query("select username from raccounts where username='".filt($_GET['username'])."' and type='Student' and status='1'");
	if(mysql_num_rows($qry)>0){
		echo 1;
	}elseif(mysql_num_rows($qry2)>0){
		echo 2;
	}else{
		echo 0;
	}
	

?>