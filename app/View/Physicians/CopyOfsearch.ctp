<div class="content menu-items-list content-full-width">  
	<?php $this->Html->script('http://maps.google.com/maps/api/js?sensor=true',  false); ?>    
	<?php echo $this->element('sidebar');?>
	<div class="column three-fourth">	
		<h1>List of Doctors</h1>
		<?php 
		$defaultProvince = $defaultprovince;
		$defaultTown = $defaulttown;
		$defaultVillage = $defaultvillage;
		$defaultHmo = $defaulthmo;
		$defaultSpecialty = $defaultspecialty;
		$defaultLastname = '';
		if(isset($filterparams) && !empty($filterparams)){
			$this->Paginator->options(array('url' =>$filterparams ));
//			debug($filterparams);
			foreach($filterparams as $name=>$value){
				if($name=='Address.province_state_id' && !empty($filterparams['Address.province_state_id']))
					$defaultProvince = $value;
				if($name=='Address.town_city_id' && !empty($filterparams['Address.town_city_id']))
					$defaultTown = $value;
				if($name=='Address.village_id' && !empty($filterparams['Address.village_id']))
					$defaultVillage = $value;
				if($name=='InsuranceProviderProduct.id' && !empty($filterparams['InsuranceProviderProduct.id']))
					$defaultHmo = $value;
				if($name=='Specialty.name' && !empty($filterparams['Specialty.name']))
					$defaultSpecialty = $value;
				if($name=='People.lastname' && !empty($filterparams['People.lastname']))
					$defaultLastname = $value;
			}
		}

		if(isset($physicians)){
			
			$count = $this->Paginator->counter('{:count}');
			if($count==0 || $count==1)
				$doctor='Physician';
			else
				$doctor='Physicians';
			
			$letter = array_combine(str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'));
				
		?>		
		<?php echo $this->Form->create(NULL,array('url'=>array('controller'=>'Physicians','action'=>'search'),'class' => 'physician-fltr'));?>
		<h2 style="width: 50px;">Filter</h2>
		<table style="float:right;">
			<tr>
				<td>Province</td>
				<td><?php echo $this->Form->input('Address.province_state_id',array('type'=>'select','title'=>'address_select_1','options'=>$provinces,'empty'=>'','label'=>false,'style'=>'width:150px;','class' => 'address_select','title' => 'address_select_1','default'=>$defaultProvince));?></td>
				<td>Town/City</td>
				<td><?php echo $this->Form->input('Address.town_city_id',array('type'=>'select','title'=>'address_select_2','options'=>array(),'empty'=>'','label'=>false,'style'=>'width:150px;','class'=>'address_select','title' => 'address_select_2','default'=>$defaultTown));?></td>
				<td>Barangay</td>
				<td><?php echo $this->Form->input('Address.village_id',array('type'=>'select','title'=>'address_select_3','options'=>array(),'empty'=>'','label'=>false,'style'=>'width:150px;','class'=>'address_select','title' => 'address_select_3','default'=>$defaultVillage));?></td>
			</tr>
			<tr style="height:50px;">
				<td>HMO</td>
				<td><?php echo $this->Form->input('InsuranceProviderProduct.id',array('type'=>'select','id'=>'hmo','options'=>$hmo,'empty'=>'','label'=>false,'style'=>'width:150px;','default'=>$defaultHmo));?></td>
				<td>Specialty</td>
				<td><?php echo $this->Form->input('Specialty.name',array('type'=>'select','id'=>'specialty','options'=>'','empty'=>false,'label'=>false,'style'=>'width:150px;','default'=>$defaultSpecialty));?>
					<?php echo $this->Form->input('User.role',array('type'=>'hidden','id'=>'role','value'=>'6','label'=>false,'style'=>'width:150px;'));?>
				</td>
				<td>Letter</td>
				<td><?php echo $this->Form->input('People.lastname',array('type'=>'select','id'=>'letter','options'=>$letter,'empty'=>'Narrow your result','label'=>false,'style'=>'width:150px;','default'=>$defaultLastname));?></td>
			</tr>
			<tr>
				<td colspan="5" style="margin-top:10px;" valign="bottom"><h2 class="menu-title" style="margin-bottom: 3px; font-size: 18px; color: green; margin-top:10px;"><span><?php if($count=='')$count=0; echo $count.' '.$doctor;?> Filtered.</span></h2></td>
				<td style="margin-top:10px;"><?php echo $this->Form->submit('               Submit               ',array('style'=>'padding: 1px 5px; font-size: 15px; margin:0px 35px 0 0; float:left;'));?></td>
			</tr>
		</table>
		<?php 
		echo $this->Form->end();
			
			$letter='';
			$newletter='';
			$divnum=1;
			?><div class="menu-list" style="margin: 0px;"><?php
			foreach($physicians as $displayKey=>$displayValue):
				$letter = $displayValue['People']['lastname'][0];
				$lower = strtolower($letter);
				$upper = strtoupper($letter);	
				if($newletter<>$lower && $newletter<>$upper){
					?><div id="<?php echo $letter;?>" class="menu-list" style="margin: 30px 0px 0px 0px;"><h2><?php echo $letter;?></h2></div>
					
					<div class="column one-half">
						<div class="menu-image">
							<span class="border " style="width: 100px;">
								<img src="<?php echo (!empty($displayValue['People']['image']))?"/media/profiles/".$displayValue['People']['image']:'/img/male.jpg';?>" alt="<?php echo $displayValue['People']['lastname'].', '.$displayValue['People']['firstname'];?>" style="height: 100px; width: 100px;">
							</span>
						</div>	                                     
						<div class="menu-details"  style=" margin: 0 0 0 58px; width: 60%;">                                   
							<table style="font-size: 11px;">
								<tr>
									<td colspan="2">
										<h2 class="menu-title" style="margin-bottom: 3px; font-size: 15px;"><span><?php echo $this->Html->link($displayValue['People']['lastname'].', '.$displayValue['People']['firstname'],'/physician/'.$displayValue['People']['id'].'/'.Inflector::slug($displayValue['People']['lastname']));?></span></h2>								
									</td>
								</tr>
								<tr>
									<td>
										<span>Address:</span>	
									</td>
									<td>
										<span><?php echo $displayValue['TownCityCode']['name'].", ".$displayValue['ProvincesStatesCode']['name'];?></span>
									</td>
								</tr>
								<tr>
									<td>
										<span>Contact Info:</span>	
									</td>
									<td>
										<span>709-7469</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="sub-title"><?php echo $this->Html->link('View Details','/physician/'.$displayValue['People']['id'].'/'.Inflector::slug($displayValue['People']['lastname']));?></span>	
									</td>
								</tr>
							</table>
						</div>
						
						<div class="hr "></div>
						
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
								<td colspan="2">
									<h2 class="menu-title" style="margin-bottom: 3px; font-size: 15px;"><span><?php echo $this->Html->link($displayValue['People']['lastname'].', '.$displayValue['People']['firstname'].' '.$displayValue['TitleCode']['display'],'/physician/'.$displayValue['People']['id'].'/'.Inflector::slug($displayValue['People']['lastname']));?></span></h2>								
								</td>
								</tr>
								<tr>
									<td>
										<span>Address:</span>	
									</td>
									<td>
										<span><?php echo $displayValue['TownCityCode']['name'].", ".$displayValue['ProvincesStatesCode']['name'];?></span>
									</td>
								</tr>
								<tr>
									<td>
										<span>Contact Info:</span>	
									</td>
									<td>
										<span>709-7469</span>
									</td>
								</tr>
								<tr>
									<td>
										<span class="sub-title"><?php echo $this->Html->link('View Details','/physician/'.$displayValue['People']['id'].'/'.Inflector::slug($displayValue['People']['lastname']));?></span>						
									</td>
								</tr>
							</table>
						</div>
					<div class="hr "></div>
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
</div>
</div>
<script>
jQuery(document).ready(function(){
	$("tr:even").removeClass("even");
	$("tr:odd").removeClass("odd");
	jQuery('td').css({'padding':'0','background':'none'});
	jQuery('tr').css({'vertical-align':'middle'});
	jQuery('.hr').css('margin','10px 0');

/*
	if($('ul.j-load-all').length){
		var container = $('ul.j-load-all'),
			m_li = container.find("li"),
			m_item = m_li.find("a");
			container.find("a:first").addClass('active');
			m_item.click(function(){
				m_li.find('.active').removeClass('active');
				$(this).addClass("active");
			});
	}
	if($('ul.j-default a.active').length == 0){
		$('ul.j-default a:first').addClass('active');
	}

	jQuery(".menu-sidebar").localScroll({filter:'.smoothScroll'});
	jQuery('.menu-sidebar').stickyfloat({ duration: 400 });
*/
});
</script>