<div class="navbar navbar-inverse navbar-static-top" role="navigation" id="mainmenu-navbar-collapse">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" ng-click="navExpandedMain = !navExpandedMain">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<?php 
		$classes = array(
			'index' => '',
			'departments' => '',
			'services' => '',
			'gallery' => '',
			'aboutus' => '',
			'contactus' => '',
		);
		$classes[$this->request->params['action']] = 'active';
		?>
		<div class="navbar-collapse collapse" aria-expanded="false" style="height: 0px;" uib-collapse="!navExpandedMain" aria-hidden="true">
			<ul class="nav navbar-nav navbar-right">
				<li class="<?php echo $classes['index'];?>"><a href="<?php echo $website['url'];?>/home"><span>HOME</span></a></li>
				<li class="<?php echo $classes['services'];?>"><a href="<?php echo $website['url'];?>/home/services"><span>SERVICES</span></a></li>
				<li class=""><a href="/"><span>RESULT ONLINE</span></a></li>
				<li class="<?php echo $classes['departments'];?>"><a href="<?php echo $website['url'];?>/home/departments"><span>DEPARTMENTS</span></a></li>
				<li class="<?php echo $classes['gallery'];?>"><a href="<?php echo $website['url'];?>/home/gallery"><span>GALLERY</span></a></li>
				<li class="<?php echo $classes['aboutus'];?>"><a href="<?php echo $website['url'];?>/home/aboutus"><span>ABOUT US</span></a></li>
				<li class=""><a href="<?php echo $website['url'];?>/home"><span>OUR TEAM</span></a></li>
				<li class="<?php echo $classes['contactus'];?>"><a href="<?php echo $website['url'];?>/home/contactus"><span>CONTACT US</span></a></li>
			</ul>
		</div>
	</div>
</div>