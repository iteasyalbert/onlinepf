<?php //echo $this->Html->script('admin/admin_templating_content.js')?>
<div class="content">
	<div id="main-tab" class="widget-result">
        <ul class="tabnav">
             <li><a style="background: none;"  href="#laboratories">Pending Corporates</a></li>
        </ul>
	    <div id="laboratories" class="tabdiv" style="height:auto;">
			<table>
				<thead>
					<tr>
						<th>Corporate Name</th>
						<th>Branch Name</th>
						<th>Owner Name</th>
						<th>Registration Date</th>
						<th>Class</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($users as $user):?>
						<?php
							$company = array();
							
							if(isset($companyMembers[$user['User']['id']])){
								$companyId = key($companyMembers[$user['User']['id']]);
								$company = $companyBranches[$companyId];
							}
							
						?>
						<tr>
							<td>
								<?php
									if(isset($company['Company']['name']))
										echo $company['Company']['name'];
								?>
							</td>
							<td>
								<?php
									if(isset($company['CompanyBranch']['branch']))
										echo $company['CompanyBranch']['branch'];
								?>
							</td>
							<td>
								<?php
									if(isset($userDetails[$user['User']['id']]))
										echo $userDetails[$user['User']['id']]['lastname'].', '.$userDetails[$user['User']['id']]['firstname'];
								?>
							</td>
							<td><?php echo $user['User']['entry_datetime'];?></td>
							<td><?php echo $user['User']['CorporateAccount']['class'];?></td>
							<td>
								<?php echo $this->Html->link('View',array('controller' => 'users','action' => 'corp_profile','sales' => true,$company['CompanyBranch']['id']));?>
								<?php echo $this->Form->postLink(__('Activate'), array('controller' => 'users','action' => 'corp_activate', 'sales' => true, $user['User']['id']), null, __('Are you sure you want to activate user %s?', $user['User']['username'])); ?>
							</td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>
</div>