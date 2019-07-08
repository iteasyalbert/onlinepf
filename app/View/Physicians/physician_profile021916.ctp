<?php $this->set('title_for_layout', 'Online Services');?>
<div id="flash" style="z-index: 100001;  left: 500px; position: fixed; bottom: 600px; color: black;"></div>
<div id="overlay" style="background-color: #000; opacity: 0.7; width: 4127px; height: 4127px; display: none;   left: 0; position: absolute; top: 0; z-index: 10000;"></div>


		
<style type="text/css">
    #ui-datepicker-div
    {
        z-index: 9999999;
    }
</style>
<br/>
<div class="content" style="width:100% !important;">
		<div id="main-tab" class="widget-result">
		
            <ul class="tabnav">
                <li><a href="#patient">MY PATIENTS</a></li>
                
            </ul>
          
            <div id="patient" class="tabdiv" style="padding:10px 10px 0px 10px !important;">
	           <div id="patient-container" >
	            <div class="header" style="width: 100%;text-align:right;"><span><b style="text-decoration:underline;">Collapse</b>&nbsp;&nbsp;&nbsp;&nbsp;</span></div>
				<div id="patient-div" style="">
					<?php echo $this->Form->create('Patient',array('class'=>'search-patient-frm','onsubmit'=>'event.preventDefault();'));?>
					<?php echo $this->Form->input('mrno',array('label'=>false,'type'=>'text','div'=>false,'placeholder'=>'MRNumber','class'=>'labeled','title'=>'MRNumber','autocomplete'=>'off'));?>
					<?php echo $this->Form->input('lastname',array('label'=>false,'div'=>false,'placeholder'=>'Lastname','class'=>'labeled','title'=>'Lastname','autocomplete'=>'off'));?>
					<?php echo $this->Form->input('firstname',array('label'=>false,'div'=>false,'placeholder'=>'Firstname','class'=>'labeled','title'=>'Firstname','autocomplete'=>'off'));?>
					<?php echo $this->Form->submit('Search Patient',array('div'=>false,'class'=>'search-patient-btn', 'style'=>'vertical-align: middle; margin: 0 0 5px;'));?>
					<?php echo $this->Form->end();?>
					<br/>
					<table id="common-tbl" class="patient_search visits_tbl" >
                		<thead>
                			<th style="width:30%;">MRNumber</th><th style="width:40%;">Name</th><th style="width:30%;">Birthdate</th>
                		</thead>
                	</table>
                	<div id="patientlist"  style="overflow-y:auto;">
	                	<table id="common-tbl" class="patient_search visits_tbl" >
	                		<!-- <thead>
	                			<th style="width:30%;">Patient ID</th><th style="width:40%;">Name</th><th style="width:30%;">Birthdate</th>
	                		</thead>-->
	                		<tbody>
	                		</tbody>
	                	</table>
                	</div>
                	<!-- 
                	<div id="photo" style="border:1px solid #BFB092; width:140px;height:140px;float:left;margin:10px 20px 0 0;">
						<?php echo $this->Html->image('male.jpg',array('style'=>'width:140px;height:140px;','id' =>'patient-idpic'));?>
					</div>
               		--> 
                	<div id="patient-profile-div">
	                	<!-- <table id="single-td-tbl">
	                	<?php echo $this->Form->create('Profile');?>
	                	<tr><td><h2>PROFILE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2></td><td></td></tr>
						<tr><td><label>MRO ID:</label></td><td><?php echo $this->Form->input('myresultonline_id',array('label'=>false, 'type'=>'text','div'=>false));?></td></tr>
						<tr><td><label>Last Name:</label></td><td><?php echo $this->Form->input('lastname',array('label'=>false,'div'=>false));?></td></tr>
						<tr><td><label>First Name:</label></td><td><?php echo $this->Form->input('firstname',array('label'=>false,'div'=>false));?></td></tr>
						<tr><td><label>Middle Name:</label></td><td><?php echo $this->Form->input('middlename',array('label'=>false,'div'=>false));?></td></tr>
						<tr><td><label>Gender:</label></td><td><?php echo $this->Form->input('sex',array('label'=>false,'type'=>'radio','div'=>false,'options'=>array('M'=>'Male','F'=>'Female'),'legend'=>false));?></td></tr>
						<tr><td><label>Birthdate:</label></td><td><?php echo $this->Form->input('birthdate',array('label'=>false,'div'=>false));?></td></tr>
						<tr><td><label>Address:</label></td><td><?php echo $this->Form->input('complete_address',array('label'=>false,'div'=>false));?></td></tr>
						<?php echo $this->Form->end(array('type'=>'hidden'));?>
						</table> -->
						<div class="patient_test_results" style="display:none">
							<h2>TEST RESULTS</h2>
							<div id="main-tab" class="widget-result">
								<ul class="tabnav">
					                <li><a href="#patient-visits">VISITS</a></li>
					                <!-- <li><a href="#patient-history">HISTORY</a></li> -->
					            </ul>
			                	 <div id="patient-visits" class="tabdiv">
			                	 	<h4>Select Visit</h4>
			                	 	<table class="patient-visits visits_tbl" id="common-tbl">
				                		<thead>
