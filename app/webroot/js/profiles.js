var patientGraph;
	
function showTestOrderDetail(testOrderId,divid){
	
	jQuery("#flash").show();
    jQuery("#overlay").fadeIn(100);
    jQuery("#flash").fadeIn(100).html('<table><tr><td style="background: none; border: none;"><img src="/img/loading.gif" align="absmiddle" style="float: left;">&nbsp;</td><td style="background: none; border: none;"><span style="font-weight: bold; font-size: 15px; color: white; padding-top: 3px;">Retrieving Data ...</span></td></tr></table>');
    
		jQuery.ajax({
			url: '/patients/testOrderDetail',
			data:{'LaboratoryTestOrderId':testOrderId},
			type: 'POST',
			dataType : 'json',
			success:function(data){
				jQuery("#flash").stop().fadeOut();
                jQuery("#overlay").stop().fadeOut();
                
				jQuery('#'+divid).empty();
				tables = '';
				jQuery.each(data.testOrderPackages,function(x,y){
					tables += '<br />';
					tables += '<table class = "test_group_detail" id="'+y.LaboratoryTestOrderPackage.test_order_id+'">';
					tables += '<thead><tr id="'+x+'" class="test_group_index"><th colspan="6" id="'+y.LaboratoryTestGroup.id+'" class="test_group" style="background-color; #4E4635;">'+y.LaboratoryTestGroup.name+'</th>';
					tables += '</tr><tr class="testGroupTr"><th>Test</th><th>Flag</th><th>SI Result</th><th>SI Range</th><th>Conventional Result</th><th>Conventional Range</th></tr></thead>';
					tables += '<tbody>';
					
					jQuery.each(data.testOrderResults[x],function(w,z){
						console.log(z.LaboratoryTestOrderResult);
						tables += '<tr  class="test_code" id='+z.LaboratoryTest.id+'><td class="name" id="'+w+'">'+z.LaboratoryTest.name+'</td>';
						tables += '<td>'+((z.LaboratoryTestOrderResult.result_flag!= null)?z.LaboratoryTestOrderResult.result_flag:'')+'</td>';
						tables += '<td>'+((z.LaboratoryTestOrderResult.si_value!= null)?z.LaboratoryTestOrderResult.si_value:'')+'</td>';
						tables += '<td>'+((z.LaboratoryTestOrderResult.si_reference_range!= null)?z.LaboratoryTestOrderResult.si_reference_range+' '+z.LaboratoryTestOrderResult.si_unit:'')+'</td>';
						tables += '<td>'+((z.LaboratoryTestOrderResult.conventional_value!= null)?z.LaboratoryTestOrderResult.conventional_value:'')+'</td>';
						tables += '<td>'+((z.LaboratoryTestOrderResult.conventional_reference_range!= null)?z.LaboratoryTestOrderResult.conventional_reference_range+' '+z.LaboratoryTestOrderResult.conventional_unit:'')+'</td>';
						tables += '</tr>';
						
					});
					tables += "<tr><td><b>Remarks:<b/></td><td colspan=\"5\">"+y.LaboratoryTestOrderPackage.remarks+"</td></tr>";
					
					physician_name = '';
					technologist_name = '';
					supervisor_name = '';
					
					if( y.LaboratoryTestOrderPackage.patient_batch_order_package_id != undefined){
						if(data.patientBatchOrderPackages[y.LaboratoryTestOrderPackage.patient_batch_order_package_id] != undefined){
							labBatchOrderPackage = data.patientBatchOrderPackages[y.LaboratoryTestOrderPackage.patient_batch_order_package_id];
							if(data.people[data.physicians[labBatchOrderPackage['physician_id']]] != undefined){
								if(data.people[data.physicians[labBatchOrderPackage['physician_id']]]['LaboratoryProfile'][0] != undefined){
									physician = data.people[data.physicians[labBatchOrderPackage['physician_id']]]['LaboratoryProfile'][0];
									physician_name = data.title[physician.title_id] + " " + physician.lastname +", "+ physician.firstname ;
								}
								
							}
							
						}
					}
					if(y.LaboratoryTestOrderPackage.technologies_user_id != undefined){
						
						if(data.people[y.LaboratoryTestOrderPackage.technologies_user_id] != undefined){
							
							technologist = data.people[y.LaboratoryTestOrderPackage.technologies_user_id]['LaboratoryProfile'][0];
							technologist_name = data.title[technologist.title_id] + " " + technologist.lastname +", "+ technologist.firstname ;
							
						}
						
					}
					if(y.LaboratoryTestOrderPackage.supervisor_user_id != undefined){
						
						if(data.people[y.LaboratoryTestOrderPackage.supervisor_user_id] != undefined){
							
							supervisor = data.people[y.LaboratoryTestOrderPackage.supervisor_user_id]['LaboratoryProfile'][0];
							supervisor_name = data.title[supervisor.title_id] + " " + supervisor.lastname +", "+ supervisor.firstname ;
							
						}
						
					}

					tables += "<tr><td><b>Physician:<b/></td><td colspan=\"5\">"+physician_name+"</td></tr>";
					tables += "<tr><td><b>Pathologist:<b/></td><td colspan=\"5\">"+supervisor_name+"</td></tr>";
					tables += "<tr><td><b>Technologist:<b/></td><td colspan=\"5\">"+technologist_name+"</td></tr>";
					tables += "<tr><td><b>Release Date:<b/></td><td colspan=\"5\">"+y.LaboratoryTestOrderPackage.release_date+" "+y.LaboratoryTestOrderPackage.release_time+"</td></tr>";
					tables += '</tbody>';
					tables += '</table>';
					
					
				});
				jQuery('#'+divid).html(tables);
				
				//testOrderId = data.testOrders[0].LaboratoryPatientOrder.id;
				
				jQuery('#printPdf').attr('name', '/Patients/print_pdf/'+testOrderId+'.pdf');
				jQuery('#print_filter').attr('action', '/Patients/print_pdf/'+testOrderId+'.pdf');
				jQuery('#printPdf').attr('onclick', "showTestOrderId('"+testOrderId+"')");
				jQuery('#printPdfResult').attr('onclick', "showTestOrderId('"+testOrderId+"')");
				jQuery('#print').attr('href', '/Patients/print_pdf/'+testOrderId+'.pdf');
				
			}
		});
	}

	function showTestOrderId(testOrderId){

		testGroupIds = {};		

		jQuery('.print_selections').empty();
		tabId = jQuery('.ui-tabs-selected > a').attr('href');		
		jQuery(tabId+' .test_group_detail').each(function(){		
			$tgtr = jQuery(this).find('.test_group');
			groupid = $tgtr.attr('id');
			grpi = jQuery(this).find('.test_group_index');
			groupindex = grpi.attr('id');			
			groupname = $tgtr.html();
			testcodetemplate = "";
			jQuery(this).find('tbody tr.test_code').each(function(){
				testid = jQuery(this).attr('id');
				testname = jQuery(this).find('.name').html();
				testindex = jQuery(this).find('.name').attr('id');
				testcodetemplate+='<div class="input checkbox">'
							+'<input type="hidden" value="0" id="TestResult'+groupid+'TestOrderDetail'+testindex+'TestCodePrint_" name="data[TestResult]['+groupindex+'][TestOrderDetail]['+testindex+'][print]">'
							+'<input type="checkbox" checked="checked" id="TestResult'+groupid+'TestOrderDetail'+testindex+'TestCodePrint" value="1" name="data[TestResult]['+groupindex+'][TestOrderDetail]['+testindex+'][print]" style="margin-left: 10px;">'
							+'<input type="hidden" value="'+testid+'" name="data[TestResult]['+groupindex+'][TestOrderDetail]['+testindex+'][id]">'
							+'<label for="TestResult'+groupid+'TestOrderDetail'+testindex+'Print">'+testname+'</label>'
						+'</div>';
				
			});
			jQuery('.print_selections').append(
				'<div class="testGroup">'
					+'<div class="input checkbox">'
						+'<input type="hidden" value="0" id="TestResult'+groupindex+'TestGroupPrint_" name="data[TestResult]['+groupindex+'][TestGroup][print]">'
						+'<input type="checkbox" checked="checked" id="TestResult'+groupindex+'TestGroupPrint" value="1" name="data[TestResult]['+groupindex+'][TestGroup][print]" style="margin-top: 10px;">'
						+'<input type="hidden" value="'+groupid+'" name="data[TestResult]['+groupindex+'][id]">'
							+'<label for="TestResult'+groupindex+'TestGroupPrint" style="font-weight: bold;">'+groupname+'</label>'
					+'</div>'
				+'</div>'
				+'<div class="testCode">'+testcodetemplate+'</div>'
			);
		});	
	}

	
	function showTestHistory(testGroupRadio,divid){
		showLoadingMask(" Retrieving Data, please wait.. ");
		
		testGroupId = jQuery(testGroupRadio).val();	
		//jQuery('#printTestHistory').attr('onclick', "printTestHistory('"+testGroupId+"','"+divid+"')");
		personId = jQuery(testGroupRadio).attr('title');
		postData = {'LaboratoryTestGroupId':testGroupId};
		if(personId != undefined)
			postData['Person'] = {id:personId};
		jQuery.ajax({
			url: '/patients/testHistory',
			data:postData,
			type: 'POST',
			dataType : 'json',
			asynch:false,
			success:function(data){
				
				hideLoadingMask();
                
				jQuery('#'+divid+' table thead').empty();
				tr = '<tr><th>Laboratory</th><th>Date</th>';
				jQuery.each(data.tests,function(x,y){
					tr += '<th>'+y+'</th>';
				});
				jQuery('#'+divid+' table thead').append(tr);

				tr = "";
				jQuery('#'+divid+' table tbody').empty();
				jQuery.each(data.tabular,function(x,y){
					tr += "<tr>";
					tr += "<td>" + y.join('</td><td>')+'</td>';
					tr += "</tr>";
				});
				jQuery('#'+divid+' table tbody').append(tr);
				if(data.graph){
					if(patientGraph != undefined)
						patientGraph.destroy();
					patientGraph = drawGraph(divid+'_historyGraph',data.graph,data.max);
					
					jQuery('.'+divid+'_legend').empty();
//					replotGraph(patientGraph,data.graph,data.max);
					checkboxes= '';
					x=0;
					jQuery.each(data.tests,function(w,y){
						//jQuery('<div style="width:15px;height:12px;border:solid 1px;display:inline-block;background-color:'+graphs['historyGraph_'+'<?php echo $patientId."_".$testGroupId?>'].series[x].fillColor+';border-color:'+graphs['historyGraph_'+'<?php echo $patientId."_".$testGroupId?>'].series[x].fillColor+'"></div>').insertBefore(this);						
						checkboxes += '<div style="display:inline-block;margin-right:10px;border:solid 1px #aaa;padding: 2px 3px;"><input type="checkbox" class="'+x+'" style = "margin:0px;" checked />';
						checkboxes += '<div style="width:15px;height:12px;border:solid 1px;display:inline-block;background-color:'+patientGraph.series[x].fillColor+';border-color:'+patientGraph.series[x++].fillColor+'"></div>';
						checkboxes +='<label>'+y+'</label></div>';
						
					});
					jQuery('.'+divid+'_legend').append(checkboxes);
					
					jQuery('.'+divid+'_legend input').click(function(){
						seriesIndex = jQuery(this).attr('class');
						if(jQuery(this).is(':checked'))
							patientGraph.series[seriesIndex].showLine = true;
						else
							patientGraph.series[seriesIndex].showLine = false;

						patientGraph.redraw();
						
					});
				}
			}
		});	
	}
		function printTestHistory(testGroupRadio,divid){
			
			testGroupId = jQuery(testGroupRadio).val();		
			personId = jQuery(testGroupRadio).attr('title');
			postData = {'TestGroupId':testGroupId};
			if(personId != undefined)
				postData['Person'] = {id:personId};
			jQuery.ajax({
				url: '/patients/testHistory',
				data:postData,
				type: 'POST',
				dataType : 'json',
				asynch:false,
				success:function(data){
									
					jQuery('#'+divid+' table thead').empty();
					tr = '<tr><th>Laboratory</th><th>Date</th>';
					jQuery.each(data.tests,function(x,y){
						tr += '<th>'+y+'</th>';
					});
					jQuery('#'+divid+' table thead').append(tr);

					tr = "";
					jQuery('#'+divid+' table tbody').empty();
					jQuery.each(data.tabular,function(x,y){
						tr += "<tr>";
						tr += "<td>" + y.join('</td><td>')+'</td>';
						tr += "</tr>";
					});
					jQuery('#'+divid+' table tbody').append(tr);
					if(data.graph){
						if(patientGraph != undefined)
							patientGraph.destroy();
						patientGraph = drawGraph(divid+'_historyGraph',data.graph,data.max);
						
						jQuery('.'+divid+'_legend').empty();
//						replotGraph(patientGraph,data.graph,data.max);
						checkboxes= '';
						x=0;
						jQuery.each(data.tests,function(w,y){
							//jQuery('<div style="width:15px;height:12px;border:solid 1px;display:inline-block;background-color:'+graphs['historyGraph_'+'<?php echo $patientId."_".$testGroupId?>'].series[x].fillColor+';border-color:'+graphs['historyGraph_'+'<?php echo $patientId."_".$testGroupId?>'].series[x].fillColor+'"></div>').insertBefore(this);						
							checkboxes += '<div style="display:inline-block;margin-right:10px;border:solid 1px #aaa;padding: 2px 3px;"><input type="checkbox" class="'+x+'" style = "margin:0px;" checked />';
							checkboxes += '<div style="width:15px;height:12px;border:solid 1px;display:inline-block;background-color:'+patientGraph.series[x].fillColor+';border-color:'+patientGraph.series[x++].fillColor+'"></div>';
							checkboxes +='<label>'+y+'</label></div>';
							
						});
						jQuery('.'+divid+'_legend').append(checkboxes);
						
						jQuery('.'+divid+'_legend input').click(function(){
							seriesIndex = jQuery(this).attr('class');
							if(jQuery(this).is(':checked'))
								patientGraph.series[seriesIndex].showLine = true;
							else
								patientGraph.series[seriesIndex].showLine = false;

							patientGraph.redraw();
							
						});
					}
				}
			});	
		}
