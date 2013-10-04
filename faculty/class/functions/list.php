<?php include '../../../table.class.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");

	if($_POST['qtype']=="" or $_POST['qtype']=="Select Academicyear & Semester"){
		$ay = enlistment('ay');
		$sem = sem('1',enlistment('sem'));
	}else{
		$q = explode(' ',$_POST['qtype']);$ay = $q[0];$sem = "";
		for($i=1;$i<count($q);$i++){$sem.=$q[$i]." ";}
		$sem = sem('1',substr($sem,0,-1));
	}
	
	
	$table = new Table();
	$classLoads = $table->showTable("id,class,subject,day,start,end,room","rclass where instr='".$_SESSION['faculty']."' and ay='$ay' and sem='$sem'");
	
	function classLoadStudents($ay,$sem,$class){
		$table = new Table();
		$classLoadStudents = $table->showTable("student","rclassstudents where ay='$ay' and sem='$sem' and class='$class'");
		return $classLoadStudents['total'];
	}
	
	
	echo "{total: ".$classLoads['total'].", rows:[\n";
	
	foreach($classLoads['rows'] as $i){
		echo "{id: '".$i[0]."', cell: ['".$i[1]."','".$i[2]."','".subject($i[2],'title')."','".subject($i[2],'lec')."','".subject($i[2],'lab')."','".subject($i[2],'prereq')."','".$i[3]."','".$i[4]."','".$i[5]."','".$i[6]."','". classLoadStudents($ay,$sem,$i[1])."']},\n";
	}
	
	echo "]}";
?>