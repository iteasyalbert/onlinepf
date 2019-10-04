<?php //debug($data);?>  
<link rel='stylesheet' href='/css/loading-bar.min.css' type='text/css' media='all' />
<script type='text/javascript' src='/js/loading-bar.min.js'></script>
<script src="/js/angularjs/controllers/utilizations.controller.js"></script>

<div class="lis-container" style="padding-top: 0;" ng-app="mro" ng-controller="auditLogsCtrl" ng-init="getUtilization()">
    <div class="lis-center-container">
        <!-- <div style="color:red">{{utilization}}adsfasd</div> -->
        <table class="table table-sm">
          <tbody>
              <tr>
                  <!-- <td><input type="text" class="form-control" id="username" ng-model="username" ng-keydown="$event.keyCode === 13 && getUtilization()" placeholder="Username"></td> -->
                  <!-- <td><input type="text" class="form-control" id="name" ng-model="name" ng-keydown="$event.keyCode === 13 && getUtilization()" placeholder="Name"></td>
                  <td>
                    <select class="form-control" id="role" ng-model="role" ng-change="getUtilization()">
                      <option value="ROLE_ADMIN">ADMIN</option>
                      <option value="ROLE_PATIENT">PATIENT</option>
                      <option value="ROLE_PHYSICIAN">PHYSICIAN</option>
                    </select>
                  </td> -->
                  <td><input type="text" class="form-control datepicker" id="start_date" ng-model="start_date" ng-change="getUtilization()"></td>
                  <td><input type="text" class="form-control datepicker" id="end_date" ng-model="end_date" ng-change="getUtilization()"></td>
                  <td><button type="submit" class="btn btn-primary" ng-click="getUtilization()">Submit</button></td>
              </tr>
          </tbody>
        </table>
        <div>TOTAL NO OF PHYSICIAN UTILIZATION: {{utilization.totalphysicianvisits}}</div>
        <div>TOTAL NO OF PATIENT UTILIZATION: {{utilization.totalpatientvisits}}</div>
        <table class="table table-hover patient_orders_tbl">
          <tr>
            <td>
              <table>
                <thead>
                  <tr>
                    <th class="col-xs-2 col-md-2">
                      PHYSICIAN NAME
                    </th>
                    <th class="col-xs-2 col-md-1" >
                      NO OF LOGGED IN
                    </th>
                  </tr>
                </thead>
                <tbody>
                    <tr ng-if="utilization.ROLE_PHYSICIAN" ng-repeat="physician in utilization.ROLE_PHYSICIAN|limitTo:5" >
                      <td class="col-xs-2 col-md-2">{{physician.name}}</td>
                      <td class="col-xs-2 col-md-1">{{physician.count}}</td>
                    </tr>
                </tbody>
              </table>
            </td>
          </tr>
           <tr>
            <td>
              <table>
                <thead>
                  <tr>
                    <th class="col-xs-2 col-md-2">
                      PATIENT NAME
                    </th>
                    <th class="col-xs-2 col-md-1" >
                      NO OF LOGGED IN
                    </th>
                  </tr>
                </thead>
                <tbody>
                    <tr ng-if="utilization.ROLE_PATIENT" ng-repeat="physician in utilization.ROLE_PATIENT | limitTo:2" >
                      <td class="col-xs-2 col-md-2">{{physician.name}}</td>
                      <td class="col-xs-2 col-md-1">{{physician.count}}</td>
                    </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </table>

        <!-- Pagination -->
        <!-- <div>
          <patient-orders-pagination></patient-orders-pagination>
        </div> -->
    </div>
</div>

<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker().datepicker("setDate", new Date());
  });
</script>

