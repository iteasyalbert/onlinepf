<div class="navbar navbar-default navbar-static-top" role="navigation" id="mainmenu-navbar-collapse">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" ng-click="navExpandedMain = !navExpandedMain">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="navbar-collapse collapse" aria-expanded="false" style="height: 0px;" uib-collapse="!navExpandedMain" aria-hidden="true">
			<span class="navbar-text">
				We believe every interaction with our patients is an opportunity!
			</span>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="https://www.facebook.com/Philippine-Society-of-Pathologists-232421263467403/">
						<?= $this->Html->image('/img/pcqacl/social-facebook.png',array('width' => '20px','class' => 'social-media-logo')) ?>
					</a>
				</li>
				<li>
					<a href="#">
						<?= $this->Html->image('/img/pcqacl/social-gplus.png',array('width' => '20px','class' => 'social-media-logo')) ?>
					</a>
				</li>
				<li>
					<a href="#">
						<?= $this->Html->image('/img/pcqacl/social-linkedin.png',array('width' => '20px','class' => 'social-media-logo')) ?>
					</a>
				</li>
				<li>
					<a href="<?php echo $website['url'].'/home/index';?>#home-services" > <span class="btn exp-link"  style="margin-top:5px;width:auto;">+ =BOOK APPOINTMENT </span> </a>
				</li>
			</ul>
			
		</div>
	</div>
</div>
