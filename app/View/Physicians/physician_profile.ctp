<?php //debug($data);?> 
<link rel='stylesheet' href='/css/loading-bar.min.css' type='text/css' media='all' />
<script type='text/javascript' src='/js/loading-bar.min.js'></script>
<script src="/js/angularjs/controllers/physicians.controller.js"></script>
<script src="/js/angularjs/services/anchor.service.js"></script>
<div class="lis-container" style="padding-top: 0;" ng-app="mro" ng-controller="physiciansCtrl" ng-init="getPatientOrders()">
    <div class="lis-center-container">
        <!-- <button class="btn btn-primary" id="toggleMessage" ng-click="toggle=!toggle" ng-init="toggle=true" ng-hide="toggle" ng-click="clearPDf()">
          
          {{toggle ? 'Hide' : 'Back to List'}}
        </button> -->
        <!-- <div>{{counter}}</div> -->
        
        <button class="btn btn-primary" id="toggleMessage" ng-init="toggle=false" ng-if="toggle" ng-click="clearPDf()">
            Back
        </button>
        
        <!-- Pdf Holder -->
        <div id="pdfHolder" class="row">
          
        </div>
        <button class="btn btn-primary btn-block" ng-if="toggle" ng-click="prevResult()">
          {{prevResultBtn ? 'Hide Previous Result' : 'Show Previous Result'}}
        </button>
        <hr>
        <!-- Patient Order List -->
        <div id="box">
          <!-- <h3>Search result by date requested</h3> -->
          
          <table class="table table-sm">
            <tbody>
                <tr>
                    <td><input type="text" class="form-control" id="firstname" ng-model="firstname" ng-keydown="$event.keyCode === 13 && getPatientOrders()" placeholder="First Name"></td>
                    <td><input type="text" class="form-control" id="lastname" ng-model="lastname" ng-keydown="$event.keyCode === 13 && getPatientOrders()" placeholder="Last Name"></td>
                    <td><input type="text" class="form-control" id="patient_id" ng-model="patient_id" ng-keydown="$event.keyCode === 13 && getPatientOrders()" placeholder="Patient ID"></td>
                    <td><input type="text" class="form-control datepicker" id="start_date" ng-model="start_date" ng-change="getPatientOrders()"></td>
                    <td><input type="text" class="form-control datepicker" id="end_date" ng-model="end_date" ng-change="getPatientOrders()"></td>
                    <td><button type="submit" class="btn btn-primary" ng-click="getPatientOrders()">Submit</button></td>
                </tr>
            </tbody>
          </table>

          <table class="table table-hover patient_orders_tbl">
            <thead>
              <tr>
                <th class="hidden-xs hidden-sm col-md-2" scope="col" ng-click="sort('specimen_id')">
                  SPECIMEN ID
                  <span class="glyphicon glyphicon-sort" ng-show="sortKey=='specimen_id'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
                </th>
                <th class="col-xs-2 col-md-4" scope="col" ng-click="sort('People.lastname')">
                  NAME
                  <span class="glyphicon glyphicon-sort" ng-show="sortKey=='People.lastname'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
                </th>
                <th class="hidden-xs hidden-sm col-md-2" scope="col" ng-click="sort('date_requested')">
                  DATE REQUESTED
                  <span class="glyphicon glyphicon-sort" ng-show="sortKey=='date_requested'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
                </th>
                <th class="col-xs-2 col-md-4" scope="col" ng-click="sort('TestOrder.examinations')">
                  EXAMINATION
                  <span class="glyphicon glyphicon-sort" ng-show="sortKey=='TestOrder.examinations'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
                </th>
              </tr>
            </thead>
            <tbody>
                <tr ng-if="patient_orders.length" ng-repeat="po in patient_orders | orderBy:sortKey:reverse" ng-click="getPdf(po.specimen_id, po.Patient.internal_id, po.TestOrder.examination_internal_ids, po.TestOrder.release_date)" data-toggle="tooltip" title="Click to view result">
                  <th class="hidden-xs hidden-sm col-md-2" scope="row">{{po.specimen_id}}</th>
                  <td class="col-xs-2 col-md-4">{{po.People.lastname}}, {{po.People.firstname}} {{po.People.middlename}}</td>
                  <td class="hidden-xs hidden-sm col-md-2">{{po.date_requested}} {{po.time_requested}}</td>
                  <td class="col-xs-2 col-md-4">{{po.TestOrder.examinations}}</td>
                </tr>
                <tr ng-if="!patient_orders.length"><td colspan="4" style="text-align: center">No record found</td></tr>
            </tbody> 
          </table>
        </div>
        <button class="btn btn-primary" id="toggleMessage" ng-init="toggle=false" ng-if="toggle" ng-click="clearPDf()">
            Back
        </button>
        <!-- Pagination -->
        <div>
          <patient-orders-pagination></patient-orders-pagination>
        </div>
    </div>
</div>

<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker().datepicker("setDate", new Date());
  });
</script>