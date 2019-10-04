<?php //debug($data);?>  
<link rel='stylesheet' href='/css/loading-bar.min.css' type='text/css' media='all' />
<script type='text/javascript' src='/js/loading-bar.min.js'></script>
<script src="/js/angularjs/controllers/users.controller.js"></script>

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

        <table class="table table-hover patient_orders_tbl">
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
  jQuery(document).ready(function(){
    jQuery( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker().datepicker("setDate", new Date());
  });
</script>

