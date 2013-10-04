<?php include '../../../../config.php' ?>
<?php
	if(isset($_FILES['file'])){
		move_uploaded_file($_FILES['file']['tmp_name'],'files/'.$_SESSION['faculty'].'-final.csv');
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Course Enlistment</title>
	<link rel="stylesheet" type="text/css" href="../../../../source/styles/flexigrid.css">
	<link rel="stylesheet" type="text/css" href="../../../../source/styles/style.css">
	<script type="text/javascript" src="../../../../source/scripts/flexigrid.pack.js"></script>
	<script type="text/javascript" src="../../../../source/scripts/flexigrid.js"></script>
	<script>
		$(document).ready(function(){
		
			windowHeight = $(window).height() - 330;
			
			$('#grid').flexigrid({
				url: 'functions/list.php?class=<?php echo $_GET['class'] ?>',
				dataType: 'json',
				buttons: [
					{separator:true},
					{name: '<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>?class=<?php echo $_GET['class']?>" id="form" enctype="multipart/form-data">CHOOSE (.csv) FILE<input type="file" name="file" id="file" style="width:140px;opacity:0;margin-left:-140px;"></form>', bclass: 'add', onpress: function(){
					
					}},
					{separator:true},{separator:true},
					{name: 'SAVE', bclass: 'add', onpress: function(){
						$.ajax({
							url: 'functions/save.php?class=<?php echo $_GET['class'] ?>',
							success: function(i){
								alert('Students successfully saved.');
								window.location = '../?class=<?php echo $_GET['class'] ?>&ay=<?php echo enlistment('ay') ?>&sem=<?php echo sem('1',enlistment('sem')) ?>';
							}
						});
					}},
					{separator:true},
				],
				colModel : [
					{display: 'STUDENT #', name : 'col', width : 100, align: 'center'},
					{display: 'NAME', name : 'col', width : 240, align: 'left'},
					{display: 'GRADE', name : 'col', width : 70, align: 'center'},
					{display: 'ABSENCES', name : 'col', width : 70, align: 'center'},
					{display: 'STATUS', name : 'col', width : 190, align: 'left'},
				],
				searchitems : [
					{display: 'Student Number', name : 'a.subject_code'}
				],
				usepager: true,
				pagestat: 'Total: {total} Students',
				nomsg: 'No student on list.',
				title: 'UPLOAD MIDTERM GRADES : <span>AY: <?php echo enlistment('ay')?> - <?php echo strtoupper(enlistment('sem')) ?></span>',
				height: windowHeight
			});
			
			$('#file').change(function(){
				$('#form').submit();
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
					<li><a href="../classes">CLASS LOADS</a></li>

					<li><a href="../logout.php">LOGOUT</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="title">
		<div class="wraper">
			<div class="right" style="font-size:15px"></div>
		</div>
	</div>

	<div class="page-content">
		<table id="grid"></table>
	</div>
	
	<div class="footer"></div>
</body>
</html>