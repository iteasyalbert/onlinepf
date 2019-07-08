<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/training.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $title_for_layout;?></title>
<!-- InstanceEndEditable -->
<link REL="ICON" HREF="../icon.ico">
<link REL="ICON" HREF="http://www.phc.gov.ph/icon.ico">

		<?php echo $this->Html->css('style.css');?>
		<?php echo $this->Html->css('default.css');?>
		<?php echo $this->Html->css('services.css');?>
		<?php echo $this->Html->css('/js/includes/jquery-ui.css');?>
		<!-- **Javascript** -->
		
		<?php echo $this->Html->script('includes/jquery-1.4.3.min.js')?>
		<?php echo $this->Html->script('includes/autoNumeric.js');?>
		<?php echo $this->Html->script('includes/jquery-ui.js');?>
		


		<!-- **Javascript** -->
		<?php echo $this->Html->script('jquery.latest.js')?>
		<?php echo $this->Html->script('jquery.jcarousel.min.js');?>
		<?php echo $this->Html->script('animatedcollapse.js');?>
		<?php echo $this->Html->script('spa.custom.js');?>
		<?php //echo $this->Html->script('smoothscroll.js');?>
		<?php echo $this->Html->script('jquery.localscroll.js');?>
		<?php echo $this->Html->script('stickyfloat.js');?>
		
		<?php echo $this->Html->script('stickyfloat.js');?>
		<?php echo $this->Html->script('jquery.cookie.js');?>
		<?php //echo $this->Html->script('plugin.scrollbar.js');?>
		<?php //echo $this->Html->script('jquery.nivo.slider.js');?>
		<?php echo $this->Html->script('jquery.skitter.js');?>
		<?php echo $this->Html->script('jquery.easing.1.3.js');?>
		<?php echo $this->Html->script('jquery.tipTip.minified.js');?>
		
		<?php
			echo $this->Html->css('jquery-ui-1.8.24.custom');
			echo $this->Html->script('jquery-ui-1.8.24.custom.min.js');
		?>
		
		
		<?php //echo $this->Html->script('jquery-ui-personalized-1.5.2.js');?>
		<?php echo $this->Html->script('jquery-ui-personalized-1.6rc6.js');?>
		<?php echo $this->Html->script('jquery.vticker.js');?>
		
		
		<?php echo $this->Html->script('sprinkle.js');?>
		<?php echo $this->Html->script('common');?>
		<?php echo $this->Html->script('physician_profiles');?>
		<?php echo $this->Html->script('jquery.vticker.js');?>

		

<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<div id="wrapper">
      <a name="top"></a>
      <div id="top">&nbsp;</div>
      <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                  <td id="left"></td>
                  <td id="middle">
                        <div id="head"></div>
                        <table id="navbar" align="center" cellpadding="0" cellspacing="0">
                        	<tr>
                              	<td class="whover"><a href="http://www.phc.gov.ph/index.php">Home</a></td>
                                    <td class="ocurrent"><a href="http://www.phc.gov.ph/services/">Our Services</a></td>
                                    <td class="yhover"><a href="http://www.phc.gov.ph/heartinfo/cardiac-catheterization.php">Heart Information</a></td>
                                    <td class="ghover"><a href="http://www.phc.gov.ph/docfind/index.php">Find a Doctor</a></td>
                                    <td class="bhover"><a href="http://www.phc.gov.ph/training/index.php">Continuing Education</a></td>
                                    <td class="phover"><a href="http://www.phc.gov.ph/patient-guide/index.php">Patient's Guide</a></td>
                              </tr>
                        </table>
                        <?php 
                        if($authorize == true):?>
                        <div style="height: 25px;">
	                        <div style="float:left;width:65%;" >
		                        <div style="margin: 0px 5px 0 5px; text-align: left; color: #F00; font: bold 16px 'Trebuchet MS', Arial, Helvetica, sans-serif; text-shadow: 1px 1px 1px #333">
	                           		 WELCOME to PHC Online Result
	                            </div>
							</div>
							<div style="float:right;width:30%;" >
								
								<span style="text-decoration:none;font: bold 14px 'Trebuchet MS', Arial, Helvetica, sans-serif; text-shadow: 1px 1px 1px #333; color: #181D13; margin: 10px 0 0 10px;">
									<?php
									$patientUser = $this->Session->read('Auth.Person');
									$physicianUser = $this->Session->read('medtrakLogin');
									if(!empty($patientUser)){
										echo strtoupper($patientUser['firstname'].' '.$patientUser['lastname']);
									}elseif (!empty($physicianUser['User.doctorId'])){
										echo strtoupper($physicianUser['User.name']);
									}
									?>
								</span>
								<a href="/Users/signout" style="text-decoration:none;font: bold 14px 'Trebuchet MS', Arial, Helvetica, sans-serif; text-shadow: 1px 1px 1px #333; color: #F00;  margin: 10px 0 0 10px;">SIGN-OUT</a>
								<?php if(!empty($patientUser)):?>
								<br/><a id="change-password" href="#" style="text-decoration:none;font: bold 12px 'Trebuchet MS', Arial, Helvetica, sans-serif; text-shadow: 1px 1px 1px #333;  margin: 10px 5px 0 10px;">CHANGE PASSWORD</a>
								<?php endif;?>
							</div>
						</div>
						<?php endif;?>
				<!-- InstanceBeginEditable name="contents" -->
                        <div id="container">
                       <?php //echo $this->Session->flash();?> 

                       <?php echo $content_for_layout ?>
                        </div>
                        <!-- InstanceEndEditable -->
                  </td>
                  <td id="right"></td>
            </tr>
      </table>
      <!-- InstanceBeginEditable name="bug" -->
      <table id="footer" cellpadding="0" cellspacing="0" border="0">
            <tr id="clearer">
            	<td class="left"></td>
                  <td class="middlelink" valign="bottom"><a href="#top">Back to top</a></td>
                  <td class="right"></td>
            </tr>
            <tr>
                  <td class="left"></td>
                  <td class="middle" valign="bottom">
                        <a href="http://www.phc.gov.ph/patient-guide/telephone-directory.php">Contact Us</a>
                        <a href="http://www.phc.gov.ph/about-phc/index.php">About Us</a>
                        <a href="http://www.phc.gov.ph/about-phc/phc-journals.php">PHC Journals</a>
                        <a href="http://www.phc.gov.ph/about-phc/privacy-policy.php" class="last">Private Policy</a>
          		</td>
                  <td class="right"></td>
            </tr>
      </table>
      <!-- InstanceEndEditable -->
      <!-- InstanceBeginEditable name="datemod" -->	
      <div id="bottom">&nbsp;</div>
      <div class="updated">
	Last modified: February 07, 2016 
    </div>
      <!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>