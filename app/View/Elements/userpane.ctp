<?php
	$user = $this->Session->read('Auth.User');
	$person = array();
	
//	if(isset($user['id']))
//		$person = $this->Session->read('Auth');//.Person.'.$user['id']);
	
	$person = $this->Session->read('Auth.Person');
?>
<?php if(empty($user)):?>
	<div class="top-login-pane" align="left" style="padding:5px;">

			<h2 class="widgettitle" style='width:100%;margin:0px;padding:0px;font-family:"Norican",cursive !important'>Get Results</h2>
			<?php
	    		echo $this->Form->create('User',array('controller'=>'Users','action'=>'signin'),array('style'=>'width:100%;'));
	        ?>
	        <?php
	            echo $this->Form->input('username',array('label'=>false,'error'=>false,'div'=>false,'class'=>'username','required'=>'required','style'=>'height: 25px;font-size:12px;margin:1px;','placeholder'=>'Email','value'=>''));
	            echo $this->Form->input('password',array('label'=>false,'error'=>false,'div'=>false,'type'=>'password','class'=>'password','required'=>'required','style'=>' height: 25px;font-size:12px;','placeholder'=>'Password','value'=>''));
	            echo $this->Form->submit('Login',array('label'=>false,'div'=>false,'style'=>'vertical-align: middle; margin-bottom: 9px;'));
	            echo $this->Form->end();
	        ?>
	        	<p style="float:left;width:120px;"><a href="/Users/forgot_password">Forgot Password?</a></p>
				<p style="float:right;width:170px;"><a href="/Users/sign_up">Not yet a Member? Sign up</a></p>
				
			
		</div>
		<?php else:?>
			<?php
        		echo $this->Form->create('User',array('controller'=>'Users','action'=>'signout'));
	        ?>
			<?php if($user['role'] == 9):?>
			<div class="user-detail-pane top-login-detail-pane" align="center">
				<span class="greetings">
					<b>Hello
						<?php
							echo isset($person['titlecode'])?ucfirst($person['titlecode']):"";
							echo " ";
							echo isset($person['firstname'])?ucfirst($person['firstname']):"";
							echo " ";
							echo isset($person['lastname'])?ucfirst($person['lastname']):"";
						?>
					</b>
				</span>
				<input type="submit" id="submit" value="Logout"/>
				<span class="user-detail" style="width:100%;display:none; font-weight: bold; text-align: center;">
					<?php
						echo isset($person['titlecode'])?ucfirst($person['titlecode']):"";
						echo " ";
						echo isset($person['firstname'])?ucfirst($person['firstname']):"";
						echo " ";
						echo isset($person['lastname'])?ucfirst($person['lastname']):"";
					?>
					<br />
				</span>
				<img src="<?php echo (!empty($person['image']))?"/media/profiles/".$person['image']:'/img/male.jpg';?>" style="width:60px;height:60px;float:left;margin:2px;display:none;" alt="" id = "side_id_pic" >
				<div class="user-pane-menu" align="center">
					<?php if($user['status'] == 1):?>
<!--					<a href="/patient">My Visit</a><br/>-->
<!--					<a href="/patient/patients/profile/tab:history">My History</a><br/>-->
					<a href="/patient/patients/profile/tab:profile">My Profile</a><br/>
<!--					<a href="/patient/patients/profile/tab:activity">Activities</a><br/>-->
					<a href="/Articles/add">Write an Article</a>
					<?php endif;?>
				<?php //echo $this->Html->link('Write an Article',array('controller'=>'Articles','action' => 'add'));?>
				<br>
					<?php echo $this->Html->link('Logout',array('controller' => 'users','action' => 'signout'),array('class'=>'signout-link','style' => 'display:none; ;font-family: arial;font-size: 10px;font-weight: bold;'));?>
				<br>
				</div>
				<br />
			</div>
			<?php elseif($user['role'] == 6):?>
			
			<div class="user-detail-pane top-login-detail-pane" align="center">
				<span class="greetings">
					<b>Hello
						<?php
							echo isset($person['titlecode'])?ucfirst($person['titlecode'])." ":"";
							echo isset($person['firstname'])?ucfirst($person['firstname']):"";
							echo " ";
							echo isset($person['lastname'])?ucfirst($person['lastname']):"";
						?>
					</b>
				</span>
				<input type="submit" id="submit" class="logoutButton" value="Logout"/>
				<span class="user-detail" style="width:100%;display:none; font-weight: bold; text-align: center;">
					<?php
						echo isset($person['titlecode'])?ucfirst($person['titlecode'])." ":"";
						echo isset($person['firstname'])?ucfirst($person['firstname']):"";
						echo " ";
						echo isset($person['lastname'])?ucfirst($person['lastname']):"";
					?>
					<br />
				</span>
				<img src="<?php echo (!empty($person['image']))?"/media/profiles/".$person['image']:'/img/male.jpg';?>" style="width:60px;height:60px;float:left;margin:2px;display:none;" alt="" id = "side_id_pic" >
				<div class="user-pane-menu" align="center">
					<?php if($user['status'] == 1):?>
					<a href="/physician">My Patient</a><br/>
