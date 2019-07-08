<script>
	var uploadType = 0;
	var $uploadImageButton;
</script>
<div class="content">
			<div id="main-tab" class="widget-result">
	            <ul class="tabnav">
	                <li><a href="#visits">VISITS</a></li>
	                <li><a href="#history">HISTORY</a></li>
	                <li><a href="#profile">PROFILE</a></li>
	                <li><a href="#hmo">INSURANCES</a></li>
	            </ul>
            </div>
		<h1>RESULTS</h1>
		
		<div id="main-tab" class="widget-result">
            <ul class="tabnav">
                <li><a href="#visits">VISITS</a></li>
                <li><a href="#history">HISTORY</a></li>
                <li><a href="#profile">PROFILE</a></li>
                <li><a href="#hmo">INSURANCES</a></li>
            </ul>
            <div id="visits" class="tabdiv">
            	<div id="visits-list" style="overflow-y:auto;">
            	<?php if(isset($testOrders) && !empty($testOrders)):?>
	                <table id="common-tbl" class="visits_tbl">
	                	<thead>
	                		<tr>
		                		<th>Date</th><th>Laboratory</th><th>Test</th>
	                		</tr>
	                	</thead>
	                	<tbody>
	                		<?php
	                		$firstTestOrder = null;
	                		
		                		foreach($testOrders as $visit):?>
		                			<tr style="cursor:pointer;" onclick="showTestOrderDetail('<?php echo $visit['LaboratoryTestOrder']['id'];?>')">
		                				<td><?php echo date('F d,Y H:i:s',strtotime($visit['LaboratoryTestOrder']['posted_datetime']));?></td>
		                				<td><?php echo $laboratories[$visit['LaboratoryPatientOrder']['laboratory_id']];?></td>
		                				<td>
		                					
		                					<?php
	///	                						debug($visit);
												if(is_null($firstTestOrder))
													$firstTestOrder =  $visit['LaboratoryTestOrder']['id'];
		                						if(isset($testOrderPackages[$visit['LaboratoryTestOrder']['id']])){
		                							echo implode(', ',$testOrderPackages[$visit['LaboratoryTestOrder']['id']]);
		                						}
		                					?>
		                				
		                				</td>
		                			</tr>
		                		<?php endforeach;
	                		?>
	                	</tbody>
	                </table>
	                <h3>Test Results</h3>
	               	<?php
		               	else:
		                	echo "You have no recorded visits.";
		                endif;
	               	?>
                </div>
                <div id="visits-view" style="height:auto;border:1px solid #BFB092;padding:5px;">
                
                </div>
                <?php echo $this->element('pop_up_print_testgroup');?>
                
                <?php //echo $this->Form->submit('Save',array('div'=>false,'class'=>'submit-save','style'=>'margin-left:75.5%;'));?>
                <?php echo $this->Form->submit('Save / Print',array('div'=>false, 'id'=>'printPdf','style'=>'margin-left:77.5%;'));?>
               
                <?php echo $this->Form->end();?>
            </div><!--/visits-->
            
            <div id="history" class="tabdiv">
                <div id="history-div">
                	<h2>TEST HISTORY</h2>
                	<?php if(!empty($testGroups)):?>
	                	<?php $group = $testGroups;?>
	                	<?php echo $this->Form->radio('group_name', $testGroups, array('legend'=>false,'onclick' => 'showTestHistory(this);'));?>
	                	<div id="test-history" style="height:auto;border:1px solid #BFB092;padding:5px;">
                			
                			
                			
                		</div>
	                	
	            	<?php else:?>
	            		You currently have no recorded test.
	            	<?php endif;?>
                </div>
            </div><!--/history-->
            
            <div id="profile" class="tabdiv">
            
            	<?php echo $this->Form->create('Person',array('class'=>'patient_form','enctype' => 'multipart/form-data'));?>
				
				<div id="photo" style="border:1px solid #BFB092; width:150px;height:150px;float:right;margin:20px 20px 0 0;">
					<?php echo $this->Html->image('../media/profiles/'.$this->data['Person']['image'],array('id' =>'idpic','style'=>'width:150px;height:150px;'));?>
					<p class="actions" align="center" style="width:100%;min-width:100%;">
						<a href="#" id="take-photo" > Take a Photo</a>
						<script>
							var filelocation = "../../../js/jscam.swf";
						</script>
						<?php echo $this->element('webcamui');?>
					</p>
					<p class="actions" align="center" style="width:100%;min-width:100%;">
						<a href="#" id="open-photo" > Open image</a>
					</p>
					<?php echo $this->Form->input('upload',array('type' => 'file','label' => false,'div' => false,'class'=>'browse_image','style' => 'display:none;'));?>
					
				</div>
				
				<br/>
				<div id="profile-div">
					<div style="width:100%;">
						<table id="profile-table">
						
						<tr><td><h2>PROFILE</h2></td><td></td></tr>
						
						<?php echo $this->Form->input('id',array('type' => 'hidden','label'=>false,'div'=>false));?>
						<?php echo $this->Form->input('image',array('type' => 'hidden','label'=>false,'div'=>false));?>
						<?php echo $this->Form->input('new_image',array('type' => 'hidden','label'=>false,'div'=>false,'class' =>'webcam-input'));?>
						<tr><td><label>Last Name:</label></td><td><?php echo $this->Form->input('lastname',array('label'=>false,'div'=>false));?></td></tr>
						<tr><td><label>First Name:</label></td><td><?php echo $this->Form->input('firstname',array('label'=>false,'div'=>false));?></td></tr>
						<tr><td><label>Middle Name:</label></td><td><?php echo $this->Form->input('middlename',array('label'=>false,'div'=>false));?></td></tr>
						<tr><td><label>Gender:</label></td><td><?php echo $this->Form->input('sex',array('label'=>false,'type'=>'radio','div'=>false,'options'=>array('M'=>'Male','F'=>'Female'),'legend'=>false));?></td></tr>
						<tr><td><label>Birthdate:</label></td><td><?php echo $this->Form->input('birthdate',array('label'=>false,'div'=>false,'type' => 'text','class' => 'datepicker'));?></td></tr>
						</table>
					</div>
					<div style="width:100%;float:left;">
						<table style="display:inline-block;width:45%">
							<tr><td><h2>ADDRESS:</h2></td><td><?php echo $this->Form->input('Address.id',array('label'=>false,'div'=>false,'type' => 'hidden','value'=>$this->data['Person']['CompleteAddress']['Address']['id']));?></td></tr>
							<tr><td><label>Province:</label></td><td><?php echo $this->Form->input('Address.province_state_id',array('label'=>false,'div'=>false,'type' => 'select','options' => $provinces,'value'=>$this->data['Person']['CompleteAddress']['ProvincesStatesCode']['id'],'class' => 'address_select','id' => 'address_select_1'));?></td></tr>
							<tr><td><label>Town/City:</label></td><td><?php echo $this->Form->input('Address.town_city_id',array('label'=>false,'div'=>false,'type' => 'select','options' => $townCities,'value'=>$this->data['Person']['CompleteAddress']['TownCityCode']['id'],'class' => 'address_select','id' => 'address_select_2'));?></td></tr>
							<tr><td><label>Barangay:</label></td><td><?php echo $this->Form->input('Address.village_id',array('label'=>false,'div'=>false,'type' => 'select','options' => $villages,'value'=>$this->data['Person']['CompleteAddress']['VillageCode']['id'],'class' => 'address_select','id' => 'address_select_3'));?></td></tr>
							<tr><td><label>Street:</label></td><td><?php echo $this->Form->input('Address.street_id',array('label'=>false,'div'=>false,'type' => 'select','options' => $streets,'value'=>$this->data['Person']['CompleteAddress']['StreetCode']['id'],'class' => 'address_select','id' => 'address_select_4'));?></td></tr>
							<tr><td><label>Street Number:</label></td><td><?php echo $this->Form->input('Address.street_number',array('label'=>false,'div'=>false,'type' => 'text','value'=>$this->data['Person']['CompleteAddress']['Address']['street_number']));?></td></tr>
							<tr><td><label>Building/Apartment:</label></td><td><?php echo $this->Form->input('Address.building_apartment',array('label'=>false,'div'=>false,'type' => 'text','value'=>$this->data['Person']['CompleteAddress']['Address']['building_apartment']));?></td></tr>
							<tr><td><label>Unit:</label></td><td><?php echo $this->Form->input('Address.unit',array('label'=>false,'div'=>false,'type' => 'text','value'=>$this->data['Person']['CompleteAddress']['Address']['unit']));?></td></tr>
							<tr><td><label>Floor:</label></td><td><?php echo $this->Form->input('Address.floor',array('label'=>false,'div'=>false,'type' => 'text','value'=>$this->data['Person']['CompleteAddress']['Address']['floor']));?></td></tr>
						</table>
					
						<table id="profile-table" class="contact_info_tbl" style="float: right;width:45%">
							<tr><td colspan="3" ><h2>CONTACT DETAILS</h2></td></tr>
								<tbody>
								<?php if(isset($this->data['Person']['Contacts'])):?>
									<?php $ctr=0;foreach($this->data['Person']['Contacts'] as $contactInfo):?>
										<tr><td><label><?php echo $this->Form->input('ContactInformation.'.$ctr.'.id',array('type'=>'hidden','div' => false,'label'=>false,'value'=>$contactInfo['id'],'class'=>'unique_id'));echo $this->Form->input('ContactInformation.'.$ctr.'.type',array('type'=>'hidden','div' => false,'label'=>false,'value'=>$contactInfo['type'],'class'=>'unique_day'));echo $contactInfo['typename'];?></label></td><td><?php echo $this->Form->input('ContactInformation.'.$ctr++.'.contact',array('type'=>'text','div' => false,'label'=>false,'style'=>'width:120px','value'=>$contactInfo['contact']));?></td><td><a style="cursor:pointer;" onclick="removeContact(this);">&nbsp;&nbsp;X</a></td></tr>
									<?php endforeach;?>
								<?php endif;?>
								<tr><td><?php echo $this->Form->input('Contact.type',array('type'=>'select','options'=>$contactTypes,'label'=>false,'div'=>false));?></td><td><?php echo $this->Form->input('Contact.contact',array('type' => 'text','label'=>false,'div'=>false,'style'=>'width:120px'))?></td><td><a onclick="addContact(this);" >add</a></td></tr>
							</tbody>
						</table>
						
					</div>
					<div style="width:100%;">
						<table id="profile-table" style="display:inline-block;width:45%">
							<tbody>
								<tr><td><h2>MEMBERSHIP</h2></td><td></td></tr>
								<tr><td><label>Date of Joining:</label></td><td><?php echo $this->Form->input('entry_datetime',array('label'=>false,'div'=>false,'type' => 'text'));?></td></tr>
								<tr><td><label>Referred by:</label></td><td><?php echo $this->Form->input('referred',array('label'=>false,'div'=>false));?></td></tr>
							</tbody>
						</table>
						<table id="profile-table" style="float: right;width:45%">
							<tr><td><h2>SUBSCRIPTION</h2></td><td></td></tr>
							<tr><td><label>Newsletter:</label></td><td><?php echo $this->Form->input('Subscription.newsletter',array('label'=>false,'type'=>'checkbox'));?></td></tr>
							<tr><td><label>Health Tips:</label></td><td><?php echo $this->Form->input('Subscription.healthtip',array('label'=>false,'type'=>'checkbox'));?></td></tr>
							<tr><td><label>Promo:</label></td><td><?php echo $this->Form->input('Subscription.promo',array('label'=>false,'type'=>'checkbox'));?></td></tr>
						</table>
					</div>
					<?php echo $this->Form->submit('Save',array('div'=>false,'style'=>'','class' => 'save_profile'));?>
					<?php echo $this->Form->end();?>
				</div>

            </div><!--/profile-->
			<div id="hmo" class="tabdiv">
				<div id="hmo-div">
					<table id="common-tbl" class="hmo_list">
						<thead>
							<tr>
								<th>Insurance Provider</th><th>Insurance Product</th><th>Accreditation No.</th><th>Join Date</th><th>Expiration Date</th><th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if(isset($this->data['Person']['HMO'])):?>
								<?php foreach($this->data['Person']['HMO'] as $hmo):?>
									<tr id="hmo_<?php echo $hmo['PersonInsurance']['id'];?>">
										
										<td class= "hmo_insurance_provider"><?php echo $this->Form->input('InsuranceProviderProduct.id',array('type'=> 'hidden','value' =>$hmo['InsuranceProvider']['id']));echo '<p>'.$hmo['InsuranceProvider']['name'].'</p>';?></td>
										<td class= "hmo_insurance_provider_product" ><?php echo $this->Form->input('InsuranceProvider.id',array('type'=> 'hidden','value' =>$hmo['InsuranceProviderProduct']['id']));echo '<p>'.$hmo['InsuranceProviderProduct']['name'].'</p>';?></td>
										<td class= "hmo_accreditation"><?php echo '<p>'.$hmo['PersonInsurance']['accreditation'].'</p>';?></td>
										<td class= "hmo_effectivity_date"><?php echo '<p>'.$hmo['PersonInsurance']['effectivity_date'].'</p>';?></td>
										<td class= "hmo_expiration_date"><?php echo '<p>'.$hmo['PersonInsurance']['expiration_date'].'</p>';?></td>
										<td>
											<a href="#" onclick="setHMO(this);" >Edit</a>
											<a href="#" onclick="deleteHMO(<?php echo $hmo['PersonInsurance']['id'];?>);">Delete</a>
										</td>
									</tr>
								<?php endforeach;?>
							<?php endif;?>
						</tbody>
					</table>
					<h3>DETAILS</h3>
					<?php echo $this->Form->create('PersonInsurance',array('class'=>'hmo_form'));?>
					<?php $legend = array('legend'=>false);?>
					<table id="single-td-tbl" class = "HMO_fields" >
						<?php echo $this->Form->input('id',array('label'=>false, 'type'=>'hidden','div'=>false,'class'=>'hmo_id'));?>
						<tr>
							<td><label>Provider:</label></td><td><?php echo $this->Form->input('insurance_provider',array('label'=>false,'empty' => true, 'type'=>'select','div'=>false,'title'=>'hmo_insurance_provider','options' => $insuranceProviders));?></td>
						</tr>
						<tr>
							<td><label>Product:</label></td><td><?php echo $this->Form->input('insurance_provider_product_id',array('label'=>false,'empty' => true, 'type'=>'select','options'=>current($insuranceProviderProducts),'div'=>false,'title'=>'hmo_insurance_provider_product'));?></td>
						</tr>
						<tr>
							<td><label>Accreditation No.:</label></td><td><?php echo $this->Form->input('accreditation',array('label'=>false, 'type'=>'text','div'=>false,'title'=>'hmo_accreditation'));?></td>
						</tr>
						<tr>
							<td><label>Date of Joining:</label></td><td><?php echo $this->Form->input('effectivity_date',array('label'=>false,'div'=>false,'title'=>'hmo_effectivity_date','type' => 'text','class'=>'datepicker'));?></td>
						</tr>
						<tr>
							<td><label>Date of Expiration:</label></td><td><?php echo $this->Form->input('expiration_date',array('label'=>false,'div'=>false,'title'=>'hmo_expiration_date','type' => 'text','class'=>'datepicker'));?></td>
						</tr>
						<tr>
						<?php echo $this->Form->end();?>
						<td><?php echo $this->Form->submit('Save',array('div'=>false,'style'=>'','class' => 'save_hmo'));?></td>
						</tr>
					</table>
					<?php echo $this->Form->end()?>
					
				</div>
			</div>
		</div><!--/widget-->
