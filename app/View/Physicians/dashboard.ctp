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
  .headings {
    cursor: pointer;
  }
</style>
<script src="/js/angularjs/controllers/physicians.controller.js"></script>
<!-- TAB PANE MENU -->

<div ng-app="mro" ng-controller="physiciansCtrl" ng-init="getPatients();">
  <!-- <div>{{filter_status}}</div> -->
  <!-- <div>{{patients}}</div> -->
  <!-- TAB PANE MENU -->
  <div class="row onloadanim">
    <div class="col-sm-6 col-xs-12">
      <div class="mobileHide">
        <div class="panel panel-info text-center">
          <div class="panel-heading" style="background-color: steelblue;">
            <h1><a href="#searchInput" class="dashboard-panel"style="text-decoration:none;color:white;">ONQUEUE</a></h1>
          </div>
          <div class="panel-body" >
            <span style="font-size: 40px;">{{onqueue}}</span>
          </div>
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
      <div class="mobileHide">
        <div class="panel panel-info text-center">
          <div class="panel-heading" style="background-color: steelblue;">
            <h1><a href="#searchInput" class="dashboard-panel" style="text-decoration:none; color:white;">COMPLETED</a></h1>
          </div>
          <div class="panel-body">
            <span style="font-size: 40px;">{{completed}}</span>
          </div>
        </div>
      </div>        
    </div>    
  </div>

      <!--MOBILE VIEW-->  
    <div class="mobileShow">
        <div class="panel-heading text-center">
          <div class="th">
            <div class="btn-group btn-group-lg">
              <button href="#searchInput" type="button" class="btn btn-warning" style="width: auto;">
               <a class="dashboard-panel"style="text-decoration:none;color:white;">ONQUEUE</a><span class="badge">{{onqueue}}</span>
                <span class="sr-only"></span>
              </button>
              <button href="#searchInput" type="button" class="btn btn-success"style="width: auto;">
                 <a  class="dashboard-panel"style="text-decoration:none;color:white;">COMPLETED</a><span class="badge">{{completed}}</span>
                <span class="sr-only"></span>
              </button>
            </div>  
          </div>
        </div>           
    </div>
    <!--END OF MOBILE VIEW-->
  <div>
    <input name="searchInput" ng-model="patient_name" type="text" id="searchInput" ng-keypress="submit($event)" placeholder="Search for names.." title="Type in a name">
  </div>
  <ul class="nav nav-tabs  md-tabs indigo bg-blue" id="myTabJust" role="tablist">
    <li ng-click="filter_status=null;getPatients()" class="nav-item active">
      <a class="nav-link active" id="onqueue-tab" data-toggle="tab" href="#onqueue" role="tab" aria-controls="onqueue" aria-selected="true"><span class="glyphicon glyphicon-bed"></span> <span class="hidden-xs">  ON QUEUE </span><!--<span class="badge badge-dark">{{patients_active.length}}</span>--></a>
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
    <h4 class="hidden-lg hidden-md hidden-sm">  ON QUEUE </h4>
    <div class="divtable accordion-xs">
      <div class="tr headings" style="color: white;background-color: steelblue;">
        <div class="th reg" ng-click="sort('visit_number')">
          ADMISSION NO. 
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='visit_number'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <div class="th patid" ng-click="sort('patient_id')">
          PATIENT ID
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='patient_id'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <div class="th name" ng-click="sort('px_last_name')">
          NAME
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='px_last_name'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <div class="th gender" ng-click="sort('px_sex')">
          GENDER
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='px_sex'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <div class="th bdate" ng-click="sort('px_birthdate')">
          AGE
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='px_birthdate'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <div class="th pf" ng-click="sort('pf_amount')" align="left">
          PF AMOUNT
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='pf_amount'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <!-- <div class="th phic" >PHIC</div>
        <div class="th disc" >DISCOUNT</div>
        <div class="th total" >TOTAL</div> -->
        <div class="th action" align="left">ACTION</div>
      </div>
      <div ng-if="!patients_active.length" style="text-align: center">No record found</div>
      <div class="tr" ng-repeat="px in patients_active = (patients | orderBy:sortKey:reverse)">
        <div class="td reg accordion-xs-toggle" align="left"><span class="hidden-lg hidden-md hidden-sm"> </span>{{px.visit_number}} <span class="hidden-lg hidden-md hidden-sm"> {{px.px_last_name}}, {{px.px_first_name}} {{px.px_middle_name}}</span></div>
        <div class="accordion-xs-collapse">
          <div class="inner">   
            <div class="td patid" align="left">{{px.patient_id}}</div>
            <div class="td name" align="left">{{px.px_last_name}}, {{px.px_first_name}} {{px.px_middle_name}}</div>
            <div class="td gender" align="left">{{px.px_sex}}</div>
            <div class="td bdate" align="left"> {{calculateAge(px.px_birthdate)}}</div>
            <div class="td pf" align="left">{{px.pf_amount | number:2}}</div>
            <!-- <div class="td phic" align="left">{{px.phic_amount | number:2}}</div>
            <div class="td disc" align="left">({{px.discount | number:2}})</div>
            <div class="td total" align="left">{{px.total | number:2}}</div> -->
            <div class="td action" align="left"><a href="/physicians/view_transaction/{{px.external_id}}/{{px.patient_id}}/{{px.practitioner_id}}" >  <span class="glyphicon glyphicon-edit"></span> EDIT</a></div>
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
        <div class="th reg" ng-click="sort('visit_number')">
          ADMISSION NO. 
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='visit_number'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <div class="th patid" ng-click="sort('patient_id')">
          PATIENT ID
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='patient_id'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <div class="th name" ng-click="sort('px_last_name')">
          NAME
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='px_last_name'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <div class="th gender" ng-click="sort('px_sex')">
          GENDER
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='px_sex'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <div class="th bdate" ng-click="sort('px_birthdate')">
          AGE
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='px_birthdate'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <div class="th pf" ng-click="sort('pf_amount')" align="left">
          PF AMOUNT
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='pf_amount'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <!-- <div class="th phic" >PHIC</div>
        <div class="th disc" >DISCOUNT</div>
        <div class="th total" >TOTAL</div> -->
        <div class="th action" align="left">ACTION</div>
      </div>
      <div ng-if="!patients_posting.length" style="text-align: center">No record found</div>
      <div class="tr" ng-repeat="px in patients_posting = (patients | orderBy:sortKey:reverse)">
        <div class="td reg accordion-xs-toggle" align="left"><span class="hidden-lg hidden-md hidden-sm"> </span>{{px.visit_number}} <span class="hidden-lg hidden-md hidden-sm"> {{px.px_last_name}}, {{px.px_first_name}} {{px.px_middle_name}}</span></div>
        <div class="accordion-xs-collapse">
          <div class="inner">   
            <div class="td patid" align="left">{{px.patient_id}}</div>
            <div class="td name" align="left">{{px.px_last_name}}, {{px.px_first_name}} {{px.px_middle_name}}</div>
            <div class="td gender" align="left">{{px.px_sex}}</div>
            <div class="td bdate" align="left"> {{calculateAge(px.px_birthdate)}}</div>
            <div class="td pf" align="left">{{px.pf_amount | number:2}}</div>
            <!-- <div class="td phic" align="left">{{px.phic_amount | number:2}}</div>
            <div class="td disc" align="left">({{px.discount | number:2}})</div>
            <div class="td total" align="left">{{px.total | number:2}}</div> -->
            <div class="td action" align="left"><a href="/physicians/view_transaction/{{px.external_id}}/{{px.patient_id}}/{{px.practitioner_id}}" >  <span class="glyphicon glyphicon-edit"></span> VIEW</a></div>
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
        <div class="th reg" ng-click="sort('visit_number')">
          ADMISSION NO. 
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='visit_number'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <div class="th patid" ng-click="sort('patient_id')">
          PATIENT ID
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='patient_id'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <div class="th name" ng-click="sort('px_last_name')">
          NAME
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='px_last_name'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <div class="th gender" ng-click="sort('px_sex')">
          GENDER
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='px_sex'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <div class="th bdate" ng-click="sort('px_birthdate')">
          AGE
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='px_birthdate'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <div class="th pf" ng-click="sort('pf_amount')" align="left">
          PF AMOUNT
          <span class="glyphicon glyphicon-sort" ng-show="sortKey=='pf_amount'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
        </div>
        <!-- <div class="th phic" >PHIC</div>
        <div class="th disc" >DISCOUNT</div>
        <div class="th total" >TOTAL</div> -->
        <div class="th action" align="left">ACTION</div>
      </div>
      <div ng-if="!patients_completed.length" style="text-align: center">No record found</div>
      <div class="tr" ng-repeat="px in patients_completed = (patients | orderBy:sortKey:reverse)">
        <div class="td reg accordion-xs-toggle" align="left"><span class="hidden-lg hidden-md hidden-sm"> </span>{{px.visit_number}} <span class="hidden-lg hidden-md hidden-sm"> {{px.px_last_name}}, {{px.px_first_name}} {{px.px_middle_name}}</span></div>
        <div class="accordion-xs-collapse">
          <div class="inner">   
            <div class="td patid" align="left">{{px.patient_id}}</div>
            <div class="td name" align="left">{{px.px_last_name}}, {{px.px_first_name}} {{px.px_middle_name}}</div>
            <div class="td gender" align="left">{{px.px_sex}}</div>
            <div class="td bdate" align="left"> {{calculateAge(px.px_birthdate)}}</div>
            <div class="td pf" align="left">{{px.pf_amount | number:2}}</div>
            <!-- <div class="td phic" align="left">{{px.phic_amount | number:2}}</div>
            <div class="td disc" align="left">({{px.discount | number:2}})</div>
            <div class="td total" align="left">{{px.total | number:2}}</div> -->
            <div class="td action" align="left"><a href="/physicians/view_transaction/{{px.external_id}}/{{px.patient_id}}/{{px.practitioner_id}}" >  <span class="glyphicon glyphicon-edit"></span> VIEW</a></div>
          </div>
        </div>
      </div>
      <!-- <div class="tr" ng-if="patients_completed.length" >
        <div class="td reg accordion-xs-toggle" align="left">GRAND TOTAL</div>
        <div class="accordion-xs-collapse">
          <div class="inner">   
            <div class="td patid" align="left"></div>
            <div class="td name" align="left"></div>
            <div class="td gender" align="left"></div>
            <div class="td bdate" align="left"></div>
            <div class="td pf" align="left">{{grand_total_pf_amount | number:2}}</div>
            <div class="td phic" align="left">{{grand_total_phic_amount | number:2}}</div>
            <div class="td disc" align="left">({{grand_total_discount | number:2}})</div>
            <div class="td total" align="left">{{grand_total_subtotal | number:2}}</div>
            <div class="td action" align="left"></div>
          </div>
        </div>
      </div> -->
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
    tabselected = jQuery(this).text().toLowerCase();
    tabselected = tabselected.replace(/\s/g, '');
    $('#myTabJust a[href="#' + tabselected + '"]').tab('show').trigger('click');
  });
</script>
