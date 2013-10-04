<?php include '../../config.php' ?>
<!DOCTYPE html>
<html>
<head>
	<title>Student</title>
	
<!--icon -->
<link rel="shortcut icon" href="../../images/icon.png">
<!---------------->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" href="../../styles/layout.css" type="text/css" />
	<style>
		* {
			font-size:14px;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="../../source/styles/flexigrid.css">
	<link rel="stylesheet" type="text/css" href="../../source/styles/style.css">
	<script type="text/javascript" src="../../source/scripts/flexigrid.pack.js"></script>
	<script type="text/javascript" src="../../source/scripts/flexigrid.js"></script>
	<script>
		$(function(){
			
			windowHeight = $(window).height() - 10;
			$('#grid').flexigrid({
				url: 'functions/list.php',
				dataType: 'json',
				colModel : [
					{display: 'SUBJECT CODE', name : 'SubjectCode', width : 80, align: 'center'},
					{display: 'SUBJECT TITLE', name : 'SubjectTitle', width : 250, align: 'center'},
					{display: 'LEC.', name : 'Lec', width : 0, align: 'left' ,hide:true },
					{display: 'LAB.', name : 'Lab', width : 0, align: 'left' ,hide:true },
					{display: 'PREREQUISITE', name : 'Prerequisite', width : 0, align: 'left' ,hide:true},
					{display: 'YEAR', name : 'Year', width : 40, align: 'left' ,hide:true},
					{display: 'SEM.', name : 'Sem', width : 40, align: 'left' ,hide:true},
					{display: 'PRELIM GRADE', name : 'Prelim', width : 70, align: 'left' ,hide:true },
					{display: 'PRELIM ABS.', name : 'Absences', width : 70, align: 'left' ,hide:true },
					{display: 'MIDTERM GRADE', name : 'Midterm', width : 70, align: 'left' ,hide:true },
					{display: 'MIDTERM ABS.', name : 'Absences', width : 70, align: 'left' ,hide:true },
					{display: 'FINAL GRADE', name : 'Grade', width : 50, align: 'left'},
					{display: 'FINAL ABS.', name : 'Grade', width : 70, align: 'left' ,hide:true },
					{display: 'TOTAL ABS.', name : 'TotalAbsences', width : 70, align: 'left' ,hide:true },
					{display: 'EQUIV.', name : 'Equiv', width : 40, align: 'left'},
					{display: 'REMARKS', name : 'Remarks', width : 90, align: 'left'},
					{display: 'INSTRUCTOR', name : 'Instructor', width : 150, align: 'left'},
					{display: 'CLASS CODE', name : 'ClassCode', width : 80, align: 'left' ,hide:true },
					{display: 'DAY', name : 'Time', width : 80, align: 'left' ,hide:true },
					{display: 'TIME', name : 'Time', width : 100, align: 'left' ,hide:true },
					{display: 'ROOM', name : 'Room', width : 40, align: 'left' ,hide:true },
					{display: 'ACADEMIC YEAR', name : 'AcademicYear', width : 90, align: 'left' ,hide:true },
					{display: 'SEMESTER', name : 'Semester', width : 50, align: 'left' ,hide:true }
				],
				usepager: true,
				searchitems : [
					{display: 'Subject Code', name : 'a.subject_code'}
				],
				pagestat: 'Displaying {total} Records',
				nomsg: 'Search has no results.',
				title: 'GRADES',
				height: windowHeight
			});
			
			$('.sDiv2 :nth-child(2),.pDiv2 :nth-child(2),.pDiv2 :nth-child(3),.pDiv2 :nth-child(4),.pDiv2 :nth-child(5),.pDiv2 :nth-child(6),.pDiv2 :nth-child(7),.pDiv2 :nth-child(8),.pDiv2 :nth-child(9)').hide();

			setInterval(function(){
				var items = $('tr :nth-child(16) > div');
				$.each(items,function(i){
					//console.log(items[i].innerHTML);
					if(items[i].innerHTML=="Passed"){
						$(items[i]).css('color','green');
					}else if(items[i].innerHTML=="&nbsp;" || items[i].innerHTML=="" || items[i].innerHTML=="REMARKS"){
						$(items[i]).css('color','');
					}else{
						$(items[i]).css('color','red');
					}
				});
			},1);
		});
	</script>
</head>

<body >

      <div id="content">
	  			<h1><font><?php echo $_SESSION['student'].' - '.student($_SESSION['student'],"lastname").", ".student($_SESSION['student'],"firstname").", ".student($_SESSION['student'],"middlename")." - ".student($_SESSION['student'],"course")." ".student($_SESSION['student'],"year"); ?></font> 	<a href="../logout.php">LOGOUT</a></h1>
	
	<div ><table id="grid"></table></div>
			
        
       
        </div>
       
      
</body>
</html>