<!--					<a href="/physician/physicians/profile/tab:result">My Result</a><br/>-->
<!--					<a href="/physician/physicians/profile/tab:report">My Report</a><br/>-->
					<a href="/physician/physicians/profile/tab:profile">My Profile</a><br/>
<!--					<a href="/physician/physicians/profile/tab:activity">Activities</a><br/>-->
					<a href="/Articles/add">Write an Article</a>
					<?php endif;?>
				<?php //echo $this->Html->link('Write an Article',array('controller'=>'Articles','action' => 'add'));?>
				</div>
				<br>
					<?php echo $this->Html->link('Logout',array('controller' => 'users','action' => 'signout'),array('class'=>'signout-link','style' => 'display:none;font-family: arial;font-size: 10px;font-weight: bold;'));?>
				<br>
			</div>
			<?php elseif($user['role'] == 3):?>
			
			<div class="user-detail-pane top-login-detail-pane" align="center">
				<span class="greetings">
					<b>Hello
						<?php
							echo isset($person['titlecode'])?ucfirst($person['titlecode'])." ":"";
							echo isset($person['firstname'])?ucfirst($person['firstname']):"";
							echo " ";
							echo isset($person['lastname'])?ucfirst($person['lastname']):"";
						?>
					</b>
				</span>
				<input type="submit" id="submit" class="logoutButton" value="Logout"/>
				<span class="user-detail" style="width:100%;display:none; font-weight: bold; text-align: center;">
					<?php
						echo isset($person['titlecode'])?ucfirst($person['titlecode'])." ":"";
						echo isset($person['firstname'])?ucfirst($person['firstname']):"";
						echo " ";
						echo isset($person['lastname'])?ucfirst($person['lastname']):"";
					?>
					<br />
				</span>
				<?php //debug($logo);?>
				<img src="<?php echo (!empty($logo['CompanyBranchInfo']['logo']))?"/media/logos/".$logo['CompanyBranchInfo']['logo']:"/img/poster-one-half-profile.jpg"?>" style="width:60px;height:60px;float:left;margin:2px;display:none;" alt="" id = "side_id_pic" >
				<div class="user-pane-menu" align="center">
					<?php if($user['status'] == 1):?>
					<a href="/laboratory/laboratories/profile/tab:profile">My Profile</a><br/>
<!--					<a href="/laboratory/laboratories/profile/tab:report">My Report</a><br/>-->
<!--					<a href="/laboratory/laboratories/profile/tab:activity">Activities</a><br/>-->
					<a href="/Articles/add">Write an Article</a>
					<?php endif;?>
				<?php //echo $this->Html->link('Write an Article',array('controller'=>'Articles','action' => 'add'));?>
				<br>
					<?php echo $this->Html->link('Logout',array('controller' => 'users','action' => 'signout'),array('class'=>'signout-link','style' => 'display:none;font-family: arial;font-size: 10px;font-weight: bold;'));?>
				<br>
				</div>
				
			</div>
			<?php elseif($user['role'] == 11):?>
			<div class="user-detail-pane top-login-detail-pane" align="center">
				<span class="greetings">
					<b>Hello
						<?php
							echo isset($person['titlecode'])?ucfirst($person['titlecode'])." ":"";
							echo isset($person['firstname'])?ucfirst($person['firstname']):"";
							echo " ";
							echo isset($person['lastname'])?ucfirst($person['lastname']):"";
						?>
					</b>
				</span>
				<input type="submit" id="submit" class="logoutButton" value="Logout"/>
				<span class="user-detail" style="width:100%;display:none; font-weight: bold; text-align: center;">
					<?php
						echo isset($person['titlecode'])?ucfirst($person['titlecode'])." ":"";
						echo isset($person['firstname'])?ucfirst($person['firstname']):"";
						echo " ";
						echo isset($person['lastname'])?ucfirst($person['lastname']):"";
					?>
					<br />
				</span>
				<?php //debug($logo);?>
				<img src="<?php echo (!empty($logo['CompanyBranchInfo']['logo']))?"/media/logos/".$logo['CompanyBranchInfo']['logo']:"/img/poster-one-half-profile.jpg"?>" style="width:60px;height:60px;float:left;margin:2px;display:none;" alt="" id = "side_id_pic" >
				<div class="user-pane-menu" align="center">
					<?php if($user['status'] == 1):?>
					<a href="/laboratory/laboratories/profile/tab:profile">My Profile</a><br/>
