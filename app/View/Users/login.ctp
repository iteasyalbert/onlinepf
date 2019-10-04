<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<title>Online PF - Providence Hospital Inc.</title>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />

		<link rel="stylesheet" href="/assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="/assets/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="/assets/plugins/animate.css/animate.min.css">
		<link rel="stylesheet" href="/assets/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="/assets/css/styles.css">
		<link rel="stylesheet" href="/assets/css/styles-responsive.css">
		<link rel="stylesheet" href="/assets/plugins/iCheck/skins/all.css">

	</head>
	
	<body class="login" ng-app="mro" ng-controller="usersCtrl">
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				
				<!-- start: LOGIN BOX -->
				<div class="box-login" style="">
					<!-- <div class="logo">
						<img src="/img/providence/logonew.png" style="width: 200px;">
						<br>
					</div> -->
					<h3>Sign in to your account</h3>
					<p style="color: gray">
						Please enter your username and password to log in.
					</p>
					<?php echo $this->Form->create('User',array('controller'=>'users','action'=>'login','autocomplete'=>'off','ng-submit'=>'login($event)'));?>
					<div class="form-group">
						<span class="input-icon"><?php echo $this->Form->input('username',array('id' => 'username','type' => 'text', 'label'=>'','placeholder'=>'PRC LIC. NO.','div'=>false, 'class'=>'form-control','ng-model'=>'User.username'));?><i class="fa fa-user"></i> </span>
						<span class="input-icon"><?php echo $this->Form->input('password',array('id' => 'password','type' => 'password', 'label'=>'','placeholder'=>'BIRTHDATE (dd/mm/yyyy)','div'=>false, 'class'=>'form-control','ng-model'=>'User.password'));?><i class="fa fa-lock"></i> </span>
					</div>

					<div class="form-group">
						<h5>Are you a robot?</h5>
						<div class="captcha-bkg" style="width:100%;height:auto;padding:0;">
							<div style="width:100%;height:auto;padding:0;border-radius: 4px;">
								<div style="width:100%;border: 1px solid #3695EB !important;padding:0;text-align:center;background:white;border-radius:4px;">
									<?php echo $this->Html->image($this->Html->url(array('controller'=>'users', 'action'=>'startCaptcha'), true),array('style'=>'height:50px;','id'=>'img-captcha','width'=>100,'vspace'=>2,'class'=>'form-control'));?>
								</div>
							</div>
						</div>
						<h5><a href="/" style="color: gray;">Can't read? Reload</a></h5>
						
						<div class="form-group has-feedback has-feedback-left">
							<?php echo $this->Form->input('User.captcha',array('required'=>'required','autocomplete'=>'off','label'=>false,'placeholder'=>'Enter CAPTCHA','div'=>true, 'class'=>'form-control','ng-model'=>'User.captcha'));?>
								<i class="form-control-feedback glyphicon glyphicon-eye-open"></i>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block" id="login-submit">Login</button>
							<?php echo $this->Form->end();?>
							<!-- <p class="help-block"><a class="pull-right" href="#" id="forgot-pw"><b style="color: gray">Forgot your password?</b></a></p>
							<br> -->
							<br>
						</div>
					</div>
					<!-- start: COPYRIGHT -->
					<!-- <div class="copyright">
						<span>2019 &copy; <a href="https://www.providencehospital.com.ph" target="_blank">Providence Hospital Inc.</a></span>
					</div> -->
					<!-- end: COPYRIGHT -->
				</div>
				<!-- end: LOGIN BOX -->
			</div>
			<!--<div class="OTP-form">
				<div><?php echo  $this->element('vcode_form');?></div>
			</div>
			<div class="forgot-pw-form">
				<div class="panel-body"><?php echo  $this->element('forgot_password');?></div>
			</div>-->
		</div>
		<script type="text/javascript">
		  // if (typeof jQuery != 'undefined') {  
		  //     // jQuery is loaded => print the version
		  //     alert(jQuery.fn.jquery);
		  // }
			jQuery(document).ready(function(){
				jQuery(".OTP-form").hide();
				jQuery(".forgot-pw-form").hide();
				jQuery('#username').focus();
			});
			jQuery('#forgot-pw').click(function(){
				jQuery(".login-form-box").hide();
				jQuery(".forgot-pw-form").show();
				jQuery('.username').focus();
			});
			var app = angular.module('mro', ['ngResource','angular-loading-bar'])
			url = window.location.hostname;
			// console.log(url);
			app.controller('usersCtrl', [ '$http', '$scope', function($http, $scope){
				$scope.login = function($event){
					$event.preventDefault();
					jQuery('#login-submit').html('Loading...').prop('disabled', true);
					$http({
						method : "POST",
						url : '/users/ajax_signin',
						data: {User : { username: $scope.User.username , password: $scope.User.password, captcha: $scope.User.captcha}},
						responseType : 'json'
					}).then(function mySuccess(response) {
						// console.log(response);
						var data = response.data;
						if(!data.status && data.verified){ // If verified proceed
							if(data.role == 'ROLE_PHYSICIAN'){
								if(data.last_url)
									window.location.replace("http://"+url+data.last_url);
								else
									window.location.replace("http://"+url+"/physicians/dashboard");
							}
							else if(data.role == 'ROLE_PATIENT')
								window.location.replace("http://"+url+"/patient/patients/profile");
							else if(data.role == 'ROLE_ADMIN')
								window.location.replace("http://"+url+"/admin");
						}
						else if(data.status){ // Display error message
							alert(data.message);
							window.location.replace("http://"+url);
						}
						else{ // Show OTP FORM
							jQuery(".login-form-box").hide();
							jQuery(".OTP-form").show();
							jQuery("#pname").html(data.message);
							jQuery("#UserPin").focus();
						}
						jQuery('#login-submit').html('Submit').prop('disabled', false);

					}, function myError(response) {
						alert(response.statusText);
					});
				};
			}]);
		</script> 	
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="assets/plugins/respond.min.js"></script>
		<script src="assets/plugins/excanvas.min.js"></script>
		<script type="text/javascript" src="assets/plugins/jQuery/jquery-1.11.1.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		<script src="/assets/plugins/jQuery/jquery-2.1.1.min.js"></script>
		<!--<![endif]-->
		<script src="/assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="/assets/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="/assets/plugins/jquery.transit/jquery.transit.js"></script>
		<script src="/assets/plugins/TouchSwipe/jquery.touchSwipe.min.js"></script>
		<script src="/assets/js/main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="/assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="/assets/js/login.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>