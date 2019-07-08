<style>
	#dt-login-form{
		margin:2px;
		border:1px solid #FFFAE4;
		border-radius: 3px 3px 3px 3px;
		background:#634E37;
		padding:2px 2px 5px 2px;
	}
	#dt-login-form div.input.text{
		margin:0px;
	}
	#dt-login-form input[type="text"],#dt-login-form input[type="password"]{
		padding: 3px 0px;
		font-size: 14px;
	}
	#dt-login-form [type="submit"]{
		padding: 2px 25px;
	}
/*	#dt-login-form a.form-anchor{
		font-family: arial;
		font-size: 14px;
	}*/
	#dt-control-inner ul li:hover{
		opacity: 1;
	}
	#dt-control-inner{
		width: 170px;
	}
	#dt-control-inner ul{
		padding:5px;
		width: 150px;
	}

     .top-login-pane{
        float:left;
        padding:20px 10px;
        margin:2px;
        border:solid 1px;
        text-align:center;
        margin: 5px 23px;
     }
        
     .top-login-pane input[type=text],.top-login-pane input[type=password]{
        padding:5px;
        height:20px;
        width:140px;
        margin:1px;
        
      }
     .top-login-detail-pane {
		float: left;
		padding: 20px 10px;
		margin: 2px;
		text-align: center;
		width: 400px;
	}
	.top-login-detail-pane b{
		margin-right: 20px;
	}
	.top-login-detail-pane a{
		font-size: 14px;
		text-decoration:underline;
		margin:0 5px;
	}
        </style>
<?php
	$user = $this->Session->read('Auth.User');
	$person = array();
	
//	if(isset($user['id']))
//		$person = $this->Session->read('Auth');//.Person.'.$user['id']);
	
	$person = $this->Session->read('Auth.Person');
?>
<?php if($logged_in): ?>
<div id="header" style="height:170px;">
	<div class="container">
    		<?php echo $this->element('admin_mainmenu');?>
	    	<?php
	        	echo $this->Form->create('User',array('controller'=>'Users','action'=>'signout'));
	        ?>
	    	<div class="headr" style="height:220px;">
				<div id="logo" style="width:25%;">
		        	<a href="/admin/" title="My Result Online">
<!--		              <img src="/img/logo.png" style="width:270px; height: 103px;">-->
		            </a>
		        </div>
				<div class="user-detail-pane top-login-detail-pane" align="center" >
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
				</div>
	    	</div>
    </div>
</div>
<?php else:?>
<div id="header" style="height:50px;">

</div>
<?php endif;?>
<?php echo $this->element('sidebarleft');?>
