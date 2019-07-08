
<?php $this->set('title_for_layout', 'Online Services');?>
<?php
echo $this->element('graph_scripts');
?>


<script>
    var uploadType = 0;
    var $uploadImageButton;
</script>
<div id="flash" style="z-index: 100001;  left: 500px; position: fixed; bottom: 600px; color: black;"></div>
<div id="overlay" style="background-color: #000; opacity: 0.7; width: 4127px; height: 4127px; display: none;   left: 0; position: absolute; top: 0; z-index: 10000;"></div>
<div class="content" style="width:100% !important">
   <h2 style="text-decoration:none;font: bold 20px 'Trebuchet MS', Arial, Helvetica, sans-serif; margin: 10px 0 0 10px;color:#F00;text-shadow: 1px 1px 1px #333;">
   	Your Visits
   </h2>
    <div id="main-tab" class="widget-result">
        <ul class="tabnav">
            <li id="1"><a href="#visits">VISITS</a></li>
          <!-- <li id="2"><a href="#history">HISTORY</a></li> --> 
            <!-- <li id="3"><a href="#profile">PROFILE</a></li> -->
            <!-- <li id="4"><a href="#hmo">HMO</a></li>
            <li id="5"><a class="activity" href="#activity">Activities</a></li>
			 -->
        </ul>
        <div id="visits" class="tabdiv">
       		<table id="common-tbl" class="visits_tbl" >
                        <thead>
                            <tr>
                                <th style="width:20%;">Released Date/Time</th>
                                <th  style="width:15%;">Episode Number</th>
                                <th  style="width:45%;">Test</th>
                            </tr>
                        </thead>
            </table>
            <div id="visits-list" style="overflow-y:auto;">
            	<?php //debug($newlogin);//debug($testOrders)?>
                <?php if (isset($testOrders) && !empty($testOrders)): ?>
                    <table id="common-tbl" class="visits_tbl" >
                       <!-- <thead>
                            <tr>
                                <th style="width:20%;">Released Date</th>
                                <th  style="width:15%;">Episode Number</th>
                                <th  style="width:45%;">Test</th>
                            </tr>
                        </thead>-->
                        <tbody>
                            <?php
                            $firstTestOrder = null;
                            $selected = '';
                          //  foreach ($testOrders as $orders):
	                            foreach ($testOrders as $visit):
	                                ?>
	                                <tr class="order" id="<?php echo $selected; ?>" class="testOrderDetailClass" style="cursor:pointer;">
	                                  <!-- 
	                                   <?php if(isset($visit['LaboratoryPatientOrder']['mumps']) && $visit['LaboratoryPatientOrder']['mumps'] == true):?>
	                                 	    <td class="<?php echo $visit['LaboratoryPatientOrder']['specimen_id']?>"><?php echo $laboratories[$visit['Laboratory']['company_branch_id']]['CompanyBranch']['name']; ?></td>
	                                   <?php else:?>
	                                   		<td id="<?php echo $visit['Laboratory']['id']?>" class="<?php echo $visit['LaboratoryPatientOrder']['specimen_id']?>"><?php echo $laboratories[$visit['Laboratory']['company_branch_id']]['CompanyBranch']['name']; ?></td>
	                                   <?php endif;?>
	                                   -->
	                                   
	                                   <td style="width:20%;" class="<?php echo $visit['LaboratoryPatientOrder']['specimen_id']?>"><?php echo date('F d,Y / g:i a', strtotime(str_replace('/', '', $visit['LaboratoryTestOrder']['posted_datetime']))); ?></td>
	                                   <td style="width:15%;text-align:center;"><?php echo $visit['LaboratoryPatientOrder']['specimen_id']?></td>
	                                   <?php if(isset($visit['LaboratoryTestResult']['test_group_id']) && !empty($visit['LaboratoryTestResult']['test_group_id'])):?>
		                                    <td style="width:45%;">
		                                    	<?php echo $testgroups[$visit['LaboratoryTestResult']['test_group_id']];?>
		                                    </td>
	                                    <?php else:?>
		                                     <td style="width:45%;" title="<?php echo $visit['LaboratoryPatientOrder']['description']?>">
		                                    	<?php //echo $visit['LaboratoryTestResult']['description'];?>
		                                    	<?php echo substr($visit['LaboratoryPatientOrder']['description'], 0, 120); if(strlen($visit['LaboratoryPatientOrder']['description']) > 100) echo ' ...'; ?>
		                                    </td>
	                                    <?php endif;?>
	                                    

	                                    
	                                </tr>
	                            <?php endforeach;
                          //  endforeach;
                            ?>
                        </tbody>
                    </table>
                    <?php
                else:
                    echo "You have no recorded visits.";
                endif;
                ?>
            </div>
            <style>
            	#patient-visits-view table{
            		margin-bottom:0px;
            	}
            </style>
         <!--    <div id="patient-visits-view" style="height:auto;border:1px solid #BFB092;padding:5px;">

            </div> -->
            <?php //echo $this->element('pop_up_print_testgroup'); ?>
            <?php //echo $this->Form->submit('Save / Print', array('class'=>'button small green','div' => false, 'id' => 'printPdf', 'style' => 'float:right;')); ?>

            <?php echo $this->Form->end(); ?>

        </div>
       
       <!--<div id="profile" class="tabdiv">
            <?php echo $this->Form->create('Person', array('class' => 'patient_form', 'enctype' => 'multipart/form-data')); ?>
            <div id="photo" style="border:1px solid #BFB092; width:150px;height:150px;float:right;margin:20px 105px 0 0;">
				<?php echo $this->Html->image('../media/profiles/' . (isset($this->data['Person']['image'])?$this->data['Person']['image']:'default.jpeg'), array('id' => 'idpic', 'style' => 'width:150px;height:150px;')); ?>
                <p class="actions" align="center" style="width:100%;min-width:100%;">
                    <a href="#" id="take-photo" > Take a Photo</a>
                    <script>
                        var filelocation = "../../../js/jscam.swf";
                    </script>
                    <?php echo $this->element('webcamui'); ?>
                </p>
                <p class="actions" align="center" style="width:100%;min-width:100%;">
                    <a href="#" id="open-photo" > Change image</a>
                </p>
                <p class="actions" align="center" style="width:100%;min-width:100%;">
                    <a href="#" id="change-password" > Change Password</a>
                </p>
                <?php echo $this->Form->input('image_id', array('type' => 'hidden','div'=> false,'label' => false));?>
                <?php echo $this->Form->input('person_image_id', array('type' => 'hidden','div'=> false,'label' => false));?>
                <?php echo $this->Form->input('upload', array('type' => 'file', 'label' => false, 'div' => false, 'class' => 'browse_image', 'style' => 'display:none;')); ?>
            </div>
            <br/>
            <div id="profile-div">
                <div style="width:100%;">
                    <table id="profile-table" class="profile-table-class" style="width: auto;">
						<?php
							$person = $this->data['Person'];
							$address = (isset($this->data['Person']['CompleteAddress'])?$this->data['Person']['CompleteAddress']:array());
							unset($person['HMO']);
							unset($person['CompleteAddress']);
							$filter = array('suffix_id','father_person_id','mother_person_id','living_status','record_status','entry_datetime','user_id','validated','validated_datetime','validating_user_id','posted','posted_datetime','role','image','image_id','person_image_id','id');
							
							foreach($filter as $key=>$value){
								unset($person[$value]);
							}
						?>
                        <tr><td><h2>PROFILE</h2></td><td></td></tr>
                        <?php echo $this->Form->input('id', array('type' => 'hidden', 'label' => false, 'div' => false)); ?>
                        <?php echo $this->Form->input('image', array('type' => 'hidden', 'label' => false, 'div' => false)); ?>
                        <?php echo $this->Form->input('new_image', array('type' => 'hidden', 'label' => false, 'div' => false, 'class' => 'webcam-input')); ?>
                        <tr class="title" ><td><label>Title:</label></td><td><?php echo $this->Form->select('title_id',$title, array('value'=>$this->data['Person']['title_id'],'label' => false, 'div' => false)); ?><i><span class="span-req" >*</span></i></td></tr>
                        <tr class="last"><td><label>Last Name:</label></td><td><?php echo $this->Form->input('lastname', array('label' => false, 'div' => false)); ?><i><span class="span-req" >*</span></i></td></tr>
                        <tr class="first"><td><label>First Name:</label></td><td><?php echo $this->Form->input('firstname', array('label' => false, 'div' => false)); ?><i><span class="span-req" >*</span></i></td></tr>
                        <tr class="middle"><td><label>Middle Name:</label></td><td><?php echo $this->Form->input('middlename', array('label' => false, 'div' => false)); ?><i><span class="span-req" >*</span></i></td></tr>
                        <tr class="gender"><td><label>Gender:</label></td><td><?php echo $this->Form->input('sex', array('label' => false, 'type' => 'radio', 'div' => false, 'options' => array('M' => 'Male', 'F' => 'Female'), 'legend' => false)); ?><i><span class="span-req" >*</span></i></td></tr>
                        <tr class="marital"><td><label>Marital Status:</label></td><td><?php echo $this->Form->select('marital_status',array('S'=>'Single','M'=>'Married','W'=>'Widowed'),array('label'=>false,'div'=>false,'legend'=>false));?><i><span class="span-req" >*</span></i></td></tr>
                        <tr class="birth"><td><label>Birthdate:</label></td><td><?php echo $this->Form->input('birthdate', array('label' => false, 'div' => false, 'type' => 'text', 'class' => 'datepicker','value'=>date('Y-m-d',strtotime($this->data['Person']['birthdate'])))); ?><i><span class="span-req" >*</span></i></td></tr>
                    </table>
                </div>
                <div style="width:100%;float:left;">
                    <table class="profile-table-class" style="display:inline-block;width:auto;">
                        <tr><td><h2>ADDRESS:</h2></td><td>
                                <?php echo $this->Form->input('Person.CompleteAddress.Address.id', array('label' => false, 'div' => false, 'type' => 'hidden')); ?>
                                <?php echo $this->Form->input('Person.CompleteAddress.Address.person_address_id', array('label' => false, 'div' => false, 'type' => 'hidden')); ?>
                            </td></tr>
                        <tr class="province"><td style="width: 100px;"><label>Province:</label></td><td><?php echo $this->Form->input('Person.CompleteAddress.ProvincesStatesCode.id', array('label' => false, 'div' => false, 'type' => 'select', 'options' => $provinces, 'class' => 'address_select', 'title' => 'address_select_1')); ?><i><span class="span-req" >*</span></i></td></tr>
                        <tr class="town"><td><label>Town/City:</label></td><td><?php echo $this->Form->input('Person.CompleteAddress.TownCityCode.id', array('label' => false, 'div' => false, 'type' => 'select', 'options' => $townCities, 'class' => 'address_select', 'title' => 'address_select_2')); ?><i><span class="span-req" >*</span></i></td></tr>
                        <tr class="brgy"><td><label>Barangay:</label></td><td><?php echo $this->Form->input('Person.CompleteAddress.VillageCode.id', array('label' => false, 'div' => false, 'type' => 'select', 'options' => $villages, 'class' => 'address_select', 'title' => 'address_select_3')); ?><i><span class="span-req" >*</span></i></td></tr>
                        <tr class="street"><td><label>Street:</label></td><td><?php echo $this->Form->input('Person.CompleteAddress.Address.street_number', array('label' => false, 'div' => false, 'type' => 'text','placeholder'=>'This is required if no lot and block')); ?><i><span class="span-req" >*</span></i></td></tr>
                        <tr class="lot"><td><label>Lot:</label></td><td><?php echo $this->Form->input('Person.CompleteAddress.Address.lot',array('label'=>false,'div'=>false,'type' => 'text','placeholder'=>'This is required if no street'));?><i><span class="span-req" >*</span></i></td></tr>
						<tr class="block"><td><label>Block:</label></td><td><?php echo $this->Form->input('Person.CompleteAddress.Address.block',array('label'=>false,'div'=>false,'type' => 'text','placeholder'=>'This is required if no street'));?><i><span class="span-req" >*</span></i></td></tr>
                        <tr><td><label>Bldg/Apt:</label></td><td><?php echo $this->Form->input('Person.CompleteAddress.Address.building_apartment', array('label' => false, 'div' => false, 'type' => 'text')); ?></td></tr>
                        <tr><td><label>Unit:</label></td><td><?php echo $this->Form->input('Person.CompleteAddress.Address.unit', array('label' => false, 'div' => false, 'type' => 'text')); ?></td></tr>
                        <tr><td><label>Floor:</label></td><td><?php echo $this->Form->input('Person.CompleteAddress.Address.floor', array('label' => false, 'div' => false, 'type' => 'text')); ?></td></tr>
                    </table>

                    <table id="profile-table" class="contact_info_tbl" style="float: right;width:45%">
                        <tr><td colspan="3" ><h2>CONTACT DETAILS</h2></td></tr>
                        <tbody>
                            <?php if (isset($this->data['Person']['Contacts'])): ?>
                                <?php
                                $ctr = 0;
                                foreach ($this->data['Person']['Contacts'] as $contactInfo):
                                    ?>
                                    <tr  style="vertical-align: middle;"><td><label><?php
                                    echo $this->Form->input('ContactInformation.' . $ctr . '.id', array('type' => 'hidden', 'div' => false, 'label' => false, 'value' => $contactInfo['id'], 'class' => 'unique_id'));
                                    echo $this->Form->input('ContactInformation.' . $ctr . '.type', array('type' => 'hidden', 'div' => false, 'label' => false, 'value' => $contactInfo['type'], 'class' => 'unique_day'));
                                    echo $contactInfo['typename'];
                                    ?></label></td>
                                        <td style="vertical-align: middle;"><?php echo $this->Form->input('ContactInformation.' . $ctr++ . '.contact', array('type' => 'text', 'div' => false, 'label' => false, 'style' => 'width:135px', 'value' => $contactInfo['contact'])); ?></td>
                                        <td style="vertical-align: middle;"><a style="cursor:pointer; text-decoration: none;" onclick="removeContact(this);">&nbsp;&nbsp;<img src="/img/delete.png" style="height: 17px; width: 17px; cursor: pointer;"/></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <tr><td><?php echo $this->Form->input('Contact.type', array('type' => 'select', 'options' => $contactTypes, 'label' => false, 'div' => false)); ?></td><td><?php echo $this->Form->input('Contact.contact', array('type' => 'text', 'label' => false, 'div' => false, 'style' => 'width:135px')) ?></td><td><a onclick="addContact(this);" style='cursor:pointer; text-decoration: none;'><img src="/img/add.png" style="height: 17px; width: 17px; cursor: pointer;"/></a></td></tr>
                        </tbody>
                    </table>

                </div>
                <div style="width:100%;">
                    <table class="profile-table-class" id="profile-table" style="display:inline-block;width:45%">
                        <tbody>
                            <tr><td><h2>MEMBERSHIP</h2></td><td></td></tr>
                            <tr><td><label>Joined Date:</label></td><td><?php echo $this->Form->input('entry_datetime', array('label' => false, 'div' => false, 'type' => 'text')); ?></td></tr>
                            <tr><td><label>Referred by:</label></td><td><?php echo $this->Form->input('referred', array('label' => false, 'div' => false)); ?></td></tr>
                        </tbody>
                    </table>
                </div>
               
                <?php echo $this->Form->submit('Save Profile',array( /*'onclick'=>'return false;',*/ 'div'=>false,'style' => 'float:right;','class' => 'save_profile button small green'));  ?>
                <br />
                <br />
                <br />
                <br />
                <?php echo $this->Form->end(); ?>
            </div>

        </div>
        --><!--/profile-->
      
    </div><!--/widget-->
