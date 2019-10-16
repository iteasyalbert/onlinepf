<style type="text/css">
  body {
    background-image: url('/assets/images/bg.png');
    background-color: transparent;
  }
  .container {
    background-color: #fff;
  }
  .blabel {
    font-weight: bold;
  }
</style>
<script src="/js/providence/auto_comma_text.js"></script>
<?php //debug($data);?>
<div class="lis-container" style="padding-top: 0;">
    <div class="lis-center-container">
        <div class="panel panel-primary">
          <div class="panel-heading">Patient Information</div>
          <div class="panel-body">
            <div class="table-responsive">   
              <table class="table">
                <tbody>
                  <tr>
                    <td class="blabel">Patient ID</td>
                    <td><?php echo $data['PatientVisit']['patient_id'];?></td>
                    <td class="blabel">Admission No.</td>
                    <td><?php echo $data['PatientVisit']['visit_number'];?></td>
                  </tr>
                  <tr>
                    <td  class="blabel">Name </td>
                    <td style="font-weight: bold; text-transform: uppercase;"><?php echo $data['PatientVisit']['px_last_name'].', '.$data['PatientVisit']['px_first_name']. ' '.$data['PatientVisit']['px_middle_name'];?></td>
                    <td class="blabel">Age/Gender </td>
                    <td>
                      <?php 
                        $birthdate = date('Y-m-d', strtotime($data['PatientVisit']['px_birthdate']));
                        $date = new DateTime($birthdate);
                         $now = new DateTime();
                         $interval = $now->diff($date);
                         echo $interval->y;
                      ?> 
                      / 
                      <?php echo $data['PatientVisit']['px_sex'];?>
                    </td>
                  </tr>
                  <tr>
                    <td  class="blabel">Date of admission</td>
                    <td><?php echo $admission_date = date('Y-m-d H:i:s', strtotime($data['PatientVisit']['admission_datetime']));?></td>
                    <td class="blabel">No. of Days Admitted</td>
                    <td>
                      <?php 
                        $now = time();
                        $mgh_datetime = strtotime($data['PatientVisit']['mgh_datetime']);
                        $admission_date = strtotime($admission_date);
                        $datediff = ($mgh_datetime?$mgh_datetime:$now) - $admission_date;

                        echo round($datediff / (60 * 60 * 24)).' Day(s)';
                      ?>
                    </td>
                  </tr>
                 
                      <tr>
                        <td  class="blabel">Date of Dicharge Order</td>
                        <td>
                          <?php if($data['PatientVisit']['mgh_datetime']):?>
                            <?php echo ($data['PatientVisit']['mgh_datetime']?date('Y-m-d H:i:s', strtotime($data['PatientVisit']['mgh_datetime'])):"");?>
                          <?php endif;?>
                            
                        </td>
                        <td class="blabel">Room & Bed:</td>
                        <td>
                          <?php echo $data['PatientVisit']['bed_room'];?>
                        </td>
                      </tr>
                    
                  <tr>
                    <td class="blabel" >Chief Complaint</td>
                    <td colspan="3"><?php echo $data['PatientVisit']['chief_complaint'];?></td>
                  </tr>
                  <tr>
                    <td class="blabel" >Final Diagnosis</td>
                    <td colspan="3"><?php echo $data['PatientVisit']['icd10'].' - '.$data['PatientVisit']['final_diagnosis'];?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="panel panel-primary">
          <div class="panel-heading">Professional Fee</div>
          <div class="panel-body">
            <div class="alert alert-info hidden" id="pf_timer">
              
            </div>
            <form id="professionalFee" action="/physicians/set_professional_fee" method="post">
              <input type="hidden" name="data[PatientVisit][id]" value="<?php echo $data['PatientVisit']['id'];?>">
              <input type="hidden" name="data[PatientCareProvider][id]" value="<?php echo $data['PatientVisit']['pcp_id'];?>">
              <input type="hidden" name="data[PatientCareProvider][expiration_datetime]" value="<?php echo $data['PatientVisit']['expiration_datetime'];?>">
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td class="blabel">Hospitalization Plan</td>
                      <td> <?php echo $data['PatientVisit']['hospitalization_plan'];?></td>
                      <td class="blabel">PHIC Eligible?</td>
                      <td><?php echo $data['PatientVisit']['membership_id'];?></td>
                    </tr>
                    <td class="blabel">HMO</td>
                      <td> 
                        <?php
                          $hmo = '';
                          foreach ($data['PatientVisitHmo'] as $hmo_key => $hmo_value)
                            $hmo .= ' | '.$hmo_value['name'];
                          echo $hmo;
                        ?>
                      </td>
                      <td class="blabel">Medical Package(s)</td>
                      <td> 
                        <?php
                          $medical_packages = '';
                          foreach ($data['PatientVisitMedicalPackages'] as $mp_key => $mp_value)
                            $medical_packages .= ' | '.$mp_value['name'];
                          echo $medical_packages;
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="blabel">Consultant Role Type</td>
                      <td> <?php echo $data['PatientVisit']['consultant_type'];?></td>
                      <td class="blabel"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td class="blabel"> PF Amount :</td>
                      <td colspan="3">
                        <div class="form-group">
                          
                          <input type="text" name="data[PatientCareProvider][pf_amount]" class="form-control" id="pf_amount" value="<?php echo $data['PatientVisit']['pf_amount'];?>">
                        </div>
                      </td>
                    </tr>
                    <!-- <tr>
                      <td class="blabel">PHIC Amount :</td>
                      <td colspan="3">
                        <div class="form-group">
                          
                          <input type="text" class="form-control" value="<?php echo $data['PatientVisit']['phic_amount'];?>" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="blabel">Discount :</td>
                      <td colspan="3">
                        <div class="form-group">
                          
                          <input type="text" class="form-control" value="<?php echo $data['PatientVisit']['discount'];?>" readonly>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="blabel">Total :</td>
                      <td colspan="3">
                        <div class="form-group">
                          
                          <input type="text" class="form-control" value="<?php echo ($data['PatientVisit']['pf_amount'] + $data['PatientVisit']['phic_amount']) - $data['PatientVisit']['discount'];?>" readonly>
                        </div>
                      </td>
                    </tr> -->
                    <tr>
                      <td  colspan="4"><button type="submit" class="btn btn-primary btn-block">Submit</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </form>
          </div>
        </div>
    </div>
