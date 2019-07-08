<style>
	#dt-login-form > .top-login-pane{
		padding:0;
		margin:0;
		float:none;
		clear:both;
	}
	#dt-login-form .user-detail-pane{
		width:100%;
		font-size:12px;
		padding:2px;
		margin:2px;
		float:none;
	}
	#dt-login-form > .top-login-pane input[type=text],input[type=password]{
		width:90%;
		font-size:12px;
		padding:2px;
		margin:2px;
	}
	#top-login-detail-pane .top-login-detail-pane{
		width:90%;
		font-size:12px;
		padding:2px;
		margin:2px;
		float:none;
	}
	#dt-login-form p{
		width:100% !important;
		line-height:10px;
		padding:0px;
		margin:0px;
		float:none !important;
		clear:both;
	}
	#dt-login-form .user-pane-menu{
		text-decoration:none;
		
	}
	#dt-login-form .greetings{
		display:none;
	}

	#dt-login-form .user-detail{
		display:block !important;
		color:#FFFAE4;
		font-size:10px;
		text-align:left;
	}
	#dt-login-form{
		width: 100%;
		float: left;
	}
	
</style>
<?php
 if(empty($minor)){
	$minor = $this->requestAction('advertisements/getMinorAds');
// 	debug($minor);
 }
?>
<div id="dt-control-panel" style="left: 0px;">
    	<div id="control-panel-main">
        	<a id="dt-control-close" href="#" class=""></a>
            <div id="dt-control-inner" style=" display:none;">
            	<ul>
            		<li>
	            		<div id="dt-login-form">
                    		<?php echo $this->element('userpane');?>
                    	</div>
                    </li>
               		<li>
               			<h2 style="width: 100%;margin: 0px;padding: 0px;font-family: Norican, cursive !important;color: rgb(255, 250, 228);">Sponsors:</h2>
                    	<div id="marquee" style="position:relative; overflow:hidden;">
	                    <ul style="position:absolute; margin:0px; padding:0px; top:0px;">
	                    <?php if(isset($minor['Advertisement'])){?>
	                    	<?php foreach ($minor['Advertisement'] as $key=>$ads){?>
			            	<li style="margin:0px; padding:0px; height: 120px; display:list-item;">
			            		<a href="<?php echo $ads['Advertisement']['external_link']?>" title="<?php echo $ads['Advertisement']['name']?>" target="_blank">
			            			<img width="140px" src="/media/mroads/<?php echo $ads['Advertisement']['image']?>" alt="" title="<?php echo $ads['Advertisement']['name']?>">
			            		</a>
			            	</li>
			            <?php }
	                   }?>
			            </ul>
			            </div>
			         </li>
			      </ul>
			</div> <!-- end #et-control-inner -->
		</div> <!-- end #control-panel-main -->
	</div>
	<script>
		jQuery(document).ready(function(){
			var bar_act = 0;
			$.cookie("sidebaract", bar_act, { expires:1 });
			var cookie_sidebar = $.cookie("sidebaract");
//			$.cookie("sidebaract", null);
//			alert(cookie_sidebar);
			jQuery('#dt-login-form a').addClass("form-anchor");
			jQuery('#dt-login-form h2').css("color","#FFFAE4");
			jQuery('#dt-login-form .user-detail-pane input[type=submit]').hide();
			jQuery('#dt-login-form .user-detail-pane img').show();
			jQuery('#dt-login-form .signout-link').show();
			if(cookie_sidebar != null){
				if(cookie_sidebar == 0){
					$("#dt-control-inner").hide();
					$("#dt-control-close").html('<img src="/img/dt-open.png"/>');
				}else{
					$("#dt-control-inner").show();
					 $("#dt-control-close").html('<img src="/img/dt-close.png"/>');
				}
				    jQuery("#dt-control-close").click( function() {
				        if ($("#dt-control-inner").is(":hidden")) {
//				            $("#dt-control-inner").animate({ left: -206 } );
				            $("#dt-control-close").html('<img src="/img/dt-close.png"/>');
				            $("#dt-control-inner").show();
				            bar_act = 1;
				            return false;
				        } else {
				            $("#dt-control-inner").animate({
				                marginTop: "0px"
				                }, 1000 );
				            $("#dt-control-close").html('<img src="/img/dt-open.png"/>');
				            $("#dt-control-inner").hide();
				            bar_act = 0;
				            return false;
				        }
				    });
			}else{
				 jQuery("#dt-control-close").click( function() {
				        if ($("#dt-control-inner").is(":hidden")) {
//				            $("#dt-control-inner").animate({ left: -206 } );
				            $("#dt-control-close").html('<img src="/img/dt-close.png"/>');
				            $("#dt-control-inner").show();
				            bar_act = 1;
				            return false;
				        } else {
				            $("#dt-control-inner").animate({
				                marginTop: "0px"
				                }, 1000 );
				            $("#dt-control-close").html('<img src="/img/dt-open.png"/>');
				            $("#dt-control-inner").hide();
				            bar_act = 0;
				            return false;
				        }
				    });
			}
			jQuery('#dt-login-form a.form-anchor').css({'font-family':'arial','font-size':'10px'});
			jQuery('form input').attr('autocomplete','off');
			jQuery('.left-user').val('Email');
			jQuery('.left-pass').val('Password');
			
			jQuery('.left-user').focus(function(){
				if(jQuery('.left-user').val() != 'Email' && jQuery('.left-user').val() != ''){
					//do nothing
				}else{
					jQuery('.left-user').val('');
				}
				
				if(jQuery('.left-pass').val() == 'Password' || jQuery('.left-pass').val() == ''){jQuery('.left-pass').val('Password');}else{}
				if(jQuery('.left-pass').val() == 'Password' ){jQuery('.left-pass').prop('type', 'text');}
				
			});
			jQuery('.left-user').change(function(){
				if(jQuery('.left-user').val() == ''){
					jQuery('.left-user').val('Email');
				}
			});
			jQuery('.left-pass').focus(function(){
				
				if(jQuery('.left-pass').val() != 'Password' && jQuery('.left-pass').val() != ''){
					//do nothing
				}else{
					jQuery('.left-pass').val('');
					jQuery('.left-pass').prop('type', 'password');
				}
				if(jQuery('.left-user').val() == 'Email' || jQuery('.left-user').val() == ''){jQuery('.left-user').val('Email');}
			});
			jQuery('#header,#main,#footer,footer-bottom,#tiptip_holder').click(function(){
				if(jQuery('.left-pass').val() == ''){
					jQuery('.left-pass').prop('type', 'text');
					jQuery('.left-pass').val('Password');
				}
			});
			jQuery('#header,#main,#footer,footer-bottom,#tiptip_holder').click(function(){
				if(jQuery('.left-user').val() == ''){
					jQuery('.left-user').val('Email');
				}
			});

			//cache last action for left-sidebar
			jQuery('#dt-control-close').click(function(){
				$.cookie("sidebaract", bar_act, { expires:1 });
//				alert($.cookie("sidebaract"));
			});

			jQuery('#marquee').vTicker({
				speed: 500,
				pause: 4000,
				showItems: 3,
				animation: 'fade',
				mousePause: true,
				height: 240,
				direction: 'up'
				});
		});

	
	</script>