<!-- 					                		<tr> -->
<!-- 					                			<th>Laboratory</th><th>Date</th><th>Test</th> -->
<!-- 					                		</tr> -->
				                		<tr>
			                                <th style="width:25%;">Laboratory</th>
			                                <th  style="width:25%;">Test</th>
			                                <th  style="width:25%;">Episode Number</th>
			                                 <th style="width:25%;">Released Date</th>
			                            </tr>
				                		</thead>
				                		<tbody>
				                		</tbody>
				                	</table>
				                	<div id="patient-visit-view" style="height:auto;border:1px solid #BFB092;">
	                		
	                				</div>
	                				<?php //echo $this->Form->submit('Save / Print',array('div'=>false, 'id'=>'printPdf','style'=>'margin-left:77.5%;'));?>
	            				     <?php echo $this->Form->end();?>
			                	 </div>
			                	 
			                	 <!-- PATIENT'S HISTORY - TEMPORARILY DISABLED -->
			                	 <!--  
			                	 <div id="patient-history" class="tabdiv">
			                	 	<h4>Select Test Group</h4>
			                	 	<div class="test-groups">
											                	
									</div>
			                	 	<div id="patient-test-history" style="height:auto;border:1px solid #BFB092;padding:5px;">
			                			<h2 class="test-name">TEST RESULT</h2>
										<div id="history-list" class="scrolled-tbl-div" style="overflow-y:auto;">
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
						                 <div id="printArea" style="display: none;">
                                                                    <h2>GRAPH</h2>
                                                                    <div id="legend" class="patient-test-history_legend">

                                                                    </div>
                                                                    <br/><br/>
                                                                     <div id="imgdiv"></div>
                                                                </div>
                                                                    <h2>GRAPH</h2>
                                                                    <div id="legend" class="patient-test-history_legend">

                                                                    </div>
                                                                    <div id="patient-test-history_historyGraph" style="height:300px;border:1px solid #BFB092;">

                                                                    </div>
						                <?php echo $this->Form->create(null, array('url'=>array('controller'=>'patients', 'action'=>'downloadPdf')));?>
                                                                <div class="input textarea"><textarea id="PersonBody" rows="6" cols="30" style="height:0px;background:#FFFAE4;width:0px; border: none;" name="data[Person][body]"></textarea></div>
						                <?php echo $this->Form->submit('Save',array('div'=>false,'class'=>'submit-save','style'=>'margin-left:70%;', 'name'=>'action'));?>
						                <?php echo $this->Form->submit('Print',array('div'=>false, 'id'=>'printTestHistory','style'=>'margin-left:3%;', 'name'=>'action'));?>
						                <?php echo $this->Form->end();?>
			                		</div>
			                	 </div>-->
			                	 <!-- PATIENT'S HISTORY - TEMPORARILY DISABLED -->
		                	 </div>
	                	 </div>
                	</div>
				</div>
			</div>	
            </div><!--/patient-->
            
            <div id="result" class="tabdiv" style="padding:10px 10px 0px 10px !important;">
                <div>
                	<h2 id="patientname" style="text-decoration:none;font: bold 20px 'Trebuchet MS', Arial, Helvetica, sans-serif; margin: 10px 0 0 10px;color:#F00;text-shadow: 1px 1px 1px #333;">&nbsp;</h2>
                	<div id="main-tab" class="widget-result">
			            <ul class="tabnav">
			                <li><a href="#physician-visits">PATIENT'S RESULTS</a></li>
			                <!-- <li><a href="#physician-history">HISTORY</a></li>-->
			            </ul>
			
			            <div id="patient-visits" class="tabdiv" >
			            <h4>Select Patient's Order</h4>
					      <table id="common-tbl" class="patient-visits visits_tbl">
                                            <thead>
					                            <tr>
					                                <!-- <th style="width:20%;">Laboratory</th> -->
					                                <th style="width:20%;">Released Date/Time</th>
					                                <th  style="width:15%;">Episode Number</th>
					                                <th  style="width:45%;">Test</th>
					                            </tr>
					                        </thead>		
					        </table>	            
			            	<div id="visits-list" style="overflow-y:auto;">
				            	
					                    <table id="common-tbl" class="patient-visits visits_tbl">
                                           <!-- <thead>
					                            <tr>
					                                <th style="width:20%;">Released Date</th>
					                                <th  style="width:15%;">Episode Number</th>
					                                <th  style="width:45%;">Test</th>
					                            </tr>
					                        </thead>
					                         --> 
					                        <tbody>

					                        </tbody>
					                    </table>
				                </div>
				                <!-- <div id="visits-view" style="height:auto;border:1px solid #BFB092;padding:5px;">
				                
				                </div> -->
				                <?php //echo $this->element('pop_up_print_testgroup');?>
				                <?php //echo $this->Form->submit('Save / Print',array('div'=>false, 'id'=>'printPdfResult','style'=>'margin-left:77.5%;'));?>
				                <?php echo $this->Form->end();?>
			            </div><!--/visits-->
			            
			            <!-- PHYSICIAN'S HISTORY - TEMPORARILY DISABLED -->
			            <!-- 
			            <div id="physician-history" class="tabdiv">
			                <div id="history-div">
			                	<h4>Select Test Group</h4>
			                	<?php if(!empty($testGroups)):?>
				                	<?php $group = $testGroups;?>
				                	<?php echo $this->Form->radio('group_name', $testGroups, array('legend'=>false,'label'=>false,'onclick' => 'showTestHistory(this,"test-history");'));?>
				                	<div id="test-history" style="height:auto;border:1px solid #BFB092;padding:5px;">
			                		
			                		<h2 class="test-name">TEST RESULT</h2>
									<div id="history-list" class="scrolled-tbl-div" style="overflow-y:auto;">
					                	<table id="common-tbl" style="width:100%">
					                		<thead>
					                			<tr>
					                				<th>Laboratoty</th>
					                				<th width = "400px">Date</th>
					                				<th></th>
					                			</tr>
					                		</thead>
					                		<tbody>
					                		</tbody>
					                	</table>
					               	</div>
                                        <div id="printTestArea" style="display: none;">
                                            <h2>GRAPH</h2>
                                            <div id="legend" class="test-history_legend">

                                            </div>
                                            <br/><br/>
                                             <div id="imgdivs"></div>
                                        </div>
                                       <h2>GRAPH</h2>
						                <div id="legend" class="test-history_legend">
							            
							        </div>
						                <br/><br/>
						                <div id="test-history_historyGraph" style="height:300px;border:1px solid #BFB092;">
						                	
						                </div>
					               
					                 <?php echo $this->Form->create(null, array('url'=>array('controller'=>'patients', 'action'=>'downloadPdf')));?>
                                                        <div class="input textarea"><textarea id="PersonTextBody" rows="6" cols="30" style="height:0px;width:0px; background:#FFFAE4;border: none;" name="data[Person][text_body]"></textarea></div>
                                                        <?php echo $this->Form->submit('Save',array('div'=>false,'class'=>'submit_save','style'=>'margin-left:70%;', 'name'=>'action'));?>
                                                        <?php echo $this->Form->submit('Print',array('div'=>false, 'id'=>'printHistory','style'=>'margin-left:3%;', 'name'=>'action'));?>
                                                        <?php echo $this->Form->end();?>
			                		
			                		</div>
				                <?php else:?>
				            		You currently have no recorded test.
				            	<?php endif;?>
			                </div>
			            </div>
			            -->
			             <!-- PHYSICIAN'S HISTORY - TEMPORARILY DISABLED -->
			            <!--/history-->
			
			        </div><!--/widget-->
                </div>
            </div><!--/result-->
            
            <br/>
            <br/>
            <br/>
        </div>

        </div><!--/widget-->
         <?php //echo $this->element('sidebar');?>
 </div>
