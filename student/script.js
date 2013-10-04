function onlyNumbers(evt) {var e = event || evt;var charCode = e.which || e.keyCode;if (charCode > 31 && (charCode < 48 || charCode > 57)){ return false;} return true;}
$(function(){

	$('div.loading').hide().ajaxStart(function(){ $(this).show();}).ajaxStop(function(){ $(this).hide();});
	$('div.msgbox').hide();
	$('div.overlay').hide();
	function msgbox(a){
		$('div.msgbox').fadeIn(250);
		$('div.msg').html(a);
		$('div.mok').click(function(){
			$('div.overlay').fadeOut(100);
			$('div.msgbox').fadeOut(250);
		});
	}

	$('#username').keypress(function(){ return onlyNumbers() });
	$('#reg-username').keypress(function(){ return onlyNumbers() });
	
	$('#login').click(function(){
		$.ajax({
			url:"http://gordoncollegeccs.edu.ph/ccswebsite/student/functions/login.php",
			data:{
				username:$('#username').val(),
				password:$('#password').val()
			},
			success:function(i){
				if($('#username').val()==""){
					$('.login-error').html('Please enter your username.');
				}else if($('#password').val()==""){
					$('.login-error').html('Please enter your password.');
				}else if(i==1){
					window.location="grades/sam.html";
				}else if(i==2){
					$('.login-error').html('The password you entered is incorrect.');
				}else if(i==4){
					alert('Sorry you cannot enlist now.\nEnlistment date is not yet started.');
				}else if(i==5){
					alert('Sorry you cannot enlist now.\nEnlistment has been ended.');
				}else{
					$('.login-error').html('Invalid login.');
				}
			}
		});
	});
	
	$('#register').click(function(){
		$.ajax({
			url:"functions/checkusername.php",
			data: { username: $('#reg-username').val() },
			success: function(i){
				if($('#reg-username').val()==""){
					$('#reg-error').html('Please enter your username.');
				}else if($('#reg-username').val().length != 9 || parseInt($('#reg-username').val()) < 200000000 ){
					$('#reg-error').html('Enter a valid Student Number.');
				}else if($('#reg-password').val()==""){
					$('#reg-error').html('Please enter your password.');
				}else if($('#reg-password').val().length < 8){
					$('#reg-error').html('Password must atleast 8 characters.');
				}else if($('#reg-confirm-password').val() == ""){
					$('#reg-error').html('Please re-type your password.');
				}else if($('#reg-confirm-password').val() != $('#reg-password').val()){
					$('#reg-error').html('Password does not match.');
				}else if(i==0){
					$('#reg-error').html('Student Number is not registered in GC CCS.');
				}else if(i==2){
					$('#reg-error').html('Your account is already registered.');
				}else if(i==1){
					$.ajax({
						url: "functions/register.php",
						data: {
							username: $('#reg-username').val(),
							password: $('#reg-password').val(),
							success:function(x){
									$('#reg-error').html('');
									alert("Your registration was successful.\nPlease verify your account to your GC CCS Email\nYour Email is: " + $('#reg-username').val() + "@gordoncollegeccs.edu.ph");
									$('#reg-username').val('');
									$('#reg-password').val('');
									$('#reg-confirm-password').val('');
							}
						}
					});
				
				}
			}
		});
		
	});
	
	$('#enlist').click(function(){
		if($('#preferred-time').val()=="Select Preferred Time"){
			$('div.overlay').fadeIn(100);
			alert("Plese select your preferred time.");
		}else if($('#subjects').html()==0){
			$('div.overlay').fadeIn(100);
			alert("Plese select the subjects you want to enlist.");
		}else{
			document.form.submit();
		}
	});

});