<div>
	<div id="index">
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
					<td><a href="/users/viewlogdetails">View</a></td>
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
	#paginatordiv a {color:black; text-decoration:none;}
	table a {color:black; text-decoration:none;}
/*	::-webkit-scrollbar {
    width: 0px;  /* remove scrollbar space */
    background: transparent;  /* optional: just make scrollbar invisible */
	}*/
	/* optional: show position indicator in red */
	::-webkit-scrollbar-thumb {
		
	}
	
   h1, h2, h3, h4{ font: bold 15px "Trebuchet MS", Arial, Helvetica, sans-serif;}
                                    
	.ui-dialog .ui-dialog-titlebar {
	    background:#ccc;
	}
	.visits_tbl td {
		font: bold 13px "Trebuchet MS", Arial, Helvetica, sans-serif;
		 border-left: 1px solid #FFCACA;
/* 	    border-right: 1px solid #FFCACA; */
/* 		border-bottom: 1px solid #FFCACA; */
	}
	.visits_tbl {
		width:100%;
	    border-left: 1px solid #FFCACA;
	    border-right: 1px solid #FFCACA;
		border-bottom: 1px solid #FFCACA;
	}
	.visits_tbl tr:nth-child(2n):hover td, .visits_tbl tbody tr:hover td {
	   background: #FF8484;
	   color: #000;
	}
	#selected td{
	   background: #FF8484;
	   color: #000;
	   /*padding: 3px 0;*/
	}
	#common-tbl th {
    	/*background: url(../../img/heartcenter/sidenav.png) repeat;*/
	    font: bold 13px "Trebuchet MS", Arial, Helvetica, sans-serif;
	    background: #FFCACA;
	    border: 1px solid #FFCACA;
	    text-align: center;
	    padding: 3px 0;
	}
	input[type="text"], textarea, select {
    border: 1px solid #CCC;
    padding: 4px;
    border-radius: 5px;
    color: #333;
	}
	td label{
		font-size: 11px;
		font-weight: bold;
	}
	table#single-td-tbl input[type="text"] {
		width: 270px !important;
	}
	table#single-td-tbl select {
		width: 281px !important;
	}
	</style>
</style>