<?php

if(empty($posts)){
	$posts = $this->requestAction('posts/getSidebarData');
	if(isset($posts['PostDetail']) && !empty($posts['PostDetail']))
		$postDetails = $posts['PostDetail'];
	if(isset($posts['User']) && !empty($posts['User']))
		$users = $posts['User'];
	
}
?>
<div class="sidebar">
	<?php if(!empty($posts['Question']) && isset($posts['Question'])):?>
		<div id="recent-posts-2" class="widget widget_recent_entries">
			<h2 class="widgettitle">
				<span>
					<?php echo $this->Html->link('Recent Questions',array(
						'controller'=>'Questions', 'action'=>'index'
					));?>
				</span>
			</h2>
			<ul id="flower-bullet">
				<?php foreach($posts['Question'] as $question):?>
					<?php $content = isset($postDetails[$question['Post']['id']])? current($postDetails[$question['Post']['id']]):array();?>
					<?php if($content):?>
					<li>
						<?php
						$title = (strlen($content['PostContent']['title']) > 100)?substr($content['PostContent']['title'],0,100).'...':$content['PostContent']['title'];
						echo $this->Html->link(
							"<b>".$title."</b> by <b>".$users[$question['Post']['user_id']]['firstname']."</b>, ".date("D F d, o",strtotime($content['PostContent']['entry_datetime'])),
							array(
								'controller' => 'questions',
								'action' => 'view',
								$content['PostContent']['slug']
							),
							array(
								'escape' => false
							)
						);
						?>
					</li>
					<?php endif;?>
				<?php endforeach;?>
			</ul>
		</div>
	<?php endif;?>
	<?php if(isset($posts['Reply'])):?>
		<div id="recent-posts-2" class="widget widget_recent_entries">
			<h2 class="widgettitle"><span>Recent Article Comments</span></h2>
			<ul>
				<?php foreach($posts['Reply'] as $reply):?>
					<li>
						<?php
						$title = (strlen($reply['PostContent']['title']) > 100)?substr($reply['PostContent']['title'],0,100).'...':$reply['PostContent']['title'];
						echo $this->Html->link(
							"<b>".$users[$reply['Reply']['user_id']]['firstname']."</b> on <b>".$title."</b>, ".date("D F o",strtotime($reply['Reply']['entry_datetime'])),
							array(
								'controller' => 'Articles',
								'action' => 'view',
								$reply['PostContent']['slug']
							),
							array(
								'escape' => false
							)
						);
						?>
					</li>
				<?php endforeach;?>
			</ul>
		</div>
	<?php endif;?>
	<?php if(isset($posts['Category'])):?>
		<div id="recent-posts-2" class="widget widget_recent_entries">
			<h2 class="widgettitle"><span>Categories</span></h2>
			<ul>
				<?php foreach($posts['Category'] as $categoryId => $subject):?>
					<li>
						<?php
						echo $this->Html->link(
							"<b>".$subject."</b>",
							array(
								'controller' => 'articles',
								'action' => 'index',
								$categoryId
							),
							array(
								'escape' => false
							)
						);
						?>
					</li>
				<?php endforeach;?>
			</ul>
		</div>
	<?php endif;?>
	
</div>