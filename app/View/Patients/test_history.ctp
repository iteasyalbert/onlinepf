			<?php 
				echo $this->Html->script('jquery.jqplot.min.js');
				echo $this->Html->script('plugins/jqplot.dateAxisRenderer.min.js');
				echo $this->Html->script('plugins/jqplot.canvasTextRenderer.min.js');
				echo $this->Html->script('plugins/jqplot.canvasAxisTickRenderer.min.js');
				echo $this->Html->script('plugins/jqplot.categoryAxisRenderer.min.js');
				echo $this->Html->script('plugins/jqplot.logAxisRenderer.js');
				echo $this->Html->script('plugins/jqplot.barRenderer.min.js');
				echo $this->Html->script('plugins/jqplot.highlighter.min.js');
				echo $this->Html->script('plugins/jqplot.cursor.min.js');
				echo $this->Html->script('jquery.PrintArea.js');
				echo $this->Html->css('jquery.jqplot.min.css');
			?>
			
			<h2 class="test-name">TEST RESULT</h2>
			<?php //debug($testOrderResults);?>

                <div id="history-list" style="overflow-y:auto;">
                	<table id="common-tbl">
                		<thead>
                			<tr>
                				<th>Laboratoty</th>
                				<th>Date</th>
                				<th><?php echo implode('</th><th>',$tests)?></th>
                			</tr>
                		</thead>
                		<tbody>
                			<?php foreach($tabular as $row):?>
                				<tr>
                					<td>
                						<?php echo implode('</td><td>',$row);?>
                					</td>
                				</tr>
                			<?php endforeach;?>
                		</tbody>
                	</table>
               	</div>
               <div id="printArea">
	                <h2>GRAPH</h2>
	                <div id="legend" class="graph_legend_<?php echo $patientId."_".$testGroupId?>">
		                <?php 
		                $ctr = 0;
		                foreach($tests as $testkey=>$testvalue){
		                	echo $this->Form->input($testvalue,array('type'=>'checkbox','value'=>$testvalue,'div'=>array('style'=>'display:inline-block;margin-right:10px;border:solid 1px #aaa;padding: 2px 3px;'),'class'=> $ctr++,'checked' => true,'style' => 'margin:0px;'));
		                }?>
		            </div>
	                <br/><br/>
	                
	                <div id="historyGraph_<?php echo $patientId."_".$testGroupId?>" style="height:300px;border:1px solid #BFB092;">
	                	
	                </div>
                </div>
                <?php //echo $this->Form->create(null, array('url'=>array('controller'=>'patients', 'action'=>'testHistory')));?>
                <?php //secho $this->Form->submit('Save',array('div'=>false,'class'=>'submit-save','style'=>'margin-left:70%;', 'name'=>'Save'));?>
                <?php echo $this->Form->submit('Print',array('div'=>false, 'class'=>'printHistory','style'=>'margin-left:87%;', 'name="Print"', 'onclick'=>'return false;'));?>
                <?php echo $this->Form->end();?>
                
<script>
	jQuery(document).ready(function(){

		if(graphs == undefined){
			graphs = {};
		}
		
		graphs['historyGraph_'+'<?php echo $patientId."_".$testGroupId?>'] = jQuery.jqplot('historyGraph_'+'<?php echo $patientId."_".$testGroupId?>', <?php echo $this->Js->object($graph);?>, {
		    title: 'Patient History',
		    axesDefaults: {
		        tickRenderer: jQuery.jqplot.CanvasAxisTickRenderer ,
		        tickOptions: {
		          angle: -50,
		          fontSize: '10pt'
		        }
		    },
		    axes: {
			      xaxis: {
			        renderer: jQuery.jqplot.CategoryAxisRenderer,
			        min:0
			      },
			      yaxis: {
			    	   min:0,
				        tickOptions: {
				          angle: 0,
				          fontSize: '8pt',
				          formatString:'%i'
				        },
				        numberTicks:5,
			        	max:setTenths(<?php echo $max?>)
				      }
			    },
			seriesDefaults:{showMarker:false},
		    series: [
                    ],
		 	legend: {
			 	show: false,
			 	placement:'outside',
			 	location:'n'
			},
			highlighter: {
				show: true,
		        sizeAdjust: 2,
		        tooltipAxes:'y',
		        fontSize: '8pt'
		      },
		      cursor: {
		        show: false
		      }
		     
		  });		  
		//'<div><div class="jqplot-table-legend-swatch" style="background-color:#4bb2c5;border-color:#4bb2c5;"></div></div>'
		jQuery('#legend.graph_legend_'+'<?php echo $patientId."_".$testGroupId?>'+'  input[type=checkbox]').each(function(x,y){
			//jQuery(this).wrap('<div style = "width:25px; padding:2px; border:1px solid #555;" />');
			jQuery('<div style="width:15px;height:12px;border:solid 1px;display:inline-block;background-color:'+graphs['historyGraph_'+'<?php echo $patientId."_".$testGroupId?>'].series[x].fillColor+';border-color:'+graphs['historyGraph_'+'<?php echo $patientId."_".$testGroupId?>'].series[x].fillColor+'"></div>').insertBefore(this);
			
		});

		jQuery('.printHistory').click(function(){
				jQuery('#printArea').printArea({mode:'popup'});
			});
		jQuery('#legend  input[type=checkbox]').click(function(){
			seriesIndex = jQuery(this).attr('class');
			if(jQuery(this).is(':checked'))
				graphs['historyGraph_'+'<?php echo $patientId."_".$testGroupId?>'].series[seriesIndex].showLine = true;
			else
				graphs['historyGraph_'+'<?php echo $patientId."_".$testGroupId?>'].series[seriesIndex].showLine = false;

			graphs['historyGraph_'+'<?php echo $patientId."_".$testGroupId?>'].redraw();
			
		});
		
	});

	function setTenths(number){
		if(parseInt(number) < 10){
			max = 10;
		}else{
			digits = number.toString().length;
			tenth = Math.pow(10,digits-1);//10^parseInt(digits);
			max = tenth;
			while( number > max){
				max += tenth;
				}
		}
		return max;
		}
	
</script>
		 		    