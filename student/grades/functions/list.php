<?php include '../../../config.php' ?>
<?php
	header("Content-type: text/x-json");
	
	function Grades($year,$sem){
		if($_POST['query']!=""){
			$query = "subject='".$_POST['query']."' and";
		}else{
			$query = "";
		}
		$qry = mysql_query("select subject,title,lec,lab,prereq,year,sem 
							from rsubjects 
							where $query course='".student($_SESSION['student'],'course')."' and curriculum='".student($_SESSION['student'],'curriculum')."' and year='$year' and sem='$sem'");
		$json = "";
		while($r=mysql_fetch_array($qry)){
		
			$grade = mysql_query("select 
									a.prelim,
									a.p_absent,
									a.midterm,
									a.m_absent,
									a.final,
									a.f_absent,
									(a.p_absent + a.m_absent + a.f_absent),
									b.instr,
									b.class,
									b.day,
									b.start,
									b.end,
									b.room,
									b.ay,
									b.sem
								from rgrades as a left join rclass as b using (class) 
								where a.student='".$_SESSION['student']."' and a.subject='".$r[0]."'");
			
			if(mysql_num_rows($grade)>0){
				while($g = mysql_fetch_array($grade)){
					$json .= "{cell: ['".$r[0]."','".$r[1]."','".$r[2]."','".$r[3]."','".$r[4]."','".$r[5]."','".$r[6]."','".$g[0]."','".$g[1]."','".$g[2]."','".$g[3]."','".$g[4]."','".$g[5]."','".$g[6]."','".gradesToEquiv($g[4])."','".gradesToRemark($g[4])."','".faculty($g[7],'firstname').' '.faculty($g[7],'lastname')."','".$g[8]."','".$g[9]."','".$g[10]." - ".$g[11]."','".$g[12]."','".$g[13]."','".$g[14]."']},\n";
				}
				
			}else{
				$json .= "{cell: ['".$r[0]."','".$r[1]."','".$r[2]."','".$r[3]."','".$r[4]."','".$r[5]."','".$r[6]."','','','','','','','','','','','','','','','','']},\n";
			}
		}
		
		if($_POST['query']==""){
			$json = "{cell: ['','".strtoupper(switch_year($year)." ".strtoupper(sem('first semester',$sem)))."','','','','','','','','','','','','','','','','','','','','','']},\n" . $json . "{cell: ['','','','','','','','','','','','','','','','','','','','','','','']},\n";
		}
		
		return $json;
	}

	function Total($year,$sem){
		if($_POST['query']!=""){
			$query = "subject='".$_POST['query']."' and";
		}else{
			$query = "";
		}
		$qry = mysql_query("select subject,title,lec,lab,prereq,year,sem 
							from rsubjects 
							where $query course='".student($_SESSION['student'],'course')."' and curriculum='".student($_SESSION['student'],'curriculum')."' and year='$year' and sem='$sem'");
		$row = 0;
		while($r=mysql_fetch_array($qry)){
		
			$grade = mysql_query("select 
									a.prelim,
									a.p_absent,
									a.midterm,
									a.m_absent,
									a.final,
									a.f_absent,
									(a.p_absent + a.m_absent + a.f_absent),
									b.instr,
									b.class,
									b.day,
									b.start,
									b.end,
									b.room,
									b.ay,
									b.sem
								from rgrades as a left join rclass as b using (class) 
								where a.student='".$_SESSION['student']."' and a.subject='".$r[0]."'");
			
			if(mysql_num_rows($grade)>0){
				while($g = mysql_fetch_array($grade)){
					$row+=1;
				}
				
			}else{
				$row+=1;
			}
		}
		return $row;
	}
	
	
	
	
	
	
	echo "{total: ".(Total('1st','1st')+Total('1st','2nd')+Total('1st','summer')+Total('2nd','1st')+ Total('2nd','2nd')+Total('3rd','1st')+ Total('3rd','2nd')+Total('3rd','summer')+Total('4th','1st')+Total('4th','2nd')).", rows:[";
	
		echo Grades('1st','1st'); 
		echo Grades('1st','2nd');
		echo Grades('1st','summer');
		
		echo Grades('2nd','1st'); 
		echo Grades('2nd','2nd');
		
		echo Grades('3rd','1st'); 
		echo Grades('3rd','2nd');
		echo Grades('3rd','summer');
		
		echo Grades('4th','1st'); 
		echo Grades('4th','2nd');
	echo "]}";
?>