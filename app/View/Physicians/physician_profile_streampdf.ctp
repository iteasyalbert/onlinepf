<?php $this->set('title_for_layout', 'Online Services');?>

<?php //echo $this->Html->css('/js/includes/jquery-ui.css');?>
		<!-- **Javascript** -->
		
		<?php //echo $this->Html->script('includes/jquery-1.4.3.min.js')?>
		<?php //echo $this->Html->script('includes/autoNumeric.js');?>
		<?php echo $this->Html->script('includes/jquery-ui.js');?>
		<?php //echo $this->Html->script('jquery-ui-personalized-1.6rc6.js');?>
  <?php
		echo $this->Html->css('jquery-ui-1.8.24.custom');
		echo $this->Html->script('jquery-ui-1.8.24.custom.min.js');
	?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
  <?php echo $this->Html->script('common');?>
  
<div id="flash" style="z-index: 100001;  left: 500px; position: fixed; bottom: 600px; color: black;"></div>
<div id="overlay" style="background-color: #000; opacity: 0.7; width: 100%; height: 100%; display: none;   left: 0; position: absolute; top: 0; z-index: 10000;"></div>


		
<style type="text/css">
    #ui-datepicker-div
    {
        z-index: 9999999;
    }
</style>
<br/>
<div id="content">
   <div id="page-2361" class="type-page" itemscope="" itemtype="http://schema.org/Article">
   	<h1 class="page-title" itemprop="name">Result Online</h1>
		<div id="main-tab" class="widget-result" ">
            <div id="patient" class="tabdiv" style="padding:10px 10px 0px 10px !important;">
	           <div id="patient-container" >
	            <div class="header" style="width: 100%;text-align:right;"><!-- <span><b style="text-decoration:underline;">Collapse</b>&nbsp;&nbsp;&nbsp;&nbsp;</span> --></div>
				<div id="patient-div" style="">
					<?php //debug($testgroups);?>
					<?php echo $this->Form->create('Patient',array('class'=>'search-patient-frm','onsubmit'=>'event.preventDefault();'));?>
					<?php echo $this->Form->input('labnumber',array('required'=>'required','label'=>false,'type'=>'text','div'=>false,'placeholder'=>'LabNumber','class'=>'labeled','title'=>'LabNumber','autocomplete'=>'off'));?>
					<?php echo $this->Form->input('lastname',array('required'=>'required','label'=>false,'div'=>false,'placeholder'=>'Lastname','class'=>'labeled','title'=>'Lastname','autocomplete'=>'off'));?>
					<?php echo $this->Form->input('firstname',array('required'=>'required','label'=>false,'div'=>false,'placeholder'=>'Firstname','class'=>'labeled','title'=>'Firstname','autocomplete'=>'off'));?>
					<?php echo $this->Form->submit('Search Patient',array('div'=>false,'class'=>'search-patient-btn', 'style'=>'vertical-align: middle; margin: 0 0 5px;'));?>
					<?php echo $this->Form->end();?>
					<!--
					<table id="common-tbl" class="patient_search visits_tbl" >
                		<thead>
                			<th style="width:30%;">LabNumber</th><th style="width:40%;">Name</th><th style="width:30%;">Birthdate</th>
                		</thead>
                	</table>
                	<div id="patientlist"  style="overflow-y:auto;">
	                	<table id="common-tbl" class="patient_search visits_tbl" >
	                		<tbody>
	                		</tbody>
	                	</table>
                	</div>
                	-->

				</div>
				<table style="border:0px solid black;width:100%;">
				<tr>
					<td style="width:25%;"></td>
					<td style="width:70%;"></td>
					
				</tr>
				
				<tr>
					<td style="vertical-align: top;    padding-top: 2px;">
						<!-- <div id="main-tab" class="widget-result"> -->
							<div id="patientsearch-ouput" class="tabdiv" style="border:5px solid #A8C0A8; padding: 0px; margin-top: 0px !important;">
				            	<div id="search-output">
									<table id="common-tbl" class="patient_search visits_tbl"" >
				                		<thead>
				                			<th style="width:0%;display: none;"></th><th style="width:100%;">Search Patient</th><th style="width:0%;display: none;"></th>
				                		</thead>
				                	</table>
				                	<div id="patientlist"  style="overflow-y:auto; height:350px;">
				                	<table id="common-tbl" class="patient_search visits_tbl" style="border: 0px solid white;" >
					                		<tbody>
					                		</tbody>
					                	</table>
				                	</div>
					            </div>
			            
			            	</div>
			            <!-- </div> -->
            	 	</td>
            	 	
		            <td style="vertical-align: top;">
			            <div id="result" class="tabdiv" style="border:0px white; padding:0px !important;">
			                <div>
			                	<!-- <h2 id="patientname" style="text-decoration:none;font: bold 20px 'Trebuchet MS', Arial, Helvetica, sans-serif; margin: 10px 0 0 10px;color:#F00;text-shadow: 1px 1px 1px #333;">&nbsp;</h2>
			                	 -->
			                	<div id="main-tab" class="widget-result">
						            <div id="patient-visits" class="tabdiv" style="padding: 10px 10px !important;">
						            
						              <table class="patient-visits detail" style="width:100%;">
						            	<tr id="input">
						            		 <td style="width:20%;text-align:center;"><input id="mrn" type="text" readonly="readonly" style="width:85%;font-weight:bold;"/></td>
						            		 <td style="width:60%;text-align:center;"><input id="name" type="text" readonly="readonly" style="width:95%;font-weight:bold;" /></td>
						          			 <td style="width:20%;text-align:center;"><input id="bday" type="text" readonly="readonly" style="width:85%;font-weight:bold;"/></td>
						            	</tr>
						            	<tr id="label">
						          			 <td style="font-weight: bold;font-size:9px;text-align:center;">LabNumber</td>
						          			 <td style="font-weight: bold;font-size:9px;text-align:center;">Patient Name</td>
						          			 <td style="font-weight: bold;font-size:9px;text-align:center;">Birthdate</td>
						            	</tr>
						            
						            </table>
						            <hr style="border: 1px solid #A8C0A8;">
						             <h4 style="    margin: 0px 5px 0 5px; color: #007640!important;font: bold 15px 'Trebuchet MS', Arial, Helvetica, sans-serif;text-shadow: 1px 1px 1px #333;">Patient Orders</h4>
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
						            
						
						        </div><!--/widget-->
			                </div>
			            </div><!--/result-->
		            </td>
           		</tr>
            </table>
			</div>
			
            </div><!--/patient-->
            
           
            
            <br/>
            <br/>
            <br/>
        </div>
	</div>
        </div><!--/widget-->
         <?php //echo $this->element('sidebar');?>
 </div>
