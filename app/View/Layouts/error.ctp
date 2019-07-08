<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $title_for_layout;?></title>
		
		<link rel="icon" href="/img/icon.png" type="image/x-icon">
	    <!-- **Favicon** -->
	    
		<link rel="shortcut icon" type="image/ico" href="<?php // echo $favicon;?>"/>
		   
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
		
		<?php echo $this->Html->script('jquery-ui-personalized-1.6rc62.js');?>
		
		<?php echo $this->Html->script('sprinkle.js');?>
		<?php echo $this->Html->script('common');?>
		<?php echo $this->Html->script('profiles');?>
		<?php echo $this->Html->script('jquery.vticker.js');?>
		
		<?php echo $this->Html->script('ckeditor/ckeditor.js'); ?>
		
		
		
		
	</head>
	<body>
		    	<?php echo $content_for_layout ?>

	</body>
</html>