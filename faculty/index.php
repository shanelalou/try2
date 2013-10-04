<?php include '../config.php';?>
<!DOCTYPE HTML>
<html>
<head>
	<title>faculty</title>
	<link rel="icon" type="image/png" href="../source/images/icon.png">
	<link rel="stylesheet" type="text/css" href="../source/styles/style.css">
	<link rel="stylesheet" type="text/css" href="../source/styles/ui-lightness/jquery-ui-1.8.23.custom.css">
	<style>
		* {
			font-size:14px;
		}
	</style>
	<script type="text/javascript" src="../source/scripts/js.js"></script>
	<script type="text/javascript" src="../source/scripts/ui.js"></script>
	<script>
		$(function(){
			$('div.overlay').hide();
			$('div.loading').hide().ajaxStart(function(){ $(this).show();}).ajaxStop(function(){ $(this).hide();});
		
			$('#login').click(function(){
				if($('#list-instructors').val()=="Select Your Account"){
					alert('Please select your account.');
				}else if($('#password').val()==""){
					alert('Please enter your password.');
				}else{
					$.ajax({
						url:"functions/login.php?username="+$('#list-instructors').val()+"&password="+$('#password').val(),
						success:function(i){
							if(i==1){
								window.location='class';
							//}else if(i==2) {
								//alert('Account is not yet verified. Please check your e-mail to confirm your account.');
							}else if(i==3) {
								alert('Incorrect password.');
							}
						}
					});
				}
			});
			
			
			
		
		});
	</script>
</head>
<body>

				
			<div id="login-form" >
				
				<div >
					<div >LOGIN FORM</div>
				</div>	
				<br>
				<div >
					
					<div style="margin-top:10px;">Username:</div>
					<div style="margin-top:5px;">
						<select id="list-instructors" style="width:380px;">
							<option>Select Your Account</option>
							<?php
							function list_instructors(){
								$q=mysql_query("select a.username,b.lastname,b.firstname,b.middlename,a.status from raccounts as a inner join rinstructors as b on a.username=b.instr where a.status='1'");
								while($r=mysql_fetch_array($q)){
									echo '
									<option value="'.$r[0].'">'.strtoupper($r[1].', '.$r[2].' '.$r[3]).'</option>
									';
								}
							}
							list_instructors();
							?>
						</select>
					</div>
					
					<div style="margin-top:10px;">Password:</div>
					<div style="margin-top:5px;"><input type="password" id="password" placeholder="Enter your password" style="width:376px;margin:auto;"></div>
					<div style="margin-top:25px;"><button id="login" >Login</button></div>
				</div>
			</div>
			
			
	
	
	

		
</body>
</html>