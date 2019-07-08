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

<div class="lis-container" style="padding-top: 0;" ng-app="mro" ng-controller="usersCtrl" ng-init="getUsers()">
    <div class="lis-center-container">
        <!-- <div>{{users}}</div> -->
        <table class="table table-sm">
          <tbody>
              <tr>
                  <td><input type="text" class="form-control" id="username" ng-model="username" ng-keydown="$event.keyCode === 13 && getUsers()" placeholder="Username"></td>
                  <td><input type="text" class="form-control" id="name" ng-model="name" ng-keydown="$event.keyCode === 13 && getUsers()" placeholder="Name"></td>
                  <td>
                    <select class="form-control" id="role" ng-model="role" ng-change="getUsers()">
                      <option value="ROLE_ADMIN">ADMIN</option>
                      <option value="ROLE_PATIENT">PATIENT</option>
                      <option value="ROLE_PHYSICIAN">PHYSICIAN</option>
                    </select>
                  </td>
                  <!-- <td><input type="text" class="form-control datepicker" id="start_date" ng-model="start_date" ng-change="getUsers()"></td>
                  <td><input type="text" class="form-control datepicker" id="end_date" ng-model="end_date" ng-change="getUsers()"></td> -->
                  <td><button type="submit" class="btn btn-primary" ng-click="getUsers()">Submit</button></td>
              </tr>
          </tbody>
        </table>

        <table class="table table-hover patient_orders_tbl table-striped">
          <thead>
            <tr>
              <th class="hidden-xs hidden-sm col-md-2" scope="col" ng-click="sort('username')">
                USERNAME
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='username'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="col-xs-2 col-md-4" scope="col" ng-click="sort('name')">
                NAME
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='name'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="hidden-xs hidden-sm col-md-2" scope="col" ng-click="sort('created_at')">
                DATE CREATED
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='created_at'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="col-xs-2 col-md-4" scope="col" ng-click="sort('role')">
                ROLE
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='role'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="col-xs-2 col-md-4" scope="col" >
                ACTION
              </th>
            </tr>
          </thead>
          <tbody>
              <tr ng-if="users.length" ng-repeat="user in users | orderBy:sortKey:reverse" >
                <th class="hidden-xs hidden-sm col-md-2" scope="row">{{user.username}}</th>
                <td class="col-xs-2 col-md-4">{{user.name}}</td>
                <td class="hidden-xs hidden-sm col-md-2">{{user.created_at}}</td>
                <td class="col-xs-2 col-md-4">{{user.role}}</td>
                <td class="col-xs-2 col-md-4">
                  <a href="/admin/users/edit/{{user.username}}" class="btn btn-success btn">
                    <span class="glyphicon glyphicon-edit"></span> Edit 
                  </a>
                </td>
              </tr>
              <tr ng-if="!users.length"><td colspan="4" style="text-align: center">No record found</td></tr>
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

    $scope.getUsers = function(pageNumber){

      if(pageNumber===undefined){
        pageNumber = '1';
      }

      $http({
        method : "POST",
        url : '/users/getUsers/'+pageNumber,
        data: { username: $scope.username , name: $scope.name, role: $scope.role }
      }).then(function mySuccess(response) {
        // console.log(response.data.data.data);
        respo_data = response.data.data;
        if(response.data.error.status)
            alert(response.data.error.message)
        else{
          

          $scope.users        = respo_data.data;
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
          '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getUsers(1)">«</a></li>'+
          '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getUsers(currentPage-1)">‹ Prev</a></li>'+
          '<li ng-repeat="i in range" ng-class="{active : currentPage == i}">'+
              '<a href="javascript:void(0)" ng-click="getUsers(i)">{{i}}</a>'+
          '</li>'+
          '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getUsers(currentPage+1)">Next ›</a></li>'+
          '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getUsers(totalPages)">»</a></li>'+
        '</ul>'
     };
  });
</script>

