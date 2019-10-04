<?php //debug($data);?>  
<link rel='stylesheet' href='/css/loading-bar.min.css' type='text/css' media='all' />
<script type='text/javascript' src='/js/loading-bar.min.js'></script>
<script src="/js/angularjs/controllers/medical_packages.controller.js"></script>

<div class="lis-container" style="padding-top: 0;" ng-app="mro" ng-controller="MedicalPackagesCtrl" ng-init="getMedicalPackages()">
    <div class="lis-center-container">
        <!-- <div>{{medical_packages}}</div> -->
        <!-- <table class="table table-sm">
          <tbody>
              <tr>
                  <td><input type="text" class="form-control" id="username" ng-model="username" ng-keydown="$event.keyCode === 13 && getMedicalPackages()" placeholder="Username"></td>
                  <td><input type="text" class="form-control datepicker" id="start_date" ng-model="start_date" ng-change="getMedicalPackages()"></td>
                  <td><input type="text" class="form-control datepicker" id="end_date" ng-model="end_date" ng-change="getMedicalPackages()"></td>
                  <td><button type="submit" class="btn btn-primary" ng-click="getMedicalPackages()">Submit</button></td>
              </tr>
          </tbody>
        </table> -->

        <table class="table table-hover patient_orders_tbl">
          <thead>
            <tr>
              <th class="col-xs-2 col-md-1" scope="col" ng-click="sort('id')">
                ID
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='id'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="col-xs-2 col-md-2" scope="col" ng-click="sort('name')">
                NAME
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='name'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="col-xs-2 col-md-6" scope="col" ng-click="sort('description')">
                DESCRIPTION
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='description'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="col-xs-1 col-md-1" scope="col" ng-click="sort('default_pf_amount')">
                VALUE
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='default_pf_amount'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="hidden-xs hidden-sm col-md-1" scope="col"  ng-click="sort('created_at')">
                CREATED
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='created_at'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="col-xs-1 col-md-1" scope="col" >
                ACTION
              </th>
            </tr>
          </thead>
          <tbody>
              <tr ng-if="medical_packages.length" ng-repeat="medical_package in medical_packages | orderBy:sortKey:reverse" >
                <th class="col-xs-2 col-md-1" scope="row">{{medical_package.id}}</th>
                <td class="col-xs-2 col-md-2">{{medical_package.name}}</td>
                <td class="col-xs-2 col-md-6">{{medical_package.description}}</td>
                <td class="col-xs-1 col-md-1">{{medical_package.default_pf_amount}}</td>
                <td class="hidden-xs hidden-sm col-md-1">{{medical_package.created_at}}</td>
                <td class="col-xs-1 col-md-1">
                  <a href="/admin/medical_packages/edit/{{medical_package.id}}" class="btn btn-success btn">
                    <span class="glyphicon glyphicon-edit"></span> Edit 
                  </a>
                </td>
              </tr>
              <tr ng-if="!medical_packages.length"><td colspan="4" style="text-align: center">No record found</td></tr>
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

