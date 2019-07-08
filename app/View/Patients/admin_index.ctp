<div>
<?php echo $this->element('admin_filter_inputs');?>	
	<div id="view">
		 <table id="common-tbl" class="visits_tbl" >
			<thead>
				<th style="width:15%;"><?php echo $this->Paginator->sort('id', 'MRN No'); ?></th>
				<th style="width:15%;"><?php echo $this->Paginator->sort('lastname', 'Last Name'); ?></th>
				<th style="width:25%;"><?php echo $this->Paginator->sort('firstname', 'First Name'); ?></th>
				<th style="width:15%;"><?php echo $this->Paginator->sort('middlename', 'Middle Name'); ?></th>
				<th style="width:10%;"><?php echo $this->Paginator->sort('sex', 'Sex'); ?></th>
				<th style="width:10%;">Action</th>
			</thead>
			<tbody>
				<?php foreach ($persons as $person): ?>
				<tr>
					<td><?php echo $person['Person']['myresultonline_id']?></td>
					<td><?php echo $person['Person']['lastname']?></td>
					<td><?php echo $person['Person']['firstname']?></td>
					<td><?php echo $person['Person']['middlename']?></td>
					<td><?php echo $person['Person']['sex']?></td>
					<td>
						<?php echo $this->Html->link(__('View'), array('action' => 'viewlogdetails', $person['User']['id'])); ?>
					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<div id="paginatordiv" style="text-align: center;">
			<?php 
				
				// Shows the next and previous links
				echo $this->Paginator->prev(
				  '<< Previous'
// 				  null,
// 				  null,
// 				  array('class' => 'disabled')
				);
				echo '&nbsp;';
				// Shows the page numbers
				echo $this->Paginator->numbers();
				echo '&nbsp;';
				echo $this->Paginator->next(
				  'Next >>'
// 				  null,
// 				  null,
// 				  array('class' => 'disabled')
				);
				echo '<br>';
				// prints X of Y, where X is current page and Y is number of pages
				echo $this->Paginator->counter(array(
				    'format' => 'Page {:page} of {:pages}, showing {:current} records out of
				             {:count} total, starting on record {:start}, ending on {:end}'
				));		
			?>
		</div>
	
	</div>
	
</div>
<style>
table#common-tbl td a{ background: url("/img/heartcenter/navbar2.png") repeat scroll 0 0 transparent; border-radius: 3px;
color: #fff;display: block;position: relative;width:50px;height:17px;margin:0 0 0px 0;line-height:31px;padding:0px 0 0 10px;text-decoration: none;
font: bold 14px 'Trebuchet MS', Arial, Helvetica, sans-serif;
}
</style>


