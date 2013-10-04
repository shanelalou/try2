<?php include '../../../../config.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	$json = "";
	
	
	if($_POST['qtype']=="m"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and a.time = 'MORNING' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc,a.enlistment_date asc
		") or die(mysql_error());
	}elseif($_POST['qtype']=="a"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and a.time = 'AFTERNOON' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}elseif($_POST['qtype']=="e"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and a.time = 'EVENING' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}
	
	
	elseif($_POST['qtype']=="1"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and b.year = '1st Year College' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}elseif($_POST['qtype']=="2"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and b.year = '2nd Year College' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}elseif($_POST['qtype']=="3"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and b.year = '3rd Year College' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}elseif($_POST['qtype']=="4"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and b.year = '4th Year College' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}
	
	elseif($_POST['qtype']=="1m"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and b.year = '1st Year College' and a.time='MORNING' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}elseif($_POST['qtype']=="1a"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and b.year = '1st Year College' and a.time='AFTERNOON' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}elseif($_POST['qtype']=="1e"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and b.year = '1st Year College' and a.time='EVENING' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}
	
	elseif($_POST['qtype']=="2m"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and b.year = '2nd Year College' and a.time='MORNING' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}elseif($_POST['qtype']=="2a"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and b.year = '2nd Year College' and a.time='AFTERNOON' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}elseif($_POST['qtype']=="2e"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and b.year = '2nd Year College' and a.time='EVENING' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}
	
	
	elseif($_POST['qtype']=="3m"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and b.year = '3rd Year College' and a.time='MORNING' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}elseif($_POST['qtype']=="3a"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and b.year = '3rd Year College' and a.time='AFTERNOON' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}elseif($_POST['qtype']=="3e"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and b.year = '3rd Year College' and a.time='EVENING' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}
	
	elseif($_POST['qtype']=="4m"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and b.year = '4th Year College' and a.time='MORNING' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}elseif($_POST['qtype']=="4a"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and b.year = '4th Year College' and a.time='AFTERNOON' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}elseif($_POST['qtype']=="4e"){
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and b.year = '4th Year College' and a.time='EVENING' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}
	
	
	else{
		$qry = mysql_query("
			SELECT a.student,b.lastname,b.firstname,b.middlename,b.course,b.year,a.time,count(*)
			FROM renlistments as a INNER JOIN rstudents as b on a.student=b.student
			WHERE a.course='".filt($_GET['course'])."' and a.curriculum='".filt($_GET['curriculum'])."' and a.status='Pending'
			GROUP BY a.student ORDER BY b.year,a.enlistment_date asc
		") or die(mysql_error());
	}
	
	

	while($r=mysql_fetch_array($qry)){
		$json.="{cell:['".$r[0]."','".$r[1]."','".$r[2]."','".$r[3]."','".$r[4]."','".$r[5]."','".$r[6]."','".$r[7]."']},\n";
	}
	
	echo "{total: ".mysql_num_rows($qry).", rows: [\n";
		echo $json;
	echo "]}";
?>