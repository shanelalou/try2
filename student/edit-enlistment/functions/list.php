<?php include '../../../config.php' ?>
<?php
	header("Content-type: text/x-json");
	
	//Check if Passed the subjects
	function subjectpassed($subj){
		$qry=mysql_query("select final from rgrades where subject='$subj' and student='".$_SESSION['student']."'");
		
		if(mysql_num_rows($qry)>0){
			if(mysql_result($qry,0,0)>=75){return true;}
		}
	}
	
	function subjectenlist($subj){
		$qry =mysql_query("select course_code from renlistments where student='".filt($_SESSION['student'])."' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."' and course_code='$subj' and status='Approved'") or die(mysql_error());
		if(mysql_num_rows($qry)>0){
			return true;
		}
	}
	//Check if passed the Prerequisites
	function prereqpassed($subj){
		$qry=mysql_query("select prereq from rsubjects where curriculum='".student($_SESSION['student'],'curriculum')."' and course='".student($_SESSION['student'],'course')."' and subject='$subj'");
		$a=explode(",",str_replace(" ","",mysql_result($qry,0,0)));$c=0;foreach($a as $i){
			if(subjectpassed($i) or $i=="None"){
				$c+=1;
			}elseif(($i)=="2ndYearStanding" and student($_SESSION['student'],"year")=="2nd Year College"){
				$c+=1;
			}elseif((($i)=="3rdYearStanding" or ($i)=="2ndYearStanding") and student($_SESSION['student'],"year")=="3rd Year College"){
				$c+=1;
			}elseif((($i)=="4thYearStanding" or ($i)=="3rdYearStanding" or ($i)=="2ndYearStanding") and student($_SESSION['student'],"year")=="4th Year College"){
				$c+=1;
			}
		}
		if(count($a)==$c){return true;}
	}
	
	$qry=mysql_query("select subject,title,lec,lab,prereq,year,sem from rsubjects where curriculum='".student($_SESSION['student'],"curriculum")."' and course='".student($_SESSION['student'],"course")."' order by  year ASC,sem ASC,subject ASC") or die(mysql_error());
	
	
	$data = "";
	$total=0;
	while($r=mysql_fetch_array($qry)){
		if(!subjectpassed($r[0]) and ($r[3]=="None" or prereqpassed($r[0])) and !subjectenlist($r[0])){
			$data.= "{id:'".$r[0]."',cell:['".$r[0]."','".$r[1]."','".$r[2]."','".$r[3]."','".$r[4]."','".$r[5]."','".$r[6]."']},\n";
			$total += 1;
		}
	}
	
	echo "{total:".$total.",rows:[\n";
		echo $data;
	echo "]}";
	
	
?>
