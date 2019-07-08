<?php //debug($data);?>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-resource.min.js"></script>  
<link rel='stylesheet' href='/css/loading-bar.min.css' type='text/css' media='all' />
 <script type='text/javascript' src='/js/loading-bar.min.js'></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<style type="text/css">
  .patient_orders_tbl tr {
      cursor: pointer;
  }
</style>
<link rel="stylesheet" type="text/css" href="/css/general.css">

<div class="lis-container" style="padding-top: 0;" ng-app="mro" ng-controller="patientsCtrl" ng-init="getPatientOrders()">
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
  // if (typeof jQuery != 'undefined') {  
  //     // jQuery is loaded => print the version
  //     alert(jQuery.fn.jquery);
  // }
  jQuery(document).ready(function(){
    jQuery( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker().datepicker("setDate", new Date());
  });
  var app = angular.module('mro', ['ngResource','angular-loading-bar'])

  app.controller('patientsCtrl', [ '$http', '$scope', '$filter', function($http, $scope, $filter){
    $scope.patient_orders = [];
    $scope.totalPages = 0;
    $scope.currentPage = 1;
    $scope.range = [];

    $scope.prevResultSID = '';
    
    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    }

    $scope.sortDesc = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = true; //if true make it false and vice versa
    }

    $scope.clearPDf = function(){
      window.location = '/';
      
      // $scope.patient_id = null;
      // $scope.specimen_ids = [];
      // $scope.counter = 0;
      // $scope.start_date = $filter('date')(new Date(), "yyyy-MM-dd");
      // angular.element( document ).find('#pdfHolder').empty();
      // $scope.toggle = !$scope.toggle;
      // console.log('here');
    }
    $scope.getPdf = function(specimen_id, pid, test_group_id, release_date) {
      // Show hidden buttons
      $scope.toggle = true;
      $scope.prevResultBtn = false;
      // Get orders of selected patient
      if(!$scope.patient_id){
        $scope.start_date = '2019-06-01';
        $scope.prevResultSID = specimen_id;
        $scope.patient_id = pid;
        $scope.test_group_id = test_group_id;
        $scope.release_date = release_date;
        $scope.getPatientOrders(1);
        var sortByExam = 'examinations';
        $scope.sortDesc(sortByExam);
      }

      // Get PDF
      $scope.pdfUrl='/patients/getPdf/'+specimen_id;
      var pdfHolder = angular.element( document ).find('#pdfHolder').empty();
      pdfHolder.append(
        '<div class="col-xs-12" id="pdfDiv"><object data='+$scope.pdfUrl+' type="application/pdf" width="100%" height="800px" >'+ 
          '<p>It appears you dont have a PDF plugin for this browser.'+
           'No biggie... you can <a href="resume.pdf">click here to'+
          'download the PDF file.</a></p>'+  
        '</object></div>'
      );
      
      // Get Prev. Result
      $http({
          method : "POST",
          url : '/physicians/getPrevResult',
          data: { patient_id: pid, specimen_id: specimen_id, test_group_id: test_group_id, release_date: release_date}
        }).then(function mySuccess(response) {
          console.log(response);
          var pdfHolder = angular.element( document ).find('#pdfHolder');
          pdfHolder.append(response.data.body);
          angular.element( document ).find('#deltacheck').hide();
        }, function myError(response) {
            alert(response.statusText);
        });
    };

    $scope.prevResult = function() {
      $scope.prevResultBtn = !$scope.prevResultBtn;
      angular.element( document ).find('#deltacheck').toggle();
      // if(!$scope.prevResultBtn)
      //   angular.element( document ).find('#pdfDiv').removeClass('col-xs-6').addClass("col-xs-12");
      // else
      //   angular.element( document ).find('#pdfDiv').removeClass('col-xs-12').addClass("col-xs-6");
    };

    $scope.getPatientOrders = function(pageNumber){

      if(pageNumber===undefined){
        pageNumber = '1';
      }

      $http({
        method : "POST",
        url : '/physicians/getPatientOrders/'+pageNumber,
        data: { start_date: $scope.start_date , end_date: $scope.end_date, first_name: $scope.firstname, last_name: $scope.lastname, patient_id: $scope.patient_id}
      }).then(function mySuccess(response) {
        // console.log(response.data.data.data);

        respo_data = response.data.data;
        if(response.data.error.status)
            alert(response.data.error.message)
        else{
          
          if(respo_data !== null){
            // Combine all test result examination
            angular.forEach(respo_data.data, function(patient_order_val, patient_order_key) {
              respo_data.data[patient_order_key].TestOrder.examinations = "";
              angular.forEach(patient_order_val.TestOrder.TestResult, function(tr_val, tr_key) {
                respo_data.data[patient_order_key].TestOrder.examinations += tr_val.TestGroup.name;
                respo_data.data[patient_order_key].TestOrder.examination_internal_ids = tr_val.TestGroup.internal_id;
              });
            });
     

            $scope.patient_orders        = respo_data.data;
            $scope.totalPages   = respo_data.last_page;
            $scope.currentPage  = respo_data.current_page;

            // Pagination Range
            var pages = [];

            for(var i=1;i<=respo_data.last_page;i++) {          
              pages.push(i);
            }

            $scope.range = pages;
          }else{
            $scope.patient_orders=[];
            $scope.range = [];
          }
        }
      }, function myError(response) {
          alert(response.statusText);
      });
    };
  }]);
</script> 
<script>
  app.directive('patientOrdersPagination', function(){  
     return{
        restrict: 'E',
        template: '<ul class="pagination">'+
          '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPatientOrders(1)">«</a></li>'+
          '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPatientOrders(currentPage-1)">‹ Prev</a></li>'+
          '<li ng-repeat="i in range" ng-class="{active : currentPage == i}">'+
              '<a href="javascript:void(0)" ng-click="getPatientOrders(i)">{{i}}</a>'+
          '</li>'+
          '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getPatientOrders(currentPage+1)">Next ›</a></li>'+
          '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getPatientOrders(totalPages)">»</a></li>'+
        '</ul>'
     };
  });
</script>

