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
		
			windowHeight = $(window).height() - 330;
			
			$('#grid').flexigrid({
				url: 'functions/list.php?course=<?php echo $_GET['course']?>&curriculum=<?php echo $_GET['curriculum']?>',
				dataType: 'json',
				buttons: [
					{separator:true},
					{name: 'SHOW SUBJECTS', bclass: 'add',onpress: function(){
						item = $('.trSelected :nth-child(1) > div');
						
						window.location = '../approval/?student='+item[0].innerHTML;
					}},{separator:true},
				],
				colModel : [
					{display: 'STUDENT NUMBER', name : 'col', width : 120, align: 'center'},
					{display: 'LAST NAME', name : 'col', width : 150, align: 'center'},
					{display: 'FIRST NAME', name : 'col', width : 150, align: 'center'},
					{display: 'MIDDLE NAME', name : 'col', width : 150, align: 'center'},
					{display: 'COURSE', name : 'col', width : 90, align: 'center'},
					{display: 'YEAR LEVEL', name : 'col', width :95, align: 'center'},
					{display: 'TIME', name : 'col', width : 95, align: 'center'},
					{display: 'SUBJECTS', name : 'col', width : 75, align: 'center'},
				],
				searchitems : [
					{display: '', name : ''},
					{display: 'Morning', name : 'm'},
					{display: 'Afternoon', name : 'a'},
					{display: 'Evening', name : 'e'},
					{display: '', name : ''},
					{display: 'First Year', name : '1'},
					{display: 'Second Year', name : '2'},
					{display: 'Third Year', name : '3'},
					{display: 'Fourth Year', name : '4'},
					{display: '', name : ''},
					{display: 'First Year - Morning', name : '1m'},
					{display: 'First Year - Afternoon', name : '1a'},
					{display: 'First Year - Evening', name : '1e'},
					{display: '', name : ''},
					{display: 'Second Year - Morning', name : '2m'},
					{display: 'Second Year - Afternoon', name : '2a'},
					{display: 'Second Year - Evening', name : '2e'},
					{display: '', name : ''},
					{display: 'Third Year - Morning', name : '3m'},
					{display: 'Third Year - Afternoon', name : '3a'},
					{display: 'Third Year - Evening', name : '3e'},
					{display: '', name : ''},
					{display: 'Fourth Year - Morning', name : '4m'},
					{display: 'Fourth Year - Afternoon', name : '4a'},
					{display: 'Fourth Year - Evening', name : '4e'},
				],
				usepager: true,
				pagestat: 'Total: {total} Students',
				nomsg: 'No approved enlistments.',
				title: 'APPROVED ENLISTMENT : <span><?php echo strtoupper(enlistment('sem').' - '.enlistment('ay'))?></span>',
				height: windowHeight
			});
			$('input[value=Clear],.qsbox,.pDiv2 :nth-child(2),.pDiv2 :nth-child(3),.pDiv2 :nth-child(4),.pDiv2 :nth-child(5),.pDiv2 :nth-child(6),.pDiv2 :nth-child(7),.pDiv2 :nth-child(8),.pDiv2 :nth-child(9)').hide();
		
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
							echo '<li><a href="../../enlistment">ENLISTMENT</a></li>';
							}
					?>
					<li><a href="../../class">CLASS LOADS</a></li>
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