<!DOCTYPE html>
<?php
	if(isset($_FILES['file'])){
		move_uploaded_file($_FILES['file']['tmp_name'],'files/students.csv');
	}
?>
<html>
<head>
	<title>Coordinator</title>
	<link rel="icon" type="image/png" href="../../../../source/images/icon.png">
	<link rel="stylesheet" type="text/css" href="../../../../source/styles/flexigrid.css">
	<link rel="stylesheet" type="text/css" href="../../../../source/styles/style.css">
	<script type="text/javascript" src="../../../../source/scripts/flexigrid.pack.js"></script>
	<script type="text/javascript" src="../../../../source/scripts/flexigrid.js"></script>
	<script>
		$(document).ready(function(){
		
			windowHeight = $(window).height() - 330;
		
			$('#grid').flexigrid({
				url: 'functions/list.php?course=<?php echo $_GET['course'] ?>&year=<?php echo $_GET['year'] ?>&block=<?php echo $_GET['block'] ?>',
				dataType: 'json',
				buttons : [
					{separator:true},
					{name: 'SHOW SUBJECTS', bclass: 'add', onpress: function(){
						item = $('.trSelected :nth-child(1) > div');
						window.location = 'subjects/?course=<?php echo $_GET['course'] ?>&year=<?php echo $_GET['year'] ?>&block=<?php echo $_GET['block'] ?>&student='+item[0].innerHTML;
					}},{separator:true},{separator:true},
					{name: 'PRINT', bclass: 'add', onpress: function(){
						window.open('print.php?course=<?php echo $_GET['course'] ?>&year=<?php echo $_GET['year'] ?>&block=<?php echo $_GET['block'] ?>','','status=1,scrollbars=1, width=900,height=500');
					}},
					{separator:true},
				],
				colModel : [
					{display: 'STUDENT NUMBER', name : 'col', width : 120, align: 'center'},
					{display: 'LAST NAME', name : 'col', width : 170, align: 'center'},
					{display: 'FIRST NAME', name : 'col', width : 170, align: 'center'},
					{display: 'MIDDLE NAME', name : 'col', width : 170, align: 'center'},
					{display: 'COURSE', name : 'col', width : 100, align: 'center'},
					{display: 'YEAR LEVEL', name : 'col', width : 120, align: 'center'},
					{display: 'SUBJECTS', name : 'col', width : 100, align: 'center'},

				],
				searchitems : [
					{display: 'Student Number', name : 'a.subject_code'}
				],
				usepager: true,
				pagestat: 'Total : {total} Students',
				nomsg: 'No students on list.',
				title: 'STUDENTS : <span><?php echo $_GET['course'].' '.$_GET['year'].'-'.$_GET['block'] ?></span>',
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