<?php //debug($data);?>  
<link rel='stylesheet' href='/css/loading-bar.min.css' type='text/css' media='all' />
<script type='text/javascript' src='/js/loading-bar.min.js'></script>
<script src="/js/angularjs/controllers/sms_templates.controller.js"></script>

<div class="lis-container" style="padding-top: 0;" ng-app="mro" ng-controller="SmsTemplatesCtrl" ng-init="getSmsTemplates()">
    <div class="lis-center-container">
        <!-- <div>{{users}}</div> -->

        <table class="table table-hover patient_orders_tbl">
          <thead>
             <tr>
              <th class="col-xs-1 col-md-1" scope="col" ng-click="sort('id')">
                ID
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='datetime'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="col-xs-8 col-md-8" scope="col" ng-click="sort('content')">
                CONTENT
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='action'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <!-- <th class="col-xs-2 col-md-6" scope="col" ng-click="sort('remarks')">
                DESCRIPTION
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='remarks'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th>
              <th class="col-xs-1 col-md-1" scope="col" ng-click="sort('ip_address')">
                VALUE
                <span class="glyphicon glyphicon-sort" ng-show="sortKey=='ip_address'" ng-class="{'glyphicon glyphicon-menu-up':reverse,'glyphicon glyphicon-menu-down':!reverse}"></span>
              </th> -->
              <th class="col-xs-1 col-md-1" scope="col" >
                CREATED
              </th>
              <th class="col-xs-1 col-md-1" scope="col" >
                ACTION
              </th>
            </tr>
          </thead>
          <tbody>
              <tr ng-if="sms_templates.length" ng-repeat="sms_template in sms_templates | orderBy:sortKey:reverse" >
                <th class="col-xs-1 col-md-1" scope="row">{{sms_template.id}}</th>
                <td class="col-xs-8 col-md-8">{{sms_template.content}}</td>
                <!-- <td class="col-xs-2 col-md-6">{{sms_template.description}}</td>
                <td class="col-xs-1 col-md-1">{{sms_template.value}}</td> -->
                <td class="col-xs-1 col-md-1">{{sms_template.created_at}}</td>
                <td class="col-xs-1 col-md-1">
                  <a href="/admin/sms_templates/edit/{{sms_template.id}}" class="btn btn-success btn">
                    <span class="glyphicon glyphicon-edit"></span> Edit 
                  </a>
                </td>
              </tr>
              <tr ng-if="!sms_templates.length"><td colspan="4" style="text-align: center">No record found</td></tr>
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

