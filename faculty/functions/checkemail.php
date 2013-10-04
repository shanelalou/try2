<?php include '../../config.php'?>
<?php
	$qry = mysql_query("select * from account where username='".filt($_GET['email'])."'") or die(mysql_error());
	
	if(mysql_num_rows($qry)>0){
		echo 0;
	}elseif(mysql_num_rows($qry)==0){
		echo 1;
	}
?>