</div>
<?php echo $this->element('change_password');?>
<script>
  
  jQuery( document ).ready(function() {
    jQuery('#pf_amount').commaTextbox();
    jQuery('#pf_amount').select();
    <?php 
      $enable_edit_pf = true;
      if( !is_null($data['PatientVisit']['status']))
        $enable_edit_pf = false;
    ?>
    var expiration_datetime = "<?php echo $data['PatientVisit']['expiration_datetime'];?>";
    var enable_edit_pf = "<?php echo $enable_edit_pf;?>";
    console.log('enabled edit pf: '+enable_edit_pf);
    console.log(expiration_datetime);
    if(enable_edit_pf){
      if(expiration_datetime){
        console.log(expiration_datetime);
        var x = setInterval(function() {
          var expiration_datetime = "<?php echo date("Y-m-d H:i:s",strtotime($data['PatientVisit']['expiration_datetime']));?>";
          jQuery.ajax({
            url:'/physicians/getRemainingTime/',
            dataType: 'json',
            method: 'post',
            data: {expiration_datetime},
            success:function(data){
              // console.log(data.abs);
              // console.log(data.readable);
              if (data.abs < 0) {
                clearInterval(x);
                jQuery('#professionalFee :submit').prop('disabled',true);
                jQuery('#professionalFee :input').prop('readonly','readonly');
              }else{
                jQuery("#pf_timer").removeClass('hidden').text('Remaining time to input your PF: '+data.readable);
              }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert('There was an error communicating webserver, please contact your administrator. '+errorThrown);             
            }
          });  
          
        }, 1000);
      }
    }else{
      jQuery('#professionalFee :submit').prop('disabled',true);
      jQuery('#professionalFee :input').prop('readonly','readonly');
    }
  });
</script>

