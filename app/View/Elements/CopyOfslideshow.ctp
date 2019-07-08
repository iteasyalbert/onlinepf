<?php 
if(empty($advertisements)){
	$advertisements = $this->requestAction('Home/getMajorAds');
}
?>
<style>
.nivoSlider {
    position:relative;
    background:url(/img/loading.gif) no-repeat 50% 50%;
}
.nivoSlider img {
    position:absolute;
    top:0px;
    left:0px;
    display:none;
    width: 1200px;
    height:300px;
    
}
.nivoSlider a {
    border:0;
    display:block;
}
.nivo-controlNav{
	position: relative;
	top: -50px;
}
#home-slider{
	height:310px;
}
</style>
<div id="home-slider">
	<div class="main-container theme-default">
		<div id="slider" class="nivoSlider">
    			<?php foreach($advertisements as $advertisement):?>
            		<img src="<?php echo $this->Html->url(array('controller' => 'Home','action'=>'mergeImage',$advertisement['Advertisement']['id'],3,1200,400,25));?>" title = "ads_<?php echo $advertisement['Advertisement']['id']?>" style = "width: 1200px;height:300px; visibility: hidden; display: inline-block;" >
            	<?php endforeach;?>
        </div>
	</div>			
</div><script>
			jQuery(document).ready(function(){
	            if($('#slider').length){
        	                $('#slider').nivoSlider({
    					        effect: 'random', // Specify sets like: 'fold,fade,sliceDown'
    					        slices: 15, // For slice animations
    					        boxCols: 8, // For box animations
    					        boxRows: 4, // For box animations
    					        animSpeed: 500, // Slide transition speed
    					        pauseTime: 10000, // How long each slide will show
    					        startSlide: 0, // Set starting Slide (0 index)
    					        directionNav: true, // Next & Prev navigation
    					        controlNav: true, // 1,2,3... navigation
    					        controlNavThumbs: false, // Use thumbnails for Control Nav
    					        pauseOnHover: true, // Stop animation while hovering
    					        manualAdvance: false, // Force manual transitions
    					        prevText: 'Prev', // Prev directionNav text
    					        nextText: 'Next', // Next directionNav text
    					        randomStart: false, // Start on a random slide
    					        beforeChange: function(){
    					        	 $('.nivo-slice', slider).hide();
    					             $('.nivo-box', slider).hide();
        					        }, // Triggers before a slide transition
    					        afterChange: function(){
    					        	 $('.nivo-slice', slider).css('opacity',0);
    					             $('.nivo-box', slider).css('opacity',0);
        					        //$('.nivo-slice', slider).fadeOut('fast');
						            //$('.nivo-box', slider).fadeOut('fast');
						            }, // Triggers after a slide transition
    					        slideshowEnd: function(){
    					        	 $('.nivo-slice', slider).css('opacity',0);
    					             $('.nivo-box', slider).css('opacity',0);
        					        //$('.nivo-slice', slider).fadeOut('fast');
						            //$('.nivo-box', slider).fadeOut('fast');
						            }, // Triggers after all slides have been shown
    					        lastSlide: function(){}, // Triggers when last slide is shown
    					        afterLoad: function(){} // Triggers when slider has loaded
    					    });
		    	}
			});
</script>