</div>
<div id="pdfFrameModal">
	<div id="pdfFrame" title="Result Viewer" style="display:none">
		<iframe type="application/pdf" id="iframeId" width='800' height='900' style='overflow-y:hidden' src=''></iframe>
	</div>

</div>
<div id="dialogModal">
	<div id="changepassword" title="Change Password" style="display:none">
				 <table  id="double-td-tbl2">
				 <?php echo $this->Form->create('User',array('action'=>'change_password','class'=>'changePasswordFrm'))?>
	
				 	<tr>
				 		<td>Old Password</td>
				 		<td>
				 			<?php echo $this->Form->input('oldpassword',array('type'=>'password','label'=>false,'class'=>'oldpassword','placeholder'=>'Old Password'))?>
				 		</td>
				 	</tr>
				 	<tr>
				 		<td>New Password</td>
				 		<td>
				 			<?php echo $this->Form->input('newpassword',array('type'=>'password','label'=>false,'class'=>'newpassword','placeholder'=>'New Password'))?>
				 		</td>
				 	</tr>
				 	<tr>
				 		<td>Confirm New Password</td>
				 		<td>
				 			<?php echo $this->Form->input('confpassword',array('type'=>'password','label'=>false,'class'=>'confpassword','placeholder'=>'Confirm Password'))?>
				 		</td>
				 	</tr>
				 	<tr>
				 		<td>
							<?php echo $this->Form->submit('Change',array('class'=>'changePass','onclick'=>' return false;'));?>
							<?php echo $this->Form->end();?>
				 		</td>
				 	</tr>
				 </table>
	</div>
