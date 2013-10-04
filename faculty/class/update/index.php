<?php include '../../../table.class.php' ?>
<?php
	if(isset($_FILES['file'])){
		move_uploaded_file($_FILES['file']['tmp_name'],'files/'.$_SESSION['faculty'].'-classloads.csv');
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Course Enlistment</title>
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
					{name: '<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" id="form" enctype="multipart/form-data">CHOOSE (.csv) FILE<input type="file" name="file" id="file" style="width:140px;opacity:0;margin-left:-140px;"></form>', bclass: 'add', onpress: function(){
					
					}},
					{separator:true},{separator:true},
					{name: 'UPDATE', bclass: 'add', onpress: function(){
						$.ajax({
							url: 'functions/save.php',
							success: function(i){
								window.location = '../';
							}
						});
					}},
					{separator:true},
				],
				colModel : [
					{display: 'CLASS CODE', name : 'col', width : 100, align: 'center'},
					{display: 'SUBJECT CODE', name : 'col', width : 100, align: 'center'},
					{display: 'SUBJECT TITLE', name : 'col', width : 350, align: 'center'},
					{display: 'LEC.', name : 'col', width : 60, align: 'center'},
					{display: 'LAB.', name : 'col', width : 60, align: 'center'},
					{display: 'DAY', name : 'col', width : 75, align: 'center'},
					{display: 'START TIME', name : 'col', width : 75, align: 'center'},
					{display: 'END TIME', name : 'col', width : 75, align: 'center'},
					{display: 'ROOM', name : 'col', width : 75, align: 'center'},
					{display: 'STATUS', name : 'col', width : 200, align: 'left'},
				],
				searchitems : [
					{display: 'Student Number', name : 'a.subject_code'}
				],
				usepager: true,
				pagestat: 'Total: {total} Class Loads',
				nomsg: 'No Class Load.',
				title: 'UPDATE CLASS LOAD : <span>AY: <?php echo enlistment('ay').' '.enlistment('sem') ?></span><div style="float:right"><a href="CLASS LOAD FORMAT.csv" style="font-weight:normal">DOWNLOAD FORMAT</a></div>',
				height: windowHeight
			});
			
			$('#file').change(function(){
				file = $('#file').val().split('.');
				
				if(file[file.length - 1]=="csv"){
					$('#form').submit();
				}else{
					alert('Select a valid file.\nOnly (.csv) file are supported.');
				}
				
			});
			
			setInterval(function(){
				item = $('tbody > tr :nth-child(10) > div,tbody > tr :nth-child(9) > div,tbody > tr :nth-child(8) > div,tbody > tr :nth-child(7) > div,tbody > tr :nth-child(6) > div,tbody > tr :nth-child(5) > div,tbody > tr :nth-child(4) > div,tbody > tr :nth-child(3) > div,tbody > tr :nth-child(2) > div,tbody > tr :nth-child(1) > div');
				$.each(item,function(i){
					if(item[i].innerHTML == "Class Code already exist." || item[i].innerHTML == "Conflict time and room."){
						$(item).css('color','red');
					}
				});
				
					
			},1);
			
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
					<li><a href="../classes">CLASS LOADS</a></li>
					<li><a href="../logout.php">LOGOUT</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="title">
		<div class="wraper">
			<div class="right" style="font-size:15px"><?php echo $_SESSION['faculty'] ?></div>
		</div>
	</div>

	<div class="page-content">
		<table id="grid"></table>
	</div>
	
	<div class="footer"></div>
</body>
</html>