<div id="pdfFrameModal">
	<div id="pdfFrame" title="Result Viewer" style="display:none">
	<iframe  type="application/pdf" id="iframeId" width='800' height='900' style='overflow-y:hidden' src=''></iframe>
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
<?php 
$ip = $_SERVER['SERVER_NAME'];
if (!filter_var($ip, FILTER_VALIDATE_IP) === false) {
	$fp = fSockOpen($ip,80,$errno,$errstr,1);
	if($fp) { $ipstatus=1; fclose($fp); } else { $ipstatus=0; }	
}else{
	$ipstatus=0;
}
?>
<script>
	var localserver = <?php echo $this->Js->object($ipstatus);?>;
	var laboratories = <?php echo $this->Js->object($laboratories);?>;
	var testgroups = <?php echo $this->Js->object($testgroups);?>;
	//alert(JSON.stringify(testgroups));
	jQuery(document).ready(function(){
		setTimeout("autoLogOut()", 3600000);
		/* jQuery(".header span b").click(function () {
			
		    jQuery('div#patient-div').slideToggle();
		    	header = jQuery(this);
		        if( header.text() == "Expand"){
		        	header.text("Collapse");
		        }else{
		        	header.text("Expand");
		        }
			      

		}); */
		//getPhysicianPatients320Days();
        var windowwidth = jQuery(window).width();
    	var windowheight = jQuery(window).height();
		var bodyheight = jQuery('html').height();
		jQuery('div#overlay').height(bodyheight);
    	jQuery('#visits-list').css({'height':windowheight-(windowheight*0.75)});
    	jQuery('#patientlist').css({'height':windowheight-(windowheight*0.75)});
    	jQuery('#patientsearch-ouput').css({'height':jQuery('#result').height()-10});
//     	jQuery('#patientsearch-ouput div#patientlist').css({'height':jQuery('#visits-list').height()+'px'});
        jQuery('#pdfFrame').css({'width':'800','height':'1000'});
		jQuery('table#common-tbl.patient-visits.visits_tbl tbody tr').live('click', function(){
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
			//jQuery('#iframeId').attr('src', jQuery('#iframeId').attr('src'));
			jQuery('#pdfFrame iframe#iframeId').removeAttr('src');
			var url = window.location.href;
			
			var pdfdata = '';
			var uri = '';
			var remsid = 0;
			if(labid){
// 				jQuery('#pdfFrameModal #pdfFrame iframe').attr('src','/patients/viewPdfMro/'+labid+''+specimenid);
// 				jQuery('#pdfFrame iframe#iframeId').attr('src','/physicians/viewPdfMro/'+labid+''+specimenid);
			}else{
				if(localserver==1){
					jQuery.ajax({
		                url: '/physicians/viewPdf/'+specimenid,
						type: 'POST',
						dataType : 'json',
						asynch:false,
						success:function(data){
		                    if(data){
		                    	remsid = specimenid;
		                    	jQuery('iframe#iframeId').height(windowheight-125);
		                    	jQuery('#pdfFrame iframe#iframeId').attr('src','http://docs.google.com/viewer?url='+url.replace("physician","")+data+'&embedded=true');
		                    }else{
		
		                    }
		                }
		            });
				}else{
					jQuery('iframe#iframeId').height(windowheight-125);
    				jQuery('#pdfFrame iframe#iframeId').attr('src','/patients/viewPdfStream/'+specimenid);
				}

			}
// 			iframe.contentWindow.location.reload();
			jQuery( "#pdfFrame" ).dialog({
			      autoOpen: false,
			      modal: true,
			      height:(windowheight-50),
// 			      width:(windowwidth-(windowwidth*.1))
// 			      height:1000,
		    	  width:835,
		    	  resizable: true,
			      close: function(event, ui){
			    	  jQuery('#pdfFrame iframe#iframeId').removeAttr('src');
			    	  jQuery.ajax({
			                url: '/physicians/removePdf/'+remsid,
							type: 'GET',
							dataType : 'json',
							asynch:false,
							success:function(data){
			                    if(data){

			                    }else{
			
			                    }
			                }
			            });
				 }
			    }).dialog("open");

			jQuery('a#change-password').click(function(){
				jQuery( "#changepassword" ).dialog({
				      autoOpen: true,
				      modal: true,
				      height:220,
				      width:430
//				      close: function(event, ui)
				    }).dialog("open");
				jQuery('.ui-widget-overlay').css({'height':windowheight});
			    
			    
			});
			jQuery('input.changePass').click(function(){
				jQuery.ajax({
	                url: "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'change_password', 'patient' => false)); ?>",
	        		data:jQuery('.changePasswordFrm').serialize(),
					type: 'POST',
					dataType : 'json',
//					asynch:false,
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
		    
		});

		jQuery('div#physician-visits table#common-tbl.visits_tbl tbody tr').live('click', function(){
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
			
			//if(jQuery('input#PatientMrno').val() == '' && (jQuery('input#PatientFirstname').val() == '' || jQuery('input#PatientLastname').val() == '')){
			//	jQuery('form#PatientPhysicianProfileForm.search-patient-frm').submit(function( event ) {
			//		alert( "submit" );
			//		event.preventDefault();
			//	});
			//}
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
					
					obj = data.Patient;
					jQuery('.patient-visits tbody').empty();
					if(obj  != undefined ){
						jQuery('.patient_search').show();
						jQuery('.patient_search tbody').empty();
						jQuery('div#result').show();
// 						alert(JSON.stringify(data.Patient));
						tr = '';
						name = '';
						var $first = true;
						//alert(JSON.stringify(obj));
							jQuery.each(obj,function(x,y){
								//alert(JSON.stringify(y));
								if(y.Person['lastname']){name+=y.Person['lastname']+', ';}
								if(y.Person['firstname']){name+=y.Person['firstname']+' ';}
								if(y.Person['middlename']){name+=y.Person['middlename'];}
								tr += '<tr  class="order" onclick="showPatientProfile('+y.Person['id']+')" style="cursor: pointer;"><td class="mrn" style="width:0%;display: none;">'+y.Person['id']+'</td><td class="name" style="width:100%;">'+ name +'</td><td class="bday" style="width:0%;display: none;">'+ y.Person['birthdate'] +'</td></tr>';
								name = '';
								if($first){
									$first = false;
									showPatientProfile(y.Person['id']);
								}
								
							});
						jQuery('.patient_search tbody').append(tr);
						//showPatientProfile(data.Patient['Person']['internal_id']);

	 					jQuery('table#common-tbl.patient_search.visits_tbl tbody tr').live().eq(0).attr('id','selected');
						
					}else{
						//jQuery('div#result.tabdiv').hide();
						alert("No Patient Found.");
						//jQuery('.patient_search').show();
						//jQuery('.patient_search tbody').empty();
						//jQuery('.patient-visits.visits_tbl tbody tr').empty();
						//jQuery('.patient-visits.detail tbody tr input').attr('value','');
						
						//jQuery('.patient_search tbody').append('<tr><td colspan="3">No Patient Found.</td></tr>');
						
						
						//getPhysicianPatients320Days();
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
					jQuery('.visits_tbl tbody').empty();
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
							//alert(JSON.stringify(y));
						if(y['Person']['lastname']){name+=y['Person']['lastname']+', ';}
						if(y['Person']['firstname']){name+=y['Person']['firstname']+' ';}
						if(y['Person']['middlename']){name+=y['Person']['middlename'];}
// 						tr += '<tr class="order" onclick="showPatientProfile('+y['Person']['internal_id']+')" style="cursor: pointer;"><td  style="width:40%;">'+ name +'</td></tr>';
						tr += '<tr class="order" onclick="showPatientProfile('+y['Person']['id']+')" style="cursor: pointer;"><td  class="mrn" style="width:0%;display: none;">'+y['Person']['mrno']+'</td><td  class="name" style="width:100%;">'+ name +'</td><td  class="bday" style="width:0%;display: none;">'+ y['Person']['birthdate'] +'</td></tr>';
// 						tr += '<tr onclick="showPatientProfile('+y['Person']['internal_id']+')" style="cursor: pointer;"><td>'+y['Person']['internal_id']+'</td><td>'+ name +'</td><td>'+ y['Person']['birthdate'] +'</td><td>'+laboratories[y['Person']['laboratory_id']]+'</td></tr>';
						name = '';
					});
				
					jQuery('.patient_search tbody').append(tr);
	
	
					jQuery('table#common-tbl.patient_search.visits_tbl tbody tr').live().eq(0).attr('id','selected').click();
	
					
				}else{
					jQuery('.patient_search tbody').append('<tr><td colspan="3">No Patient Found.</td></tr>');
				}
			}, timeout: 60000 // sets timeout to 3 seconds
		});
	}
	function showPatientProfile(personId){
	
// 		alert(personId);
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

	/* 				    jQuery('div#patient-div').slideToggle();
				        if(jQuery(".header span b").text() == "Expand"){
				        	jQuery(".header span b").text("Collapse");
				        }else{
				        	jQuery(".header span b").text("Expand");
				        } */
					var pmrn = "";
					var pname = "";
				    var pbirthdate ="";
			        pmrn = jQuery('table.patient_search.visits_tbl tr#selected.order td.mrn').text();
			        pname = jQuery('table.patient_search.visits_tbl tr#selected.order  td.name').text();
			        pbirthdate = jQuery('table.patient_search.visits_tbl tr#selected.order  td.bday').text();
// 			        alert(pmrn + " " +pname + " " + pbirthdate);
					jQuery('div#result div#main-tab div#patient-visits table.patient-visits.detail tr#input input#mrn').attr('value',pmrn);
					jQuery('div#result div#main-tab div#patient-visits table.patient-visits.detail tr#input input#name').attr('value',pname);
					jQuery('div#result div#main-tab div#patient-visits table.patient-visits.detail tr#input input#bday').attr('value',pbirthdate);
					
					jQuery('.patient-visits.visits_tbl tbody tr').empty();
					trs = '';
					jQuery('#visits-list table.visits_tbl tbody').empty();
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
			}, timeout: 60000 // sets timeout to 3 seconds
		});
	}		