<!--					<a href="/laboratory/laboratories/profile/tab:report">My Report</a><br/>-->
<!--					<a href="/laboratory/laboratories/profile/tab:activity">Activities</a><br/>-->
					<a href="/Articles/add">Write an Article</a>
					<?php endif;?>
				<?php //echo $this->Html->link('Write an Article',array('controller'=>'Articles','action' => 'add'));?>
				<br>
					<?php echo $this->Html->link('Logout',array('controller' => 'users','action' => 'signout'),array('class'=>'signout-link','style' => 'display:none;font-family: arial;font-size: 10px;font-weight: bold;'));?>
				<br>
				</div>
				
			</div>
			<?php elseif($user['role'] == 1):?>
			
			<div class="user-detail-pane top-login-detail-pane" align="center">
				<span class="greetings">
					<b>Hello
						<?php
							echo isset($person['titlecode'])?ucfirst($person['titlecode'])." ":"";
							echo isset($person['firstname'])?ucfirst($person['firstname']):"";
							echo " ";
							echo isset($person['lastname'])?ucfirst($person['lastname']):"";
						?>
					</b>
				</span>
				<input type="submit" id="submit" class="logoutButton" value="Logout"/>
				<span class="user-detail" style="width:100%;display:none; font-weight: bold; text-align: center;">
					<?php
						echo isset($person['titlecode'])?ucfirst($person['titlecode'])." ":"";
						echo isset($person['firstname'])?ucfirst($person['firstname']):"";
						echo " ";
						echo isset($person['lastname'])?ucfirst($person['lastname']):"";
					?>
					<br />
				</span>
				<?php //debug($logo);?>
				<img src="<?php echo (!empty($logo['CompanyBranchInfo']['logo']))?"/media/logos/".$logo['CompanyBranchInfo']['logo']:"/img/poster-one-half-profile.jpg"?>" style="width:60px;height:60px;float:left;margin:2px;display:none;" alt="" id = "side_id_pic" >
				<div class="user-pane-menu" align="center">
					<?php if($user['status'] == 1):?>
					<a href="/admin/">My Profile</a><br/>

					<a href="/admin/articles/add">Write an Article</a>
					<?php endif;?>
				<?php //echo $this->Html->link('Write an Article',array('controller'=>'Articles','action' => 'add'));?>
				<br>
					<?php echo $this->Html->link('Logout',array('controller' => 'users','action' => 'signout'),array('class'=>'signout-link','style' => 'display:none;font-family: arial;font-size: 10px;font-weight: bold;'));?>
				<br>
				</div>
				
			</div>
			
			<?php elseif($user['role'] == 10):?>
			
			<div class="user-detail-pane top-login-detail-pane" align="center">
				<span class="greetings">
					<b>Hello
						<?php
							echo isset($person['titlecode'])?ucfirst($person['titlecode'])." ":"";
							echo isset($person['firstname'])?ucfirst($person['firstname']):"";
							echo " ";
							echo isset($person['lastname'])?ucfirst($person['lastname']):"";
						?>
					</b>
				</span>
				<input type="submit" id="submit" class="logoutButton" value="Logout"/>
				<span class="user-detail" style="width:100%;display:none; font-weight: bold; text-align: center;">
					<?php
						echo isset($person['titlecode'])?ucfirst($person['titlecode'])." ":"";
						echo isset($person['firstname'])?ucfirst($person['firstname']):"";
						echo " ";
						echo isset($person['lastname'])?ucfirst($person['lastname']):"";
					?>
					<br />
				</span>
				<?php //debug($logo);?>
				<img src="<?php echo (!empty($logo['CompanyBranchInfo']['logo']))?"/media/logos/".$logo['CompanyBranchInfo']['logo']:"/img/poster-one-half-profile.jpg"?>" style="width:60px;height:60px;float:left;margin:2px;display:none;" alt="" id = "side_id_pic" >
				<div class="user-pane-menu" align="center">
					<?php if($user['status'] == 1):?>
					<a href="/sales/">My Profile</a><br/>
					<?php endif;?>
				<?php //echo $this->Html->link('Write an Article',array('controller'=>'Articles','action' => 'add'));?>
				<br>
					<?php echo $this->Html->link('Logout',array('controller' => 'users','action' => 'signout'),array('class'=>'signout-link','style' => 'display:none;font-family: arial;font-size: 10px;font-weight: bold;'));?>
				<br>
				</div>
				
			</div>
			<?php else:?>
			<div class="user-detail-pane top-login-detail-pane" align="center">
				<span class="greetings">
					<b>Hello
						<?php
							echo isset($person['titlecode'])?ucfirst($person['titlecode'])." ":"";
							echo isset($person['firstname'])?ucfirst($person['firstname']):"";
							echo " ";
							echo isset($person['lastname'])?ucfirst($person['lastname']):"";
						?>
					</b>
				</span>
				<input type="submit" id="submit" class="logoutButton" value="Logout"/>
				<span class="user-detail" style="width:100%;display:none; font-weight: bold; text-align: center;">
					<?php
						echo isset($person['titlecode'])?ucfirst($person['titlecode'])." ":"";
						echo isset($person['firstname'])?ucfirst($person['firstname']):"";
						echo " ";
						echo isset($person['lastname'])?ucfirst($person['lastname']):"";
					?>
					<br />
				</span>
				<?php //debug($logo);?>
				<img src="<?php echo (!empty($logo['CompanyBranchInfo']['logo']))?"/media/logos/".$logo['CompanyBranchInfo']['logo']:"/img/poster-one-half-profile.jpg"?>" style="width:60px;height:60px;float:left;margin:2px;display:none;" alt="" id = "side_id_pic" >
				<div class="user-pane-menu" align="center">
					<?php if($user['status'] == 1):?>
