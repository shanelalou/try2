<?php include '../config.php';?>
<?php
	if(isset($_SESSION['student'])){
		header("Location: enlistment");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student</title>
	<link rel="icon" type="image/png" href="../source/images/icon.png">
	<link rel="stylesheet" type="text/css" href="../source/styles/style.css">
	<link rel="stylesheet" type="text/css" href="../source/styles/absolution/absolution.css">
	<style>
		* {
			font-size:14px;
		}
	</style>
	<script type="text/javascript" src="../source/scripts/js.js"></script>
	<script type="text/javascript" src="../source/scripts/ui.js"></script>
	<script type="text/javascript" src="functions/script.js"></script>
</head>
<body>

	<div class="head" style="width:900px;border-radius:3px;">
		<div class="wraper" style="width:900px;">
			<div class="head-logo"  onclick="window.location='http://www.gordoncollegeccs.edu.ph'" style="margin-left:30px;"></div>
			<div class="head-label">
				<div class="center" style="font-size:18px;cursor:pointer;" onclick="window.location='http://www.gordoncollegeccs.edu.ph'">COLLEGE OF COMPUTER STUDIES</div>
				<div class="center" style="font-size:15px;background:;">COURSE ENLISTMENT</div>
			</div>
			<div style="margin-top:70px;text-align:right;">
				<span style="margin-right:10px;text-shadow:1px 1px 2px black;color:white;font-size:12px;">
					ENLISTMENT : 
					<span style="font-size:13px;text-decoration:underline;">
						<?php echo enlistment('sem').' '.enlistment('ay') ?>
					</span> &nbsp;&nbsp;&nbsp;&nbsp;
					SCHEDULE: 
					<span style="font-size:13px;text-decoration:underline;">
						<?php echo date('F d, Y',strtotime(enlistment('start'))).' - '.date('F d, Y',strtotime(enlistment('end'))) ?>
					</span>
				</span>
			</div>
			<div class="right" style="margin-right:10px;margin-top:70px;">
				
			</div>
			<!--<div class="right" style="margin-right:15px;"><a href="http://www.gordoncollegeccs.edu.ph">Gordon College CCS Main Page</a></div>-->
		</div>
	</div>

	<div class="page-content" style="width:900px;margin-top:10px;background:none;height:440px;">
		<div class="wraper" style="width:900px;">
			
			<div style="width:100%;height:70px;background:url(../source/images/orange.png);margin-top:-5px;border-radius:3px;">
					<div style="text-shadow:1px 1px 2px black;color:white;font-size:20px;text-align:center;padding-top:20px;">WELCOME TO GORDON COLLEGE CCS COURSE ENLISTMENT</div>
			</div>
			
			<div id="login-form" style="background:#d7d7d7;width:420px;height:330px;border:1px solid gray;border-radius:3px;margin-top:20px;" class="left">
				
				<div style="width:100%;height:35px;background:url(../source/images/th2.png);border-top-left-radius:3px;border-top-right-radius:3px;">
					<div style="padding:8px 0px 0px 10px;color:white;text-shadow:1px 1px 2px black;">LOG-IN FORM</div>
				</div>
				<div style="width:350px;margin:auto;margin-top:10px;height:20px;">
					<div class="login-error" style="color:red;"></div>
				</div>
				
				<div style="width:350px;margin:auto;margin-top:10px;">
					<span class="inline" style="width:90px;">Username: </span><input type="text" class="txt" id="username" maxlength="9" placeholder="Enter your Student Number">
				</div>
				
				<div style="width:350px;margin:auto;margin-top:20px;">
					<span class="inline" style="width:90px;">Password: </span><input type="password" class="txt" id="password" placeholder="Enter your Password">
				</div>
				
				<div style="width:350px;margin:auto;margin-top:30px;">
					<div style="margin-top:5px;">
						<span class="a" >Forgot Password</span><button id="login" class="right" style="margin-right:-5px;width:120px;">Login</button>
					</div>
				</div>
			</div>
			<!---->
			<div id="reg-form" style="background:#d7d7d7;width:440px;height:330px;border:1px solid gray;border-radius:3px;margin-top:20px;" class="right">
				<div style="width:100%;height:35px;background:url(../source/images/th2.png);border-top-left-radius:3px;border-top-right-radius:3px;">
					<div style="padding:8px 0px 0px 10px;color:white;text-shadow:1px 1px 2px black;">REGISTRATION FORM</div>
				</div>
				<div style="width:380px;margin:auto;margin-top:15px;height:20px;"><div id="reg-error" style="color:red;"></div></div>
				<div style="width:380px;margin:auto;margin-top:5px;">
					<div>Student Number:</div>
					<div><input type="text" id="reg-username" maxlength="9" class="txt" placeholder="Enter your Student Number"></div>
				</div>
				<div style="width:380px;margin:auto;margin-top:5px;">
					<div id="student-name"></div>
					<div id="student-course"></div>
				</div>
				<div style="width:380px;margin:auto;margin-top:5px;">
					<div>Password:</div>
					<div><input type="password" class="txt" id="reg-password"placeholder="Enter your Password"></div>
				</div>
				<div style="width:380px;margin:auto;margin-top:5px;">
					<div>Re-type Password:</div>
					<div><input type="password" class="txt" id="reg-confirm-password" placeholder="Re-type your Password"></div>
				</div>
				<div style="width:380px;margin:auto;margin-top:20px;">
					<button class="right" style="width:120px;" id="register">Register</button>
				</div>
			</div>
		</div>
	</div>
	
		<div style="width:900px;height:30px;padding-top:10px;margin:auto;margin-top:10px;background:url(../source/images/th3.png);border-radius:3px;border:1px solid gray;text-align:center;">
			<span style="font-size:15px;">&copy; All Rights Reserve 2013</span>
		</div>
</body>
</html>