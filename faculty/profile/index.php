<?php include '../../config.php';?>
<?php
	if(!isset($_SESSION['faculty'])){
		header("location: ../");
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Course Enlistment</title>
	<link rel="stylesheet" type="text/css" href="../../source/styles/flexigrid.css">
	<link rel="stylesheet" type="text/css" href="../../source/styles/style.css">
	<script type="text/javascript" src="../../source/scripts/flexigrid.pack.js"></script>
	<script type="text/javascript" src="../../source/scripts/flexigrid.js"></script>
	<script>
		$(document).ready(function(){
			windowHeight = $(window).height() - 195;
			$('.page-content').css('min-height',windowHeight);
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
					<li>
						<?php
							if(faculty($_SESSION['faculty'],"position")=="BSIT Coordinator" or faculty($_SESSION['faculty'],"position")=="BSCS Coordinator" or faculty($_SESSION['faculty'],"position")=="ACT Coordinator" ){
								echo '<a href="../enlistment">ENLISTMENT</a>';
							}
						?>
					</li>
					<li><a href="../logout.php">LOGOUT</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="title">
		<div class="wraper">
			<div class="right" style="font-size:15px"><a href="../profile"><?php echo faculty($_SESSION['faculty'],"code")." - ".faculty($_SESSION['faculty'],"lastname").", ".faculty($_SESSION['faculty'],"firstname")." ".faculty($_SESSION['faculty'],"middlename"); ?></a></div>
		</div>
	</div>

	<div class="page-content">
		<br>
		<div style="width:800px;margin:auto;">
			<div class="profile" style="width:400px;display:table-cell;border:1px solid gray;">
				<div style="height:25px;background:url(../../source/images/th2.png);margin-bottom:10px;padding-top:5px;padding-left:10px;">PROFILE</div>
				<div style="width:380px;margin:auto;">E-mail / Username:</div>
				<div style="width:380px;margin:auto;">
					<input style="width:380px;" type="text" id="username" value="<?php echo account($_SESSION['faculty'],'username') ?>">
				</div>
				<br>
				<div style="width:380px;margin:auto;">Last Name:</div>
				<div style="width:380px;margin:auto;">
					<input style="width:380px;" type="text" id="lastname" value="<?php echo faculty($_SESSION['faculty'],'lastname') ?>">
				</div>
				<br>
				<div style="width:380px;margin:auto;">First Name:</div>
				<div style="width:380px;margin:auto;">
					<input style="width:380px;" type="text" id="firstname" value="<?php echo faculty($_SESSION['faculty'],'firstname') ?>">
				</div>
				<br>
				<div style="width:380px;margin:auto;">Middle Name:</div>
				<div style="width:380px;margin:auto;">
					<input style="width:380px;" type="text" id="middlename" value="<?php echo faculty($_SESSION['faculty'],'middlename') ?>">
				</div>
				<br>
				<div style="width:380px;margin:auto;">Position:</div>
				<div style="width:380px;margin:auto;">
					<?php if(faculty($_SESSION['faculty'],'position')=="ACT Coordinator"){ ?>
					<select id="position" style="width:384px;">
						<option selected="selected">ACT Coordinator</option>
						<option>BSCS Coordinator</option>
						<option>BSIT Coordinator</option>
						<option>Intructor</option>
					</select>
					<?php } ?>
					
					<?php if(faculty($_SESSION['faculty'],'position')=="BSCS Coordinator"){ ?>
					<select id="position" style="width:384px;">
						<option>ACT Coordinator</option>
						<option selected="selected">BSCS Coordinator</option>
						<option>BSIT Coordinator</option>
						<option>Intructor</option>
					</select>
					<?php } ?>
					
					<?php if(faculty($_SESSION['faculty'],'position')=="BSIT Coordinator"){ ?>
					<select id="position" id="position" style="width:384px;">
						<option>ACT Coordinator</option>
						<option>BSCS Coordinator</option>
						<option selected="selected">BSIT Coordinator</option>
						<option>Intructor</option>
					</select>
					<?php } ?>
					
					<?php if(faculty($_SESSION['faculty'],'position')=="Intructor"){ ?>
					<select id="position" id="position" style="width:384px;">
						<option>ACT Coordinator</option>
						<option>BSCS Coordinator</option>
						<option>BSIT Coordinator</option>
						<option selected="selected">Intructor</option>
					</select>
					<?php } ?>
				</div>
				<br>
				<div style="height:30px;">
					<button class="btn right" id="updateprofile">Save</button>
				</div>
			</div>
			
			
			<div class="account" style="width:400px;display:table-cell;border:1px solid gray;">
				<div style="height:25px;background:url(../../source/images/th2.png);margin-bottom:10px;padding-top:5px;padding-left:10px;">ACCOUNT</div>

				<div style="width:380px;margin:auto;">Old Password:</div>
				<div style="width:380px;margin:auto;">
					<input style="width:380px;" type="text" id="lastname">
				</div>
				<br>
				<div style="width:380px;margin:auto;">New Password:</div>
				<div style="width:380px;margin:auto;">
					<input style="width:380px;" type="text" id="newpassword">
				</div>
				<br>
				<div style="width:380px;margin:auto;">Re-type new password:</div>
				<div style="width:380px;margin:auto;">
					<input style="width:380px;" type="text" id="retypenewpassword">
				</div>
				<br>
				<div style="height:30px;">
					<button class="btn right" id="changepassword">Save</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="footer"></div>
</body>
</html>