<!--					<a href="/laboratory/laboratories/profile/tab:report">My Report</a><br/>-->
					<a href="/laboratory/laboratories/profile/tab:profile">My Profile</a><br/>
<!--					<a href="/laboratory/laboratories/profile/tab:activity">Activities</a><br/>-->
					<a href="/Articles/add">Write an Article</a>
					<?php endif;?>
				<?php //echo $this->Html->link('Write an Article',array('controller'=>'Articles','action' => 'add'));?>
				
				<br>
					<?php echo $this->Html->link('Logout',array('controller' => 'users','action' => 'signout'),array('class'=>'signout-link','style' => 'display:none; font-family: arial;font-size: 10px;font-weight: bold;'));?>
				<br>
				</div>
				
			</div>
			<?php endif;?>
			<?php echo $this->Form->end();?>
		<?php endif;?>
<style>
	.user-pane-menu a{
		font-weight: bold;
		text-decoration: none;
		font-size: 13px;
		text-align: left;
		/*margin:0px 2px;*/
	}
	
	.user-pane-menu a:hover{
		text-decoration: underline;
	}
	.logoutButton{
		font-size: 14px;
	}
	.top-login-detail-pane{
		width: 426px;
		padding: 20px 10px 0 10px;
	}
	.main-container{
		padding-top: 10px;
	}
	.top-login-pane{
		border: none;
	}
	input[type="submit"]{
		border-radius: 4px;
	}
	.user-pane-menu a{
		display:none;
	}
</style>
<script>
	jQuery(document).ready(function(){
		
		jQuery('.user-pane-menu a').show();
		jQuery('div.headr div.user-detail-pane.top-login-detail-pane div.user-pane-menu br').remove();
		jQuery('div.headr div.user-detail-pane.top-login-detail-pane div.user-pane-menu a.signout-link').remove();
		
	});
</script>