<?php
if(empty($footerdata)){
	$footerdata = $this->requestAction('posts/getFooterData');
	if(isset($footerdata['PostDetail']) && !empty($footerdata['PostDetail']))
		$postDetails = $footerdata['PostDetail'];
	if(isset($footerdata['User']) && !empty($footerdata['User']))
		$users = $footerdata['User'];
}
?>

<div id="footer">
	<div class="main-container">
		<?php if(isset($footerdata['Article'])):?>
			<div class="column one-fourth ">
	        	<div id="my_custom_post-3" class="widget widget_recent_entries">
	        		<h2 class="widgettitle"><span>Recent Articles</span></h2>
	        			<ul>
	        			<?php
//	        			$this->log($footerdata['Article'],"debug");
//	        			$this->log($footerdata['PostDetail'],"debug");
	        			if($this->request->params['controller'] == 'Home' && $this->request->params['action'] == 'index'){
							if(isset($footerdata['Article'][0]))
								unset($footerdata['Article'][0]);
	        				if(isset($footerdata['Article'][1]))
								unset($footerdata['Article'][1]);
	        			}else{
	        				$count = count($footerdata['Article']);
							if($count>3){
								$footerdata['Article'] = array_slice($footerdata['Article'],0,2);
							}
						}
						?>
	        			<?php foreach ($footerdata['Article'] as $key => $article){?>
	        					<?php $content = isset($postDetails[$article['Post']['id']])? current($postDetails[$article['Post']['id']]):array();?>
								<li>
		        					<a href="<?php echo $this->Html->url(array('controller'=>'Articles','action'=>'view',$content['PostContent']['slug']));?>">
		        						<img style="margin-left:0px;" src="/img/contents/small/<?php if(isset($content['Image'][0]['thumbnail'])){echo $content['Image'][0]['thumbnail'];}?>" width="54" height="54" alt="<?php echo $content['PostContent']['title'];?>">
		        					</a>
		        					<h6><a href="<?php echo $this->Html->url(array('controller'=>'Articles','action'=>'view',$content['PostContent']['slug']));?>" title="<?php echo $content['PostContent']['title'];?>"><?php echo (strlen($content['PostContent']['title']) > 23)?substr($content['PostContent']['title'],0,23)."...":$content['PostContent']['title'];?></a></h6>
		        						<p><?php echo str_replace('&nbsp;',' ',substr(strip_tags($content['PostContent']['description']),0,35))?><?php echo '...';?></p>
		        				</li>
	        			<?php }?>
	        			</ul>
	        			<a href="/Articles" class="button shape small green " style="bottom: 0;color:#fffae4;">View All<span></span></a>
	        	</div>
	        	<div id="archives-3" class="widget widget_archive">
	        	</div>
			</div>
		<?php endif;?>
		<?php if(isset($footerdata['LaboratoryTest']) && !empty($footerdata['LaboratoryTest'])):?>
			<div class="column one-fourth ">
				<div id="linkcat-16" class="widget widget_links"><h2 class="widgettitle"><span>Laboratory Tests</span></h2>
					<ul class="xoxo blogroll">
						<?php foreach($footerdata['LaboratoryTest'] as $test):?>
							<li><a style="padding-left: 20px;" href="<?php echo $this->Html->url(array('controller'=>'Tests', 'action'=>'view', $test['Post']['slug']));?>"><?php echo $test['Post']['title']?></a></li>
						<?php endforeach;?>
					</ul>
					<a href="/Tests" class="button shape small green ">View All<span></span></a>
				</div>
			</div>
		<?php endif;?>
		<div class="column one-fourth ">
				<div id="text-2" class="widget widget_text">
					<h2 class="widgettitle"><span>Testimonials</span></h2>
					<div class="textwidget">
						<div class="testimonial-skin-carousel ">
							<div class="jcarousel-container jcarousel-container-horizontal" style="position: relative; display: block;">
									<div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;">
										<ul class="testimonial-carousel  jcarousel-list jcarousel-list-horizontal" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px; width: 1060px;">
											<?php if(isset($footerdata['Message']) && !empty($footerdata['Message'])):?>
												<?php foreach($footerdata['Message'] as $testimonial):?>
												<li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" style="float: left; list-style: none;" jcarouselindex="1">
													<blockquote>
														<p><?php echo (strlen($testimonial['Message']['content']) > 350)?substr(str_replace('<p>&nbsp;</p>','<br/>',$testimonial['Message']['content']),0,350).'...':$testimonial['Message']['content'];?>
															<cite>
																<?php echo $testimonial['Message']['name'];?>
															</cite>
														</p>
													</blockquote>
												</li>
												<?php endforeach;?>
											<?php endif;?>
										</ul>
									</div>
									<div class="jcarousel-prev jcarousel-prev-horizontal jcarousel-prev-disabled jcarousel-prev-disabled-horizontal" style="display: block;" disabled="disabled"></div>
									<div class="jcarousel-next jcarousel-next-horizontal" style="display: block;"></div>
							</div>
						</div>
					</div>
		
				</div>
		</div>
		
		<div class="column one-fourth last">
			<?php if(isset($footerdata['Contact'][0])):?>
			<div id="text-3" class="widget widget_text">
				<?php if(isset($footerdata['PostDetail'][$footerdata['Contact'][0]['Post']['id']])):?>
					<?php foreach($footerdata['PostDetail'][$footerdata['Contact'][0]['Post']['id']] as $contactDetail):?>
						<?php //if($contactDetail['PostContent']['slug'] == 'contact_info'):?>
							<h2 class="widgettitle"><span><?php echo $contactDetail['PostContent']['title'];?></span></h2>
							<div class="textwidget">
								<?php echo $contactDetail['PostContent']['content'];?>
							</div>
						<?php //endif;?>
					<?php endforeach;?>
				<?php endif;?>
			</div>
			<?php endif;?>
			<div id="my_social_links-2" class="widget social-widget">
				<h2 class="widgettitle"><span>		We're social	</span></h2>
					<ul>
						<li><a href="http://www.facebook.com/pages/My-Result-Online/474634745890005?fref=ts" id="linkfb">
								<img src="/img/facebook-hover.png" alt="My Result Online Facebook" title="Facebook">
								<img src="/img/facebook.png" alt="My Result Online Facebook" title="Facebook">
							</a>
						</li>
						<li><a href="https://twitter.com/result_online" id="linktwitter">
								<img src="/img/twitter-hover.png" alt="My Result Online Twitter" title="Twitter">
								<img src="/img/twitter.png" alt="My Result Online Twitter" title="Twitter">
							</a>
						</li>