</script>
 	</script>
 	<style>     
/*	::-webkit-scrollbar {
    width: 0px;  /* remove scrollbar space */
    background: transparent;  /* optional: just make scrollbar invisible */
	}*/
	/* optional: show position indicator in red */
	::-webkit-scrollbar-thumb {
		
	}
	
   /*h1, h2, h3, h4{ font: bold 15px "Trebuchet MS", Arial, Helvetica, sans-serif;}*/
                                    
	.ui-dialog .ui-dialog-titlebar {
	    background:#ccc;
	}
	.visits_tbl {
		width:100%;
	    border-left: 1px solid #A8C0A8;
	    border-right: 1px solid #A8C0A8;
		border-bottom: 1px solid #A8C0A8;
	}
	.visits_tbl tr td{
		 color: #293807;
	}
	.visits_tbl tr:nth-child(2n):hover td, .visits_tbl tbody tr:hover td {
	   background: #82a45b;
	   color: #000;
	}
	#selected td{
	   background: #82a45b;
	   color: #000;
	   /*padding: 3px 0;*/
	}
	#common-tbl th {
    	/*background: url(../../img/heartcenter/sidenav.png) repeat;*/
	    font: bold 15px "Trebuchet MS", Arial, Helvetica, sans-serif;
	    background: #d7d7d7;
	    border: 1px solid #71a115;
	    text-align: center;
	    padding: 3px 0;
		color:#293807;
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