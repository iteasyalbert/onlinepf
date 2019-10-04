<!-- CUSTOMIZED STYLE -->
<?php echo $this->Html->css('dashboard.css')?>
<?php echo $this->Session->flash();?>

  <!-- TAB PANE MENU -->
  <ul class="nav nav-tabs  md-tabs indigo bg-blue" id="myTabJust" role="tablist"
    >
      <li class="nav-item">
        <a class="nav-link active" id="home-tab-just" data-toggle="tab" href="#home-just" role="tab" aria-controls="home-just"
        aria-selected="true"><span class="glyphicon glyphicon-bed"></span>  Admitted</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab-just" data-toggle="tab" href="#profile-just" role="tab" aria-controls="profile-just"
        aria-selected="false"><span class="glyphicon glyphicon-home"></span> MGH</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="contact-tab-just" data-toggle="tab" href="#contact-just" role="tab" aria-controls="contact-just"
        aria-selected="false"><span class="glyphicon glyphicon-ok"></span> POSTED</a>
      </li>
  </ul>

<!--TAB PANE-->
<div class="tab-content card pt-5" id="myTabContentJust">
  <!-- TAB PANE CONTENT ADMITTED-->
  <div class="tab-pane fade in active" id="home-just" role="tabpanel" aria-labelledby="home-tab-just">
      <div class="container" style="padding-top: 0;"></div>
          <div class="divtable accordion-xs">
            <div class="tr headings" style="color: white;background-color: steelblue;">
              <div class="th name">NAME</div>
              <div class="th reg">REG#</div>
              <div class="th patid">PATIENT ID</div>
              <div class="th gender">GENDER</div>
              <div class="th bdate">BIRTHDATE</div>
              <div class="th pf">PF AMOUNT</div>
              <div class="th action">ACTION</div>

            </div>
                <?php foreach ($data['data'] as $px):?>
                  <?php if($px['patient_visit_status']=="A" & $px['status']!="1"){ ?>
                  <div class="tr">
                    <div class="td name accordion-xs-toggle" align="left"><?php echo strtoupper($px['px_last_name'].', '.$px['px_first_name'].' '.$px['px_middle_name']);?></div>
                    <div class="accordion-xs-collapse">
                    <div class="inner">    
                      <div class="td reg" align="left"><?php echo $px['visit_number'];?></div>
                      <div class="td patid" align="left"><?php echo $px['patient_id'];?></div>
                      <div class="td gender" align="left"><?php echo $px['px_sex'];?></div>
                      <div class="td bdate" align="left"><?php echo date('Y-m-d', strtotime($px['px_birthdate']));?></div>
                      <div class="td pf" align="left"><?php echo $px['pf_amount'];?></div>
                      <div class="td action" align="left"><a href="/physicians/view_transaction/<?php echo $px['visit_number']?>/<?php echo $px['patient_id']?>/<?php echo $px['practitioner_id']?>" >EDIT<span class="glyphicon glyphicon-edit"></span></a></div>
                    </div>
                    </div>
                  </div>
                <?php } ?>
                <?php endforeach;?>
          </div>
  </div>  
  <!-- TAB PANE CONTENT MGH-->
  <div class="tab-pane fade" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-just">
      <div class="container" style="padding-top: 0;"></div>
          <div class="divtable accordion-xs">
            <div class="tr headings" style="color: white;background-color: steelblue;">
              <div class="th name">NAME</div>
              <div class="th reg">REG#</div>
              <div class="th patid">PATIENT ID</div>
              <div class="th gender">GENDER</div>
              <div class="th bdate">BIRTHDATE</div>
              <div class="th pf">PF AMOUNT</div>
              <div class="th action">ACTION</div>

            </div>

                <?php foreach ($data['data'] as $px):?>
                    <?php if($px['patient_visit_status']=="F" & $px['status']!="1"){ ?>
                  <div class="tr">
                    <div class="td name accordion-xs-toggle" align="left"><?php echo strtoupper($px['px_last_name'].', '.$px['px_first_name'].' '.$px['px_middle_name']);?></div>
                    <div class="accordion-xs-collapse">
                    <div class="inner">    
                      <div class="td reg" align="left"><?php echo $px['visit_number'];?></div>
                      <div class="td patid" align="left"><?php echo $px['patient_id'];?></div>
                      <div class="td gender" align="left"><?php echo $px['px_sex'];?></div>
                      <div class="td bdate" align="left"><?php echo date('Y-m-d', strtotime($px['px_birthdate']));?></div>
                      <div class="td pf" align="left"><?php echo $px['pf_amount'];?></div>
                      <div class="td action" align="left"><a href="/physicians/view_transaction/<?php echo $px['visit_number']?>/<?php echo $px['patient_id']?>/<?php echo $px['practitioner_id']?>" >EDIT<span class="glyphicon glyphicon-edit"></span></a></div>
                    </div>
                    </div>
                  </div>
                    <?php } ?> 
                <?php endforeach;?>
          </div>
  </div>
