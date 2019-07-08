<?php 
		if(isset($filterparams) && !empty($filterparams)){
			$this->Paginator->options(array('url' =>$filterparams ));
		}

		if(isset($physicians)){
			
			$count = $this->Paginator->counter('{:count}');
			if($count==0 || $count==1)
				$doctor='Physician';
			else
				$doctor='Physicians';
			?><h2 class="menu-title" style="margin-bottom: 3px; font-size: 15px; color: green;"><span><?php if($count=='')$count=0; echo $count.' '.$doctor;?> Filtered.</span></h2><?php 
				$letter='';
				$newletter='';
				$divnum=1;
				?><div class="menu-list" style="margin: 0px;"><?php
				foreach($physicians as $displayKey=>$displayValue):
					$letter = $displayValue['People']['lastname'][0];
					$lower = strtolower($letter);
					$upper = strtoupper($letter);	
					if($newletter<>$lower && $newletter<>$upper){
						?><div class="menu-list" style="margin: 30px 0px 0px 0px;"><h2><?php echo $letter;?></h2></div>
						
						<div class="column one-half" style="padding-bottom:0px;">
							<div class="menu-image">
								<span class="border " style="width: 100px;">
									<img src="http://iamdesigning.com/themes/spatreats/wp-content/uploads/2012/10/spa13.jpg" alt="Etiam a enim nec sem hendrerit" style="height: 100px; width: 100px;">
								</span>
							</div>	                                     
							<div class="menu-details"  style=" margin: 0 0 0 58px; width: 60%;">                                   
								<table style="font-size: 11px;">
									<tr>
										<td colspan="2" style="background:none repeat scroll 0 0;padding:0px;">
											<h2 class="menu-title" style="margin-bottom: 3px; font-size: 15px;"><span><?php echo $this->Html->link($displayValue['People']['lastname'].', '.$displayValue['People']['firstname'].' '.$displayValue['TitleCode']['display'],'/physician/'.$displayValue['People']['id'].'/'.$displayValue['People']['lastname']);?></span></h2>								
										</td>
									</tr>
									<tr>
										<td style="background:none repeat scroll 0 0;padding:0px;">
											<span>Address:</span>	
										</td>
										<td style="background:none repeat scroll 0 0;padding:0px;">
											<span><?php echo $displayValue['TownCityCode']['name'].", ".$displayValue['ProvincesStatesCode']['name'];?></span>
										</td>
									</tr>
									<tr>
										<td style="background:none repeat scroll 0 0;padding:0px;">
											<span>Contact Info:</span>	
										</td>
										<td style="background:none repeat scroll 0 0;padding:0px;">
											<span>709-7469</span>
										</td>
									</tr>
									<tr>
										<td style="background:none repeat scroll 0 0;padding:0px;">
											<span class="sub-title"><?php echo $this->Html->link('View Details','/physician/'.$displayValue['People']['id'].'/'.$displayValue['People']['lastname']);?></span>	
										</td>
									</tr>
								</table>
							</div>
							
							<div class="hr " style="margin-top:10px; margin-bottom:10px;"></div>
							
							<?php $divnum=1;?>
							
						</div>
						<?php 
						$newletter=$letter;					
					}
					else{
						if($divnum==1){
							?><div class="column one-half last"><?php 
							$divnum=2;
						}
						else{
							?><div class="column one-half"><?php
							$divnum=1;
						}
						?>
							<div class="menu-image">
								<span class="border " style="width: 100px;">
									<img src="http://iamdesigning.com/themes/spatreats/wp-content/uploads/2012/10/spa13.jpg" alt="Etiam a enim nec sem hendrerit" style="height: 100px; width: 100px;">
								</span>
							</div>	                                     
							<div class="menu-details" style=" margin: 0 0 0 58px; width: 60%;">                                   
								<table style="font-size: 11px;">
									<tr>
									<td colspan="2" style="background:none repeat scroll 0 0;padding:0px;">
										<h2 class="menu-title" style="margin-bottom: 3px; font-size: 15px;"><span><?php echo $this->Html->link($displayValue['People']['lastname'].', '.$displayValue['People']['firstname'].' '.$displayValue['TitleCode']['display'],'/physician/'.$displayValue['People']['id'].'/'.$displayValue['People']['lastname']);?></span></h2>								
									</td>
									</tr>
									<tr>
										<td style="background:none repeat scroll 0 0;padding:0px;">
											<span>Address:</span>	
										</td>
										<td style="background:none repeat scroll 0 0;padding:0px;">
											<span><?php echo $displayValue['TownCityCode']['name'].", ".$displayValue['ProvincesStatesCode']['name'];?></span>
										</td>
									</tr>
									<tr>
										<td style="background:none repeat scroll 0 0;padding:0px;">
											<span>Contact Info:</span>	
										</td>
										<td style="background:none repeat scroll 0 0;padding:0px;">
											<span>709-7469</span>
										</td>
									</tr>
									<tr>
										<td style="background:none repeat scroll 0 0;padding:0px;">
											<span class="sub-title"><?php echo $this->Html->link('View Details','/physician/'.$displayValue['People']['id'].'/'.$displayValue['People']['lastname']);?></span>						
										</td>
									</tr>
								</table>
							</div>
						<div class="hr " style="margin-top:10px; margin-bottom:10px;"></div>
						</div>
			
						<?php 
						$newletter=$letter;	
					}
				endforeach;
			
				if(!empty($count) && $count > 20){
				?>
				<div class="pagination" style="color:green;">

					<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>

					| 	<?php echo $this->Paginator->numbers();?> |	
					<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>

				</div>
				<?php 
				}
				?>
			</div>	
				<?php
		}
		?>   