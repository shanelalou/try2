<?php include '../../../../table.class.php' ?>
<?php include '../../../../csv.class.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	
	$csv = new CSV();
	$classLoads = $csv->open('../files/'.$_SESSION['faculty'].'-classloads.csv');

	function isExist($class){
		$qry = mysql_query("select * from rclass where class='$class' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."'");
		if(mysql_num_rows($qry)>0){
			return true;
		}
	}
	
	function isConflict($day,$start,$room){
		$qry = mysql_query("select * from rclass where start='$start' and room='$room' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."'");
		if(mysql_num_rows($qry)>0){
			return true;
		}
	}
	
	if($classLoads['cols']==8){
		foreach($classLoads['rows'] as $i){
			if(is_numeric($i[0]) and isSubject($i[1]) and !isExist($i[0]) and !isConflict($i[4],$i[5],$i[7])){
				mysql_query("insert into rclass(instr,class,subject,day,start,end,room,ay,sem) 
							values('".$_SESSION['faculty']."','".$i[0]."','".$i[1]."','".strtoupper($i[4])."','".strtoupper($i[5])."','".strtoupper($i[6])."','".strtoupper($i[7])."','".enlistment('ay')."','".sem('1',enlistment('sem'))."')");
			}
		}
	}
	unlink('../files/'.$_SESSION['faculty'].'-classloads.csv');
?>