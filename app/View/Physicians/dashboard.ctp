<!-- CUSTOMIZED STYLE -->
<?php echo $this->Html->css('dashboard.css')?>
<?php echo $this->Session->flash();?>
<style type="text/css">
  body {
    background-image: url('/assets/images/bg.png');
    background-color: transparent;
  }
  .container {
    background-color: #fff;
  }
  
</style>
<script src="/js/angularjs/controllers/physicians.controller.js"></script>
<!-- TAB PANE MENU -->
<div ng-app="mro" ng-controller="physiciansCtrl" ng-init="getPatients();getPatientVisits()">
  <!-- <div>{{filter_status}}</div> -->
  <!-- <div>{{patients}}</div> -->
  <!-- TAB PANE MENU -->
  <div class="row onloadanim">
    <div class="col-sm-6 col-xs-12">
      <div class="panel panel-info text-center">
        <div class="panel-heading">
          <h1><a href="#searchInput" class="dashboard-panel">Onqueue</a></h1>
        </div>
        <div class="panel-body">
          <span style="font-size: 40px;">{{onqueue}}</span>
        </div>
      </div>      
    </div>     
    <!-- <div class="col-sm-4 col-xs-12">
      <div class="panel panel-info text-center">
        <div class="panel-heading">
          <h1><a href="#searchInput" class="dashboard-panel">For Posting</a></h1>
        </div>
        <div class="panel-body">
            <span style="font-size: 40px;">30</span>
        </div>
      </div>      
    </div>  -->      
    <div class="col-sm-6 col-xs-12">
      <div class="panel panel-info text-center">
        <div class="panel-heading">
          <h1><a href="#searchInput" class="dashboard-panel">Completed</a></h1>
        </div>
        <div class="panel-body">
          <span style="font-size: 40px;">{{completed}}</span>
        </div>
      </div>      
    </div>    
  </div>
  <div>
    <input name="searchInput" ng-model="patient_name" type="text" id="searchInput" ng-keypress="submit($event)" placeholder="Search for names.." title="Type in a name">
  </div>
  <ul class="nav nav-tabs  md-tabs indigo bg-blue" id="myTabJust" role="tablist">
    <li ng-click="filter_status=null;getPatients()" class="nav-item active">
      <a class="nav-link active" id="onqueue-tab" data-toggle="tab" href="#onqueue" role="tab" aria-controls="onqueue" aria-selected="true"><span class="glyphicon glyphicon-bed"></span> <span class="hidden-xs">  ONQUEUE </span><!--<span class="badge badge-dark">{{patients_active.length}}</span>--></a>
    </li>
     <li ng-click="filter_status=0;getPatients()" class="nav-item">
      <a class="nav-link" id="posting-tab" data-toggle="tab" href="#posting" role="tab" aria-controls="posting" aria-selected="false"><span class="glyphicon glyphicon-refresh"></span> <span class="hidden-xs">FOR POSTING  </span><!--<span class="badge badge-dark">{{patients_posting.length}}</span>--></a>
    </li>
    <li ng-click="filter_status=1;getPatients()" class="nav-item">
      <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false"><span class="glyphicon glyphicon-check"></span> <span class="hidden-xs"> COMPLETED  </span><!--<span class="badge badge-dark">{{patients_completed.length}}</span>--></a>
    </li>
  </ul>

  <!--TAB PANE-->
  <div class="tab-content card pt-5" id="myTabContentJust">
  <!-- TAB PANE CONTENT ADMITTED-->
  <div class="tab-pane fade in active" id="onqueue" role="tabpanel" aria-labelledby="onqueue-tab">
    <h4 class="hidden-lg hidden-md hidden-sm">  ONQUEUE </h4>
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
      <div ng-if="!patients_active.length" style="text-align: center">No record found</div>
      <div class="tr" ng-repeat="px in patients_active = (patients | filter:{status: null})">
        <div class="td name accordion-xs-toggle" align="left">{{px.px_last_name}}, {{px.px_first_name}} {{px.px_middle_name}}</div>
        <div class="accordion-xs-collapse">
          <div class="inner">    
            <div class="td reg" align="left">{{px.visit_number}}</div>
            <div class="td patid" align="left">{{px.patient_id}}</div>
            <div class="td gender" align="left">{{px.px_sex}}</div>
            <div class="td bdate" align="left">{{px.px_birthdate}}</div>
            <div class="td pf" align="left">{{px.pf_amount | number:2}}</div>
            <div class="td action" align="left"><a href="/physicians/view_transaction/{{px.visit_number}}/{{px.patient_id}}/{{px.practitioner_id}}" > EDIT<span class="glyphicon glyphicon-edit"></span></a></div>
          </div>
        </div>
      </div>
    </div>
    <div ng-if="patients_active.length">
      <patients-pagination></patients-pagination>
    </div>
  </div>
  <!-- TAB PANE CONTENT POSTING-->
  <div class="tab-pane fade" id="posting" role="tabpanel" aria-labelledby="posting-tab">
    <h4 class="hidden-lg hidden-md">  FOR POSTING </h4>
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
      <div ng-if="!patients_posting.length" style="text-align: center">No record found</div>
      <div class="tr" ng-repeat="px in patients_posting = (patients | filter:{status: 0})">
        <div class="td name accordion-xs-toggle" align="left">{{px.px_last_name}}, {{px.px_first_name}} {{px.px_middle_name}}</div>
        <div class="accordion-xs-collapse">
          <div class="inner">    
            <div class="td reg" align="left">{{px.visit_number}}</div>
            <div class="td patid" align="left">{{px.patient_id}}</div>
            <div class="td gender" align="left">{{px.px_sex}}</div>
            <div class="td bdate" align="left">{{px.px_birthdate}}</div>
            <div class="td pf" align="left">{{px.pf_amount | number:2}}</div>
            <div class="td action" align="left"><a href="/physicians/view_transaction/{{px.visit_number}}/{{px.patient_id}}/{{px.practitioner_id}}" > VIEW<span class="glyphicon glyphicon-edit"></span></a></div>
          </div>
        </div>
      </div>
    </div>
    <div ng-if="patients_posting.length">
      <patients-pagination></patients-pagination>
    </div>
  </div>  
  <!-- TAB PANE CONTENT onqueue-->
  <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
    <h4 class="hidden-lg hidden-md">  POSTED </h4>
    <div class="divtable accordion-xs">
      <div class="tr headings" style="color: white;background-color: steelblue;">
        <div class="th name">NAME</div>
        <div class="th reg">REG#</div>
        <div class="th patid">PATIENT ID</div>
        <div class="th gender">GENDER</div>
        <div class="th bdate">BIRTHDATE</div>
        <div class="th pf">PF AMOUNT</div>
        <div class="th action">ACTION</div>
        <!-- <div class="th action">ACTION</div> -->
      </div>
      <div ng-if="!patients_completed.length" style="text-align: center">No record found</div>
      <div class="tr" ng-repeat="px in patients_completed = (patients | filter:{status: 1})">
        <div class="td name accordion-xs-toggle" align="left">{{px.px_last_name}}, {{px.px_first_name}} {{px.px_middle_name}}</div>
        <div class="accordion-xs-collapse">
          <div class="inner">    
            <div class="td reg" align="left">{{px.visit_number}}</div>
            <div class="td patid" align="left">{{px.patient_id}}</div>
            <div class="td gender" align="left">{{px.px_sex}}</div>
            <div class="td bdate" align="left">{{px.px_birthdate}}</div>
            <div class="td pf" align="left">{{px.pf_amount | number:2}}</div>
            <div class="td action" align="left"><a href="/physicians/view_transaction/{{px.visit_number}}/{{px.patient_id}}/{{px.practitioner_id}}" > VIEW<span class="glyphicon glyphicon-edit"></span></a></div>
          </div>
        </div>
      </div>
    </div>
    <div ng-if="patients_completed.length">
      <patients-pagination></patients-pagination>
    </div>
  </div>
  </div>
</div>

<?php echo $this->element('change_password');?>
<script type="text/javascript">
  jQuery(".dashboard-panel").click(function(){
    var tabselected=jQuery(this).text().toLowerCase();
    console.log(tabselected);
    $('#myTabJust a[href="#' + tabselected + '"]').tab('show').trigger('click');
  });
</script>
