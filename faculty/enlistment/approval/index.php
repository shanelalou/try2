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
			
			windowHeight = (($(window).height())/2 - 330);
		
			$('#grid').flexigrid({
				url: 'functions/list.php?student=<?php echo $_GET['student']?>',
				dataType: 'json',
				buttons: [
					{separator:true},
					{name: 'APPROVE', bclass: 'add',onpress: function(){
						items = "";
						item = $('.trSelected :nth-child(1) > div');
						
						$.each(item, function(i){
							items += item[i].innerHTML + ",";
						});
						
						if(items.length == 0){
							alert('Select the subjects to be approve.');
						}else {
							$.ajax({
								type: 'POST',
								url: 'functions/approve.php',
								data: { 
									subjects: items ,
									student: '<?php echo $_GET['student']?>',
								},
								success: function(i){
									$('#grid').flexReload();
								}
							});
						}
					}},{separator:true},{separator:true},
					{name: 'DISAPPROVE', bclass: 'delete',onpress:function(){
						items = "";
						item = $('.trSelected :nth-child(1) > div');
						
						$.each(item, function(i){
							items += item[i].innerHTML + ",";
						});
						
						if(items.length == 0){
							alert('Select the subjects to be approve.');
						}else {
							reason = prompt("Reason of disapproval:");

							$.ajax({
								type: 'POST',
								url: 'functions/disapprove.php',
								data: { 
									subjects: items ,
									student: '<?php echo $_GET['student']?>',
									notes: reason,
								},
								success: function(i){
									$('#grid').flexReload();
								}
							});
						}
					
					
					}},{separator:true},{separator:true},
					{name: 'DELETE', bclass: 'delete', onpress: function(){
						items = "";
						item = $('.trSelected :nth-child(1) > div');
						$.each(item, function(i){
							items += item[i].innerHTML + ",";
						});
						
						$.ajax({
							type: 'POST',
							url: 'functions/delete.php',
							data: { 
								subjects: items ,
								student: '<?php echo $_GET['student']?>',
							},
							success: function(i){
								$('#grid').flexReload();
								$('#recommended').flexReload();
							}
						});
					
					}},{separator:true},
				],
				colModel : [
					{display: 'SUBJECT CODE', name : 'col', width : 120, align: 'center'},
					{display: 'SUBJECT TITLE', name : 'col', width : 400, align: 'center'},
					{display: 'LEC.', name : 'col', width : 50, align: 'center'},
					{display: 'LAB.', name : 'col', width : 50, align: 'center'},
					{display: 'PREREQUISITE', name : 'col', width : 150, align: 'center'},
					{display: 'TIME', name : 'col', width : 100, align: 'center'},
					{display: 'STATUS', name : 'col', width : 100, align: 'center'},
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
				pagestat: 'Total: {total} Subjects',
				nomsg: 'No pending enlistments.',
				title: 'ENLISTMENT : <span><?php echo strtoupper(student($_GET['student'],'lastname').', '.student($_GET['student'],'firstname').' '.student($_GET['student'],'middlename')) ?></span> - <span><?php echo strtoupper(student($_GET['student'],'course').' - '.student($_GET['student'],'year')) ?></span> - <span><?php echo strtoupper(enlistment('sem')).' - '.enlistment('ay') ?></span>',
				height: windowHeight
			});
			
			
			$('#recommended').flexigrid({
				url: 'functions/recommended.php?student=<?php echo $_GET['student']?>',
				dataType: 'json',
				buttons: [
					{separator:true},
					{name: 'ADD', bclass: 'add',onpress: function(){
						reason = prompt("Reason:");
						items = "";
						item = $('.trSelected :nth-child(1) > div');
						
						$.each(item,function(i){
							items += item[i].innerHTML + ",";
						});
						
						$.ajax({
							type: 'POST',
							url: 'functions/add.php',
							data: {
								subjects: items,
								student: <?php echo $_GET['student'] ?>,
								reason: reason
							},
							success: function(i){
								$('#grid').flexReload();
								$('#recommended').flexReload();
							},
						});
					}},{separator:true},
				
				],
				colModel : [
					{display: 'SUBJECT CODE', name : 'col', width : 120, align: 'center'},
					{display: 'SUBJECT TITLE', name : 'col', width : 400, align: 'center'},
					{display: 'LEC.', name : 'col', width : 50, align: 'center'},
					{display: 'LAB.', name : 'col', width : 50, align: 'center'},
					{display: 'PREREQUISITE', name : 'col', width : 150, align: 'center'},
				],
				searchitems : [
					{display: '', name : ''},
				],
				usepager: true,
				pagestat: 'Total: {total} Recommended Subjects',
				nomsg: 'No recommended subjects.',
				title: '<span>Other Recommended Subjects</span>',
				height: windowHeight
			});
			
			$('.sDiv2 :nth-child(2),.pDiv2 :nth-child(3),.pDiv2 :nth-child(4),.pDiv2 :nth-child(5),.pDiv2 :nth-child(6),.pDiv2 :nth-child(7),.pDiv2 :nth-child(8),.pDiv2 :nth-child(9)').hide();
			
			setInterval(function(){
				item = $('tbody tr :nth-child(7) > div');
				item2 = $('tbody tr :nth-child(6) > div');
				item3 = $('tbody tr :nth-child(5) > div');
				item4 = $('tbody tr :nth-child(4) > div');
				item5 = $('tbody tr :nth-child(3) > div');
				item6 = $('tbody tr :nth-child(2) > div');
				item7 = $('tbody tr :nth-child(1) > div');
				
				$.each(item,function(i){
					if(item[i].innerHTML=="Approved"){
						$(item[i]).css('color','green');
						$(item2[i]).css('color','green');
						$(item3[i]).css('color','green');
						$(item4[i]).css('color','green');
						$(item5[i]).css('color','green');
						$(item6[i]).css('color','green');
						$(item7[i]).css('color','green');
					}else if(item[i].innerHTML=="Disapproved"){
						$(item[i]).css('color','red');
						$(item2[i]).css('color','red');
						$(item3[i]).css('color','red');
						$(item4[i]).css('color','red');
						$(item5[i]).css('color','red');
						$(item6[i]).css('color','red');
						$(item7[i]).css('color','red');
					}
				});
			},1);
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

	<div class="page-content">
		<table id="grid"></table>
		<table id="recommended"></table>
	</div>
	
	<div class="footer"></div>
</body>
</html>