<div id="pdfFrameModal">
	<div id="pdfFrame" title="Result Viewer" style="display:none">
	<iframe  type="application/pdf" id="iframeId" width='800' height='900' style='overflow-y:hidden' src=''></iframe>
	</div>

</div>


<script>
	var laboratories = <?php echo $this->Js->object($laboratories);?>;
	jQuery(document).ready(function(){
		setTimeout("autoLogOut()", 3600000);
		jQuery(".header span b").click(function () {
			
		    jQuery('div#patient-div').slideToggle();
// 		        //execute this after slideToggle is done
// 		        //change text of header based on visibility of content div
		    	header = jQuery(this);
		        if( header.text() == "Expand"){
		        	header.text("Collapse");
		        }else{
		        	header.text("Expand");
		        }
			      

		});
		getPhysicianPatients320Days();
        var windowwidth = jQuery(window).width();
    	var windowheight = jQuery(window).height();
    	jQuery('#patientlist').css({'height':windowheight-(windowheight*0.70)});
    	jQuery('#visits-list').css({'height':windowheight-(windowheight*0.70)});
        jQuery('#pdfFrame').css({'width':'800','height':'1000'});
		jQuery('table#common-tbl.patient-visits.visits_tbl tr').live('click', function(){
			jQuery(this).parent().children('tr').removeAttr('id');
			jQuery(this).attr('id','selected');
			var labid=jQuery(this).children('td:first').attr('id');
			var specimenid=jQuery(this).children('td:first').attr('class');
			var mrno=jQuery('table.patient_search.visits_tbl tr#selected.order').children('td:first').text();
// 			alert(mrno);
			var iframe = document.getElementById("iframeId");
// 			 var html = "";
// 			iframe.contentWindow.document.open();
// 			iframe.contentWindow.document.write(html); 
// 			iframe.contentWindow.document.close();
			jQuery('#iframeId').attr('src', jQuery('#iframeId').attr('src'));
			jQuery('#pdfFrameModal #pdfFrame iframe').removeAttr('src');
			if(labid){
// 				jQuery('#pdfFrameModal #pdfFrame iframe').attr('src','/patients/viewPdfMro/'+labid+''+specimenid);
// 				jQuery('#pdfFrame iframe#iframeId').attr('src','/physicians/viewPdfMro/'+labid+''+specimenid);
			}else{
// 				jQuery('#pdfFrameModal #pdfFrame iframe').attr('src','/patients/viewPdf/'+specimenid+" "+mrno);
// 				jQuery('#pdfFrame iframe#iframeId').attr('src','/physicians/viewPdf/'+specimenid+" "+mrno);
// 				jQuery('#pdfFrameModal #pdfFrame iframe').attr('src','/patients/viewPdf/'+specimenid);
				jQuery('#pdfFrame iframe#iframeId').attr('src','/physicians/viewPdf/'+specimenid);
				
				//jQuery.post('/physicians/viewPdf/'+specimenid, { specimenid: specimenid }, function(retData) {
// 					alert(JSON.stringify(retData))
//  				  $("#pdfFrame").append("<iframe src='data:application/pdf;base64," + retData + "' ></iframe>");
// 					jQuery('#pdfFrame iframe#iframeId').attr('src',retData);
// 					jQuery('#pdfFrame iframe#iframeId').attr('src','/physicians/viewPdf/'+specimenid);
				//});

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

		jQuery('div#physician-visits table#common-tbl.visits_tbl tr').live('click', function(){
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
// 			jQuery('#pdfFrameModal #pdfFrame iframe').attr('src','/physicians/viewPdf/'+labid+''+specimenid);
// 			jQuery('#pdfFrame iframe#iframeId').attr('src','/physicians/viewPdf/'+labid+''+specimenid);
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
        
   
		jQuery('.current-crumb').append(' MEMBER ACCOUNT');


		jQuery('#selected').css({'background':'url(../../img/btn-bg.jpg) repeat'});
		divId = jQuery('.ui-tabs-selected > a').attr('href');
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
		jQuery('table.patient_search.visits_tbl tr.order').live('click',function(){
// 			alert(jQuery(this).find('td:nth-child(2)').text());
			jQuery('h2#patientname').text(jQuery(this).find('td:nth-child(2)').text());
		});
		jQuery('.search-patient-btn').click(function(){
			showLoadingMask(" Retrieving Data, please wait.. ");
			clearLabel();
			serializedFormData = jQuery('.search-patient-frm').serialize();
			setLabel();
			jQuery.ajax({
				
				url: '<?php echo $this->Html->url(array('controller'=>'Physicians','action'=>'getPhysicianPatients','physician'=>false));?>',
				data:serializedFormData,
				type: 'POST',
				dataType : 'json',
				error: function(){
			        alert('Connection timeout. Please try again later.');
			        hideLoadingMask();
			    },
				success:function(data){
// 					alert(JSON.stringify(data));
					hideLoadingMask();
					jQuery('.patient_search').show();
					jQuery('.patient_search tbody').empty();
					obj = data.Patient;
// 					alert(JSON.stringify(obj));
					if(obj['Person']  != undefined ){
						jQuery('div#result').show();
// 						alert(JSON.stringify(data.Patient));
						tr = '';
						name = '';
							jQuery.each(data.Patient,function(x,y){
	// 							alert(JSON.stringify(y));
								if(y['lastname']){name+=y['lastname']+', ';}
								if(y['firstname']){name+=y['firstname']+' ';}
								if(y['middlename']){name+=y['middlename'];}
								tr += '<tr  class="order" onclick="showPatientProfile('+y['internal_id']+')" style="cursor: pointer;"><td style="width:30%;">'+y['mrno']+'</td><td style="width:40%;">'+ name +'</td><td style="width:30%;">'+ y['birthdate'] +'</td></tr>';
							});
						jQuery('.patient_search tbody').append(tr);
						showPatientProfile(data.Patient['Person']['internal_id']);

	 					jQuery('table#common-tbl.patient_search.visits_tbl tbody tr').live().eq(0).attr('id','selected');
						
					}else{
						jQuery('div#result.tabdiv').hide();
						jQuery('.patient_search tbody').append('<tr><td colspan="3">No Patient Found.</td></tr>');
					}
				}, timeout: 30000 // sets timeout to 3 seconds
			});
			return false;
		});

		jQuery('.patient-list-filter-btn').click(function(){
			//showLoadingMask(" Retrieving Data, please wait.. ");

			serializedFormData = jQuery('.patient-list-filter').serialize();
			jQuery.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'Physicians','action'=>'getPhysicianPatients','physician'=>false));?>',
				data:serializedFormData,
				type: 'POST',
				dataType : 'json',
				error: function(){
			        alert('Connection timeout. Please try again later.');
			        hideLoadingMask();
			    },
				success:function(data){
					hideLoadingMask();
					jQuery('.patient-list-tbl tbody').empty();
					len = data.Patient.length;
					if(len){
						tr = '';
						jQuery.each(data.Patient,function(x,y){
							tr += '<tr  class="order"><td>'+y['Person']['lastname']+', '+y['Person']['firstname']+' '+y['Person']['middlename']+'</td><td>'+data.Patient[x]['Patient']['registered_date']+'</td><td>'+data.Address.Province[y['Address']['province_state_id']]+'</td><td>'+data.Address.TownCity[y['Address']['town_city_id']]+'</td><td>'+data.Patient[x]['Person']['sex']+'</td><td>'+data.Patient[x]['Person']['birthdate']+'</td><td>'+data.Patient[x]['Person']['age']+'</td></tr>';
						});
						jQuery('.patient-list-tbl tbody').append(tr);

					}else{
						jQuery('.patient-list-tbl tbody').append('<tr><td colspan="7">No Patient Found.</td></tr>');
					}
				}, timeout:300000 // sets timeout to 3 seconds
			});
			return false;
		});
		function IsEmail(email) {
		  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		  return regex.test(email);
		}
		function strLength(pass){
		  var len = pass.length;
		  return len;
		}

	});

	function autoLogOut(){
		var isLoggedIn = 0;
		$.ajax({
		    type: "POST",
		    url: '<?php echo $this->Html->url(array('controller'=>'physicians','action'=>'checklogin','physician'=>false));?>',
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
	function getPhysicianPatients320Days(){
		jQuery('div#result').show();
		showLoadingMask(" Retrieving Data, please wait.. ");
		jQuery.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>'physicians','action'=>'getPhysicianPatients320Days','physician'=>false));?>',
			type: 'POST',
			dataType : 'json',
			asynch:false,
			error: function(){
		        alert('Connection timeout. Please try again later.');
		        hideLoadingMask();
		    },
			success:function(data){
				hideLoadingMask();
				jQuery('.patient-list-tbl tbody').empty();
				obj = data.Patient;
				if(obj){
//					alert(JSON.stringify(obj));
					tr = '';
					name = '';
					jQuery.each(data.Patient.PaperAll,function(x,y){
	//						alert(JSON.stringify(y));
						if(y['Person']['lastname']){name+=y['Person']['lastname']+', ';}
						if(y['Person']['firstname']){name+=y['Person']['firstname']+' ';}
						if(y['Person']['middlename']){name+=y['Person']['middlename'];}
						tr += '<tr class="order" onclick="showPatientProfile('+y['Person']['internal_id']+')" style="cursor: pointer;"><td  style="width:30%;">'+y['Person']['mrno']+'</td><td  style="width:40%;">'+ name +'</td><td  style="width:30%;">'+ y['Person']['birthdate'] +'</td></tr>';
// 						tr += '<tr onclick="showPatientProfile('+y['Person']['internal_id']+')" style="cursor: pointer;"><td>'+y['Person']['internal_id']+'</td><td>'+ name +'</td><td>'+ y['Person']['birthdate'] +'</td><td>'+laboratories[y['Person']['laboratory_id']]+'</td></tr>';
						name = '';
					});
				
					jQuery('.patient_search tbody').append(tr);
	
	
					jQuery('table#common-tbl.patient_search.visits_tbl tbody tr').live().eq(0).attr('id','selected');
	
					
				}else{
					jQuery('.patient_search tbody').append('<tr><td colspan="3">No Patient Found.</td></tr>');
				}
			}, timeout: 30000 // sets timeout to 3 seconds
		});
	}
	function showPatientProfile(personId){
		showLoadingMask(" Retrieving Data, please wait.. ");
		jQuery.ajax({
			url: '<?php echo $this->Html->url(array('controller'=>'patients','action'=>'getPatientOrder','physician'=>false));?>',
			data:{'Person':{'id':personId}},
			type: 'POST',
			dataType : 'json',
			asynch:false,
			error: function(){
		        alert('Connection timeout. Please try again later.');
		        hideLoadingMask();
		    },
			success:function(data){
				hideLoadingMask();
				if( data['testOrders'] != undefined ){

					    jQuery('div#patient-div').slideToggle();
				        if(jQuery(".header span b").text() == "Expand"){
				        	jQuery(".header span b").text("Collapse");
				        }else{
				        	jQuery(".header span b").text("Expand");
				        }

					jQuery('.patient-visits tbody tr').empty();
					trs = '';
					jQuery.each(data['testOrders'],function(a,b){
// 						alert(JSON.stringify(a));
							trs += '<tr style="cursor:pointer;" class="testOrderDetailClass" style="cursor:pointer;">';
							//trs += '<td class="'+b['LaboratoryPatientOrder']['specimen_id']+'">';
							//if(b['Laboratory']['id'] != undefined)
								//trs += laboratories[b['Laboratory']['id']];
							//trs += '</td>';
						
							trs += '<td style="width:20%" class="'+b['LaboratoryPatientOrder']['specimen_id']+'">'+b['LaboratoryTestOrder']['posted_datetime']+'</td>';
							trs += '<td style="width:15%;text-align:center;" >'+b['LaboratoryPatientOrder']['specimen_id']+'</td>';
							trs += '<td style="width:45%" class="'+b['LaboratoryPatientOrder']['specimen_id']+'">'+b['LaboratoryPatientOrder']['description']+'</td>';

// 							trs += '<tr style="cursor:pointer;" class="testOrderDetailClass" style="cursor:pointer;">';
// 							trs += '<td id="'+b['LaboratoryPatientOrder']['laboratory_id']+'" class="'+b['LaboratoryPatientOrder']['specimen_id']+'">';
// 							if(data['laboratories'][b['Laboratory']['company_branch_id']] != undefined)
// 								trs += data['laboratories'][b['Laboratory']['company_branch_id']]['CompanyBranch']['name'];
// 							trs += '</td>';
// 							trs += '<td>'+data['testgroups'][b['LaboratoryTestResult']['test_group_id']]+'</td>';
// 							trs += '<td>'+b['LaboratoryPatientOrder']['specimen_id']+'</td>';
// 							trs += '<td>'+b['LaboratoryTestOrder']['posted_datetime']+'</td>';
	
							trs += '</tr>';
						
					});
					jQuery('#visits-list table.visits_tbl tbody').append(trs);
					
// 					showTestOrderDetail(data['testOrders'][0]['LaboratoryTestOrder']['id'],'patient-visit-view');
						
				}
			}, timeout: 30000 // sets timeout to 3 seconds
		});
	}		


</script>
 	<style>
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
	  /*padding: 3px 0;*/
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