<!--						<li><a href="#">-->
<!--								<img src="/img/youtube-hover.png" alt="My Result Online Youtube" title="Youtube">-->
<!--								<img src="/img/youtube.png" alt="My Result Online Youtube" title="Youtube">-->
<!--							</a>-->
<!--						</li>			-->
<!--						<li><a href="#">-->
<!--								<img src="/img/rss-hover.png" alt="My Result Online RSS" title="RSS">-->
<!--								<img src="/img/rss.png" alt="My Result Online RSS" title="RSS">-->
<!--							</a>-->
<!--						</li>		-->
					</ul>
			</div>
		</div>
	</div>
	<div id="copyright" style="float:left;width:100%;text-align:center;">
		<p>&copy; My Result Online 2013 | Powered by <a href="http://www.easy.com.ph" target="_blank">IT Easy Software Solutions</a></p>
	</div>
</div>
<script>
jQuery(document).ready(function(){
	jQuery('div.column.one-fourth.last ul li').css('padding-left','20px');
	jQuery('a#linkfb').click(function(){
		var linkvalue = 'http://www.facebook.com/pages/My-Result-Online/474634745890005?fref=ts';
		if(linkvalue){
//			window.location.href = linkvalue;
			window.open(linkvalue);
			return false;
		}
	});
	jQuery('a#linktwitter').click(function(){
		var linkvalue2 = 'https://twitter.com/result_online';
		if(linkvalue2){
//			window.location.href = linkvalue2;
			window.open(linkvalue2);
			return false;
		}
	});

});
</script>