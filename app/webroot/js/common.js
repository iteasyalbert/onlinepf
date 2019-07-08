//[
// 	[
// 	 	["October 10,2012","3"]
// 	],
// 	[
// 	 	["October 10,2012","4"]
// 	],
// 	[
// 	 	["October 10,2012","5"]
// 	]
//]
//array(
//	array(
//		array(
//			x,y
//		)
//	)
//)
function camelize(string){
	result = '';
	strarr = string.split('_');
	jQuery.each(strarr,function(x,y){
		result += y.toUpperCase().charAt(0) + y.substring(1);
		});
	return result;
}
function validateForm(formid,exceptions){
	
	result = true;
	jQuery('#'+formid+' input,textare,select').each(
		function(){
			expresult = false;
			try{
				eval('expresult = '+exceptions);
			}catch(e){
				
			}
			if(!expresult)
				if(jQuery(this).val().length == 0){
//					alert('\n'+expresult+'\n'+jQuery(this).parents('table').parents('tr').attr('class')+'\n'+exceptions);
					result = false;
					return false;
				}
		}
	);
	return result;
}

reindexorder = function(selector){
	jQuery(selector).each(function(x,y){
		jQuery(this).find('input, select, textarea').each(function(){
			name = jQuery(this).attr('name');
			name = name.replace(/\[(\d)+?\]/,'['+x+']'); // test regex, unreliable
			jQuery(this).attr('name',name);
		});
	});
};

function emptyForm(id){
	jQuery('#'+id).find('input:not(input[type=hidden]), select, textare').each(function(){
		jQuery(this).val('');
	});
}

function generateId(pattern){
	randomDigits = (Math.floor(Math.random()*10000000000)).toString()+(Math.floor(Math.random()*10000000000)).toString();
	patterns = pattern.split('-');
	tempids = [];
	ind = 0;
	jQuery.each(patterns,function(x,y){
		tempids[x] = randomDigits.substring(ind,(ind+=parseInt(y)));
	});
	return tempids.join('-');
	//return randomDigits.match(new RegExp("(\d{5})(\d{3})(\d{6})"));///);//new RegExp("^?\\d{5}$"));
}

function getOffsetPosition(elem) {
	  var top=0, left=0;

	  while(elem) {
	    top = top + parseInt(elem.offsetTop);
	    left = left + parseInt(elem.offsetLeft);
	    elem = elem.offsetParent ;       
	  }
	  return {top: top, left: left};
	   
	}

function clearLabel(){
	jQuery('.labeled').each(function(x,y){
		if(jQuery(this).val() == jQuery(this).attr('title')){
			jQuery(this).val('');
		}
	});	
}

function setLabel(){
	jQuery('.labeled').each(function(x,y){
		if(jQuery(this).val() == ''){
			jQuery(this).val(jQuery(this).attr('title'));
		}
	});	
}
function autoCompleteCompany(){
	$(function () {
    'use strict';
//    autoCompleteCompany();
    // Load countries then initialize plugin:
    $.ajax({
        url: '/users/getCompanies',
        dataType: 'json'
    }).done(function (data) {

        var countriesArray = $.map(data, function (value, key) { return { value: value, data: key }; }),
            countries = $.map(data, function (value) { return value; });

        // Setup jQuery ajax mock:
        $.mockjax({
            url: '*',
            responseTime:  200,
            response: function (settings) {
                var query = settings.data.query,
                    queryLowerCase = query.toLowerCase(),
                    suggestions = $.grep(countries, function(country) {
                         return country.toLowerCase().indexOf(queryLowerCase) !== -1;
                    }),
                    response = {
                        query: query,
                        suggestions: suggestions
                    };
                this.responseText = JSON.stringify(response);
            }
        });

        // Initialize ajax autocomplete:
        $('.autocomplete-ajax').autocomplete({
        	lookup: countriesArray,
        	serviceUrl:'/Common/json',
			minChars:'2',
            onSelect: function(suggestion) {
                $('#selction-ajax').html('You selected: ' + suggestion.value + ', ' + suggestion.data);
                $('input.comid').val(suggestion.data);
            }
        });
        
    });

});
}