</div>
<?php echo $this->element('sidebar');?>
<script>
	var thisGraph;
	
	var insuranceProductProviders = <?php echo $this->Js->object($insuranceProviderProducts);?>;
	
	var historyHandler = function(){
		jQuery('#history-div input[type=radio]:first').click();
		jQuery(this).unbind('click',historyHandler);
	};
	var indexIdcon = 1;
	var contact_delid = 0;
	jQuery(document).ready(function(){
		jQuery('#open-photo').click(function(){
			jQuery(".browse_image").click();
		});
		
		jQuery('#take-photo').click(function(){
			jQuery( "#webcam-dialog" ).dialog('open');
		});
		jQuery('#printPdf').click(function(){
			$('.testgroup-dialog').dialog('open');
			var print = jQuery('#printPdf').val();
			//window.open(print);
			});

		jQuery('#print').click(function(){
			var print = jQuery('#print').attr('href');
			window.open(print);
		});
		jQuery('.testgroup-dialog').dialog({
			title:'Select test to print',
			autoOpen:false,
			modal:true,
			resizable:false,
			width:300,
			height:430,
			buttons:{
				Save: function(){
					jQuery('#stream').val(0);
					jQuery('#print_filter').submit();
					jQuery(this).dialog('close');
				},
				Print: function(){
					jQuery('#stream').val(1);
					jQuery('#print_filter').submit();
					jQuery(this).dialog('close');
				},
				Close:function(){
					jQuery(".testgroup-dialog").dialog('close');
				}
			}
		});
			
		jQuery('#selected').css({'background':'url(../../img/btn-bg.jpg) repeat'});
		jQuery('.visits_tbl tr').live('click', function(){
			if(jQuery('#selected').size() == 0 )
			{
				jQuery(this).attr('id','selected');
			}
			else
			{
				jQuery('.visits_tbl tr').removeAttr('id');
				jQuery(this).attr('id','selected');
				}
			});
		
		jQuery('.testGroup input').live('click',function(){
			if(jQuery(this).is(':checked'))
				jQuery(this).parents('.testGroup').next('.testCode').find('*:input').attr('checked','checked');
			else
				jQuery(this).parents('.testGroup').next('.testCode').find('*:input').removeAttr('checked');

		});
		jQuery('.testgroup-dialog input').attr('checked','checked');
		jQuery('.testGroup input').live('click',function(){
			if(jQuery('input[type!=hidden]:checked', '.testGroup').length == 0 || jQuery('input[type!=hidden]', '.testGroup').length != jQuery('input[type!=hidden]:checked', '.testGroup').length)
				jQuery('#print_all').removeAttr('checked');

		});

		jQuery('.testCode input').live('click',function(){
			jQuery(this).parents('.testCode').prev('.testGroup').find('input').attr('checked', 'checked');

			if(jQuery(this).parents('.testCode').find('input[type != hidden]:checked').length == 0)
				jQuery(this).parents('.testCode').prev('.testGroup').find('input').removeAttr('checked');
		});

		jQuery('#print_all').live('click',function(){
			if(jQuery(this).is(':checked'))
				jQuery('*:input','.testGroup, .testCode').attr('checked', 'checked');
			else
				jQuery('*:input','.testGroup, .testCode').removeAttr('checked');
		});
		jQuery('.current-crumb').append(' MEMBER ACCOUNT');
		<?php if(isset($firstTestOrder)):?>
			showTestOrderDetail('<?php echo $firstTestOrder;?>');
			showTestOrderId('<?php echo $firstTestOrder;?>');
		<?php endif;?>
		jQuery('a[href=#history]').bind('click',historyHandler);

		jQuery('select[title=hmo_insurance_provider]').change(function(){
			insId = jQuery(this).val();
			alert(insId);
			if(insuranceProductProviders[insId] != undefined){

				jQuery('select[title=hmo_insurance_provider_product]').empty();
				options = '<option value=""></option>';
				jQuery.each(insuranceProductProviders[insId],function(x,y){
					options += '<option value="'+x+'">'+y+'</option>';
				});
				jQuery('select[title=hmo_insurance_provider_product]').append(options);
				
			}

		});
		jQuery('.save_profile').click(function(){
			if(uploadType == 1){
				jQuery(".browse_image").replaceWith($uploadImageButton);
			}else if(uploadType == 2){
				jQuery('.webcam-input').val('');
			}

			var formData = new FormData(jQuery('.patient_form')[0]);
			 
			if (window.XMLHttpRequest){
				xmlhttp=new XMLHttpRequest();
			} else {
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.open("POST", "<?php echo $this->Html->url(array('controller'=>'Patients','action'=>'updateProfile'));?>", true);

			xmlhttp.setRequestHeader("X_REQUESTED_WITH", "XMLHttpRequest");
				
			xmlhttp.onreadystatechange = function(){

				if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
					parser = new DOMParser();
					xmlDoc = parser.parseFromString(xmlhttp.responseText, "application/xml");
                    result = parseInt(xmlDoc.getElementsByTagName("result")[0].childNodes[0].nodeValue);
					if(result){
						alert('Your profile was successfully updated');
					}else{
						alert('An error ocurred while saving your profile, please try again.');
					}
                } else if(xmlhttp.readyState == 4)
                 	alert("Error: returned status code " + xmlhttp.status + " " + xmlhttp.statusText);
            };
			xmlhttp.send(formData);
			event.preventDefault();
		});
		jQuery('.save_hmo').click(function(){
			jQuery.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'Insurances','action'=>'addPersonInsurance'));?>',
				data:jQuery('.hmo_form').serialize(),
				type: 'POST',
				dataType : 'json',
				success:function(data){
					if(data){
						alert('Saving insurance details was successful.');
						id = jQuery('.hmo_id').val();
						tr = '<tr id="hmo_'+data+'">';

						jQuery('.HMO_fields').find('input[type=text],select').each(function(){
							tr += '<td class="'+jQuery(this).attr('title')+'">';
							if(this.nodeName.toLowerCase() == 'input'){
								tr += '<p>'+jQuery(this).val()+'<p>';
							}else{
								tr += '<input type="hidden" name="data[InsuranceProviderProduct][id]" value="'+jQuery(this).val()+'" id="InsuranceProviderProductId">';
								tr += '<p>'+jQuery(this).find('option:selected').text()+'<p>';
							}
							tr += '</td>';
						
						});
						tr += '<td><a href="#" onclick="setHMO(this);" >Edit</a><a href="#" onclick="deleteHMO('+data+');">Delete</a></td>';
						tr += '</tr>';

						if(jQuery('#hmo_'+id).length){
							jQuery('#hmo_'+id).replaceWith(tr);
						}else{
							jQuery('.hmo_list tbody').append(tr);
						}
						
					}else{
						alert('Saving insurance fail, please try again stupid!');
					}
				}
			});
			event.preventDefault();
		});
		var addressSelectLen = jQuery('.address_select').length;
		jQuery('.address_select').change(function(){
				index = parseInt(jQuery(this).attr('id').replace('address_select_',''));
				
				if(index < addressSelectLen){
					index++;
					//clear dependent address fields
					for(i=index; i<= addressSelectLen;i++){
						jQuery('#address_select_'+i).empty();
					}

					jQuery.ajax({
						url: '<?php echo $this->Html->url(array('controller'=>'Addresses','action'=>'getList'));?>',
						data:{'Address':{
								'hierarchy':index,
								'parent_id':jQuery(this).val(),
							}
						},
						type: 'POST',
						dataType : 'json',
						success:function(data){
							if(data){
								jQuery.each(data['List'],function(x,y){
									jQuery.each(y,function(w,z){
										jQuery('#address_select_'+data['Hierarchy'][x]).append('<option value="'+w+'">'+z+'</option>');
									});
								});
							}else{
								alert('Unable to retrieve '+addressInfo[index].model+'s');
							}
						}
					});
				}
				
			});
		$uploadImageButton = jQuery(".browse_image").clone();
		$uploadImageButton.change(updateImagePreview);
		jQuery(".browse_image").change(updateImagePreview);
	});

	updateImagePreview = function(event){
		uploadType = 2;
		files = event.target.files;
		for (var i = 0, f; f = files[i]; i++) {
	      if (!f.type.match('image.*')) {
	        continue;
	      }
	      var reader = new FileReader();
	      reader.onload = (function(theFile) {
	        return function(e) {
	        	datauri = e.target.result;
	        	jQuery('#idpic').attr('src',datauri);
	        };
	      })(f);
	      reader.readAsDataURL(f);
		}
	};

