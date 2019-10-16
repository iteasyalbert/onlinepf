<?php //debug($consultant_types);?>  
<link rel='stylesheet' href='/css/loading-bar.min.css' type='text/css' media='all' />
<script type='text/javascript' src='/js/loading-bar.min.js'></script>
<script src="/js/angularjs/controllers/hmo.controller.js"></script>
<style type="text/css">
  .lis-center-container {
    border-left: 6px solid #23374d;
    border-right: 1px solid #23374d;
    border-top: 1px solid #23374d;
    border-bottom: 1px solid #23374d;
    border-radius: 5px;
  }
</style>
<div class="lis-container" style="padding-top: 0;" ng-app="mro" ng-controller="HmoCtrl" ng-init="getHmo()">
    <div class="lis-center-container" >
        <!-- <div>{{hmos}}</div> -->
        <!-- <table class="table table-sm">
          <tbody>
              <tr>
                  <td><input type="text" class="form-control" id="username" ng-model="username" ng-keydown="$event.keyCode === 13 && getHmo()" placeholder="Username"></td>
                  <td><input type="text" class="form-control datepicker" id="start_date" ng-model="start_date" ng-change="getHmo()"></td>
                  <td><input type="text" class="form-control datepicker" id="end_date" ng-model="end_date" ng-change="getHmo()"></td>
                  <td><button type="submit" class="btn btn-primary" ng-click="getHmo()">Submit</button></td>
              </tr>
          </tbody>
        </table> -->
        <h5 class="text-center">HMO Management</h5>
        <div><button type="button" class="btn pull-right btn-primary" id="add-hmo">Add HMO</button></div>
        <table class="table table-bordered table-hover patient_orders_tbl">
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
             <!--  <th class="col-xs-1 col-md-1" scope="col" ng-click="sort('default_pf_amount')">
                PF AMOUNT
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='default_pf_amount'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th> -->
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
              <tr ng-if="hmos.length" ng-repeat="hmo in hmos | orderBy:sortKey:reverse" >
                <th class="col-xs-2 col-md-1" scope="row">{{hmo.external_id}}</th>
                <td class="col-xs-2 col-md-2">{{hmo.name}}</td>
                <td class="col-xs-2 col-md-6">
                  <!-- {{hmo.description}} -->
                  <ul ng-repeat="hmo_consultant_type_pf in hmo.HmoConsultantTypePfs">
                    <li>{{hmo_consultant_type_pf.consultant_type_name}} : {{hmo_consultant_type_pf.default_pf_amount}}</li>
                  </ul>
                </td>
                <!-- <td class="col-xs-1 col-md-1">{{hmo.default_pf_amount}}</td> -->
                <td class="hidden-xs hidden-sm col-md-1">{{hmo.created_at}}</td>
                <td class="col-xs-1 col-md-1">
                  <a href="/admin/hmo/edit/{{hmo.id}}" class="btn btn-success btn">
                    <span class="glyphicon glyphicon-edit"></span> Edit 
                  </a>
                </td>
              </tr>
              <tr ng-if="!hmos.length"><td colspan="4" style="text-align: center">No record found</td></tr>
          </tbody> 
        </table>

        <!-- Pagination -->
        <div>
          <patient-orders-pagination></patient-orders-pagination>
        </div>
    </div>
    <?php echo $this->element('general_modal');?>
</div>
<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker().datepicker("setDate", new Date());
  });
</script>