jQuery(document).ready(function(){
	
//	//Leave or reload page warning
//    window.onbeforeunload = function() {
//   	 var browserName = getBrowser();
//        if(browserName == 'Firefox') {
//            return "";
//        }else if(browserName == 'Chrome') {
//       	 return "Data you have entered may not be saved.";
//        }else if(browserName == 'Safari') {
//       	 return "";
//        }else if(browserName == 'Explorer') {
//       	 return "";
//        }else if(browserName == 'Opera') {
//       	 return "";
//        }
//    }

	
//	jQuery('div.error-message').css('display','none');
//	jQuery('.input.text.required.error').removeClass().addClass('input text');
	/*
	jQuery('.flashClose').on('click','a',function() {
		jQuery('#flashMessage').fadeOut(1000);
		jQuery('flashMessage').hide();
	  });
	*/
	var flashMessage = jQuery('div#flashMessage').text();
	if(flashMessage == 'Incorrect captcha'){
		jQuery('input#recaptcha_response_field').focus();
	}
//	var errorText = jQuery('form#UserSignUpForm div.error-message').text();
	var errorText = jQuery('div.error-message').text();
	if(errorText){
		var divFlashError = '<div id="flashMessage" class="message">'+errorText+'</div>';
		jQuery('div.flasherrormesage').html(divFlashError);

	}

//	alert(flashMessage);
	if(jQuery(".datepicker").length)
		jQuery(".datepicker").datepicker({
			dateFormat:'yy-mm-dd',
			changeMonth:true,
			changeYear:true,
			yearRange: '1920:+2020',
			beforeShow:function(){
				jQuery('#ui-datepicker-div').removeClass("ui-helper-hidden-accessible");
			}
		});
	
	
	labels = [];
	jQuery('.labeled').each(function(x,y){
		labels[x] = jQuery(this).attr('title');
		jQuery(this).bind('focus',function(){
			if(jQuery(this).val() != labels[x] && jQuery(this).val() != ''){
				//do nothing
			}else{
				jQuery(this).val('');
			}
		});
		
		jQuery(this).bind('change',function(){
			if(jQuery(this).val() == ''){
				jQuery(this).val(labels[x]);
			}
		});
		
		jQuery(this).bind('blur',function(){
			if(jQuery(this).val() == ''){
				jQuery(this).val(labels[x]);
			}
		});

	});
	
	//address selections
	var addressSelectLen = jQuery('.address_select').length;
	
	jQuery('.address_select').change(function(){
			formClass = jQuery(this).parents('form').attr('class');
			if(jQuery(this).is("select")){
				index = parseInt(jQuery(this).attr('title').replace('address_select_',''));
				if(index < addressSelectLen){
					index++;
					//clear dependent address fields
					for(i=index; i<= addressSelectLen;i++){
						jQuery('.'+formClass+' select[title=address_select_'+i+']').empty();
						jQuery('.'+formClass+' select[title=address_select_'+i+']').append('<option value=""></option>');
						}
	
					jQuery.ajax({
						url: '/Addresses/getList',
						data:{'Address':{
								'hierarchy':index,
								'parent_id':jQuery(this).val()
							}
						},
						type: 'POST',
						dataType : 'json',
						success:function(data){
							if(data){
								jQuery.each(data['List'],function(x,y){
									jQuery.each(y,function(w,z){
										jQuery('.'+formClass+' select[title=address_select_'+data['Hierarchy'][x]+']').append('<option value="'+w+'">'+z+'</option>');
									});
								});
							}else{
								alert('Unable to retrieve '+addressInfo[index].model+'s');
							}
						}
					});
				}
			}
			
		});


	
});

