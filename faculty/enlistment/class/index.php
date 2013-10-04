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
				url: 'functions/list.php',
				dataType: 'json',
				buttons: [
					{separator:true},
					{name: 'SHOW SUBJECTS', bclass: 'add', onpress: function(){
						item = $('.trSelected :nth-child(1) > div');item2 = $('.trSelected :nth-child(2) > div');

						if(item.length == 0){
							alert('Select a block.');
						}else{
							item2 = item2[0].innerHTML;item2 = item2.replace(/ /g,'');item2 = item2.split('-');
							course = item[0].innerHTML;
							year = item2[0];
							block = item2[1];
							
							window.location= 'subjects/?course='+ course +'&year='+ year +'&block='+block;
						}
					}},{separator:true},{separator:true},
					{name: 'SHOW STUDENTS', bclass: 'add', onpress: function(){
						item = $('.trSelected :nth-child(1) > div');item2 = $('.trSelected :nth-child(2) > div');
						if(item.length == 0){
							alert('Select a block.');
						}else{
							item2 = item2[0].innerHTML;item2 = item2.replace(/ /g,'');item2 = item2.split('-');
							course = item[0].innerHTML;
							year = item2[0];
							block = item2[1];
							
							window.location= 'students/?course='+ course +'&year='+ year +'&block='+block;
							
						}
					}},{separator:true},{separator:true},
					{name: 'UPLOAD CLASSES', bclass: 'add',onpress: function(){
							window.location = 'upload';

					}},{separator:true},{separator:true},
					{name: 'DELETE', bclass: 'delete',onpress: function(){
						items = "";item = $('.trSelected :nth-child(1) > div');item2 = $('.trSelected :nth-child(2) > div');

						for(i=0; i < item.length; i++){
							
							yearblock =  item2[i].innerHTML;
							yearblock = yearblock.replace(/ /g,'');
							yearblock = yearblock.split('-');

							course = item[i].innerHTML;
							year = yearblock[0];
							block = yearblock[1];
							
							items += course + ',' + year + ',' + block + '|';
							
						}
						
						if(item.length !=0){
							$.ajax({
								type: 'POST',
								url: 'functions/delete.php',
								data: { classes: items },
								success: function(i){
									$('#grid').flexReload();
								}
							});
						}
						
						
					}},{separator:true},
				],
				colModel : [
					{display: 'COURSE', name : 'col', width : 100, align: 'center'},
					{display: 'YEAR & BLOCK', name : 'col', width : 100, align: 'center'},
					{display: 'TIME', name : 'col', width : 100, align: 'center'},
					{display: 'SUBJECTS', name : 'col', width : 100, align: 'center'},
					{display: 'STUDENTS', name : 'col', width : 100, align: 'center'},
				],
				searchitems : [
					{display: '', name : ''},
				],
				usepager: true,
				pagestat: 'Total: {total} Blocks',
				nomsg: 'No class schedules.',
				title: 'CLASS SCHEDULES : <span><?php echo strtoupper(enlistment('semester')).' - '.enlistment('academicyear')?></span>',
				height: windowHeight
			});
			$('.sDiv2 :nth-child(2),.pDiv2 :nth-child(3),.pDiv2 :nth-child(4),.pDiv2 :nth-child(5),.pDiv2 :nth-child(6),.pDiv2 :nth-child(7),.pDiv2 :nth-child(8),.pDiv2 :nth-child(9)').hide();
			
			setInterval(function(){
				item = $(' :nth-child(1) > div');
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
	<div class="page-content"><table id="grid"></table></div>
	<div class="footer"></div>
	
</body>
</html>