//	function addContact(a){
//		contact = jQuery('#ContactContact').val();
//		if(contact.length){
//			type = jQuery('#ContactType').val();
//			typename = jQuery('#ContactType').find('option:selected').text();
//			tr = '<tr class="odd"><td><label><input type="hidden" name="data[ContactInformation][1][type]" id="ContactInformation0Type" value="'+type+'">'+typename+'</label></td><td><input name="data[ContactInformation][1][contact]" style="width:120px" value="'+contact+'" type="text" id="ContactInformation0Contact"></td><td><a href="#" onclick="removeContact(this);">X</a></td></tr>';
//			jQuery(tr).insertBefore(jQuery('.contact_info_tbl tbody tr:last'));
//			reindexorder('.contact_info_tbl');
//			jQuery('#ContactContact').val('');
//		}else{
//			alert('Please type your contact detail.');
//		}
//	}
	function addContact(a){
		contact = jQuery('#ContactContact').val();
		if(contact.length){
			id = 0;
			idval = jQuery('table.contact_info_tbl tbody tr:last').prev('tr').find('input.unique_id').val();
			if(!idval){
				idval = contact_delid;
				id = Number(idval);
			}else{
				id = 1 + Number(idval);
			}
			type = jQuery('#ContactType').val();
			typename = jQuery('#ContactType').find('option:selected').text();
			tr = '<tr class="odd"><td><label><input type="hidden" name="data[ContactInformation][1][id]" id="ContactInformation0Id" value="'+id+'"><input type="hidden" name="data[ContactInformation][1][type]" id="ContactInformation0Type" value="'+type+'">'+typename+":"+'</label></td><td><input name="data[ContactInformation][1][contact]" style="width:120px" value="'+contact+'" type="text" id="ContactInformation0Contact"></td><td><a style="cursor:pointer;" onclick="removeContact(this);">&nbsp;&nbsp;X</a></td></tr>';
			jQuery(tr).insertBefore(jQuery('.contact_info_tbl tbody tr:last'));
			reindexorder('.contact_info_tbl');
			jQuery('#ContactContact').val('');
		}else{
			alert('Please type your contact detail.');
		}
	}
