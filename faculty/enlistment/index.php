<?php include '../../config.php' ?>
<!DOCTYPE html>
<html>
<head>
	<title>Coordinator</title>
	<link rel="icon" type="image/png" href="../../source/images/icon.png">
	<link rel="stylesheet" type="text/css" href="../../source/styles/flexigrid.css">
	<link rel="stylesheet" type="text/css" href="../../source/styles/style.css">
	<script type="text/javascript" src="../../source/scripts/flexigrid.pack.js"></script>
	<script type="text/javascript" src="../../source/scripts/flexigrid.js"></script>
	<script>
		$(document).ready(function(){
		
			windowHeight = $(window).height() - 330;
			
			$('#grid').flexigrid({
				url: 'functions/list.php',
				dataType: 'json',
				buttons: [
					{separator:true},
					{name: 'SHOW APPROVED', bclass: 'add', onpress: function(){
						item = $('.trSelected');
						course = $('.trSelected :nth-child(1) > div');
						curriculum = $('.trSelected :nth-child(3) > div');
						
						if(item.length==0){
							alert('Select a curriculum.');
						}else{
							window.location = 'approved/?course='+ course[0].innerHTML + '&curriculum=' + curriculum[0].innerHTML;
						}
					
					}},{separator:true},{separator:true},
					{name: 'SHOW PENDING', bclass: 'add', onpress: function(){
						item = $('.trSelected');
						course = $('.trSelected :nth-child(1) > div');
						curriculum = $('.trSelected :nth-child(3) > div');
						
						if(item.length==0){
							alert('Select a curriculum.');
						}else{
							window.location = 'pending/?course='+ course[0].innerHTML + '&curriculum=' + curriculum[0].innerHTML;
						}
					}},
					{separator:true},
				],
				colModel : [
					{display: 'COURSE', name : 'col', width : 120, align: 'center'},
					{display: 'COURSE TITLE', name : 'col', width : 500, align: 'center'},
					{display: 'CURRICULUM', name : 'col', width : 120, align: 'center'},
					{display: 'PENDING', name : 'col', width : 75, align: 'center'},
					{display: 'APPROVED', name : 'col', width : 75, align: 'center'},
					{display: 'REQUEST', name : 'col', width : 75, align: 'center'},
				],
				searchitems : [
					{display: 'Student Number', name : 'a.subject_code'}
				],
				usepager: true,
				pagestat: 'Total: {total} Curriculums',
				nomsg: 'No curriculum on list.',
				title: 'ENLISTMENT : <span><?php echo strtoupper(enlistment('sem').' - '.enlistment('ay'))?></span> - <span><?php echo strtoupper('SCHEDULE : '.date('F d, Y',strtotime(enlistment('start'))).' - '.date('F d, Y',strtotime(enlistment('end'))))?></span>',
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
					<?php
						$pos = explode(' ',faculty($_SESSION['faculty'],'position'));
							if($pos[0]=="BSIT" or $pos[0]=="BSCS" or $pos[0]=="ACT"){
							echo '<li><a href="../enlistment">ENLISTMENT</a></li>';
							}
					?>
					<li><a href="../class">CLASS LOADS</a></li>
					<li><a href="../logout.php">LOGOUT</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="title">
		<div class="wraper">
			<div class="right" style="font-size:15px"><?php echo $_SESSION['faculty'] ?> - <?php echo faculty($_SESSION['faculty'],'lastname').', '.faculty($_SESSION['faculty'],'firstname').' '.faculty($_SESSION['faculty'],'middlename').' - '.faculty($_SESSION['faculty'],'position') ?></div>
		</div>
	</div>
	<div class="page-content"><table id="grid"></table></div>
	<div class="footer"></div>
	
</body>
</html>