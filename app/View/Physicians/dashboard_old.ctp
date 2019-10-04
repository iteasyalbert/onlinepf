
<?php debug($data);?>
<div class="lis-container" style="padding-top: 0;">
    <div class="lis-center-container">
        <hr>
        <!-- Patient Order List -->
        <div id="box">
          <!-- <h3>Search result by date requested</h3> -->
          
          <table class="table table-sm">
            <tbody>
                <tr>
                    <td><input type="text" class="form-control" id="firstname" ng-model="firstname" ng-keydown="$event.keyCode === 13 && getPatientOrders()" placeholder="First Name"></td>
                    <td><input type="text" class="form-control" id="lastname" ng-model="lastname" ng-keydown="$event.keyCode === 13 && getPatientOrders()" placeholder="Last Name"></td>
                    <td><input type="text" class="form-control" id="patient_id" ng-model="patient_id" ng-keydown="$event.keyCode === 13 && getPatientOrders()" placeholder="Patient ID"></td>
                    <td><input type="text" class="form-control datepicker" id="start_date" ng-model="start_date" ng-change="getPatientOrders()"></td>
                    <td><input type="text" class="form-control datepicker" id="end_date" ng-model="end_date" ng-change="getPatientOrders()"></td>
                    <td><button type="submit" class="btn btn-primary" ng-click="getPatientOrders()">Submit</button></td>
                </tr>
            </tbody>
          </table>

          <table class="table table-hover patient_orders_tbl">
            <thead>
              <tr>
                <th >
                  Registration Number
                </th>
                <th >
                  PATIENT ID
                </th>
                <th >
                  NAME
                </th>
                <th >
                  Birthdate
                </th>
                <th >
                  Gender
                </th>
                <th >
                  PF AMOUNT
                </th>
                <th >
                  ACTION
                </th>
              </tr>
            </thead>
            <tbody>
            	<?php foreach ($data['data'] as $px):?>
	                <tr >
	                  <th ><?php echo $px['visit_number'];?></th>
                    <th ><?php echo $px['patient_id'];?></th>
	                  <td ><?php echo $px['px_last_name'].', '.$px['px_first_name'].' '.$px['px_middle_name'];?></td>
	                  <td ><?php echo $px['px_sex'];?></td>
	                  <td ><?php echo date('Y-m-d', strtotime($px['px_birthdate']));?></td>
	                  <td ><?php echo $px['pf_amount'];?></td>
                    <td >
                      <a href="/physicians/view_transaction/<?php echo $px['visit_number']?>/<?php echo $px['patient_id']?>" class="btn btn-success btn">
                        <span class="glyphicon glyphicon-edit"></span> Edit 
                      </a>
                    </td>
	                </tr>
	            <?php endforeach;?>
                <!-- <tr ng-if="!patient_orders.length"><td colspan="4" style="text-align: center">No record found</td></tr> -->
            </tbody> 
          </table>
        </div>
    </div>
</div>

<script type="text/javascript">
</script>