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
        <button class="btn btn-primary" id="toggleMessage" ng-if="counter" ng-click="clearPDf()">
            Back to List
        </button>
        <!-- Pdf Holder -->
        <div id="pdfHolder" class="row">
          
        </div>
        <!-- Patient Order List -->
        <div id="box" >
          <!-- <h3>Search result by date requested</h3> -->
          
          <table class="table table-sm">
            <tbody>
                <tr>
                    <!-- <td><input type="text" class="form-control" id="firstname" ng-model="firstname" ng-keydown="$event.keyCode === 13 && getPatientOrders()" placeholder="First Name"></td>
                    <td><input type="text" class="form-control" id="lastname" ng-model="lastname" ng-keydown="$event.keyCode === 13 && getPatientOrders()" placeholder="Last Name"></td>
                    <td><input type="text" class="form-control" id="patient_id" ng-model="patient_id" ng-keydown="$event.keyCode === 13 && getPatientOrders()" placeholder="Patient ID"></td> -->
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
                <tr ng-if="patient_orders.length" ng-repeat="po in patient_orders | orderBy:sortKey:reverse" ng-click="getPdf(po.specimen_id)" data-toggle="tooltip" title="Click to view result">
                  <th class="hidden-xs hidden-sm col-md-2" scope="row">{{po.specimen_id}}</th>
                  <td class="col-xs-2 col-md-4">{{po.People.lastname}}, {{po.People.firstname}} {{po.People.middlename}}</td>
                  <td class="hidden-xs hidden-sm col-md-2">{{po.date_requested}} {{po.time_requested}}</td>
                  <td class="col-xs-2 col-md-4">{{po.TestOrder.examinations}}</td>
                </tr>
                <tr ng-if="!patient_orders.length"><td colspan="4" style="text-align: center">No record found</td></tr>
            </tbody> 
          </table>
        </div>

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
    $scope.counter = 0;
    $scope.pdfDivSize = 'col-xs-12';
    $scope.specimen_ids = [];
    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    }

    $scope.clearPDf = function(){
      $scope.specimen_ids = [];
      $scope.counter = 0;
      angular.element( document ).find('#pdfHolder').empty();
      // console.log('here');
    }
    $scope.deletePdf = function(){
      $scope.counter = 0;
      angular.element( document ).find('#pdfHolder').parent();
      console.log('here');
    }
    $scope.getPdf = function(specimen_id) {
      
      console.log($scope.specimen_ids.indexOf( specimen_id));
      console.log($scope.specimen_ids);
      if($scope.specimen_ids.indexOf(specimen_id) == -1 && $scope.specimen_ids.indexOf(specimen_id)){
        if(!$scope.counter == 0){
          angular.element( document ).find('#pdfDiv').removeClass('col-xs-12').addClass("col-xs-6");
          $scope.pdfDivSize = 'col-xs-6';
        }else
          $scope.pdfDivSize = 'col-xs-12';
          // $scope.toggle=!$scope.toggle;
          // Use this if pdf file is from test result pdf_file column
          // //Filter patient_orders by specimen id 
          // selected_tr = $filter('filter')($scope.patient_orders, {'specimen_id':specimen_id});
          // // Show each test result
          // angular.forEach(selected_tr[0].TestOrder.TestResult, function(tr_val, tr_key) {
          //   // console.log(tr_val.pdf_file);
          //   var pdfHolder = angular.element( document ).find('#pdfHolder').empty();
          //   pdfHolder.append(
          //     '<object data='+$scope.pdfUrl+' type="application/pdf" width="100%" height="800px" >'+ 
          //       '<p>It appears you dont have a PDF plugin for this browser.'+
          //        'No biggie... you can <a href="resume.pdf">click here to'+
          //       'download the PDF file.</a></p>'+  
          //     '</object>'
          //   ); 
          // });

          $scope.pdfUrl='/patients/getPdf/'+specimen_id;
          var pdfHolder = angular.element( document ).find('#pdfHolder');
          pdfHolder.append(
            '<div class="'+$scope.pdfDivSize+'" id="pdfDiv"><object data='+$scope.pdfUrl+' type="application/pdf" width="100%" height="800px" >'+ 
              '<p>It appears you dont have a PDF plugin for this browser.'+
               'No biggie... you can <a href="resume.pdf">click here to'+
              'download the PDF file.</a></p>'+  
            '</object></div>'
          ); 
          $scope.counter++;
          $scope.specimen_ids.push(specimen_id);
        }
       
    };
    $scope.getPatientOrders = function(pageNumber){

      if(pageNumber===undefined){
        pageNumber = '1';
      }

      $http({
        method : "POST",
        url : '/patients/getPatientOrders/'+pageNumber,
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

