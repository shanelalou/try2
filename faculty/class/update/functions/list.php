<?php include '../../../../table.class.php' ?>
<?php include '../../../../csv.class.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	$json = null;
	
	$csv = new CSV();
	$classLoads = $csv->open('../files/'.$_SESSION['faculty'].'-classloads.csv');
	$rows = 0;
	
	
	function isExist($class){
		$qry = mysql_query("select * from rclass where class='$class' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."' and instr!='".$_SESSION['faculty']."'");
		if(mysql_num_rows($qry)>0){
			return true;
		}
	}
	
	function isConflict($day,$start,$room){
		$qry = mysql_query("select * from rclass where start='$start' and room='$room' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."' and instr!='".$_SESSION['faculty']."'");
		if(mysql_num_rows($qry)>0){
			return true;
		}
	}
	
	
	if($classLoads['cols']==8){
		foreach($classLoads['rows'] as $i){
			if(is_numeric($i[0]) and isSubject($i[1])){
				if(isExist($i[0])){ $status = "Class Code already exist.";}
				elseif(isConflict($i[4],$i[5],$i[7])){ $status = "Conflict time and room.";}
				else{$status = "OK";}
				$json .= "{ cell: ['".$i[0]."','".strtoupper($i[1])."','".Subject($i[1],'title')."','".Subject($i[1],'lec')."','".Subject($i[1],'lab')."','".strtoupper($i[4])."','".strtoupper($i[5])."','".strtoupper($i[6])."','".strtoupper($i[7])."','$status']},\n";
				$rows +=1;
			}
		}
	}
	
	echo "{total: ".$rows.",rows:[\n";
		echo $json;
	echo "]}";
?>