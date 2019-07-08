<?php
	if(empty($advertisements)){
		$advertisements = $this->requestAction('Home/getMajorAds');
	}
?>
<style>
	#home-slider{
		height:320px;
	}
	.info_slide_dots{
		top:260px;
		text-align:center;
	}
	.image_number_select{
		background-color: rgb(204, 51, 51); color: rgb(255, 255, 255);
	}
	.image_number{
		background-color: rgb(51, 51, 51); color: rgb(255, 255, 255);
	}
</style>

<div id="home-slider">
	<div class="main-container theme-default">
		<div class="box_skitter box_skitter_large" align ="center">
		    <ul>
		    	<?php
		    		$imageSlugs = array();
		    		array_pop($advertisements);
		    		$remove = true;
		    	?>
    			<?php foreach($advertisements as $advertisement):
    					$sluggedName = Inflector::slug($advertisement['Advertisement']['image']);
						$imageSlugs[$sluggedName]['id'] = $advertisement['Advertisement']['id'];
    					$imageSlugs[$sluggedName]['type'] = $advertisement['Advertisement']['type'];
    					if(strlen($advertisement['Advertisement']['external_link']))
	    					$imageSlugs[$sluggedName]['external_link'] = $advertisement['Advertisement']['external_link'];
	    				else
	    					$imageSlugs[$sluggedName]['external_link'] = $this->Html->url(array('controller' => 'advertisements','action' => 'view',$advertisement['Advertisement']['id']));
	    				
	    				if($remove && $advertisement['Advertisement']['type'] == 2){
							$remove = false;
							continue;
						}
						?>
            		<li>
	            		<img id="<?php echo Inflector::slug($advertisement['Advertisement']['image']);?>" src="<?php echo $this->Html->url(array('controller' => 'Home','action'=>'mergeImage',Inflector::slug($advertisement['Advertisement']['image']),($advertisement['Advertisement']['type'] == 1)?1:3,950,340,25));?>" title = "ads_<?php echo $advertisement['Advertisement']['id']?>" style = "width: 1200px;height:300px; visibility: hidden; display: inline-block;" >
	            	</li>
            	<?php endforeach;?>
		    </ul>
		
		</div>
		
	</div>
			
</div>
<script>
	var imageInfos = <?php echo $this->Js->object($imageSlugs);?>;
	var imagecount = 3;
	var padding = 25;
	var width = 940;
	var height = 360;
	var imageIds = [];
	var imageSlugs = [];
	var imageTypes = [];
	var imageLinks = [];
	var link = '<?php echo $this->Html->url(array('controller'=>'Advertisements','action'=>'view'));?>';

	jQuery(document).ready(function(){
		var resizeTimer;
		$(window).resize(function() {
//			alert(getWindowSize());
		    clearTimeout(resizeTimer);
		    resizeTimer = setTimeout(ResizeCss, 50);
		});
		if (!Array.prototype.indexOf) {
		    Array.prototype.indexOf = function (elt /*, from*/) {
		        var len = this.length >>> 0;
		        var from = Number(arguments[1]) || 0;
		        from = (from < 0) ? Math.ceil(from) : Math.floor(from);
		        if (from < 0) from += len;

		        for (; from < len; from++) {
		            if (from in this && this[from] === elt) return from;
		        }
		        return -1;
		    };
		}
		jQuery.each(imageInfos,function(x,y){
			imageIds.push(y.id);
			imageSlugs.push(x);
			imageTypes.push(y.type);
			imageLinks.push(y.external_link);
		});
		
		$('.box_skitter_large').skitter({
			animation: 'random',
			controls_position: 'center',
			dots:true,
			controls:false,
			numbers:false,
			interval:5000,
			afterAnimation:finishAnim,
			afterSetup:finishSetup
		});


	
	});
	var finishAnim = function(skitter){
		currentimageid = skitter.settings.image_id;
		currentindex = skitter.settings.image_i;
		len = skitter.settings.images_links.length;


		jQuery('span.image_number').removeClass('image_number_select');
		jQuery('span.image_number:eq('+(currentindex-1)+')').addClass('image_number_select');
		
		setLinks(currentimageid);
	};

	var finishSetup = function(skitter){

		var imageWidth;
		var imageHeight;

		imageWidth = (width - (padding*(imagecount+1)))/imagecount;
		imageHeight = height - (padding*2);
		imageWidth += 3;
		imageHeight *= parseFloat('.8');
		imageHeight -= 4;

		jQuery('<a/>',{
		    name: 'ads_link',
		    'class': 'single',
		    target:'_blank'
		}).css({'background':'#fff','opacity':'0','position':'absolute','left':padding,'top':padding,'display':'none','z-index':99,'width':'auto','height':imageHeight}).appendTo('#home-slider > div > div');
		
		for(i = 0;i< imagecount;i++){
			
			x = ((imageWidth)*i) + ((i+1)*padding);
			jQuery('<a/>',{
			    name: 'ads_link',
			    'class': 'multiple',
			    target:'_blank'
			}).css({'background':'#fff','opacity':'0','position':'absolute','left':x,'top':padding,'display':'none','z-index':99,'width':'auto%','height':imageHeight}).appendTo('#home-slider > div > div');

		}
		
		setLinks(imageSlugs[0]);
		
		jQuery('span.image_number').removeAttr('style');
		jQuery('.info_slide_dots').css('left',((width - (jQuery('span.image_number').width() * skitter.settings.images_links.length ))/2) + 'px' );
	};

	function setLinks(id){
		currentid = imageSlugs.indexOf(id);
		imageIndexes = [];

		
		
		if(imageTypes[currentid] == 2){
			jQuery('a[name=ads_link].multiple').show();
			jQuery('a[name=ads_link].single').hide();
			
			classText = 'multiple';
			
			countLeft = 0;
			countRight = 0;
	
			if(((imagecount-1) % 2) > 0){
				countLeft = floor((imagecount-1)/2);
	        	$rightCount = floor((imagecount-1)/2) + 1;
	        }else{
	        	countLeft = (imagecount-1)/2;
	        	countRight = (imagecount-1)/2;
	        }
			
	
			index = currentid;
	        for(i = 0;i < countLeft;i++){
	            index--;
	            if(index<0)
	                index = imageSlugs.length-1;
				imageIndexes.push(index);
				
	        }
	        index = currentid;
	        imageIndexes.push(index);
	        
	        for(i = 0;i < countRight;i++){
	            index++;
	            if(index == imageSlugs.length)
	                index = 0;
				imageIndexes.push(index);
			}
		}else if(imageTypes[currentid] == 1){
			jQuery('a[name=ads_link].multiple').hide();
			jQuery('a[name=ads_link].single').show();
			classText = 'single';
			imageIndexes.push(currentid);
		}
		
		
		jQuery('#home-slider > div > div > a[name=ads_link].'+classText).each(function(x,y){
			jQuery(this).attr('href','http://'+imageLinks[imageIndexes[x]].trim());//jQuery.trim(link)+'/'+imageIds[imageIndexes[x]]);
		});
    }
	function ResizeCss(){
/*
			jQuery('div.image a img.image_main').css({'width':'100%','height':'100%'});
			jQuery('div.container_skitter').css({'width':'100%'});
			jQuery('span.info_slide_dots').css({'left':(getWindowWidth()-50)/2+'px'});
			jQuery('span.info_slide_dots').css({'display':'none'});
			jQuery('.box_skitter .box_clone img').css({'display':'none'});
			//.box_skitter .box_clone img {position:absolute;top:0;left:0;z-index:20;}
		*/
		
	}

</script>
