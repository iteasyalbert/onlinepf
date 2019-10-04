<?php //debug($data);?>  
<link rel='stylesheet' href='/css/loading-bar.min.css' type='text/css' media='all' />
<script type='text/javascript' src='/js/loading-bar.min.js'></script>
<script src="/js/angularjs/controllers/audit_logs.controller.js"></script>

<div class="lis-container" style="padding-top: 0;" ng-app="mro" ng-controller="auditLogsCtrl" ng-init="getAuditLogs()">
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

        <table class="table table-hover patient_orders_tbl">
          <thead>
            <tr>
              <th class="col-xs-2 col-md-2" scope="col" ng-click="sort('datetime')">
                DATETIME
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='datetime'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="col-xs-2 col-md-1" scope="col" ng-click="sort('action')">
                ACTION
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='action'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="col-xs-2 col-md-6" scope="col" ng-click="sort('remarks')">
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
                <th class="col-xs-2 col-md-2" scope="row">{{audit_log.datetime}}</th>
                <td class="col-xs-2 col-md-1">{{audit_log.action}}</td>
                <td class="col-xs-2 col-md-6">{{audit_log.remarks}}</td>
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
  jQuery(document).ready(function(){
    jQuery( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker().datepicker("setDate", new Date());
  });
</script>

