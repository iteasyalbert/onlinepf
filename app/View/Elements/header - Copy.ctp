<style>
	#dt-login-form{
		margin:2px;
		border:1px solid white;
		border-radius: 10px 10px 10px 10px;
		padding:2px;
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
</style>
<div id="header">
	<div class="container">
    	<?php echo $this->element('mainmenu');?>
		<div id="logo">
        	<a href="/" title="My Result Online">
              <img src="/img/logo.png" style="width:290px; height: 93px;">
            </a>
        </div>
        <form method="get" id="searchform" action="http://localhost/myresultonline">
			<fieldset>
			    <input id="s" name="s" type="text" value="Search our site" class="text_input" onblur="if(this.value==''){this.value='Search our site';}" onfocus="if(this.value =='Search our site') {this.value=''; }">
				<input name="submit" type="submit" class="button" value="">
		    </fieldset>
		</form>
    </div>
</div>
<!--
	<div id="dt-control-panel" style="left: 0px;">
		<div id="control-panel-main">
        	<a id="dt-control-close" href="#" class=""></a>
            <div id="dt-control-inner">
            	<ul>
                    <li>
                    	<div id="dt-login-form">
	                    	<a>Get Results</a>
	                    	<?php 
	                    		echo $this->Form->create('User',array('controller'=>'','action'=>''));
	                    		echo $this->Form->input('username',array('label'=>false));
	                    		echo $this->Form->input('password',array('label'=>false,'type'=>'text'));
	                    		echo "<a class='form-anchor'>Forgot Password?</a>";
	                    		echo $this->Form->end('Login');
	                    	?>
	                    		<a class='form-anchor' style="margin-top:100px;">Not yet a Member?</a>
	                    		<br/>
                    	</div>
                    	<br/>
                    <li><a title=""> Advertisment 1 <br> <img width="140px" src="http://iamdesigning.com/themes/spatreats/wp-content/themes/spatreats-1.3/framework/theme_switcher/images/spatreats.jpg" alt="" title=""> </a></li>
<!--                    <li><a title=""> Advertisment 1  <br> <img width="140px" src="http://iamdesigning.com/themes/spatreats/wp-content/themes/spatreats-1.3/framework/theme_switcher/images/restaurant.jpg" alt="" title=""> </a></li>-->
                    <li><a title=""> Advertisment 2 <br> <img width="140px" src="http://iamdesigning.com/themes/spatreats/wp-content/themes/spatreats-1.3/framework/theme_switcher/images/restaurant.jpg" alt="" title=""> </a></li>
                        
                </ul>
<<<<<<< .mine
			</div> <!-- end #et-control-inner -->
		</div> <!-- end #control-panel-main -->
	</div>
	<script>
		jQuery(document).ready(function(){
			jQuery('#dt-login-form a.form-anchor').css({'font-family':'arial','font-size':'10px'});
			jQuery('form input').attr('autocomplete','off');
			jQuery('#UserUsername').val('Email');
			jQuery('#UserPassword').val('Password');
			
			jQuery('#UserUsername').click(function(){
				if(jQuery('#UserUsername').val() != 'Email' && jQuery('#UserUsername').val() != ''){
					//do nothing
				}else{
					jQuery('#UserUsername').val('');
				}
				
				if(jQuery('#UserPassword').val() == 'Password' || jQuery('#UserPassword').val() == ''){jQuery('#UserPassword').val('Password');}else{}
				if(jQuery('#UserPassword').val() == 'Password' ){jQuery('#UserPassword').prop('type', 'text');}
				
			});
			jQuery('#UserUsername').change(function(){
				if(jQuery('#UserUsername').val() == ''){
					jQuery('#UserUsername').val('Email');
				}
			});
			jQuery('#UserPassword').click(function(){
				
				if(jQuery('#UserPassword').val() != 'Password' && jQuery('#UserPassword').val() != ''){
					//do nothing
				}else{
					jQuery('#UserPassword').val('');
					jQuery('#UserPassword').prop('type', 'password');
				}
				if(jQuery('#UserUsername').val() == 'Email' || jQuery('#UserUsername').val() == ''){jQuery('#UserUsername').val('Email');}
			});
			jQuery('#header,#main,#footer,footer-bottom,#tiptip_holder').click(function(){
				if(jQuery('#UserPassword').val() == ''){
					jQuery('#UserPassword').prop('type', 'text');
					jQuery('#UserPassword').val('Password');
				}
			});
			jQuery('#header,#main,#footer,footer-bottom,#tiptip_holder').click(function(){
				if(jQuery('#UserUsername').val() == ''){
					jQuery('#UserUsername').val('Email');
				}
			});
//			jQuery('#UserPassword').removeAttr('type','password');
//			jQuery('#UserPassword').attr('type','text');
			
		});
			
	</script>=======
			</div> 
		</div> 
	</div>
-->>>>>>>> .r11
