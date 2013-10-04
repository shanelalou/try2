<?php include '../../../../config.php' ?>
<?php
	header("Content-type: text/x-json; charset=ISO-8");
	$classes = explode('|',substr($_POST['classes'],0,-1));
	
	foreach($classes as $i){
		$class = explode(',',$i);
		$qry = mysql_query("select a.class_code 
			from class_schedule_student as a inner join class_schedule as b 
			where b.course='".filt($class[0])."' and b.year='".filt($class[1])."' and b.block='".filt($class[2])."' and b.academicyear='".enlistment('academicyear')."' and b.semester='".enlistment('semester')."'");
		
		while($r=mysql_fetch_array($qry)){
			mysql_query("delete from class_schedule_student where class_code='' and academicyear='".enlistment('academicyear')."' and semester='".enlistment('semester')."'");
		}
		
		mysql_query("delete from class_schedule where course='".filt($class[0])."' and year='".filt($class[1])."' and block='".filt($class[2])."' and academicyear='".enlistment('academicyear')."' and semester='".enlistment('semester')."'");
	}
?>