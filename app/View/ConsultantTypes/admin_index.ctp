<?php //debug($data);?>  
<link rel='stylesheet' href='/css/loading-bar.min.css' type='text/css' media='all' />
<script type='text/javascript' src='/js/loading-bar.min.js'></script>
<script src="/js/angularjs/controllers/consultant_types.controller.js"></script>
<style type="text/css">
  .lis-center-container {
    border-left: 6px solid #23374d;
    border-right: 1px solid #23374d;
    border-top: 1px solid #23374d;
    border-bottom: 1px solid #23374d;
    border-radius: 5px;
  }
</style>
<div class="lis-container" style="padding-top: 0;" ng-app="mro" ng-controller="ConsultantTypesCtrl" ng-init="getConsultantTypes()">
    <div class="lis-center-container">
        <!-- <div>{{medical_packages}}</div> -->
        <!-- <table class="table table-sm">
          <tbody>
              <tr>
                  <td><input type="text" class="form-control" id="username" ng-model="username" ng-keydown="$event.keyCode === 13 && getConsultantTypes()" placeholder="Username"></td>
                  <td><input type="text" class="form-control datepicker" id="start_date" ng-model="start_date" ng-change="getConsultantTypes()"></td>
                  <td><input type="text" class="form-control datepicker" id="end_date" ng-model="end_date" ng-change="getConsultantTypes()"></td>
                  <td><button type="submit" class="btn btn-primary" ng-click="getConsultantTypes()">Submit</button></td>
              </tr>
          </tbody>
        </table> -->
        <h5 class="text-center">Consultant Type Management</h5>
        <div><button type="button" class="btn pull-right btn-primary" id="add">Add Consultant Type</button></div>
        <table class="table table-bordered table-hover patient_orders_tbl">
          <thead>
            <tr>
              <th class="col-xs-1 col-md-1" scope="col" ng-click="sort('id')">
                ID
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='id'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="col-xs-6 col-md-4" scope="col" ng-click="sort('name')">
                NAME
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='name'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
             <!--  <th class="col-xs-2 col-md-6" scope="col" ng-click="sort('description')">
                DESCRIPTION
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='description'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th> -->
              <th class="col-xs-4 col-md-4" scope="col" ng-click="sort('default_pf_amount')">
                PF AMOUNT
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='default_pf_amount'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="hidden-xs hidden-sm col-md-2" scope="col"  ng-click="sort('created_at')">
                CREATED
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='created_at'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="col-xs-1 col-md-1" scope="col" >
                ACTION
              </th>
            </tr>
          </thead>
          <tbody>
              <tr ng-if="consultant_types.length" ng-repeat="consultant_type in consultant_types | orderBy:sortKey:reverse" >
                <th class="col-xs-2 col-md-1" scope="row">{{consultant_type.external_id}}</th>
                <td class="col-xs-2 col-md-2">{{consultant_type.name}}</td>
                <!-- <td class="col-xs-2 col-md-6">{{consultant_type.description}}</td> -->
                <td class="col-xs-1 col-md-1">{{consultant_type.default_pf_amount}}</td>
                <td class="hidden-xs hidden-sm col-md-1">{{consultant_type.created_at}}</td>
                <td class="col-xs-1 col-md-1">
                  <a href="/admin/consultant_types/edit/{{consultant_type.id}}" class="btn btn-success btn">
                    <span class="glyphicon glyphicon-edit"></span> Edit 
                  </a>
                </td>
              </tr>
              <tr ng-if="!consultant_types.length"><td colspan="4" style="text-align: center">No record found</td></tr>
          </tbody> 
        </table>

        <!-- Pagination -->
        <div>
          <patient-orders-pagination></patient-orders-pagination>
        </div>
    </div>
    <?php echo $this->element('consultant_type_modal');?>
</div>

<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker().datepicker("setDate", new Date());
  });
</script>