function drawGraph(id,data,maxValue){
	return jQuery.jqplot(id, data , {
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
		        	max:setTenths(maxValue)
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
}
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
function replotGraph(graph,data,maxValue){
//	xTicks = [];
//	len = graph.series.length;
//	jQuery.each(data,function(x,y){
//		if(x >= len){
//			graph.series[x] = graph.series[0];
//		}
//		graph.series[x].data = [];
//		jQuery.each(data[x],function(w,z){
//			graph.series[x].data[w] = [];
//			graph.series[x].data[w][0] = w+1;
//			graph.series[x].data[w][1] = data[x][w][1];
//			xTicks[w] = data[x][w][0];
//		});
//	});
//	graph.axes.yaxis.max = setTenths(maxValue);
//	graph.axes.xaxis.ticks = xTicks;
//	graph.replot();
	graph.data = data;
	graph.init();
	
}

function locateAddress(){

	address_fields = [];
	jQuery('.address_field').each(function(x,y){
		if(jQuery(this).is('select'))
			address_fields[x] = jQuery(this).find(':selected').text();
		else
			address_fields[x] = jQuery(this).val();
			
	});

	address_fields = address_fields.filter(function(element){ return element.length;});
	address_fields.reverse();
	address = address_fields.join(', ');

	return address;

}

function fillSelect(selector,options){
		
	jQuery(selector).empty();
	option = '';
	jQuery.each(options,function(x,y){
		option += '<option value="'+x+'">';
		option += y;
		option += '</option>';
	});
	jQuery(selector).append(option);
}
function xmlForm(formSelector,destination, handler){
	
	var formData = new FormData(jQuery(formSelector)[0]);
	 
	if(window.XMLHttpRequest)
		xmlhttp=new XMLHttpRequest();
	else
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	
	xmlhttp.open("POST", destination, true);

	xmlhttp.setRequestHeader("X_REQUESTED_WITH", "XMLHttpRequest");
		
	xmlhttp.onreadystatechange = handler;
	
	xmlhttp.send(formData);
}

updateImagePreview = function(event){
	uploadType = 2;
	files = event.target.files;
	for (var i = 0, f; f = files[i]; i++) {
      if (!f.type.match('image.*')) {
        continue;
      }
      var reader = new FileReader();
      reader.onload = (function(theFile) {
        return function(e) {
        	datauri = e.target.result;
        	jQuery.each(event.data.selectors,function(x,y){
            	jQuery(y).attr('src',datauri);
        	});

//        	jQuery('#idpic').attr('src',datauri);
//       	jQuery('#dt-login-form #side_id_pic').attr('src',datauri);
        };
      })(f);
      reader.readAsDataURL(f);
	}
};

function addVerticalScrollBar(id){
	$scrollable = jQuery('#'+id);
	pos = $scrollable.position();
	vheight = $scrollable.get(0).scrollHeight;
	height = $scrollable.height();

	rate = parseFloat(height/vheight);

	dbheight = parseFloat(height * (rate));


	
	$dragbar = jQuery("<div id='dragbar' class='draggable_vertical_bar'></div>");

	$scrollbar = jQuery("<div class='vertical_bar column'></div>");
	$scrollbar.append($dragbar);

	$dragbar.css({
		'height':dbheight+"px",
		'top':0
	});
	
	$scrollbar.css({
		'left': pos.left + $scrollable.width(),
		'top': pos.top,
		'height': $scrollable.height(),
		'opacity': 0.5
		}
	);

	$scrollbar.css({
		'left': pos.left + $scrollable.width(),
		'top': pos.top,
		'height': $scrollable.height(),
		'opacity': 0.5
		}
	);
	
	$scrollable.css({
		'padding-right':'10px',
		'width':$scrollable.width() - 20
		}
	);
	$scrollable.append($scrollbar);
	vbheight = $scrollbar.height();

	
	$scrollable.scroll(setDragBar);

	sboff = $scrollbar.offset();

	jQuery('#dragbar').draggable({
		containment: "parent",//[sboff.left + 4,sboff.top + 4,sboff.left+10 -4 ,sboff.top + height - dbheight -4]
		start:function(){
			$scrollable.unbind("scroll");
		},
		drag: function(){
			dbtop = jQuery(this).position().top;
			if(dbtop > 0){
				dragrate = dbtop/vbheight;
				scrollTop = vheight * dragrate;
				$scrollable.scrollTop(scrollTop);
			} else {
				$dragbar.trigger('mouseup');
				$dragbar.offset({top:0});
			}
		},
		stop:function(){
			$scrollable.scroll(setDragBar);
		}
	});
			
	function setDragBar(){
		scrollRate = jQuery(this).scrollTop() / vheight;
		scrollRate *= vbheight;
		$dragbar.css({
			'top': scrollRate
		});
	}
	//YQL Checking of URL
	function checkUrl(url) {
		url = url.trim();
		
		$.getJSON("http://query.yahooapis.com/v1/public/yql?"+
	            "q=select%20*%20from%20html%20where%20url%3D%22"+
	            encodeURIComponent(url)+
	            "%22&format=xml'&callback=?",
	    function(data){
	      if(data.results[0]){
		      alert('Url exist');
		      return data.results[0];
	        // do whatever
	      }else{
		      alert('Url not exist');
		      return data.results[0];
	      }
	    }
  		);
	}
	function isValidURL(url){
	    var RegExp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;

	    if(RegExp.test(url)){
	        return true;
	    }else{
	        return false;
	    }
	}

}

function showLoadingMask(message){
	if(message == null)
		message = "Retrieving data, please wait..";

	jQuery("#flash").show();
    jQuery("#overlay").fadeIn(100);
    jQuery("#flash").fadeIn(100).html('<table style="position:fixed;top:300px;"><tr><td style="background: none; border: none;"><img src="/img/loading.gif" align="absmiddle" style="float: left;">&nbsp;</td><td style="background: none; border: none;"><span style="font-weight: bold; font-size: 15px; color: white; padding-top: 3px;">'+message+'</span></td></tr></table>');
    
}

function hideLoadingMask(){
	
	jQuery("#flash").stop().fadeOut();
    jQuery("#overlay").stop().fadeOut();
    
}
function flashErrorMessage(message){
	jQuery('#flashMessage').empty();
    $("#flash").stop().fadeOut();
    $("#overlay").stop().fadeOut();
    
    jQuery('#flashMessage').attr('class','error_message');
    jQuery('#flashMessage').append(message+'<a class="flashClose" style="float:right;margin-right:5%;color:white;cursor:pointer;font-weight:bold;">X</a>');
    jQuery("#flashMessage").fadeIn(700, function() {
        $(this).show();
    });
//    jQuery("#flashMessage").hide();
    return true;
}
function flashSuccessMessage(message){
   	 jQuery('#flashMessage').empty();
     $("#flash").stop().fadeOut();
     $("#overlay").stop().fadeOut();
     jQuery('#flashMessage').attr('class','success_message');
     jQuery('#flashMessage').append(message+'<a class="flashClose" style="float:right;margin-right:5%;color:white;cursor:pointer;font-weight:bold;">X</a>');
     jQuery("#flashMessage").fadeIn(1000, function() {
         $(this).show();
     });
//     jQuery("#flashMessage").hide();
     return true;
}
function isValidContactDetail(input,type){
	var value = false;
	if(type == 1 || type == 3){
		value = IsPhone(input);
	}else if(type == 2){
		value = IsMobile(input);
	}else if(type == 4){
		value = IsEmail(input);
	}
	
	return value;
	
}

function IsEmail(email) {
	  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}
function IsMobile(mobile) {
    var pattern = /^([0-9]{10,11})+$/;
    if (pattern.test(mobile)) {
        return true;
    } 
        return false;
}
function IsPhone(phone) {
    var pattern = /^([0-9\-\+]{7,15})+$/;
    if (pattern.test(phone)) {
        return true;
    } 
        return false;
}
function getBrowser(){
	var BrowserDetect = {
			init: function () {
				this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
				this.version = this.searchVersion(navigator.userAgent)
					|| this.searchVersion(navigator.appVersion)
					|| "an unknown version";
				this.OS = this.searchString(this.dataOS) || "an unknown OS";
			},
			searchString: function (data) {
				for (var i=0;i<data.length;i++)	{
					var dataString = data[i].string;
					var dataProp = data[i].prop;
					this.versionSearchString = data[i].versionSearch || data[i].identity;
					if (dataString) {
						if (dataString.indexOf(data[i].subString) != -1)
							return data[i].identity;
					}
					else if (dataProp)
						return data[i].identity;
				}
			},
			searchVersion: function (dataString) {
				var index = dataString.indexOf(this.versionSearchString);
				if (index == -1) return;
				return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
			},
			dataBrowser: [
				{
					string: navigator.userAgent,
					subString: "Chrome",
					identity: "Chrome"
				},
				{ 	string: navigator.userAgent,
					subString: "OmniWeb",
					versionSearch: "OmniWeb/",
					identity: "OmniWeb"
				},
				{
					string: navigator.vendor,
					subString: "Apple",
					identity: "Safari",
					versionSearch: "Version"
				},
				{
					prop: window.opera,
					identity: "Opera",
					versionSearch: "Version"
				},
				{
					string: navigator.vendor,
					subString: "iCab",
					identity: "iCab"
				},
				{
					string: navigator.vendor,
					subString: "KDE",
					identity: "Konqueror"
				},
				{
					string: navigator.userAgent,
					subString: "Firefox",
					identity: "Firefox"
				},
				{
					string: navigator.vendor,
					subString: "Camino",
					identity: "Camino"
				},
				{		// for newer Netscapes (6+)
					string: navigator.userAgent,
					subString: "Netscape",
					identity: "Netscape"
				},
				{
					string: navigator.userAgent,
					subString: "MSIE",
					identity: "Explorer",
					versionSearch: "MSIE"
				},
				{
					string: navigator.userAgent,
					subString: "Gecko",
					identity: "Mozilla",
					versionSearch: "rv"
				},
				{ 		// for older Netscapes (4-)
					string: navigator.userAgent,
					subString: "Mozilla",
					identity: "Netscape",
					versionSearch: "Mozilla"
				}
			],
			dataOS : [
				{
					string: navigator.platform,
					subString: "Win",
					identity: "Windows"
				},
				{
					string: navigator.platform,
					subString: "Mac",
					identity: "Mac"
				},
				{
					   string: navigator.userAgent,
					   subString: "iPhone",
					   identity: "iPhone/iPod"
			    },
				{
					string: navigator.platform,
					subString: "Linux",
					identity: "Linux"
				}
			]

		};
		BrowserDetect.init();

		return BrowserDetect.browser;
}
function getVersion(){
	var BrowserDetect = {
			init: function () {
				this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
				this.version = this.searchVersion(navigator.userAgent)
					|| this.searchVersion(navigator.appVersion)
					|| "an unknown version";
				this.OS = this.searchString(this.dataOS) || "an unknown OS";
			},
			searchString: function (data) {
				for (var i=0;i<data.length;i++)	{
					var dataString = data[i].string;
					var dataProp = data[i].prop;
					this.versionSearchString = data[i].versionSearch || data[i].identity;
					if (dataString) {
						if (dataString.indexOf(data[i].subString) != -1)
							return data[i].identity;
					}
					else if (dataProp)
						return data[i].identity;
				}
			},
			searchVersion: function (dataString) {
				var index = dataString.indexOf(this.versionSearchString);
				if (index == -1) return;
				return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
			},
			dataBrowser: [
				{
					string: navigator.userAgent,
					subString: "Chrome",
					identity: "Chrome"
				},
				{ 	string: navigator.userAgent,
					subString: "OmniWeb",
					versionSearch: "OmniWeb/",
					identity: "OmniWeb"
				},
				{
					string: navigator.vendor,
					subString: "Apple",
					identity: "Safari",
					versionSearch: "Version"
				},
				{
					prop: window.opera,
					identity: "Opera",
					versionSearch: "Version"
				},
				{
					string: navigator.vendor,
					subString: "iCab",
					identity: "iCab"
				},
				{
					string: navigator.vendor,
					subString: "KDE",
					identity: "Konqueror"
				},
				{
					string: navigator.userAgent,
					subString: "Firefox",
					identity: "Firefox"
				},
				{
					string: navigator.vendor,
					subString: "Camino",
					identity: "Camino"
				},
				{		// for newer Netscapes (6+)
					string: navigator.userAgent,
					subString: "Netscape",
					identity: "Netscape"
				},
				{
					string: navigator.userAgent,
					subString: "MSIE",
					identity: "Explorer",
					versionSearch: "MSIE"
				},
				{
					string: navigator.userAgent,
					subString: "Gecko",
					identity: "Mozilla",
					versionSearch: "rv"
				},
				{ 		// for older Netscapes (4-)
					string: navigator.userAgent,
					subString: "Mozilla",
					identity: "Netscape",
					versionSearch: "Mozilla"
				}
			],
			dataOS : [
				{
					string: navigator.platform,
					subString: "Win",
					identity: "Windows"
				},
				{
					string: navigator.platform,
					subString: "Mac",
					identity: "Mac"
				},
				{
					   string: navigator.userAgent,
					   subString: "iPhone",
					   identity: "iPhone/iPod"
			    },
				{
					string: navigator.platform,
					subString: "Linux",
					identity: "Linux"
				}
			]

		};
		BrowserDetect.init();

		return BrowserDetect.version;
}

function getWindowWidth(){
	var wwindow = jQuery(window).width();

	return wwindow;
}
function getWindowHeight(){
	var hwindow = jQuery(window).heigth();

	return hwindow;
}


//function isAcrobatReaderInstalled(){
//	var found = false;
//	var info = '';
//	try 
//	{    
//	    acrobat4 = new ActiveXObject('PDF.PdfCtrl.1');    
//	    if (acrobat4) 
//	    {      
//	        found = true;      
//	        info = 'v. 4.0';    
//	    }  
//	}  
//	catch (e) 
//	{
//	    //???
//	}
//	if (!found)
//	{
//	    try 
//	    {
//	        acrobat7 = new ActiveXObject('AcroPDF.PDF.1');
//	        if (acrobat7) 
//	        {
//	                found = true;
//	                info = 'v. 7+';
//	        }
//	    } 
//	    catch (e) 
//	    {
//	        //???
//	    }
//	    if (!found && navigator.plugins && navigator.plugins.length>0)
//	    {
//	        for (var i = 0; i<navigator.plugins.length; i++) 
//	        {                                               
//	                if (navigator.plugins[i].name.indexOf('Adobe Acrobat') > -1)
//	                {
//	                        found = true; 
//	                        info = navigator.plugins[i].description + ' (' + navigator.plugins[i].filename + ')';
//	                        break;
//	                }
//	        }
//	    }
//	}
//	if(!found){
//		var alertmsg = "Adobe Acrobat Reader not Installed. Please download and install latest version of Adobe Acrobat Reader to open and download your result. After Installation, Please Logout your account to refresh the page. Thank you!";
//		alert(alertmsg);
//		downloadAdobeReader();
//	}
////	if (found){ alertmsg = alertmsg+ '<br/>' + "Info : " + info;}
//
//}
//function downloadAdobeReader()
//{
//	window.open("http://get.adobe.com/reader/download/?installer=Reader_10.1.3_English_for_Windows&os=Windows%207&browser_type=Gecko&browser_dist=Firefox&a=McAfee_Security_Scan_Plus");
//}
