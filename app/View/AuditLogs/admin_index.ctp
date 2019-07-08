<?php //debug($data);?>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-resource.min.js"></script>  
<link rel='stylesheet' href='/css/loading-bar.min.css' type='text/css' media='all' />
 <script type='text/javascript' src='/js/loading-bar.min.js'></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<style type="text/css">
  .patient_orders_tbl th {
      cursor: pointer;
  }
</style>
<link rel="stylesheet" type="text/css" href="/css/general.css">

<div class="lis-container" style="padding-top: 0;" ng-app="mro" ng-controller="usersCtrl" ng-init="getAuditLogs()">
    <div class="lis-center-container">
        <!-- <div>{{users}}</div> -->
        <table class="table table-sm">
          <tbody>
              <tr>
                  <td><input type="text" class="form-control" id="username" ng-model="username" ng-keydown="$event.keyCode === 13 && getAuditLogs()" placeholder="Username"></td>
                  <!-- <td><input type="text" class="form-control" id="name" ng-model="name" ng-keydown="$event.keyCode === 13 && getAuditLogs()" placeholder="Name"></td>
                  <td>
                    <select class="form-control" id="role" ng-model="role" ng-change="getAuditLogs()">
                      <option value="ROLE_ADMIN">ADMIN</option>
                      <option value="ROLE_PATIENT">PATIENT</option>
                      <option value="ROLE_PHYSICIAN">PHYSICIAN</option>
                    </select>
                  </td> -->
                  <td><input type="text" class="form-control datepicker" id="start_date" ng-model="start_date" ng-change="getAuditLogs()"></td>
                  <td><input type="text" class="form-control datepicker" id="end_date" ng-model="end_date" ng-change="getAuditLogs()"></td>
                  <td><button type="submit" class="btn btn-primary" ng-click="getAuditLogs()">Submit</button></td>
              </tr>
          </tbody>
        </table>

        <table class="table table-hover patient_orders_tbl table-striped">
          <thead>
            <tr>
              <th class="col-xs-2 col-md-4" scope="col" ng-click="sort('datetime')">
                DATETIME
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='datetime'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="col-xs-2 col-md-1" scope="col" ng-click="sort('action')">
                ACTION
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='action'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="col-xs-2 col-md-4" scope="col" ng-click="sort('remarks')">
                REMARKS
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='remarks'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="col-xs-2 col-md-2" scope="col" ng-click="sort('ip_address')">
                IP ADDRESS
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='ip_address'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="hidden-xs hidden-sm col-md-1" scope="col" >
                DEVICE
              </th>
            </tr>
          </thead>
          <tbody>
              <tr ng-if="audit_logs.length" ng-repeat="audit_log in audit_logs | orderBy:sortKey:reverse" >
                <th class="col-xs-2 col-md-4" scope="row">{{audit_log.datetime}}</th>
                <td class="col-xs-2 col-md-1">{{audit_log.action}}</td>
                <td class="col-xs-2 col-md-4">{{audit_log.remarks}}</td>
                <td class="col-xs-2 col-md-2">{{audit_log.ip_address}}</td>
                <td class="hidden-xs hidden-sm col-md-1">{{audit_log.device}}</td>
              </tr>
              <tr ng-if="!audit_logs.length"><td colspan="4" style="text-align: center">No record found</td></tr>
          </tbody> 
        </table>

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

  app.controller('usersCtrl', [ '$http', '$scope', '$filter', function($http, $scope, $filter){
    $scope.users = [];
    $scope.totalPages = 0;
    $scope.currentPage = 1;
    $scope.range = [];

    $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    }

    $scope.getAuditLogs = function(pageNumber){

      if(pageNumber===undefined){
        pageNumber = '1';
      }

      $http({
        method : "POST",
        url : '/audit_logs/getAuditLogs/'+pageNumber,
        data: { username: $scope.username , start_date: $scope.start_date, end_date: $scope.end_date }
      }).then(function mySuccess(response) {
        // console.log(response.data.data.data);
        respo_data = response.data.data;
        if(response.data.error.status)
            alert(response.data.error.message)
        else{
          

          $scope.audit_logs        = respo_data.data;
          $scope.totalPages   = respo_data.last_page;
          $scope.currentPage  = respo_data.current_page;

          // Pagination Range
          var pages = [];

          for(var i=1;i<=respo_data.last_page;i++) {          
            pages.push(i);
          }

          $scope.range = pages;
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
          '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getAuditLogs(1)">«</a></li>'+
          '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getAuditLogs(currentPage-1)">‹ Prev</a></li>'+
          '<li ng-repeat="i in range" ng-class="{active : currentPage == i}">'+
              '<a href="javascript:void(0)" ng-click="getAuditLogs(i)">{{i}}</a>'+
          '</li>'+
          '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getAuditLogs(currentPage+1)">Next ›</a></li>'+
          '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getAuditLogs(totalPages)">»</a></li>'+
        '</ul>'
     };
  });
</script>

