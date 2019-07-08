<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-resource.min.js"></script>  
<link rel='stylesheet' href='/css/loading-bar.min.css' type='text/css' media='all' />
<script type='text/javascript' src='/js/loading-bar.min.js'></script>
<link rel="stylesheet" type="text/css" href="/css/general.css">
<style type="text/css">
	/*Override default color of loading */
	#loading-bar .bar {
	background: #506171;
	height: 4px;
	}
	#loading-bar-spinner .spinner-icon {
	width: 18px;
	height: 18px;
	border: solid 4px transparent;
	border-top-color: #506171;
	border-left-color: #506171;
	border-radius: 10px;
	}
</style>
<div class="row lis-container" ng-app="mro" ng-controller="usersCtrl">
	<div class="lis-center-container lis-login-container">
		<div class="login-title col-xs-12 no-padding">
			Online Results Portal
			<hr />
		</div>
		<div class="login-message col-xs-12 col-sm-6 col-md-7 col-lg-8 no-padding">
			<p>
				<b>LOGIN INSTRUCTIONS:</b></p>
			<p style="padding:0px;margin: 0px;">
				<b>PATIENTS</b></p>
			<p style="padding:0px;margin: 0px;padding-left: 20px;">
				<b>Username</b> &ndash; Patient Identification Number (PIN)</p>
			<p style="padding-left: 20px;">
				<b>Password</b> &ndash; Your birthdate (ddmmyyyy) e.g. 25121970</p>
			<p style="padding:0px;margin: 0px;">
				<b>DOCTORS</b></p>
			<p style="padding:0px;margin: 0px;padding-left: 20px;">
				<b>Username</b> &ndash; PRC License Number</p>
			<p style="padding-left: 20px;">
				<b>Password</b> &ndash; Your birthdate (ddmmyyyy) e.g. 25121970</p>
			
			<b>CAPTCHA</b>  
			<p style="text-indent: 20px;">This is to distinguish if you are a human and not a machine and to
thwart spam and automated extraction of data. CAPTCHA is case-sensitive. </p>
			
			<b>Security Code</b> 
			<p style="text-indent: 20px;">This will be sent via SMS to the cellphone number provided to the hospital and valid only for 24 hours.</p>
			<p>
				<b>Note:</b> If you have problems accessing your Laboratory examination results online, please call the Laboratory Department at 558-6999 (Local 510). </p>
			<p>
				&nbsp;</p>
			<p>
				<b>CONFIDENTIALITY AND DISCLAIMER</b></p>
			<p>
				To protect patient&rsquo;s privacy and safety, certain examination results may not be available online depending on their nature and sensitivity as determined by Hospital. For these examinations, proceed to Laboratory to secure the official result.
			</p>
			<p>
				Hospital recognizes and values your data privacy rights in compliance with Data Privacy Act and its implementing rules and regulations. Laboratory examination results and any information transmitted with Hospital are confidential and intended solely for the use of the authorized individuals whom username, password and security code are provided.
			</p>	
			<p>
				Once examination result is duly issued/released to authorized individuals, or patient/doctor concerned in accordance with the stringent rules of Hospital, the same shall be handled by the said authorized individuals, or patient/doctor concerned with utmost confidentiality in accordance with data privacy laws. Otherwise, said authorized individual, or patient/doctor concerned shall be liable for any misuse or data loss.
			</p>
		</div>
		<div class="login-form col-xs-12 col-sm-6 col-md-5 col-lg-4 no-padding">
			<div class="login-form-box">
				<?php echo $this->Form->create('User',array('controller'=>'users','action'=>'login','autocomplete'=>'off','ng-submit'=>'login($event)'));?>
					<table class="table table-sm no-margin no-padding">
						<tbody>
							<tr>
								<td>
									<div class="form-group has-feedback has-feedback-left">
									    <?php echo $this->Form->input('username',array('id' => 'username','type' => 'text', 'label'=>'username','div'=>false, 'class'=>'form-control','ng-model'=>'User.username'));?>
									    <i class="form-control-feedback glyphicon glyphicon-user"></i>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group has-feedback has-feedback-left">
									    <?php echo $this->Form->input('password',array('id' => 'password','type' => 'password', 'label'=>'password','div'=>false, 'class'=>'form-control','ng-model'=>'User.password'));?>
									    <i class="form-control-feedback glyphicon glyphicon-lock"></i>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									Are you a robot?
									<div class="captcha-bkg" style="width:100%;height:auto;padding:0;">
										<div style="width:100%;height:auto;padding:0;border-radius: 4px;">
											<div style="width:100%;border: 1px solid #3695EB !important;padding:0;text-align:center;background:white;border-radius:4px;">
												<?php echo $this->Html->image($this->Html->url(array('controller'=>'users', 'action'=>'startCaptcha'), true),array('style'=>'height:50px;','id'=>'img-captcha','width'=>100,'vspace'=>2,'class'=>'form-control'));?>
											</div>
										</div>
									</div>
									<?php echo '<p style="margin-top:2px;"><a href="/Users/login" id="a-reload">Can\'t read? Reload</a></p>';?>
								</td>
							</tr>
							<tr>
								<td>Enter CAPTCHA
									<div class="form-group has-feedback has-feedback-left">
									    <?php echo $this->Form->input('User.captcha',array('required'=>'required','autocomplete'=>'off','label'=>false,'div'=>true, 'class'=>'form-control','ng-model'=>'User.captcha'));?>
									    <i class="form-control-feedback glyphicon glyphicon-eye-open"></i>
									</div>
								</td>
							</tr>
							<tr>
								<td><button type="submit" class="btn btn-primary btn-block" id="login-submit">Submit</button></td>
							</tr>
                            <tr>
                                <td>
                                    <p class="help-block"><a class="pull-right" href="#" id="forgot-pw"><small style="color:#3695eb">Forgot your password?</small></a>
                                    </p>
                                </td>
                            </tr>
						</tbody>
					</table>
				<?php echo $this->Form->end();?>
			</div>
			<div class="panel panel-default OTP-form">
				<div class="panel-heading" id="pname" style="background-color: #fff !important"></div>
				<div class="panel-body"><?php echo  $this->element('vcode_form');?></div>
			</div>
            <div class="panel panel-default forgot-pw-form">
                <div class="panel-heading" style="background-color: #fff !important">Forgot your password?</div>
                <div class="panel-body"><?php echo  $this->element('forgot_password');?></div>
            </div>
		</div>
	</div>	
</div>

<!-- <button id="resultModalBtn" type="button" class="btn btn-primary hidden" data-toggle="modal" data-target="#resultModal" data-keyboard="false"></button>
<div class="modal fade" id="resultModal" role="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
    
          	<span style="font-size: 10px;" id="pname"></span>	
          
        </div>
        <div class="modal-body">
          	<div id="pdfFrame" title="Result Viewer" class="embed-responsive embed-responsive-16by9">
				<?php echo  $this->element('vcode_form');?>
			</div>
        </div>
      </div>
    </div>
</div>	 -->
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
					if(data.role == 'ROLE_PHYSICIAN')
						window.location.replace("http://"+url+"/physician/physicians/profile");
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
