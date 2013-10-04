<?php include '../../../config.php' ?>
<!DOCTYPE html>
<html>
<head>
	<title>Coordinator</title>
	<link rel="icon" type="image/png" href="../../../source/images/icon.png">
	<link rel="stylesheet" type="text/css" href="../../../source/styles/flexigrid.css">
	<link rel="stylesheet" type="text/css" href="../../../source/styles/style.css">
	<script type="text/javascript" src="../../../source/scripts/flexigrid.pack.js"></script>
	<script type="text/javascript" src="../../../source/scripts/flexigrid.js"></script>
	<script>
		$(document).ready(function(){
		
			windowHeight = $(window).height()- 330;
		
			$('#grid').flexigrid({
				url: 'functions/list.php?course=<?php echo $_GET['course']?>&curriculum=<?php echo $_GET['curriculum']?>',
				dataType: 'json',
				buttons: [
					{separator:true},
					{name: 'SHOW SUBJECTS', bclass: 'add',onpress: function(){
						item = $('.trSelected :nth-child(1) > div');
						
						window.location = '../approval/?student='+item[0].innerHTML;
					}},{separator:true},{separator:true},
					
					{name: 'SAVE AS EXCEL', bclass: 'add',onpress: function(){
						item = $('.trSelected :nth-child(1) > div');
						$.ajax({
							url: 'functions/saveasexcel.php?course=<?php echo $_GET['course']?>&curriculum=<?php echo $_GET['curriculum']?>',
							success: function(){
								window.location = 'files/ENLISTMENT <?php echo strtoupper(enlistment('sem')).' '.enlistment('ay')?>.csv';
							}
						});
					}},
					{separator:true},{separator:true},
					
					{name: 'PRINT', bclass: 'add',onpress: function(){
						item = $('.trSelected :nth-child(1) > div');
						window.open('print.php?course=<?php echo $_GET['course']?>&curriculum=<?php echo $_GET['curriculum']?>','','status=1,scrollbars=1, width=900,height=500');

					}},
					{separator:true},
				],
				colModel : [
					{display: 'SUBJET CODE', name : 'col', width : 100, align: 'center'},
					{display: 'SUBJECT TITLE', name : 'col', width : 440, align: 'center'},
					{display: 'LEC.', name : 'col', width : 50, align: 'center'},
					{display: 'LAB.', name : 'col', width : 50, align: 'center'},
					{display: 'PREREQUISITE', name : 'col', width : 120, align: 'center'},
					{display: 'YEAR', name : 'col', width : 50, align: 'center'},
					{display: 'SEM.', name : 'col', width : 50, align: 'center'},
					{display: 'STUDENTS', name : 'col', width : 60, align: 'center'},
					{display: 'MORNING', name : 'col', width : 60, align: 'center'},
					{display: 'AFTERNOON', name : 'col', width : 70, align: 'center'},
					{display: 'EVENING', name : 'col', width : 60, align: 'center'},
				],
				searchitems : [
					{display: '', name : ''},
				],
				usepager: true,
				pagestat: 'Total: {total} Subjects',
				nomsg: 'No pending enlistments.',
				title: 'ENLISTMENT : <span>APPROVED PER SUBJECT</span>',
				height: windowHeight
			});
			$('.sDiv2 :nth-child(2),.pDiv2 :nth-child(2),.pDiv2 :nth-child(3),.pDiv2 :nth-child(4),.pDiv2 :nth-child(5),.pDiv2 :nth-child(6),.pDiv2 :nth-child(7),.pDiv2 :nth-child(8),.pDiv2 :nth-child(9)').hide();

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
					<li><a href="../../curriculum">CURRICULUM</a></li>
					<li><a href="../../faculty">FACULTY</a></li>
					<li><a href="../../students">STUDENT</a></li>
					<li><a href="../../enlistment">ENLISTMENT</a></li>
					<li><a href="../../logout.php">LOGOUT</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="title"></div>

	<div class="page-content"><table id="grid"></table></div>
	
	<div class="footer"></div>
</body>
</html>