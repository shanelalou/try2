<!DOCTYPE html>
<?php
	if(isset($_FILES['file'])){
		move_uploaded_file($_FILES['file']['tmp_name'],'files/students.csv');
	}
?>
<html>
<head>
	<title>Administrator</title>
	<link rel="icon" type="image/png" href="../../../../source/images/icon.png">
	<link rel="stylesheet" type="text/css" href="../../../../source/styles/flexigrid.css">
	<link rel="stylesheet" type="text/css" href="../../../../source/styles/style.css">
	<script type="text/javascript" src="../../../../source/scripts/flexigrid.pack.js"></script>
	<script type="text/javascript" src="../../../../source/scripts/flexigrid.js"></script>
	<script>
		$(document).ready(function(){
			
			windowHeight = $(window).height() - 330;
		
			$('#grid').flexigrid({
				url: 'functions/list.php',
				dataType: 'json',
				buttons : [
					{separator:true},
					{name: '<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" id="form" enctype="multipart/form-data">CHOOSE (.csv) FILE<input type="file" name="file" id="file" style="width:140px;opacity:0;margin-left:-140px;"></form>', bclass: 'add', onpress : function(){  } },{separator:true},{separator:true},
					{name: 'SAVE', bclass: 'add', onpress: function(){
						$.ajax({
							url: 'functions/save.php',
							success: function(){
								alert('Classes schedules successfully saved.');
								window.location = '../../class';
							}
						});
					}},
					{separator:true},
				],
				colModel : [
					{display: 'COURSE', name : 'col', width : 100, align: 'center'},
					{display: 'CURRICULUM', name : 'col', width : 100, align: 'center'},
					{display: 'YEAR LEVEL', name : 'col', width : 60, align: 'center'},
					{display: 'BLOCK', name : 'col', width : 50, align: 'center'},
					{display: 'CLASS CODE', name : 'col', width : 70, align: 'center'},
					{display: 'SUBJECT CODE', name : 'col', width : 80, align: 'center'},
					{display: 'DAY', name : 'col', width : 40, align: 'center'},
					{display: 'START TIME', name : 'col', width : 80, align: 'center'},
					{display: 'END TIME', name : 'col', width : 80, align: 'center'},
					{display: 'ROOM', name : 'col', width : 40, align: 'center'},
					{display: 'INSTRUCTOR', name : 'col', width : 200, align: 'center'},
					{display: 'TIME', name : 'col', width : 100, align: 'center'},
				],
				searchitems : [
					{display: 'Student Number', name : 'a.subject_code'}
				],
				usepager: true,
				pagestat: 'Total : {total} Classes',
				nomsg: 'No students on list.',
				title: 'UPLOAD CLASS SCHEDULES',
				height: windowHeight
			});
			$('.sDiv2 :nth-child(2),.pDiv2 :nth-child(2),.pDiv2 :nth-child(3),.pDiv2 :nth-child(4),.pDiv2 :nth-child(5),.pDiv2 :nth-child(6),.pDiv2 :nth-child(7),.pDiv2 :nth-child(8),.pDiv2 :nth-child(9)').hide();
			
			$('#file').change(function(){
				$('#form').submit();
			});
			
			$('#save').click(function(){
				$.ajax({ url: 'functions/save.php'});
				window.location = '../../students';
			});
		
		});

	</script>
</head>
<body>

	<div class="head">
		<div class="wraper">
			<div class="head-logo"></div>
			<div class="head-label">
				<div class="center" style="font-size:18px">COLLEGE OF COMPUTER STUDIES</div>
				<div class="center" style="font-size:15px">COURSE ENLISTMENT</div>
			</div>
			<div class="menu">
				<ul>
					<li><a href="../../../curriculum">CURRICULUM</a></li>
					<li><a href="../../../faculty">FACULTY</a></li>
					<li><a href="../../../students">STUDENT</a></li>
					<li><a href="../../../enlistment">ENLISTMENT</a></li>
					<li><a href="../../../logout.php">LOGOUT</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="title"></div>
	<div class="page-content"><table id="grid"></table></div>
	<div class="footer"></div>
	
</body>
</html>