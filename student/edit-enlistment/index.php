<?php include '../../config.php';?>
<?php
	if(!isset($_SESSION['student'])){
		header("Location: ../");
	}
	
	$subjects = mysql_query("select * from renlistments where student='".$_SESSION['student']."' and ay='".enlistment('ay')."' and sem='".sem('1',enlistment('sem'))."' and status='Approved'");
	
	function lecunits(){
		$qry = mysql_query("select (b.lec) from renlistments as a inner join rsubjects as b on a.course_code=b.subject where a.student='".$_SESSION['student']."' and a.ay='".enlistment('ay')."' and a.sem='".sem('1',enlistment('sem'))."' and a.status='Approved' and b.curriculum='".student($_SESSION['student'],'curriculum')."' and b.course='".student($_SESSION['student'],'course')."'");
		$units = 0;
		if(mysql_num_rows($qry)>0){
			while($r=mysql_fetch_array($qry)){
				$units+=$r[0];
			}
		}
		
		return $units;
	}
	
	function labunits(){
		$qry = mysql_query("select (b.lab) from renlistments as a inner join rsubjects as b on a.course_code=b.subject where a.student='".$_SESSION['student']."' and a.ay='".enlistment('ay')."' and a.sem='".sem('1',enlistment('sem'))."' and a.status='Approved' and b.curriculum='".student($_SESSION['student'],'curriculum')."' and b.course='".student($_SESSION['student'],'course')."'");
		$units = 0;
		if(mysql_num_rows($qry)>0){
			while($r=mysql_fetch_array($qry)){
				$units+=$r[0];
			}
		}
		return $units;
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student</title>
	<link rel="icon" type="image/png" href="../../source/images/icon.png">
	<link rel="stylesheet" type="text/css" href="../../source/styles/flexigrid.css">
	<link rel="stylesheet" type="text/css" href="../../source/styles/style.css">
	<script type="text/javascript" src="../../source/scripts/flexigrid.pack.js"></script>
	<script type="text/javascript" src="../../source/scripts/flexigrid.js"></script>
	<script>
		$(function(){
			
			windowHeight = $(window).height() - 415;
		
			$('#tblenlist').flexigrid({
				url: 'functions/list.php',
				dataType: 'json',
				colModel : [
					{display: 'SUBJECT CODE', name : 'SubjectCode', width : 100, align: 'center'},
					{display: 'SUBJECT TITLE', name : 'SubjectTitle', width :420, align: 'center'},
					{display: 'LEC.', name : 'Lec', width : 50, align: 'left'},
					{display: 'LAB.', name : 'Lab', width : 50, align: 'left'},
					{display: 'PREREQUISITE', name : 'Prerequisite', width : 150, align: 'left'},
					{display: 'YEAR', name : 'Year', width : 60, align: 'left'},
					{display: 'SEM.', name : 'Sem', width : 60, align: 'left'},
				],
				searchitems : [
					{display: 'Subject Code', name : 'a.subject_code'}
				],
				pagestat: 'Displaying {total} Records',
				nomsg: 'Search has no results.',
				title: '' , //'SELECT THE SUBJECTS YOU WANT TO ENLIST',
				height: windowHeight
			});
			
			$('.sDiv2 :nth-child(2),.pDiv2 :nth-child(2),.pDiv2 :nth-child(3),.pDiv2 :nth-child(4),.pDiv2 :nth-child(5),.pDiv2 :nth-child(6),.pDiv2 :nth-child(7),.pDiv2 :nth-child(8),.pDiv2 :nth-child(9)').hide();
			$('#error').hide();
			$('table').click(function(){
				
				var subjects = <?php echo mysql_num_rows($subjects);?>;
				var lecunits = <?php echo lecunits()?>;
				var labunits = <?php echo labunits()?>;
				var items = $('.trSelected :nth-child(3) > div');
				var itemss = $('.trSelected :nth-child(4) > div');
				$.each(items,function(i){
					subjects+=1;
					lecunits += parseInt(items[i].innerHTML);
					labunits += parseInt(itemss[i].innerHTML);
				});
				if((lecunits + labunits)>30) $('#error').hide().fadeIn(1000).html("Please deselect other subjects. Units must not exceed to 30."); else $('#error').fadeOut(1000).html("");
				if(subjects>0) $('#subjects').html(subjects); else $('#subjects').html('0'); 
				if(lecunits>0) $('#lecunits').html(lecunits); else $('#lecunits').html('0'); 
				if(labunits>0) $('#labunits').html(labunits); else $('#labunits').html('0'); 
			});
			
			$('#enlist').click(function(){
				if($('#subjects').html()=="0")  $('#error').hide().fadeIn(1000).html("Please select the subjects you want to enlist.");
				else if($('#preferred-time').val()=="Select Preferred Time") $('#error').hide().fadeIn(1000).html("Please select your preferred time.");
				else if((parseInt($('#lecunits').html())+parseInt($('#labunits').html()))>30) $('#error').hide().fadeIn(1000).html("Please deselect other subjects. Units must not exceed to 30.");
				else {
					var sel = $('.trSelected :nth-child(1) > div');
					var list = "";
					$.each(sel,function(i){
						list = list + sel[i].innerHTML + ",";
					});
					$.ajax({
						type: "POST",
						url: "functions/save.php",
						data: {
							subjects: list,
							time: $('#preferred-time').val()
						},
						success: function(i){
							window.location = '../summary';
						}
					});
				}
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
					<li><a href="../enlistment">ENLISTMENT</a></li>
					<li><a href="../grades">GRADES</a></li>
					<li><a href="../logout.php">LOGOUT</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="title">
		<div class="wraper">
			<div class="left" style="font-size:15px"><?php echo $_SESSION['student'].' - '.student($_SESSION['student'],"lastname").", ".student($_SESSION['student'],"firstname").", ".student($_SESSION['student'],"middlename")." - ".student($_SESSION['student'],"course")." ".student($_SESSION['student'],"year"); ?></div>
		</div>
	</div>

	<div class="page-content">
			<!-- ------------------------------------------------------------ -->
			<div style="height:30px;">
				<div id="error" style="height:24px;padding:6px 0px 0px 10px;color:white;font-size:14px;background:url(../../source/images/red.png);border-radius:3px;border:1px solid #cd0a0a;"></div>
			</div>
			<div style="background:url(../../source/images/wbg.gif) repeat-x top;padding:8px 0px 8px 10px;margin-bottom:5px;font-size:15px;">
				COURSE ENLISTMENT FOR <?php echo strtoupper(enlistment("sem")." A-Y: ".strtoupper(enlistment("ay")))?>
			</div>
			<form action="summary.php" method="post" id="form">
			<div style="background:url(../../source/images/wbg.gif) repeat-x top;padding:8px 0px 8px 10px;">
				<span class="normal">PREFERRED TIME: </span>
				<select class="normal" id="preferred-time" name="preferred-time">
					<?php
					
					switch(enlistment_status($_SESSION['student'],'time')){
						case "MORNING" :
							echo '
							<option selected="selected">MORNING</option>
							<option>AFTERNOON</option>
							<option>EVENING</option>
							';break;
						case "AFTERNOON" :
							echo '
							<option>MORNING</option>
							<option selected="selected">AFTERNOON</option>
							<option>EVENING</option>
							';break;
						case "EVENING" :
							echo '
							<option>MORNING</option>
							<option>AFTERNOON</option>
							<option selected="selected">EVENING</option>
							';break;
						default :
							echo '
							<option selected="selected">MORNING</option>
							<option>AFTERNOON</option>
							<option>EVENING</option>
							';break;
						
					}
					?>
				</select>
			</div>
			<div style="margin-top:5px;">
				<table id="tblenlist" style="display:none"></table>
			</div>
			<div>
				<table border="1" bordercolor="cccccc" style="border-collapse:collapse;display:inline-block;">
					<tr style="background:url(../../source/images/wbg.gif) repeat-x top;">
						<td class="normal" style="width:150px;">TOTAL SUBJECTS</td>
						<th class="normal" style="width:50px;;"><span class="normal" id="subjects"><?php echo mysql_num_rows($subjects);?></span></th>
						<td class="normal" style="width:125px;">LEC. UNITS</td>
						<th class="normal" style="width:50px;"><span class="normal" id="lecunits"><?php echo lecunits() ?></span></th>
						<td class="normal" style="width:125px;">LAB. UNITS</td>
						<th class="normal" style="width:50px;"><span class="normal" id="labunits"><?php echo labunits() ?></span></th>
					</tr>
				</table>
			</div>
			</form>
			<button class="btn right normal" style="width:150px;display:inline-block;margin-top:-30px;" id="enlist">ENLIST</button>
			<!-- ------------------------------------------------------------ -->
	</div>
	
	<div class="footer"></div>
</body>
</html>