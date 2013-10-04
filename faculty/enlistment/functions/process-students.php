<?php include '../../../config.php';?>
<?php
	$courses = mysql_query("select course from subject group by course");
	
	while($course = mysql_fetch_array($courses)){
		echo $course[0].'<br>';
		$classes = mysql_query("select course,year,block,time from class_schedule where course='".$course[0]."' group by course,year,block");
		while($class = mysql_fetch_array($classes)){
			echo '-'.$class[0].' - '.$class[1].'-'.$class[2].' - '.strtoupper($class[3]).'<br>';
			
			$cl = mysql_query("select subject_code,class_code from class_schedule where course='".$class[0]."' and year='".$class[1]."' and block='".$class[2]."'");
			while($c = mysql_fetch_array($cl)){
				echo '---'.$c[0].' - '.$c[1].'<br>';
				$enlistments = mysql_query("select student_id,course_code from enlistment where status='Approved' and time='".$class[3]."'");
				while($enlistment = mysql_fetch_array($enlistments)){
					if($c[0]==$enlistment[1]){
						echo '---------'.$enlistment[0].' - '.$enlistment[1].'<br>';
						mysql_query("insert into class_schedule_student(class_code,student_number,academicyear,semester) 
									values('".$c[1]."','".$enlistment[0]."','".enlistment('academicyear')."','".enlistment('semester')."')");
					}
				}
			}
			
		}
	}
?>