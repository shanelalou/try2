<?php
	session_start();
	mysql_connect("localhost","root","");
	mysql_select_db("dbccsportal");

	function genCode($b,$a){
		$chars=array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		do{
			$code = $chars[rand(0,35)].$chars[rand(0,35)].$chars[rand(0,35)].$chars[rand(0,35)].$chars[rand(0,35)];
			$qry=mysql_query("select $b from $a where $b='".$code."'");
			if(mysql_num_rows($qry)==0){
				return $code;
				break;
			}
		}while(true);
	}
	function filt($a){return mysql_real_escape_string(addslashes(strip_tags($a)));}
	function sem($a,$b){
		if(strtolower($a)=='first semester' or strtolower($a)=='second semester' or strtolower($a)=='summer'){
			if($b=='1' or $b=='1st'){
				return 'First Semester';
			}elseif($b=='2' or $b=='2nd'){
				return 'Second Semester';
			}elseif($b=='3' or $b=='summer'){
				return 'Summer';
			}
		}
		
		elseif($a=='1' or $a=='2' or $a=='3'){
			if(strtolower($b)=='first semester' or $b=='1st'){
				return '1';
			}elseif(strtolower($b)=='second semester' or $b=='2nd'){
				return '2';
			}elseif(strtolower($b)=='summer' or $b=='3rd'){
				return '3';
			}
		}
	}
	function course($a,$b){
		$qry=mysql_query("select * from rcourses where course='".filt($a)."'") or die(mysql_error());
		if(mysql_num_rows($qry)>0){
			return mysql_result($qry,0,$b);
		}
	}
	function switch_year($a){
		switch(strtolower($a)){
			case "1":
				return "First Year";break;
			case "2":
				return "Second Year";break;
			case "3":
				return "Third Year";break;
			case "4":
				return "Fourth Year";break;
				
			case "1st":
				return "First Year";break;
			case "2nd":
				return "Second Year";break;
			case "3rd":
				return "Third Year";break;
			case "4th":
				return "Fourth Year";break;
				
			case "first year":
				return "1";break;
			case "second year":
				return "2";break;
			case "third year":
				return "3";break;
			case "fourth year":
				return "4";break;
				
			case "1st year college":
				return "1";break;
			case "2nd year college":
				return "2";break;
			case "3rd year college":
				return "3";break;
			case "4th year college":
				return "4";break;
		}
	}
	
	function enlistment($a){
		$qry = mysql_query("select $a from renlistmentschedule");
		return mysql_result($qry,0,0);
	}
	
	function enlistment_status($a,$b){
		$qry=mysql_query("select * from renlistments where student='".filt($a)."' group by student") or die(mysql_error());
		if(mysql_num_rows($qry)>0){
			return mysql_result($qry,0,$b);
		}
	}
	
	function subject($a,$b){
		$qry = mysql_query("select $b from rsubjects where subject='$a'");
		if(mysql_num_rows($qry)>0){return mysql_result($qry,0,0);}
	}
	
	function student($a,$b){
		$qry = mysql_query("select $b from rstudents where student='$a'");
		if(mysql_num_rows($qry)>0){return mysql_result($qry,0,0);}
	}
	
	function faculty($a,$b){
		$qry = mysql_query("select $b from rinstructors where instr='$a'");
		if(mysql_num_rows($qry)>0){return mysql_result($qry,0,0);}
	}
	
	function classe($a,$b){
		$qry = mysql_query("select $b from rclass where class='$a'");
		if(mysql_num_rows($qry)>0){return mysql_result($qry,0,0);}
	}
	
	function isSubject($a){
		$qry = mysql_query("select subject from rsubjects where subject='$a'");
		if(mysql_num_rows($qry)>0){ return true; }
	}
	
		function gradesToRemark($grade){
		if($grade==""){
			return "";
		}elseif($grade >= 75){
			return "Passed";
		}elseif(strtolower($grade)=="drp"){
			return "Dropped";
		}elseif(strtolower($grade)=="inc"){
			return "Incomplete";
		}elseif(strtolower($grade)=="cf"){
			return "Conditional Failure";
		}elseif(strtolower($grade)=="nfe"){
			return "No Final Exam";
		}elseif(strtolower($grade)=="fda"){
			return "Failure Due Absences";
		}elseif($grade < 75){
			return "Failed";
		}
	
	}
	
	function gradesToEquiv($grade){
		$qry = mysql_query("select equivalent from rgradesequivalent where grade = '$grade'") or die(mysql_error());
		if(mysql_num_rows($qry)>0){ return mysql_result($qry,0,0); }
		else {return $grade;}
	}
?>