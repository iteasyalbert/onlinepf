<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $title_for_layout;?></title>
		
		<link rel="icon" href="/img/icon.png" type="image/x-icon">
	    <!-- **Favicon** -->
	    
		   
		<!-- **CSS - stylesheets** -->
		<link id="title-font" href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
		<link id="menu-font" href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
		<link id="script-font" href="http://fonts.googleapis.com/css?family=Niconne" rel="stylesheet" type="text/css">
		<link id="footer-font" href="http://fonts.googleapis.com/css?family=Norican" rel="stylesheet" type="text/css">
		
		<?php echo $this->Html->css('style.css');?>
		<?php echo $this->Html->css('responsive.css');?>
		<?php echo $this->Html->css('/css/themes/style.css');?>
		<?php echo $this->Html->css('/css/themes/responsive.css');?>
		<?php echo $this->Html->css('nivo-slider.css');?>
		<?php echo $this->Html->css('/css/skitter.styles.css');?>

		<!-- **Javascript** -->
      <?php echo $this->Html->script('jquery.latest.js')?>
		<?php echo $this->Html->script('jquery.jcarousel.min.js');?>
		<?php echo $this->Html->script('animatedcollapse.js');?>
		<?php echo $this->Html->script('spa.custom.js');?>
		<?php //echo $this->Html->script('smoothscroll.js');?>
		<?php echo $this->Html->script('jquery.localscroll.js');?>
		<?php echo $this->Html->script('stickyfloat.js');?>
		
		<?php echo $this->Html->script('stickyfloat.js');?>
		<?php echo $this->Html->script('jquery.cookie.js');?>
		<?php echo $this->Html->script('jquery.skitter.js');?>
		<?php echo $this->Html->script('jquery.easing.1.3.js');?>
		<?php echo $this->Html->script('jquery.tipTip.minified.js');?>
		
		<?php echo $this->Html->css('jquery-ui-1.8.24.custom');?>
		<?php echo $this->Html->script('jquery-ui-1.8.24.custom.min.js');?>
		
		<?php echo $this->Html->script('jquery-ui-personalized-1.6rc6.js');?>
		
		<?php echo $this->Html->script('sprinkle.js');?>
		<?php echo $this->Html->script('common');?>
		<?php echo $this->Html->script('profiles');?>
		<?php echo $this->Html->script('jquery.vticker.js');?>
		
		<?php echo $this->Html->script('ckeditor-full/ckeditor.js'); ?>
		<?php if(empty($uid)):?>
			<style>
				.headr .top-login-pane{
					padding-left: 40px !important;
				}
			</style>
		<?php endif;?>
		
	</head>
	<body class="home" >
		<?php echo $this->Session->flash('auth');?>

		<?php echo $this->Session->flash();?>
		<div id="flashTemp"></div>
		
		<?php echo $this->element('header');?>

		<div id="main">
			<?php if(isset($this->request->params['controller'])){?>
				<?php if($this->request->params['controller'] == 'Home'  && $this->request->params['action'] == 'index'){?>
					<?php echo $this->element('slideshow');?>
				<?php }else{?>
					<?php echo $this->element('breadcrumb');?>
				<?php }
			 }?>
			<div class="main-container">
		    	<?php echo $content_for_layout ?>
		    	<div class="hr_invisible"></div>
		    	<div id="newsletter">
		    		<?php echo $this->element('question_entry');?>
		    	</div>
			</div>
		</div>
		
		<?php echo $this->element('footer',array('footerdata' => (isset($footerdata))?$footerdata:array()));?>
		<style>
			.cke_contents{background-color:#fffae4;height:100px !important;}
		</style>
		
		
	    <script>
	    CKEDITOR.config.toolbar = [];

		CKEDITOR.config.removePlugins = 'toolbar,elementspath,resize';
	    jQuery(document).ready(function(){
	    	
	    	jQuery('#authMessage').attr('id','flashMessage');
	    	jQuery('#flashMessage').fadeIn(6600);
			jQuery('#flashMessage').append("<a class='flashClose' style='float:right;margin-right:5%;color:white;cursor:pointer;font-weight:bold;'>X</a>");
	    	jQuery('.flashClose').click(function() {
	    		jQuery('#flashMessage').fadeOut(1000);
	    		jQuery('#authMessage').hide();
	    	  });
		    });
	    </script>
	    <?php  echo $this->element('sql_dump');?>
	</body>
</html>