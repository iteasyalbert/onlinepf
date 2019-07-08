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
				//echo $this->Html->script('jquery.PrintArea.js');
				echo $this->Html->css('jquery.jqplot.min.css');
			?>
			
                <h2>GRAPH</h2>
                <div id="legend">
	                <?php 
	                $ctr = 0;
	               // foreach($tests as $testkey=>$testvalue){
	             //   	echo $this->Form->input($testvalue,array('type'=>'checkbox','value'=>$testvalue,'div'=>array('style'=>'display:inline-block;margin-right:10px;border:solid 1px #aaa;padding: 2px 3px;'),'class'=> $ctr++,'checked' => true,'style' => 'margin:0px;'));
	             //   }?>
	            </div>
                <br/><br/>
                <div class="historyGraph" id="historyGraph" style="height:300px;border:1px solid #BFB092;">
                	
                </div>
<script>
	jQuery(document).ready(function(){

		if(graphs == undefined){
			graphs = [];
		}
		index = graphs.length;
		newid = 'historyGraph'+index;
		jQuery('#historyGraph').attr('id',newid);
		graphs[index] = jQuery.jqplot(newid, <?php echo $this->Js->object($graph);?>, {
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
		  window.print();
		//'<div><div class="jqplot-table-legend-swatch" style="background-color:#4bb2c5;border-color:#4bb2c5;"></div></div>'
		jQuery('#legend  input[type=checkbox]').each(function(x,y){
			//jQuery(this).wrap('<div style = "width:25px; padding:2px; border:1px solid #555;" />');
			jQuery('<div style="width:15px;height:12px;border:solid 1px;display:inline-block;background-color:'+graphs[index].series[x].fillColor+';border-color:'+graphs[index].series[x].fillColor+'"></div>').insertBefore(this);
			
		});
		jQuery('#legend  input[type=checkbox]').click(function(){
			seriesIndex = jQuery(this).attr('class');
			if(jQuery(this).is(':checked'))
				graphs[index].series[seriesIndex].showLine = true;
			else
				graphs[index].series[seriesIndex].showLine = false;

			graphs[index].redraw();
			
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
		 		    