</div>
<?php //echo $this->element("sidebar");?>
<script>
	var person = <?php echo $this->Js->object($person);?>;

	var address = <?php echo $this->Js->object($address);?>;

    var insuranceProductProviders = <?php echo $this->Js->object($insuranceProviderProducts); ?>;

//    var apple = <?php //echo $this->Js->object($AppleDetect);?>;
	
    var historyHandler = function(){
		
        jQuery('#history-div input[type=radio]:last').click();
        jQuery(this).unbind('click',historyHandler);
    };
    var actEventHandler = false;
    var indexIdcon = 1;
    var contact_delid = 0;

    var newlogin = <?php echo $this->Js->object($newlogin);?>;
    
    
    jQuery(document).ready(function(){
        
    	setTimeout("autoLogOut()", 3600000);
        if(newlogin && newlogin.new == true){changePassword();}
    	var windowwidth = jQuery(window).width();
    	var windowheight = jQuery(window).height();
    	jQuery('#visits-list').css({'height':windowheight-(windowheight*0.50)});
    	jQuery('.ui-widget-overlay').css({'height':windowheight+"%"});
//     	jQuery('#pdfFrame').css({'width':windowheight-(windowheight*.1),'height':windowwidth-(windowwidth*.1)});
    	jQuery('#pdfFrame').css({'width':'800','height':'1000'});
        jQuery('table.profile-table-class input[type="text"]').css('width','190px');
        jQuery('table.profile-table-class tr td select').css('width','203px');

        jQuery('#PersonInsuranceInsuranceProvider').change(function(){
        	value = jQuery(this).val();
        	if(value == ''){
				jQuery('#PersonInsuranceInsuranceProviderProductId').empty();
        	}
        });
		jQuery('table#common-tbl.visits_tbl tr.order').click(function(){
			jQuery(this).parent().children('tr').removeAttr('id');
			jQuery(this).attr('id','selected');
			var labid=jQuery(this).children('td:first').attr('id');
			var specimenid=jQuery(this).children('td:first').attr('class');
			var iframe = document.getElementById("iframeId");
// 			 var html = "";
// 			iframe.contentWindow.document.open();
// 			iframe.contentWindow.document.write(html); 
// 			iframe.contentWindow.document.close();
			jQuery('#iframeId').attr('src', jQuery('#iframeId').attr('src'));
			jQuery('#pdfFrameModal #pdfFrame iframe').removeAttr('src');

			if(labid){
				jQuery('#pdfFrameModal #pdfFrame iframe').attr('src','/patients/viewPdfMro/'+labid+''+specimenid);
				jQuery('#pdfFrame iframe#iframeId').attr('src','/patients/viewPdfMro/'+labid+''+specimenid);
			}else{
				jQuery('#pdfFrameModal #pdfFrame iframe').attr('src','/patients/viewPdf/'+specimenid);
				jQuery('#pdfFrame iframe#iframeId').attr('src','/patients/viewPdf/'+specimenid);
			}
			
// 			iframe.contentWindow.location.reload();
			jQuery( "#pdfFrame" ).dialog({
			      autoOpen: false,
			      modal: true,
			      height:(windowheight-50),
// 			      width:(windowwidth-(windowwidth*.1))
// 			      height:1000,
		    	  width:840,
		    	  resizable: true,
// 			      close: function(event, ui){}
			    }).dialog("open");
		    
		});
//    	jQuery('#printTestHistory').click(function(){
//        	if(!apple){
//				isAcrobatReaderInstalled();
//				jQuery('#printTestHistory').submit();
////				return false;
//				alert('here');
//
//			}
//
//
//    		jQuery('#printTestHistory').submit();
//        });
//        jQuery('#printTestHistory').click(function(){
//        	if(!apple){
//				isAcrobatReaderInstalled();
//				return false;
//			}
//        });

		
		jQuery('a#change-password').click(function(){
			jQuery( "#changepassword" ).dialog({
			      autoOpen: true,
			      modal: true,
			      height:220,
			      width:430
//			      close: function(event, ui)
			    }).dialog("open");
			jQuery('.ui-widget-overlay').css({'height':windowheight});
		    
		    
		});
		jQuery('input.changePass').click(function(){
			jQuery.ajax({
                url: "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'change_password', 'patient' => false)); ?>",
        		data:jQuery('.changePasswordFrm').serialize(),
				type: 'POST',
				dataType : 'json',
//				asynch:false,
				success:function(data){
                    if(data == 1){
                    	alert('You are successfully changed your password.');
                      	jQuery("#changepassword :password").each(function(){
            				jQuery(this).val('');
                        });
                    	jQuery( "#changepassword" ).dialog('close');
                    }else if(data == 2){
                    	alert('New password and Confirm new password are not match!.');
                    }else if(data == 3){
                    	alert('Incorrect old password entered. Please entered correct password.');
                    }else{
                    	alert('Unable to change password. Please complete all fields.');
                    }
                }
            });
		});
        jQuery('a.activity').click(function(){
			if(!actEventHandler){
				showLoadingMask();
          		
	            jQuery.ajax({
	                url: "<?php echo $this->Html->url(array('controller' => 'patients', 'action' => 'getActivity', 'patient' => false)); ?>",
	        		data:{'data':''},
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
	            actEventHandler = true;
            }

        });

		jQuery.each(person,function(x,y){
			id = 'Person'+ camelize(x);
			if(x == 'sex'){
				jQuery('#'+id+y).attr('checked','checked');
				if(jQuery('#PersonSexM').is(":checked")){
					if(jQuery('#PersonSexM').is(":checked")){jQuery('tr.gender td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}else{jQuery('tr.gender td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.gender td:eq(1) i span.span-req').text() == "*"){jQuery('tr.gender td:eq(1) i span.span-req').append('');}}
				}else if(jQuery('#PersonSexF').is(":checked")){
					if(jQuery('#PersonSexF').is(":checked")){jQuery('tr.gender td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}else{jQuery('tr.gender td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.gender td:eq(1) i span.span-req').text() == "*"){jQuery('tr.gender td:eq(1) i span.span-req').append('');}}
				}
			}else if(x == 'birthdate'){
				var inputVal = y;if(inputVal == null){jQuery('tr.birth td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.birth td:eq(1) i span.span-req').text() == "*"){jQuery('tr.birth td:eq(1) i span.span-req').append('');}}else{jQuery('tr.birth td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
			}else if(x == 'lastname'){
				var inputVal = y;if(inputVal == null){jQuery('tr.last td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.last td:eq(1) i span.span-req').text() == "*"){jQuery('tr.last td:eq(1) i span.span-req').append('');}}else{jQuery('tr.last td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
			}else if(x == 'firstname'){
				var inputVal = y;if(inputVal == null){jQuery('tr.first td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.first td:eq(1) i span.span-req').text() == "*"){jQuery('tr.first td:eq(1) i span.span-req').append('');}}else{jQuery('tr.first td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
			}else if(x == 'middlename'){
				var inputVal = y;if(inputVal == null){jQuery('tr.middle td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.middle td:eq(1) i span.span-req').text() == "*"){jQuery('tr.middle td:eq(1) i span.span-req').append('');}}else{jQuery('tr.middle td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
			}else if(x == 'title_id'){
				var inputVal = y;if(inputVal == null){jQuery('tr.title td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.title td:eq(1) i span.span-req').text() == "*"){jQuery('tr.title td:eq(1) i span.span-req').append('');}}else{jQuery('tr.title td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
			}else if(x == 'marital_status'){
				var inputVal = y;if(inputVal == null){jQuery('tr.marital td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.marital td:eq(1) i span.span-req').text() == "*"){jQuery('tr.marital td:eq(1) i span.span-req').append('');}}else{jQuery('tr.marital td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
			}
		});
		jQuery.each(address,function(x,y){
//			alert(x+"="+y);
			id = 'PersonCompleteAddress'+ camelize(x);
				if(x == 'VillageCode'){
					var inputVal = y.id;if(inputVal == null){jQuery('tr.province td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.province td:eq(1) i span.span-req').text() == "*"){jQuery('tr.province td:eq(1) i span.span-req').append('');}}else{jQuery('tr.province td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
				}else if(x == 'ProvincesStatesCode'){
					var inputVal = y.id;if(inputVal == null){jQuery('tr.town td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.town td:eq(1) i span.span-req').text() == "*"){jQuery('tr.town td:eq(1) i span.span-req').append('');}}else{jQuery('tr.town td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
				}else if(x == 'TownCityCode'){
					var inputVal = y.id;if(inputVal == null){jQuery('tr.brgy td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.brgy td:eq(1) i span.span-req').text() == "*"){jQuery('tr.brgy td:eq(1) i span.span-req').append('');}}else{jQuery('tr.brgy td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
				}else if(x == 'Address'){
					jQuery.each(y,function(a,b){
						if(a == 'street_number'){
							var inputVal = b;if(inputVal == ''){jQuery('tr.street td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.street td:eq(1) i span.span-req').text() == "*"){jQuery('tr.street td:eq(1) i span.span-req').append('');}}else{jQuery('tr.street td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
							
						}
						if(a == 'lot'){
//							alert(b);
							var inputVal = b;if(inputVal == ''){jQuery('tr.lot td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.lot td:eq(1) i span.span-req').text() == "*"){jQuery('tr.lot td:eq(1) i span.span-req').append('');}}else{jQuery('tr.lot td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
							
						}
						if(a == 'block'){
							var inputVal = b;if(inputVal == ''){jQuery('tr.block td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.block td:eq(1) i span.span-req').text() == "*"){jQuery('tr.block td:eq(1) i span.span-req').append('');}}else{jQuery('tr.block td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}
						}
					});
					
				}
		});

    	jQuery('#PersonBody').hide();
        jQuery('#printHistory').click(function(){
            var id = $('.jqplot-target').attr('id');
            var imgelem = $('#patient-test-history_historyGraph').jqplotToImageElem();
            $('#imgdiv').hide();
            $('#imgdiv').empty();
            $('#imgdiv').append(imgelem);
            var content_innerhtml_pdf = document.getElementById("printArea").innerHTML;
            jQuery('textarea#PersonBody').val(content_innerhtml_pdf);
        });
        jQuery('#printTestHistory').click(function(){
            var id = $('.jqplot-target').attr('id');
            var imgelem = $('#patient-test-history_historyGraph').jqplotToImageElem();
            $('#imgdiv').hide();
            $('#imgdiv').empty();
            $('#printArea').append(imgelem);
            var Lastname = jQuery('#PersonLastname').val();
            var Firstname = jQuery('#PersonFirstname').val();
            var name = Lastname+', '+Firstname;
            var birthdate = jQuery('#PersonBirthdate').val();
            jQuery('#patientName').append(name);
            jQuery('#birthdate').append(birthdate);
            var content_innerhtml_pdf = document.getElementById("printArea").innerHTML;
            jQuery('textarea#PersonBody').val(content_innerhtml_pdf);
          });

        jQuery('.submit-save').click(function(){
            var id = $('.jqplot-target').attr('id');
            var imgelem = $('#patient-test-history_historyGraph').jqplotToImageElem();
            $('#imgdiv').hide();
            $('#imgdiv').empty();
            $('#printArea').append(imgelem);
            var Lastname = jQuery('#PersonLastname').val();
            var Firstname = jQuery('#PersonFirstname').val();
            var name = Lastname+', '+Firstname;
            var birthdate = jQuery('#PersonBirthdate').val();
            jQuery('#patientName').append(name);
            jQuery('#birthdate').append(birthdate);
            var content_innerhtml_pdf = document.getElementById("printArea").innerHTML;
            jQuery('textarea#PersonBody').val(content_innerhtml_pdf);
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
        jQuery('#closeFlash').live('click',function(){
                jQuery('#SuccessMessages').hide();
        });
        jQuery('#print_all').live('click',function(){
            if(jQuery(this).is(':checked'))
                jQuery('*:input','.testGroup, .testCode').attr('checked', 'checked');
            else
                jQuery('*:input','.testGroup, .testCode').removeAttr('checked');
        });
        jQuery('.current-crumb').append(' MEMBER ACCOUNT');
        var orderId = jQuery('.testOrderDetailClass').attr('id');
        <?php if (isset($firstTestOrder)): ?>
              //showTestOrderDetail('<?php echo $firstTestOrder;?>','patient-visits-view');
              //showTestOrderId('<?php echo $firstTestOrder; ?>','patient-visits-view');
        <?php endif; ?>
                jQuery('.save_profile').click(function(){
                	var checkForm = validationForm('Address','Person');
//                 	alert(JSON.stringify(checkForm));
            		if(checkForm){
	                	showLoadingMask("Saving patient profile...");
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
	                    xmlhttp.open("POST", "<?php echo $this->Html->url(array('controller' => 'Patients', 'action' => 'updateProfile', 'patient' => false)); ?>", true);
	                    xmlhttp.setRequestHeader("X_REQUESTED_WITH", "XMLHttpRequest");
	                    xmlhttp.onreadystatechange = function(){
	                        hideLoadingMask();
	                        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
	                        	parser = new DOMParser();
	            				xmlDoc = parser.parseFromString(xmlhttp.responseText, "application/xml");
	                            result = parseInt(xmlDoc.getElementsByTagName("result")[0].childNodes[0].nodeValue);
	                            if(result){
	                            		flashSuccessMessage('Your profile was successfully updated');
	                            }else{
	                                    flashErrorMessage('An error ocurred while saving your profile, please try again.');
	                            }
	                        } else if(xmlhttp.readyState == 4)
	                        	flashErrorMessage("Error: returned status code " + xmlhttp.status + " " + xmlhttp.statusText);
	                    };
	                    xmlhttp.send(formData);
	                    return false;
            		}else{flashErrorMessage('Some fields are required.');
            		 return false;
            		}
           		 return false;
                });
                jQuery('.save_hmo').click(function(){
                	form = validationForm(".hmo_form");
            		if(!form){
            			flashErrorMessage("All fields required!");
            		}else{
	                	showLoadingMask("Saving patient hmo...");
	                    jQuery.ajax({
	                        url: '<?php echo $this->Html->url(array('controller' => 'Insurances', 'action' => 'addPersonInsurance', 'patient' => false)); ?>',
	                        data:jQuery('.hmo_form').serialize(),
	                        type: 'POST',
	                        dataType : 'json',
	                        success:function(data){
	                            hideLoadingMask();
	                            if(data){
	                            	flashSuccessMessage('Saving insurance details was successful.');

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
	                                tr += '<td><a href="#" onclick="setHMO(this);" >Edit</a>&nbsp;<a href="#" onclick="deleteHMO('+data+');">Delete</a></td>';
	                                tr += '</tr>';

	                                if(jQuery('#hmo_'+id).length){
	                                    jQuery('#hmo_'+id).replaceWith(tr);
	                                }else{
	                                    jQuery('.hmo_list tbody').append(tr);
	                                }
	        						jQuery('.HMO_fields').find('input[type=text],select,.hmo_id').each(function(){
	        							jQuery(this).val("");
	        						});
	                            }else{
	                            	flashErrorMessage('Saving insurance fail, please try again stupid!');
	                            }
	                        }
	                    });
//	                    event.preventDefault();
            		}
            		return false;
                });
                jQuery('a[href=#history]').bind('click',historyHandler);
                jQuery('select[title=hmo_insurance_provider_product]').empty();
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
                $uploadImageButton = jQuery(".browse_image").clone();
                $uploadImageButton.change(updateImagePreview);
                jQuery(".browse_image").change(updateImagePreview);

                <?php if(isset($this->params['named']['tab']) && strlen($this->params['named']['tab'])):?>
	        		//setSelectedTab("<?php echo $this->params['named']['tab'];?>");
	        		jQuery("a[href=#"+"<?php echo $this->params['named']['tab'];?>"+"]").click();
	        	<?php endif;?>

	        	jQuery('#ContactContact').live('focusout',function(){
	        		var inputVal = jQuery(this).val();
	        		if(inputVal != ""){
	        			addContact();
	        		}
	        	});
	        	checkInput();
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
                    valid = isValidContactDetail(contact,type);
                    if(valid){
	                    typename = jQuery('#ContactType').find('option:selected').text();
	                    tr = '<tr class="odd"><td><label><input type="hidden" name="data[ContactInformation][1][id]" id="ContactInformation0Id"><input type="hidden" name="data[ContactInformation][1][type]" id="ContactInformation0Type" value="'+type+'">'+typename+":"+'</label></td><td><input name="data[ContactInformation][1][contact]" style="width:140px" value="'+contact+'" type="text" id="ContactInformation0Contact"></td><td><a style="cursor:pointer;" onclick="removeContact(this);"><img src="/img/delete.png" style="height: 17px; width: 17px; cursor: pointer;"/></a></td></tr>';
	                    jQuery(tr).insertBefore(jQuery('.contact_info_tbl tbody tr:last'));
	                    reindexorder('.contact_info_tbl tbody tr');
	                    jQuery('#ContactContact').val('');
	                    jQuery('.error_message').css('display','none');
                    }else{
                    	flashErrorMessage('Invalid contact. Please check your contact detail first.');
                    }
                    
                }else{
                	flashErrorMessage('Please type your contact detail.');
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
                	showLoadingMask("Deleting patient hmo...");
                    jQuery.ajax({
                        url: '<?php echo $this->Html->url(array('controller' => 'Insurances', 'action' => 'deletePersonInsurance', 'patient' => false)); ?>',
                        data:{'PersonInsurance':{'id':personInsId}},
                        type: 'POST',
                        dataType : 'json',
                        success:function(data){
                            hideLoadingMask();
                            if(data){
                            	flashSuccessMessage('Deletion of insurance was successful.');
                                jQuery('#hmo_'+personInsId).remove();
						
                            }else{
                            	flashErrorMessage('Deletion of insurance fail, please try again stupid!');
                            }
                        }
                    });
                }
            }
    		jQuery('.reset_hmo').click(function(){
    			jQuery('.HMO_fields').find('input[type=text],select,.hmo_id').each(function(){
    				jQuery(this).val("");
    			});
    			return false;
    		});
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
        	function validationForm(address,person){
        		var result = true;
        			if(address == "Address"){
        				provinceInput = jQuery("#PersonCompleteAddressProvincesStateId").val();
        				TownCityInput = jQuery("#PersonCompleteAddressTownCityCodeId").val();
        				VillageInput = jQuery("#PersonCompleteAddressVillageCodeId").val();
        				StreetInput = jQuery("#PersonCompleteAddressAddressStreetNumber").val();
        				Lot = jQuery("#PersonCompleteAddressAddressLot").val();
        				Block = jQuery("#PersonCompleteAddressAddressBlock").val();
        				if(provinceInput == 0 || TownCityInput == 0 || VillageInput == 0){
        					result = false;
        				}else{
        					if(StreetInput == '' || StreetInput == 'This is required if no lot and block'){if(Lot != '' && Block != '' && Lot != 'This is required if no street' && Block != 'This is required if no street'){result = true;}else{result = false;}}
        				}
            		}
        			if(person == "Person"){
        				PersonTitleInput = jQuery("#"+person+"TitleId").val();
        				PersonLastnameInput = jQuery("#"+person+"Lastname").val();
        				PersonFirstnameInput = jQuery("#"+person+"Firstname").val();
        				PersonMiddlenameInput = jQuery("#"+person+"Middlename").val();

//        				PersonMaritalInput = jQuery("#"+person+"MaritalStatus").val();
        				PersonBirthdateInput = jQuery("#"+person+"Birthdate").val();
        				
//        				ContactInput = jQuery('#ContactInformation0Contact').val();
        				if(PersonTitleInput == "" || PersonLastnameInput == "" || PersonFirstnameInput == "" || PersonMiddlenameInput == "" || PersonBirthdateInput == ""){result = false;}
        				if(jQuery('#PersonSexM').is(':checked')){
        				}else if(jQuery('#PersonSexF').is(':checked')){
        				}else{result = false;}
        			}
        		return result;
        	}
        	function checkInput(){
        		var inputUserVal = '';
        		var inputPassVal = '';
        		var result = "";
        		jQuery('#PersonLastname').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.last td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.last td:eq(1) i span.span-req').text() == "*"){jQuery('tr.last td:eq(1) i span.span-req').append('');}}else{jQuery('tr.last td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
        		jQuery('#PersonFirstname').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.first td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.first td:eq(1) i span.span-req').text() == "*"){jQuery('tr.first td:eq(1) i span.span-req').append('');}}else{jQuery('tr.first td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
        		jQuery('#PersonMiddlename').live('focusout',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.middle td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.middle td:eq(1) i span.span-req').text() == "*"){jQuery('tr.middle td:eq(1) i span.span-req').append('');}}else{jQuery('tr.middle td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
        		jQuery('#PersonTitleId').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.title td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.title td:eq(1) i span.span-req').text() == "*"){jQuery('tr.title td:eq(1) i span.span-req').append('');}}else{jQuery('tr.title td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
        		jQuery('#PersonMyresultonlineId').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.id td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.id td:eq(1) i span.span-req').text() == "*"){jQuery('tr.id td:eq(1) i span.span-req').append('');}}else{jQuery('tr.id td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
        		jQuery('#PersonMaritalStatus').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.marital td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.marital td:eq(1) i span.span-req').text() == "*"){jQuery('tr.marital td:eq(1) i span.span-req').append('');}}else{jQuery('tr.marital td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
        		jQuery('#PersonBirthdate').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.birth td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.birth td:eq(1) i span.span-req').text() == "*"){jQuery('tr.birth td:eq(1) i span.span-req').append('');}}else{jQuery('tr.birth td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
        		jQuery('#PersonSexM').live('click',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.gender td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.gender td:eq(1) i span.span-req').text() == "*"){jQuery('tr.gender td:eq(1) i span.span-req').append('');}}else{jQuery('tr.gender td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
        		jQuery('#PersonSexF').live('click',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.gender td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.gender td:eq(1) i span.span-req').text() == "*"){jQuery('tr.gender td:eq(1) i span.span-req').append('');}}else{jQuery('tr.gender td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});

        		jQuery('#PersonCompleteAddressProvincesStatesCodeId').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.province td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.province td:eq(1) i span.span-req').text() == "*"){jQuery('tr.province td:eq(1) i span.span-req').append('');}}else{jQuery('tr.province td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
        		jQuery('#PersonCompleteAddressTownCityCodeId').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.town td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.town td:eq(1) i span.span-req').text() == "*"){jQuery('tr.town td:eq(1) i span.span-req').append('');}}else{jQuery('tr.town td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
        		jQuery('#PersonCompleteAddressVillageCodeId').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.brgy td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.brgy td:eq(1) i span.span-req').text() == "*"){jQuery('tr.brgy td:eq(1) i span.span-req').append('');}}else{jQuery('tr.brgy td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
        		jQuery('#PersonCompleteAddressAddressStreetNumber').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.street td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.street td:eq(1) i span.span-req').text() == "*"){jQuery('tr.street td:eq(1) i span.span-req').append('');}}else{jQuery('tr.street td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});

        		jQuery('#PersonCompleteAddressAddressLot').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.lot td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.lot td:eq(1) i span.span-req').text() == "*"){jQuery('tr.lot td:eq(1) i span.span-req').append('');}}else{jQuery('tr.lot td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});
        		jQuery('#PersonCompleteAddressAddressBlock').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.block td:eq(1) i span.span-req').html('*').css('color','red');if(jQuery('tr.block td:eq(1) i span.span-req').text() == "*"){jQuery('tr.block td:eq(1) i span.span-req').append('');}}else{jQuery('tr.block td:eq(1) i span.span-req').html('&#10003;').css('color','#687719');}});

        		jQuery('#ContactContact').live('change',function(){var inputVal = jQuery(this).val();if(inputVal == ''){jQuery('tr.contact td:eq(2) a i span.span-req').html('*').css('color','red');if(jQuery('tr.contact td:eq(2) a i span.span-req').text() == "*"){jQuery('tr.contact td:eq(2) a i span.span-req').append('');}}else{jQuery('tr.contact td:eq(2) a i span.span-req').html('&#10003;').css('color','#687719');}});
        		

        	}
        	
        	function strLength(pass){
        	  var len = pass.length;
        	  return len;
        	}

        	function changePassword(){
        			jQuery( "#changepassword" ).dialog({
        			      autoOpen: true,
        			      modal: true,
        			      height:220,
        			      width:430
        			 }).dialog("open");
        		    
        	}
        	function autoLogOut(){
        		var isLoggedIn = 0;
        		$.ajax({
        		    type: "POST",
        		    url: '<?php echo $this->Html->url(array('controller'=>'patients','action'=>'checklogin','patient'=>false));?>',
        		    success: function(msg){
        		        isLoggedIn = msg;
        		        if(isLoggedIn == 0){
        		        	location.reload();
        		        }else{
        		        	setTimeout("autoLogOut()", 3600000);
        		        }
        		    }
        		});
        	}
</script>
 	<style>
   h1, h2, h3, h4{ font: bold 15px "Trebuchet MS", Arial, Helvetica, sans-serif;}
                                    
	.ui-dialog .ui-dialog-titlebar {
	    background:#ccc;
	}
	.visits_tbl {
		width:100%;
	    border-left: 1px solid #FFCACA;
	    border-right: 1px solid #FFCACA;
		border-bottom: 1px solid #FFCACA;
	}
	.visits_tbl tr:nth-child(2n):hover td, .visits_tbl tbody tr:hover td {
	   background: #FF8484;
	   color: #000;
	}
	#selected td{
	   background: #FF8484;
	   color: #000;
	   /*padding: 3px 0;*/
	}
	#common-tbl th {
    	/*background: url(../../img/heartcenter/sidenav.png) repeat;*/
	    font: bold 13px "Trebuchet MS", Arial, Helvetica, sans-serif;
	    background: #FFEAEA;
	    border: 1px solid #FFCACA;
	    text-align: center;
	    padding: 3px 0;
	}
	input[type="text"], textarea, select {
    border: 1px solid #CCC;
    padding: 4px;
    border-radius: 5px;
    color: #333;
	}
	td label{
		font-size: 11px;
		font-weight: bold;
	}
	table#single-td-tbl input[type="text"] {
		width: 270px !important;
	}
	table#single-td-tbl select {
		width: 281px !important;
	}
	</style>
