<div id="top-menu" style="height:55px">
	<ul id="main-menu" class="menu">
		<li>
			<?php echo $this->Html->link("<span></span>Patient Logs",array('controller' => 'Patients','action' => 'index'),array('escape'=>false)); ?>
		</li>
		<li>
			<?php echo $this->Html->link("<span></span>Physician Logs",array('controller' => 'Physicians','action' => 'index'),array('escape'=>false)); ?>
		</li>
		<li>
			<?php echo $this->Html->link("<span></span>Reports",array('controller' => 'Physicians','action' => 'index'),array('escape'=>false)); ?>
		</li>
		</ul>
		
</div>
<script>
	jQuery(document).ready(function(){
		count = jQuery('ul.menu > li').length;
		//jQuery('ul.menu li').css('width',(100 / count) +"%");
	});
</script>