<!-- TAB PANE CONTENT POSTED-->  
  <div class="tab-pane fade" id="contact-just" role="tabpanel" aria-labelledby="contact-tab-just">
      <div class="container" style="padding-top: 0;"></div>
          <div class="divtable accordion-xs">
            <div class="tr headings" style="color: white;background-color: steelblue;">
              <div class="th name">NAME</div>
              <div class="th reg">REG#</div>
              <div class="th patid">PATIENT ID</div>
              <div class="th gender">GENDER</div>
              <div class="th bdate">BIRTHDATE</div>
            
            </div>

                <?php foreach ($data['data'] as $px):?>
                   <?php if($px['status']=="1"){ ?>
                  <div class="tr">
                    <div class="td name accordion-xs-toggle" align="left"><?php echo strtoupper ($px['px_last_name'].', '.$px['px_first_name'].' '.$px['px_middle_name']);?></div>
                    <div class="accordion-xs-collapse">
                    <div class="inner">    
                      <div class="td reg" align="left"><?php echo $px['visit_number'];?></div>
                      <div class="td patid" align="left"><?php echo $px['patient_id'];?></div>
                      <div class="td gender" align="left"><?php echo $px['px_sex'];?></div>
                      <div class="td bdate" align="left"><?php echo date('Y-m-d', strtotime($px['px_birthdate']));?></div>
                      <div class="td pf" align="left"><?php echo $px['pf_amount'];?></div>
                    
                    </div>
                    </div>
                  </div>
                    <?php } ?>
                <?php endforeach;?>
          </div>
  </div>
</div>
<?php echo $this->element('change_password');?>
<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker().datepicker("setDate", new Date());
  });
$(function() {    
  var isXS = false,
      $accordionXSCollapse = $('.accordion-xs-collapse');

  // Window resize event (debounced)
  var timer;
  $(window).resize(function () {
      if (timer) { clearTimeout(timer); }
      timer = setTimeout(function () {
          isXS = Modernizr.mq('only screen and (max-width: 767px)');
          
          // Add/remove collapse class as needed
          if (isXS) {
              $accordionXSCollapse.addClass('collapse');               
          } else {
              $accordionXSCollapse.removeClass('collapse');
          }
      }, 100);
  }).trigger('resize'); //trigger window resize on pageload    
  
  // Initialise the Bootstrap Collapse
  $accordionXSCollapse.each(function () {
      $(this).collapse({ toggle: false });
  });      
  $(document).on('click', '.accordion-xs-toggle', function (e) {
      e.preventDefault();
      
      var $thisToggle = $(this),
          $targetRow = $thisToggle.parent('.tr'),
          $targetCollapse = $targetRow.find('.accordion-xs-collapse');            
    
      if (isXS && $targetCollapse.length) { 
          var $siblingRow = $targetRow.siblings('.tr'),
              $siblingToggle = $siblingRow.find('.accordion-xs-toggle'),
              $siblingCollapse = $siblingRow.find('.accordion-xs-collapse');
          
          $targetCollapse.collapse('toggle'); //toggle this collapse
          $siblingCollapse.collapse('hide'); //close siblings
          $thisToggle.toggleClass('collapsed'); //class used for icon marker
          $siblingToggle.removeClass('collapsed'); //remove sibling marker class
      }
  });
}); 

</script>