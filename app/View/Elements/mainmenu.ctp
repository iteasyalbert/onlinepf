<?php $user = $this->Session->read('Auth.User');?>
<?php $membershipdata = $this->requestAction('posts/getMembershipData');?>
	<div id="top-menu">
		<div class="menu-main-menu-container">
			<ul id="main-menu" class="menu">
				<?php //debug($this->params['controller']);?>
				<li id="menu-item-651" class="menu-item menu-item-type-post_type menu-item-object-page<?php if($this->params['controller'] == 'Home' && $this->params['action'] == "index"):?> current_page_item<?php endif;?>"><?php echo $this->Html->link("<span>Its Home.</span>Home",array('controller' => 'Home','action' => 'index'),array('escape'=>false)); ?></li>
				<li id="menu-item-652" class="menu-item menu-item-type-post_type menu-item-object-page<?php if($this->params['controller'] == 'Abouts' && $this->params['action'] == "index"):?> current_page_item<?php endif;?>" >
					<a href="/Abouts">
						<span>Who we are?</span>About Us
					</a>
				</li>
				<li id="menu-item-653" class="menu-item menu-item-type-post_type menu-item-object-page<?php if($this->params['controller'] == 'Services' && $this->params['action'] == "index"):?> current_page_item<?php elseif($this->params['controller'] == 'Services' && $this->params['action'] == "get_result"):?> current_page_item<?php elseif(($this->params['controller'] == 'Laboratories' || $this->params['controller'] == 'laboratories') && $this->params['action'] == "search"):?> current_page_item<?php elseif(($this->params['controller'] == 'Physicians' || $this->params['controller'] == 'physicians') && $this->params['action'] == "search"):?> current_page_item<?php elseif(($this->params['controller'] == 'Hospitals' || $this->params['controller'] == 'hospitals') && $this->params['action'] == "search"):?> current_page_item<?php endif;?>" ><?php echo $this->Html->link("<span>What we offer?</span>Services",array('controller' => 'Services','action' => 'index'),array('escape'=>false)); ?>
					<ul class="sub-menu">
						<li id="menu-item-654" class="menu-item menu-item-type-post_type menu-item-object-page">
						<?php if($uid)
							{
								if($user['role'] == 9){
									echo $this->Html->link('Get Results',array('controller' => 'Patients','action' => 'profile','patient'=>true));
								}elseif($user['role'] == 6){
									echo $this->Html->link('Get Results',array('controller' => 'Physicians','action' => 'profile','physician'=>true));
								}elseif($user['role'] == 11){
									echo $this->Html->link('Get Results',array('controller' => 'CorporateAccounts','action' => 'profile','corporate'=>true));
								}elseif($user['role'] == 3){
									echo $this->Html->link('Get Results',array('controller' => 'Laboratories','action' => 'profile','laboratory'=>true));
								}else{
									echo $this->Html->link('Get Results','/Services/get_result', array('class'=>'get_result'));
								}
							}else{
								echo $this->Html->link('Get Results','/Services/get_result', array('class'=>'get_result'));
							}
						?>
						</li>
						<li id="menu-item-655" class="menu-item menu-item-type-post_type menu-item-object-page">
							<?php echo $this->Html->link('Laboratories',array('controller'=>'laboratories', 'action'=>'search'));?>
						</li>
						<li id="menu-item-656" class="menu-item menu-item-type-post_type menu-item-object-page">
							<?php echo $this->Html->link('Doctors',array('controller'=>'physicians', 'action'=>'search'));?>
						</li>
						<li id="menu-item-657" class="menu-item menu-item-type-post_type menu-item-object-page">
							<?php echo $this->Html->link('Hospitals',array('controller'=>'hospitals','action'=>'search'));?>
						</li>
					</ul>
				</li>
				<li id="menu-item-658" class="menu-item menu-item-type-post_type menu-item-object-page<?php if($this->params['controller'] == 'Supports' && $this->params['action'] == "faqs"):?> current_page_item<?php elseif($this->params['controller'] == 'Supports' && $this->params['action'] == "download"):?> current_page_item<?php elseif($this->params['controller'] == 'Glossaries' && $this->params['action'] == "view"):?> current_page_item<?php endif;?>" >
					<?php echo $this->Html->link("<span>Need help?</span>Support",array('controller' => 'Supports','action' => 'faqs'),array('escape'=>false)); ?>
					<ul class="sub-menu">
						<li id="menu-item-659" class="menu-item menu-item-type-post_type menu-item-object-page">
							<?php echo $this->Html->link('FAQs',array('controller'=>'Supports', 'action'=>'faqs'));?>
						</li>
						<li id="menu-item-660" class="menu-item menu-item-type-post_type menu-item-object-page">
							<?php echo $this->Html->link('Contact Us',array('controller'=>'Supports', 'action'=>'contact_us'));?>
						</li>
						<li id="menu-item-661" class="menu-item menu-item-type-post_type menu-item-object-page">
							<?php echo $this->Html->link('Download',array('controller'=>'Supports','action'=>'download'));?>
						</li>
						<li id="menu-item-662" class="menu-item menu-item-type-post_type menu-item-object-page">
							<?php echo $this->Html->link('Glossary',array('controller'=>'Glossaries','action'=>'view','glossaries'));?>
						</li>
					</ul>
				</li>
				<li id="menu-item-663" class="menu-item menu-item-type-post_type menu-item-object-page<?php if($this->params['controller'] == 'Membership' && $this->params['action'] == "index"):?> current_page_item<?php elseif($this->params['controller'] == 'Users' && $this->params['action'] == "sign_up"):?> current_page_item<?php elseif($this->params['controller'] == 'Membership' && $this->params['action'] == "view"):?> current_page_item<?php elseif($this->params['controller'] == 'Membership' && $this->params['action'] == "advertise_us"):?> current_page_item<?php endif;?>" >
					<?php echo $this->Html->link("<span>Be one of us.</span>Membership",array('controller' => 'Membership','action' => 'index'),array('escape'=>false)); ?>
					<ul class="sub-menu">
						<li id="menu-item-664" class="menu-item menu-item-type-post_type menu-item-object-page">
							<?php if($logged_in){
									if($user['role'] == 9){
										echo $this->Html->link('Result',array('controller' => 'Patients','action' => 'profile','patient'=>true));
									}elseif($user['role'] == 6){
										echo $this->Html->link('Result',array('controller' => 'Physicians','action' => 'profile','physician'=>true));
									}elseif($user['role'] == 3){
										echo $this->Html->link('Result',array('controller' => 'Laboratories','action' => 'profile','laboratory'=>true));
									}elseif($user['role'] == 11){
										echo $this->Html->link('Result',array('controller' => 'CorporateAccounts','action' => 'profile','corporate'=>true));
									}elseif($user['role'] == 1){
										echo $this->Html->link('Result','/Services/get_result', array('class'=>'get_result'));
									}elseif($user['role'] == 10){
										echo $this->Html->link('Result','/Services/get_result', array('class'=>'get_result'));
									}
							}else{
								echo $this->Html->link('Sign Up','/Users/sign_up');
							}?>
						</li>
						<?php foreach($membershipdata as $key=>$value):?>
						<li id="menu-item-665" class="menu-item menu-item-type-post_type menu-item-object-page">
							<?php echo $this->Html->link($value['Post']['title'],array('controller' => 'Membership','action'=>'view',$value['Post']['slug']));?>
						</li>
						<?php endforeach;?>
						<li id="menu-item-666" class="menu-item menu-item-type-post_type menu-item-object-page">
							<?php echo $this->Html->link('Advertise',array('controller' => 'Membership','action' => 'advertise_us'));?>
						</li>
					</ul>
				</li>
				<li id="menu-item-667" class="menu-item menu-item-type-post_type menu-item-object-page<?php if($this->params['controller'] == 'Supports' && $this->params['action'] == 'contact_us'):?> current_page_item<?php endif;?>" ><?php echo $this->Html->link("<span>Talk to us.</span>Contact Us",array('controller'=>'Supports', 'action'=>'contact_us'),array('escape'=>false)); ?></li>
				<li id="menu-item-668" class="menu-item menu-item-type-post_type menu-item-object-page<?php if($this->params['controller'] == 'Tests'):?> current_page_item<?php endif;?>" ><?php echo $this->Html->link("<span>Know your Lab test.</span>Lab Tests",array('controller' => 'Tests','action' => 'index'),array('escape'=>false)); ?></li>
				<li id="menu-item-669" class="menu-item menu-item-type-post_type menu-item-object-page<?php if($this->params['controller'] == 'Careers'):?> current_page_item<?php endif;?>" ><?php echo $this->Html->link("<span>Looking for job?</span>Career",array('controller' => 'Careers','action' => 'index'),array('escape'=>false)); ?></li>
			</ul>
		</div>
	</div>
