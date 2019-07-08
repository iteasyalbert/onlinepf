<?php
	echo $this->element('graph_scripts');
?>
<script>
	var uploadType = 0;
	var $uploadImageButton;
</script>
							<div id="imgdiv"></div>

<div class="content">
		<h1>RESULTS</h1>
		<div id="main-tab" class="widget-result">
            <ul class="tabnav">
                <li id="1"><a href="#visits">VISITS</a></li>
                <li id="2"><a href="#history">HISTORY</a></li>
                <li id="3"><a href="#profile">PROFILE</a></li>
                <li id="4"><a href="#hmo">HMO</a></li>
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
	                			$selected = 'selected';
	                			foreach($testOrders as $visit):?>
		                			<tr id="<?php echo $selected;?>" class="testOrderDetailClass" style="cursor:pointer;" onclick="showTestOrderDetail('<?php echo $visit['LaboratoryTestOrder']['id'];?>','patient-visits-view')">
		                				<td><?php echo date('F d,Y H:i:s',strtotime($visit['LaboratoryTestOrder']['posted_datetime']));?></td>
		                				<td><?php echo $laboratories[$visit['LaboratoryPatientOrder']['laboratory_id']];?></td>
		                				<td>
		                					
		                					<?php
	///	                						debug($visit);
												if(is_null($firstTestOrder))
													$firstTestOrder =  $visit['LaboratoryTestOrder']['id'];
													$selected = '';
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
	               	<?php
		               	else:
		                	echo "You have no recorded visits.";
		                endif;
	               	?>
                </div>
                <div id="patient-visits-view" style="height:auto;border:1px solid #BFB092;padding:5px;">
                
                </div>
                <?php echo $this->element('pop_up_print_testgroup');?>
                <?php echo $this->Form->submit('Save / Print',array('div'=>false, 'id'=>'printPdf','style'=>'margin-left:77.5%;'));?>
               
                <?php echo $this->Form->end();?>
            </div>
            <!--/visits-->
            
            <!-- TEST HISTORY -->
            <div id="history" class="tabdiv">
                <div id="history-div">
                	<h2>TEST HISTORY</h2>
                	<?php if(!empty($testGroups)):?>
	                	<?php $group = $testGroups;?>
	                	<?php echo $this->Form->radio('group_name', $testGroups, array('legend'=>false,'onclick' => 'showTestHistory(this,"patient-test-history");'));?>
	                	<div id="patient-test-history" style="height:auto;border:1px solid #BFB092;padding:5px;">
                			<h2 class="test-name">TEST RESULT</h2>
							<div id="history-list" style="overflow-y:auto;">
			                	<table id="common-tbl">
			                		<thead>
			                			<tr>
			                				<th>Laboratoty</th>
			                				<th>Date</th>
			                				<th></th>
			                			</tr>
			                		</thead>
			                		<tbody>
			                		</tbody>
			                	</table>
			               	</div>
				            <div id="printArea">
				                <h2>GRAPH</h2>
				                <div id="legend" class="graph_legend">
					            
					            </div>
				                <br/><br/>
				                <div id="patient-test-history_historyGraph" style="height:300px;border:1px solid #BFB092;">
				                	
				                </div>
			                </div>
			                <?php echo $this->Form->create(null, array('url'=>array('controller'=>'patients', 'action'=>'testHistory')));?>
			                <?php echo $this->Form->submit('Save',array('div'=>false,'class'=>'submit-save','style'=>'margin-left:74%;', 'name'=>'action', 'onclick'=>'return false;'));?>
			                <?php echo $this->Form->submit('Print',array('div'=>false, 'id'=>'printTestHistory','style'=>'margin-left:1%;', 'name'=>'action', 'onclick'=>'return false;'));?>
			                <?php echo $this->Form->end();?>
                			
                		</div>
	                	
	            	<?php else:?>
	            		You currently have no recorded test.
	            	<?php endif;?>
                </div>
            </div><!--/history-->
            
            <div id="profile" class="tabdiv">
            	<?php echo $this->Form->create('Person',array('class'=>'patient_form','enctype' => 'multipart/form-data'));?>
					<div id="photo" style="border:1px solid #BFB092; width:150px;height:150px;float:right;margin:20px 105px 0 0;">
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
						<table style="display:inline-block;width:47%">
							<tr><td><h2>ADDRESS:</h2></td><td>
								<?php echo $this->Form->input('Person.CompleteAddress.Address.id',array('label'=>false,'div'=>false,'type' => 'hidden'));?>
								<?php echo $this->Form->input('Person.CompleteAddress.Address.person_address_id',array('label'=>false,'div'=>false,'type' => 'hidden'));?>
							</td></tr>
							<tr><td style="width: 100px;"><label>Province:</label></td><td><?php echo $this->Form->input('Person.CompleteAddress.ProvincesStatesCode.id',array('label'=>false,'div'=>false,'type' => 'select','options' => $provinces,'class' => 'address_select','title' => 'address_select_1'));?></td></tr>
							<tr><td><label>Town/City:</label></td><td><?php echo $this->Form->input('Person.CompleteAddress.TownCityCode.id',array('label'=>false,'div'=>false,'type' => 'select','options' => $townCities,'class' => 'address_select','title' => 'address_select_2'));?></td></tr>
							<tr><td><label>Barangay:</label></td><td><?php echo $this->Form->input('Person.CompleteAddress.VillageCode.id',array('label'=>false,'div'=>false,'type' => 'select','options' => $villages,'class' => 'address_select','title' => 'address_select_3'));?></td></tr>
							<!--<tr><td><label>Street:</label></td><td><?php //echo $this->Form->input('Person.CompleteAddress.StreetCode.id',array('label'=>false,'div'=>false,'type' => 'select','options' => $streets,'class' => 'address_select','title' => 'address_select_4'));?></td></tr>-->
							<tr><td><label>Street:</label></td><td><?php echo $this->Form->input('Person.CompleteAddress.Address.street_number',array('label'=>false,'div'=>false,'type' => 'text'));?></td></tr>
							<tr><td><label>Bldg/Apt:</label></td><td><?php echo $this->Form->input('Person.CompleteAddress.Address.building_apartment',array('label'=>false,'div'=>false,'type' => 'text'));?></td></tr>
							<tr><td><label>Unit:</label></td><td><?php echo $this->Form->input('Person.CompleteAddress.Address.unit',array('label'=>false,'div'=>false,'type' => 'text'));?></td></tr>
							<tr><td><label>Floor:</label></td><td><?php echo $this->Form->input('Person.CompleteAddress.Address.floor',array('label'=>false,'div'=>false,'type' => 'text'));?></td></tr>
						</table>
					
						<table id="profile-table" class="contact_info_tbl" style="float: right;width:45%">
							<tr><td colspan="3" ><h2>CONTACT DETAILS</h2></td></tr>
								<tbody>
								<?php if(isset($this->data['Person']['Contacts'])):?>
									<?php $ctr=0;foreach($this->data['Person']['Contacts'] as $contactInfo):?>
										<tr  style="vertical-align: middle;"><td><label><?php echo $this->Form->input('ContactInformation.'.$ctr.'.id',array('type'=>'hidden','div' => false,'label'=>false,'value'=>$contactInfo['id'],'class'=>'unique_id'));echo $this->Form->input('ContactInformation.'.$ctr.'.type',array('type'=>'hidden','div' => false,'label'=>false,'value'=>$contactInfo['type'],'class'=>'unique_day'));echo $contactInfo['typename'];?></label></td>
											<td style="vertical-align: middle;"><?php echo $this->Form->input('ContactInformation.'.$ctr++.'.contact',array('type'=>'text','div' => false,'label'=>false,'style'=>'width:140px','value'=>$contactInfo['contact']));?></td>
											<td style="vertical-align: middle;"><a style="cursor:pointer; text-decoration: none;" onclick="removeContact(this);">&nbsp;&nbsp;<img src="/img/delete.png" style="height: 17px; width: 17px; cursor: pointer;"/></a></td>
										</tr>
									<?php endforeach;?>
								<?php endif;?>
								<tr><td><?php echo $this->Form->input('Contact.type',array('type'=>'select','options'=>$contactTypes,'label'=>false,'div'=>false));?></td><td><?php echo $this->Form->input('Contact.contact',array('type' => 'text','label'=>false,'div'=>false,'style'=>'width:140px'))?></td><td><a onclick="addContact(this);" style='cursor:pointer; text-decoration: none;'><img src="/img/add.png" style="height: 17px; width: 17px; cursor: pointer;"/></a></td></tr>
							</tbody>
						</table>
						
					</div>
					<div style="width:100%;">
						<table id="profile-table" style="display:inline-block;width:45%">
							<tbody>
								<tr><td><h2>MEMBERSHIP</h2></td><td></td></tr>
								<tr><td><label>Joined Date:</label></td><td><?php echo $this->Form->input('entry_datetime',array('label'=>false,'div'=>false,'type' => 'text'));?></td></tr>
								<tr><td><label>Referred by:</label></td><td><?php echo $this->Form->input('referred',array('label'=>false,'div'=>false));?></td></tr>
							</tbody>
						</table>
						<table id="profile-table" style="float: right;width:30%;margin-right: 115px;">
							<tr><td><h2>SUBSCRIPTION</h2></td><td></td></tr>
							<tr><td><label>Newsletter:</label></td><td><?php echo $this->Form->input('Subscription.newsletter',array('label'=>false,'type'=>'checkbox'));?></td></tr>
							<tr><td><label>Health Tips:</label></td><td><?php echo $this->Form->input('Subscription.healthtip',array('label'=>false,'type'=>'checkbox'));?></td></tr>
							<tr><td><label>Promo:</label></td><td><?php echo $this->Form->input('Subscription.promo',array('label'=>false,'type'=>'checkbox'));?></td></tr>
						</table>
					</div>
					<a class="save_profile button small green" style="color:#fff;float:none;clear:both;margin-bottom:20px;">Save</a>
					<br />
					<br />
					<?php //echo $this->Form->submit('Save',array('div'=>false,'style'=>'','class' => 'save_profile'));?>
					<?php echo $this->Form->end();?>
				</div>

            </div><!--/profile-->
			<div id="hmo" class="tabdiv">
				<div id="hmo-div">
								<table id="common-tbl" class="hmo_list">
									<thead>
										<tr>
											<th>Insurance Provider</th><th>Insurance Product</th><th>Accreditation No.</th><th>Date of Joining</th><th>Date of Expiration</th><th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(isset($this->data['Person']['HMO'])):?>
											<?php foreach($this->data['Person']['HMO'] as $hmo):?>
												<tr id="hmo_<?php echo $hmo['PersonInsurance']['id'];?>">
													
													<td class= "hmo_insurance_provider"><?php echo $this->Form->input('InsuranceProviderProduct.id',array('type'=> 'hidden','value' =>$hmo['InsuranceProvider']['id']));echo '<p>'.$hmo['CompanyBranch']['branch'].'</p>';?></td>
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
	
	var insuranceProductProviders = <?php echo $this->Js->object($insuranceProviderProducts);?>;
	
	var historyHandler = function(){
		
		jQuery('#history-div input[type=radio]:last').click();
		jQuery(this).unbind('click',historyHandler);
	};
	var indexIdcon = 1;
	var contact_delid = 0;
	jQuery(document).ready(function(){
			
		jQuery('#printHistory').click(function(){
			//jQuery('#printArea').printArea({mode:'popup'});
			var id = $('.jqplot-target').attr('id');
			var imgelem = $('#test-history_historyGraph').jqplotToImageElem();
			  $('#imgdiv').hide();
			  $('#imgdiv').empty();
			  $('#imgdiv').append(imgelem);
			  $('#imgdiv').printArea({mode:'popup'});
			 // jQuery('#patient-test-history_historyGraph').printArea({mode:'iframe'});
		});
		jQuery('#printTestHistory').click(function(){
			//jQuery('#printArea').printArea({mode:'popup'});
			var id = $('.jqplot-target').attr('id');
			var imgelem = $('#patient-test-history_historyGraph').jqplotToImageElem();
			  $('#imgdiv').hide();
			  $('#imgdiv').empty();
			  $('#imgdiv').append(imgelem);
			  $('#imgdiv').printArea({mode:'popup'});
			 // jQuery('#patient-test-history_historyGraph').printArea({mode:'iframe'});
		});
	      
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
		var orderId = jQuery('.testOrderDetailClass').attr('id');
		<?php if(isset($firstTestOrder)):?>
			showTestOrderDetail('<?php echo $firstTestOrder;?>','patient-visits-view');
			showTestOrderId('<?php echo $firstTestOrder;?>','patient-visits-view');
		<?php endif;?>
		jQuery('a[href=#history]').bind('click',historyHandler);
		jQuery('select[title=hmo_insurance_provider]').change(function(){
			insId = jQuery(this).val();
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
			xmlhttp.open("POST", "<?php echo $this->Html->url(array('controller'=>'Patients','action'=>'updateProfile', 'patient'=>false));?>", true);
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
		});
		jQuery('.save_hmo').click(function(){
			jQuery.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'Insurances','action'=>'addPersonInsurance', 'patient'=>false));?>',
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
	        	jQuery('#dt-login-form #side_id_pic').attr('src',datauri);
	        };
	      })(f);
	      reader.readAsDataURL(f);
		}
	};

	function addContact(a){
		contact = jQuery('#ContactContact').val();
		if(contact.length){
			type = jQuery('#ContactType').val();
			typename = jQuery('#ContactType').find('option:selected').text();
			tr = '<tr class="odd"><td><label><input type="hidden" name="data[ContactInformation][1][id]" id="ContactInformation0Id"><input type="hidden" name="data[ContactInformation][1][type]" id="ContactInformation0Type" value="'+type+'">'+typename+":"+'</label></td><td><input name="data[ContactInformation][1][contact]" style="width:140px" value="'+contact+'" type="text" id="ContactInformation0Contact"></td><td><a style="cursor:pointer;" onclick="removeContact(this);"><img src="/img/delete.png" style="height: 17px; width: 17px; cursor: pointer;"/></a></td></tr>';
			jQuery(tr).insertBefore(jQuery('.contact_info_tbl tbody tr:last'));
			reindexorder('.contact_info_tbl tbody tr');
			jQuery('#ContactContact').val('');
		}else{
			alert('Please type your contact detail.');
		}
	}

	function removeContact(a){
		rowcon = jQuery(a).parent().parent().html();
		contact_delid = jQuery(rowcon).find('input.unique_id').val();
		statusinput = '<input type="hidden" name="data[ContactInformationDelete]['+indexIdcon+'][id]" id="ContactInformationDelete0" value="'+contact_delid+'">';
		jQuery(statusinput).insertBefore(jQuery('.contact_info_tbl tbody tr:last'));
		indexIdcon += 1;
		jQuery(a).parent().parent().remove();
		reindexorder('.contact_info_tbl tbody tr');
	}
	
	function deleteHMO(personInsId){
		if(confirm("Are you sure you want to remove this insurance?")){
			jQuery.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'Insurances','action'=>'deletePersonInsurance', 'patient'=>false));?>',
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
			if(inputClass=='hmo_insurance_provider'){
				element = document.getElementById('PersonInsuranceInsuranceProvider');
				if ("fireEvent" in element)
				    element.fireEvent("onchange");
				else
				{
				    var evt = document.createEvent("HTMLEvents");
				    evt.initEvent("change", false, true);
				    element.dispatchEvent(evt);
				}
				
			}
			
		});
		jQuery('.hmo_id').val(jQuery(button).parent().parent().attr('id').replace('hmo_',''));
	}
</script>
	<style>
	.ui-dialog .ui-dialog-titlebar {
	    background:#ccc;
	}
	.visits_tbl tr:nth-child(2n):hover td, .visits_tbl tbody tr:hover td {
	   background:#687719;
	   color: #fffae4;
	}
	#selected td{
	   background: #687719;
	   color: #fffae4;
	}
	#common-tbl th{
	   background: url(../../img/btn-bg.jpg) repeat;
	   color: #fffae4;
	}
    input[type="text"], textarea,select{
        border-color:#7B7B7B #CBCCCE #CBCCCE #7B7B7B;
        border-radius: 2px;
    }
    select{
    	width: 214px;
    }
	</style>