//	function removeContact(a){
//		jQuery(a).parent().parent().remove();
//		reindexorder('.contact_info_tbl');
//	}
	function removeContact(a){
		rowcon = jQuery(a).parent().parent().html();
		contact_delid = jQuery(rowcon).find('input.unique_id').val();
		statusinput = '<input type="hidden" name="data[ContactInformationDelete]['+indexIdcon+'][id]" id="ContactInformationDelete0" value="'+contact_delid+'">';
		jQuery(statusinput).insertBefore(jQuery('.contact_info_tbl tbody tr:last'));
		indexIdcon += 1;
		jQuery(a).parent().parent().remove();
		reindexorder('.contact_info_tbl');
	}
	function deleteHMO(personInsId){
		if(confirm("Are you sure you want to remove this insurance?")){
			jQuery.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'Insurances','action'=>'deletePersonInsurance'));?>',
				data:{'PersonInsurance':{'id':personInsId}},
				type: 'POST',
				dataType : 'json',
				success:function(data){
					if(data){
						alert('Deletion of insurance was successful.');
						jQuery('#hmo_'+personInsId).remove();
						
					}else{
						alert('Deletion of insurance fail, please try again stupid!');
					}
				}
			});
		}
	}
	function setHMO(button){
		jQuery(button).parent().parent().find('td').each(function(){
			inputClass =  jQuery(this).attr('class');
			inputValue = (jQuery(this).find('input').length)?jQuery(this).find('input').val():jQuery(this).find('p').html();
			jQuery('input[title='+inputClass+'],select[title='+inputClass+']').val(inputValue);
			if(inputClass=='hmo_insurance_provider')
				jQuery(this).triggerHandler('change');
			
		});
		jQuery('.hmo_id').val(jQuery(button).parent().parent().attr('id').replace('hmo_',''));
	}

	function showTestOrderDetail(testOrderId){
		jQuery('#printPdf').attr('name', '/Patients/print_pdf/'+testOrderId+'.pdf');
		jQuery('#print_filter').attr('action', '/Patients/print_pdf/'+testOrderId+'.pdf');
		jQuery('#printPdf').attr('onclick', "showTestOrderId('"+testOrderId+"')");
		jQuery('#print').attr('href', '/Patients/print_pdf/'+testOrderId+'.pdf');
			
		jQuery.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>'patients','action'=>'testOrderDetail'));?>',
			data:{'LaboratoryTestOrderId':testOrderId},
			type: 'POST',
			dataType : 'html',
			success:function(data){
				jQuery('#visits-view').html(data);
			}
		});
	}
	function showTestOrderId(testOrderId){
		testGroupIds = {};

		jQuery('.print_selections').empty();
		jQuery('.test_group_detail').each(function(){
			$tgtr = jQuery(this).find('.test_group');
			groupid = $tgtr.attr('id');
			grpi = jQuery(this).find('.test_group_index');
			groupindex = grpi.attr('id');
			groupname = $tgtr.html();

			testcodetemplate = "";
			jQuery(this).find('tbody tr').each(function(){
				testid = jQuery(this).attr('id');
				testname = jQuery(this).find('.name').html();
				testindex = jQuery(this).find('.name').attr('id');
				testcodetemplate+='<div class="input checkbox">'
							+'<input type="hidden" value="0" id="TestResult'+groupid+'LaboratoryTestOrderDetail'+testindex+'LaboratoryTestCodePrint_" name="data[TestResult]['+groupindex+'][TestOrderDetail]['+testindex+'][print]">'
							+'<input type="checkbox" checked="checked" id="TestResult'+groupid+'LaboratoryTestOrderDetail'+testindex+'LaboratoryTestCodePrint" value="1" name="data[TestResult]['+groupindex+'][TestOrderDetail]['+testindex+'][print]" style="margin-left: 10px;">'
							+'<input type="hidden" value="'+testid+'" name="data[TestResult]['+groupindex+'][TestOrderDetail]['+testindex+'][id]">'
							+'<label for="TestResult'+groupid+'LaboratoryTestOrderDetail'+testindex+'Print">'+testname+'</label>'
						+'</div>'
				
			});
			
			//alert(testcodetemplate.toString());
			
			jQuery('.print_selections').append(
				'<div class="testGroup">'
					+'<div class="input checkbox">'
						+'<input type="hidden" value="0" id="TestResult'+groupindex+'LaboratoryTestGroupPrint_" name="data[TestResult]['+groupindex+'][TestGroup][print]">'
						+'<input type="checkbox" checked="checked" id="TestResult'+groupindex+'LaboratoryTestGroupPrint" value="1" name="data[TestResult]['+groupindex+'][TestGroup][print]" style="margin-top: 10px;">'
						+'<input type="hidden" value="'+groupid+'" name="data[TestResult]['+groupindex+'][id]">'
							+'<label for="TestResult'+groupindex+'LaboratoryTestGroupPrint" style="font-weight: bold;">'+groupname+'</label>'
					+'</div>'
				+'</div>'
				+'<div class="testCode">'+testcodetemplate+'</div>'
			);
		});
	}

	
	function showTestHistory(testGroupRadio){
		testGroupId = jQuery(testGroupRadio).val();
		jQuery.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>'patients','action'=>'testHistory'));?>',
			data:{'LaboratoryTestGroupId':testGroupId},
			type: 'POST',
			dataType : 'html',
			asynch:false,
			success:function(data){
				jQuery('#test-history').html(data);
//				alert(data);
			}
		});
	}
	
</script>
<style>
.ui-dialog .ui-dialog-titlebar {
    background:#ccc;
}
.visits_tbl tr:nth-child(2n):hover td, .visits_tbl tbody tr.even:hover td {
   background: url(../../img/tab-bg.jpg) repeat;
   color: #fffae4;
}
#selected td{
   background: url(../../img/tab-bg.jpg) repeat;
   color: #fffae4;
}
#common-tbl th{
   background: url(../../img/btn-bg.jpg) repeat;
   color: #fffae4;
}
</style>