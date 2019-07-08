<?php echo $this->Html->script('jquery.mtz.monthpicker.js')?>

	<div id="activity-div" style="padding:5px;">
            <br/>
            <p style="margin:5px;font-size:15px;font-weight:bold;">Your Activities
                  <a onclick="byMonth();return false;" class="save_hmo button small green" style="cursor:pointer;float:right;color:#fffae4;text-decoration:none;padding:3.7px;border-radius: 0 5px 5px 0;font-size:12px;">Go</a>
                   <?php echo $this->Form->input('start_date',array('class'=>'monthpicker start_date','style'=>'width:230px;float:right;','label'=>false,'div'=>false,'value'=>$mo));?>
           		  <label style="float:right;font-size: 11px;margin-left: 10px;margin-top: 2.5px;" >Month:</label>
            </p>
            <br/>
            	<?php $date = '';?>
				<?php //$datetmp = '';?>
				<?php $datenow = date('Y-m-d',strtotime('now'))?>
				<?php if(!$recentActivities):?>
					<p>You have no recent activity.</p>
				<?php endif;?>
				
            	<?php foreach($recentActivities as $key=>$value):?>
            		<?php if(!empty($value['Post']) && !empty($value['PostContent']['id'])):?>
	            	<?php $key = date("Y-m-d",strtotime($key))?>
	    				<?php //$days = (strtotime($datenow) - strtotime($datetmp)) / (60 * 60 * 24);?>
	    				<?php if(empty($datetmp)):?>
	    					<?php //debug($key);?>
	    					<?php //debug($datenow);?>
	    					<?php $days = strtotime($datenow) - strtotime($key);?>
	    				<?php else:?>
	    					<?php $days = strtotime($datenow) - strtotime($key);?>
	    				<?php endif;?>
	    				<?php $days = round($days / (60 * 60 * 24));?>
	    				<?php //debug($days);?>
	    				<?php //debug($key);?>
	            		 <?php if(empty($date)):?>
	            		 	<?php if($key == date('Y-m-d',strtotime('now'))):?>
		            			<p style="margin:5px;font-size:12px;font-weight:bold;">Today</p>
	            		 	<?php elseif($days == 1):?>
		           	 			<p style="margin:5px;font-size:12px;font-weight:bold;">Yesterday</p>
		            		<?php else:?>
		            			<p style="margin:5px;font-size:12px;font-weight:bold;"><?php echo date("F j, Y",strtotime($key))?></p>
		            		<?php endif;?>
		            		<?php $date = $key;?>
	            		<?php elseif($date == $key):?>
		            		<?php $date = $key;?>
	
		            	<?php else:?>
		            		<?php if($days == 1):?>
		           	 		<hr style="margin:5px;"/><p style="margin:5px;font-size:12px;font-weight:bold;">Yesterday</p>
		            		<?php else:?>
		            		<hr style="margin:5px;"/><p style="margin:5px;font-size:12px;font-weight:bold;"><?php echo date("F j, Y",strtotime($key))?></p>
		            		<?php endif;?>
		            		<?php $date = $key;?>
		            	<?php endif;?>
		            		<?php
	//	            		debug($days);
		            		$type = '';
		            		if(isset($value['Post']['status']) && $value['Post']['type'] == 1){
		            			$type = '<img src="/img/article.png" style="height:27px;" />'.'<span style="vertical-align: top;">You posted an article - ';
		            			$link = "/articles/view/".$value['PostContent']['slug'];
		            		}elseif(isset($value['Post']['status']) && $value['Post']['type'] == 3){
		            			$type = '<img src="/img/key_question.png" style="height:27px;" />'.'<span style="vertical-align: top;">You asked a question - ';
		            			$link = "/questions/view/".$value['PostContent']['slug'];
	            			}else{
	            				$type = '<img src="/img/comments.png" style="height:27px;" />'.'<span style="vertical-align: top;">You commented to ';
	            				if($value['Post']['Post']['type'] == 1){
	            					$link = "/articles/view/".$value['PostContent']['slug'];
	            				}else if($value['Post']['Post']['type'] == 4){
	            					$link = "/news/view/".$value['PostContent']['slug'];
	            				}else if($value['Post']['Post']['type'] == 5){
	            					$link = "/events/view/".$value['PostContent']['slug'];
	            				}else if($value['Post']['Post']['type'] == 3){
	            					$link = "/questions/view/".$value['PostContent']['slug'];
	            				}
	            			}
	            			
		            		?>
		            		<p style="text-indent:20px;"><?php echo $type.'<a href="'.$link.'" style="vertical-align: top;color:#092F5E;">'.$value['PostContent']['title'].'</a>';?> - <i style="font-size:11px;vertical-align: top;">
	
			            		<?php if(isset($value['Post']['status']) && $value['Post']['status'] == 0):?>
	                        		<?php echo date("g:i a",strtotime($value['PostContent']['entry_datetime']))?></i>
	                        		<span style="vertical-align: top;float:right;font-size:11px;color:red;"><i>Waiting for approval.</i></span>
			            		<?php elseif(isset($value['Post']['status']) && $value['Post']['status'] == 1):?>
			            			<?php echo date("g:i a",strtotime($value['PostContent']['entry_datetime']))?></i>
			            			 <span style="vertical-align: top;float:right;font-size:11px;color:green;">
										<i>
			            				<?php
										$count = count($value['Reply']);
										if($count == 1){
											echo 'Recieved '.$count.' comment.';
										}else if($count > 1){
											echo 'Recieved '.$count.' comments.';
										}
										?>
										</i>
									</span>
			            		<?php elseif(isset($value['Reply']['status']) && $value['Reply']['status'] == 1):?>
			            			<?php echo date("g:i a",strtotime($value['Reply']['entry_datetime']))?></i>
			            		<?php elseif(isset($value['Reply']['status']) && $value['Reply']['status'] == 0):?>
			            			<?php echo date("g:i a",strtotime($value['Reply']['entry_datetime']))?></i>
			            			<span style="vertical-align: top;float:right;font-size:11px;color:red;"><i>Waiting for approval.</i></span>
			            		<?php else:?>
			            			<?php //echo date("g:i a",strtotime($value['PostContent']['entry_datetime']))?></i>
	                        	<?php endif;?>
			            		</span>
		            		</p>
		            		
	<!--	            		<span><?php echo date("D F d, o",strtotime($value['PostContent']['entry_datetime']));?></span><hr style="margin:5px 0px;width:100%" />-->
            		<?php endif;?>
                <?php endforeach;?>
            	<hr style="margin:5px;"/>
            	<br/>
            	<br/>
            	<br/>
            	<br/>
            </div>
            
 <style>
     div#activity-div .ui-datepicker .ui-datepicker-header { padding:.0 !important; }
	div#activity-div .ui-datepicker .ui-datepicker-title select {
		font-size: 10px !important;
		margin: 0px !important;
	}
    div#activity-div .ui-widget-header {
		border: 0px solid transparent !important ;
		background: #ccccc url(images/ui-bg_highlight-soft_75_cccccc_1x100.png) 50% 50% repeat-x;
		color: #222222;
		font-weight: bold;
	}
	div#activity-div #ui-datepicker-div{
		width:180px;
	}
 
 </style>
 <script>
 jQuery('document').ready(function(){
     jQuery('.monthpicker').css({'width': '140px','height': '25px','padding': '0px 10px'});
		options = {
 		    pattern: 'yyyy-mm', // Default is 'mm/yyyy' and separator char is not mandatory
// 		    selectedYear: 2010,
 		    startYear: 2012,
 		    finalYear: 2020,
// 		    monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec']
 		};

 	$('.monthpicker').monthpicker(options);
 	

 });
function byMonth(){
		showLoadingMask();
		var monthData = jQuery('.monthpicker').val();
        jQuery.ajax({
            url: '<?php echo $this->Html->url(array('controller' => 'patients', 'action' => 'getActivity', 'patient' => false)); ?>',
        	data:{'data':monthData},
			type: 'POST',
			dataType : 'html',
			asynch:false,
			success:function(data){
               hideLoadingMask();
                 if(data){
                    jQuery('#activity div').html(data);
                 }else{

              	 }
            }
        });
}

 
 </script>