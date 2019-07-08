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
				<li class="<?php echo $classes['index'];?>"><a href="/home"><span>HOME</span></a></li>
				<li class="<?php echo $classes['services'];?>"><a href="/home/services"><span>SERVICES</span></a></li>
				<li class=""><a href="/home"><span>RESULT ONLINE</span></a></li>
				<li class="<?php echo $classes['departments'];?>"><a href="/home/departments"><span>DEPARTMENTS</span></a></li>
				<li class="<?php echo $classes['gallery'];?>"><a href="/home/gallery"><span>GALLERY</span></a></li>
				<li class="<?php echo $classes['aboutus'];?>"><a href="/home/aboutus"><span>ABOUT US</span></a></li>
				<li class=""><a href="/home"><span>OUR TEAM</span></a></li>
				<li class="<?php echo $classes['contactus'];?>"><a href="/home/contactus"><span>CONTACT US</span></a></li>
			</ul>
		</div>
	</div>
</div>