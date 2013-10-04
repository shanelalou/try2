<?php include '../../../config.php' ?>
<!DOCTYPE html>
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
				url: 'functions/list.php?class=<?php echo $_GET['class']?>&ay=<?php echo $_GET['ay']?>&sem=<?php echo $_GET['sem']?>',
				dataType: 'json',
				buttons: [
					<?php if($_GET['ay']==enlistment('ay') and $_GET['sem']==sem('1',enlistment('sem'))){ ?>
					
					{separator:true},
					{name: 'UPLOAD STUDENTS', bclass: 'add', onpress: function(){
						if($('#grid').html()==""){
							window.location = 'upload/?class=<?php echo $_GET['class'] ?>';
						}else{
							alert('Students are already uploaded.');
						}
					}},
					{separator:true},{separator:true},
					
					{name: 'UPDATE STUDENTS', bclass: 'add', onpress: function(){
						window.location = 'update/?class=<?php echo $_GET['class'] ?>';
					}},
					{separator:true},{separator:true},
					
					{name: 'DELETE', bclass: 'delete', onpress: function(){
						items = "";
						item = $('.trSelected :nth-child(1) > div');
						$.each(item,function(i){
							items += item[i].innerHTML + ',';
						});
						if(item.length>0){
							conf = confirm('Are you sure you want to delete '+ item.length +' student.\nIt will also delete grades of this student in this subject.');
							if(conf==true){
								$.ajax({
									type: 'POST',
									url: 'functions/delete.php',
									data: { students: items, classcode: '<?php echo $_GET['class'] ?>' },
									success: function(i){
										$('#grid').flexReload();
									}
								});
							}
						}else{
							alert('Select a student.');
						}
					}},
					{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},
					
					{name: 'UPLOAD PRELIM', bclass: 'add', onpress: function(){
						window.location = 'prelim/?class=<?php echo $_GET['class'] ?>';
					}},
					{separator:true},{separator:true},
					{name: 'UPLOAD MIDTERM', bclass: 'add', onpress: function(){
						window.location = 'midterm/?class=<?php echo $_GET['class'] ?>';	
					}},
					{separator:true},{separator:true},
					{name: 'UPLOAD FINAL', bclass: 'add', onpress: function(){
						window.location = 'final/?class=<?php echo $_GET['class'] ?>';
					}},
					{separator:true},
					{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},{separator:true},
					<?php } ?>
					{separator:true},
					{name: 'PRINT', bclass: 'add', onpress: function(){
							window.open('print.php?class=<?php echo $_GET['class']?>','','status=1,scrollbars=1, width=900,height=500');
					}},
					{separator:true},
				],
				colModel : [
					{display: 'STUDENT NUMBER', name : 'col', width : 100, align: 'center'},
					{display: 'NAME', name : 'col', width : 240, align: 'left'},
					{display: 'COURSE', name : 'col', width : 110, align: 'center', hide: true },
					{display: 'CURRICULUM', name : 'col', width : 120, align: 'center', hide: true },
					{display: 'YEAR LEVEL', name : 'col', width : 130, align: 'center', hide: true },
					{display: 'PRELIM', name : 'col', width : 60, align: 'left'},
					{display: 'P. ABSENT', name : 'col', width : 60, align: 'left'},
					{display: 'MIDTERM', name : 'col', width : 60, align: 'left'},
					{display: 'M. ABSENT', name : 'col', width : 60, align: 'left'},
					{display: 'FINAL', name : 'col', width : 60, align: 'left'},
					{display: 'F. ABSENT', name : 'col', width : 60, align: 'left'},
					{display: 'EQUIV.', name : 'col', width : 70, align: 'left'},
					{display: 'REMARKS', name : 'col', width : 160, align: 'left'},
				],
				searchitems : [
					{display: 'Student Number', name : 'a.subject_code'}
				],
				usepager: true,
				pagestat: 'Displaying {total} Students',
				nomsg: 'No student on list.',
				title: 'CLASS STUDENTS : <span><?php echo $_GET['class'] ?></span>',
				height: windowHeight
			});
			$('.sDiv2 :nth-child(2),.pDiv2 :nth-child(2),.pDiv2 :nth-child(3),.pDiv2 :nth-child(4),.pDiv2 :nth-child(5),.pDiv2 :nth-child(6),.pDiv2 :nth-child(7),.pDiv2 :nth-child(8),.pDiv2 :nth-child(9)').hide();
		
			setInterval(function(){
				item = $('tbody > tr :nth-child(13) > div');
				$.each(item,function(i){
					if(item[i].innerHTML=="Passed"){
						$(item[i]).css('color','green');
					}else{
						$(item[i]).css('color','red');
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
					<?php
						$pos = explode(' ',faculty($_SESSION['faculty'],'position'));
							if($pos[0]=="BSIT" or $pos[0]=="BSCS" or $pos[0]=="ACT"){
							echo '<li><a href="../../enlistment">ENLISTMENT</a></li>';
							}
					?>
					<li><a href="../../classes">CLASS LOADS</a></li>
					<li><a href="../../logout.php">LOGOUT</a></li>
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