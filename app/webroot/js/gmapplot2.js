/*
 * Google Map Plot
 */

(function($) {
	
    var settings;
    
//	var map;
//	var items = [];
//	var $.fn.gmapplot.obj.geocoder;
//	var $.fn.gmapplot.obj.addTable, $.fn.gmapplot.obj.addTableBody;
//	var $.fn.gmapplot.obj.lngSpan, $.fn.gmapplot.obj.latSpan;
//	var $.fn.gmapplot.obj.locationListDiv;
//	var $.fn.gmapplot.obj.locationDiv;
//	var $.fn.gmapplot.obj.locationsDiv;
//	var upImage;
//	var downImage;
//	var $.fn.gmapplot.obj.locationButtons;
    
	var methods = {
			
    	    init : function( options , locations ) { 
    	    	if(locations == undefined)
    	    		locations = [];
    	    	$.fn.gmapplot.obj = {};
    	    	items = [];
    	    	
    	    	settings = $.extend(true,{
			      selectable_location       : false,
			      list_location				: false,
			      list_location_title		: "Plotted Locations",
			      resizable:false,
			      mapOptions				:{
					  zoom						: 15,
				      mapTypeId 				: google.maps.MapTypeId.ROADMAP
				  },
				  lngInputAttr				:{ 
					  'class':'current-lng-tb',
					  readonly:'readonly',
					  style:'border:solid 1px #999;width:80px;padding:2px;background-color: #fbf2ce;border: 1px solid #bbaf9b;'
				  },
				  latInputAttr				:{ 
					  'class':'current-lat-tb',
					  readonly:'readonly',
					  style:'border:solid 1px #999; width:80px;padding:2px;background-color: #fbf2ce;border: 1px solid #bbaf9b;'
				  }
			    }, options);
				
				upImage = '<img src="https://maps.gstatic.com/mapfiles/arrow-up.png" draggable="false" style="-webkit-user-select: none; top: -10; border: 0px; padding: 0px; margin: 0px 0px 6px 0px;width: 7px; height: 4px;">';
				downImage = '<img src="https://maps.gstatic.com/mapfiles/arrow-down.png" draggable="false" style="-webkit-user-select: none; top: -10; border: 0px; padding: 0px; margin: 0px 0px 6px 0px;width: 7px; height: 4px;">';
				
				return this.each(function() {
					
					$(this).html('<div style="width:100%;height:100%;" class="gmapplot-target-area"></div>');
					
					//if(locations == undefined)
			    	//	locations = [];
					
					//if($.fn.gmapplot.obj.locationButtons == undefined)
					//	$.fn.gmapplot.obj.locationButtons = [];

			    	if(locations.length && checkCoords(locations[0])){
			    		cntr = new google.maps.LatLng(locations[0].lat, locations[0].lng);
			    	}else
			    		cntr = new google.maps.LatLng(14.636739,121.050625);

			    	settings.mapOptions.center = cntr;
				 	
			    	$.fn.gmapplot.obj.map = new google.maps.Map($(this).find('.gmapplot-target-area').get(0),settings.mapOptions);
				 	
			    	$.fn.gmapplot.obj.geocoder = new google.maps.Geocoder();
			    	itemInfoWindow = new google.maps.InfoWindow();
			    	
			    	if(locations.length)
			    		methods.plot(locations);
			    	
			    	if(settings.selectable_location){
			    		$.fn.gmapplot.obj.addTable = $('<table />',{ id:'addresses',style:'height:50px;max-height:50px;'});
			    		$.fn.gmapplot.obj.addTableBody = $('<tbody />',{ style:'overflow:auto;height:50px;max-height:50px;width:100%;max-width:100%;display:block'});
			    		$(this).append($.fn.gmapplot.obj.addTable);
			    		$.fn.gmapplot.obj.addTable.append($.fn.gmapplot.obj.addTableBody);
			    		$.fn.gmapplot.obj.addTable.wrap('<div style="width:100%;bottom:80px;position:relative;height:50px; hidden;background: #fffae4;border: 1px solid #aaa;"></div>');
			    		
			    		$.fn.gmapplot.obj.lngSpan = $('<input />',settings.lngInputAttr);
			    		$.fn.gmapplot.obj.latSpan = $('<input />',settings.latInputAttr);
			    		
			    		$(this).append($.fn.gmapplot.obj.lngSpan);
			    		$.fn.gmapplot.obj.lngSpan.wrap('<div style="width: 100%;bottom: 80px;position: relative;background: #fffae4;height: 25px;border: 1px solid #aaa;padding:0px;margin:0px;"></div>');
			    		$.fn.gmapplot.obj.lngSpan.parent().append($.fn.gmapplot.obj.latSpan);
			    		$('<label>',{text:'Lat:'}).insertBefore($.fn.gmapplot.obj.latSpan);
			    		$('<label>',{text:'Lng:'}).insertBefore($.fn.gmapplot.obj.lngSpan);
			    		
//			    		$.fn.gmapplot.obj.addTable.parent().resizable({
//			    			handles:'n'
//			    		});
			    	}
			    	if(settings.list_location){
			    		
			    		$.fn.gmapplot.obj.locationsDiv = document.createElement('div'); //$('<div />',{ id:'location_list_div',style:'width:200px;min-height:50px;'});
			    		$.fn.gmapplot.obj.locationsDiv.style.width = '180px';
			    		$.fn.gmapplot.obj.locationsDiv.style.background = '#fff';
			    		$.fn.gmapplot.obj.locationsDiv.style.margin = '4px 10px';
			    		$.fn.gmapplot.obj.locationsDiv.style['text-align'] = 'center';
			    		$.fn.gmapplot.obj.locationsDiv.style['box-shadow'] = "rgba(0, 0, 0, 0.398438) 0px 2px 4px"; 
			    		$.fn.gmapplot.obj.locationsDiv.style['-webkit-box-shadow'] = "rgba(0, 0, 0, 0.398438) 0px 2px 4px";
			    		
			    		titleDiv = document.createElement('div');//titleDiv = $('<div />',{id:'location_list_title',style:'width:95%;height:50px;border:solid 1px;'});
			    		titleDiv.style.width = '99%';
			    		titleDiv.style.height = '15px';
			    		titleDiv.style.padding = '1px';
			    		titleDiv.style.border = '1px solid #888';
			    		titleDiv.innerHTML = '<strong>'+settings.list_location_title+'</strong>';
			    		titleDiv.style['background'] = "-webkit-linear-gradient(top,rgb(255,255,255),rgb(230,230,230))"; 
			    		
			    		$.fn.gmapplot.obj.locationListDiv = document.createElement('div');
			    		$.fn.gmapplot.obj.locationListDiv.style.width = '99%';
			    		$.fn.gmapplot.obj.locationListDiv.style.padding = '3px';
			    		$.fn.gmapplot.obj.locationListDiv.style.display = 'none';
			    		$.fn.gmapplot.obj.locationListDiv.style['min-height'] = '50px';
			    		$.fn.gmapplot.obj.locationListDiv.style['max-height'] = ($(this).height()- 60) +'px';
			    		$.fn.gmapplot.obj.locationListDiv.style['overflow'] = 'auto';
			    		$.fn.gmapplot.obj.locationListDiv.style['overflow-x'] = 'none';
			    		$.fn.gmapplot.obj.locationListDiv.align = 'center';
			    		
			    		buttonDiv = document.createElement('div');
			    		buttonDiv.style.width = '99%';
			    		buttonDiv.style.height = '8px';
			    		buttonDiv.style.padding = '1px';
			    		buttonDiv.style.border = '1px solid #888';
			    		buttonDiv.style.background = '#fff';
			    		buttonDiv.innerHTML = downImage;
			    		buttonDiv.style.cursor = 'pointer';
			    		buttonDiv.style['background'] = "-webkit-linear-gradient(top,rgb(255,255,255),rgb(230,230,230))"; 
			    		
			    		$.fn.gmapplot.obj.locationDiv = document.createElement('div');
			    		$.fn.gmapplot.obj.locationDiv.style.width = '90%';
			    		$.fn.gmapplot.obj.locationDiv.style['overflow'] = 'hidden';
			    		$.fn.gmapplot.obj.locationDiv.style['white-space'] = 'nowrap';
			    		$.fn.gmapplot.obj.locationDiv.style['text-overflow'] = 'ellipsis';
			    		$.fn.gmapplot.obj.locationDiv.style.border = '1px #ccc solid';
			    		$.fn.gmapplot.obj.locationDiv.style.height = '15px';
			    		$.fn.gmapplot.obj.locationDiv.style.padding = '1px 1px';
			    		$.fn.gmapplot.obj.locationDiv.style.margin = '1px';
			    		$.fn.gmapplot.obj.locationDiv.style.cursor = 'pointer';
			    		$.fn.gmapplot.obj.locationDiv.style['text-align'] = 'left';
			    		$.fn.gmapplot.obj.locationDiv["class"] = "location-btn";
			    		$.fn.gmapplot.obj.locationDiv.innerHTML = "Heart Center";
			    		
			    		google.maps.event.addDomListener(buttonDiv, 'click', function() {
			    			if($.fn.gmapplot.obj.locationListDiv.style.display == 'none'){
			    				//$($.fn.gmapplot.obj.locationListDiv).slideDown('slow');
			    				$.fn.gmapplot.obj.locationListDiv.style.display = 'block';
			    				buttonDiv.innerHTML = upImage;
			    			}else{
			    				//$($.fn.gmapplot.obj.locationListDiv).slideUp('slow');
			    				$.fn.gmapplot.obj.locationListDiv.style.display = 'none';
			    				buttonDiv.innerHTML = downImage;
			    			}
			    		});
			    		
			    		
			    		
			    		$.fn.gmapplot.obj.locationsDiv.appendChild(titleDiv);
			    		$.fn.gmapplot.obj.locationsDiv.appendChild($.fn.gmapplot.obj.locationListDiv);
			    		$.fn.gmapplot.obj.locationsDiv.appendChild(buttonDiv);
			    		
			    		$.fn.gmapplot.obj.locationListDiv.appendChild($.fn.gmapplot.obj.locationDiv);
			    		$.fn.gmapplot.obj.map.controls[google.maps.ControlPosition.TOP_RIGHT].push($.fn.gmapplot.obj.locationsDiv);
			    		
			    	}
			    	if(settings.resizable){
				    	$(this).resizable({
				    		maxHeight: $(this).height()* 2,
				    		maxWidth: $(this).width() *2,
				    		minHeight: $(this).height(),
				    		minWidth: $(this).width()
				    	});
				    	
			    	}
			    	$(this).resize(function(){
			    		if(settings.resizable)
			    			google.maps.event.trigger($.fn.gmapplot.obj.map, "resize");
			    		$.fn.gmapplot.obj.locationListDiv.style['max-height'] = ($(this).height()- 60) +'px';
			    	});
			    });
			},
    	    
    	    hide_selectable_location : function(){
    	    	settings.selectable_location = false;

    	    	if($.fn.gmapplot.obj.addTable != undefined){
	    	    	$.fn.gmapplot.obj.addTable.parent().hide();
	    	    	$.fn.gmapplot.obj.lngSpan.parent().hide();
	    	    	$.fn.gmapplot.obj.addTableBody.empty();
    	    	}
    	    	
    	    },
    	    
    	    show_selectable_location : function(){
    	    	
    	    	$.fn.gmapplot.obj.addTable.parent().show();
    	    	$.fn.gmapplot.obj.lngSpan.parent().show();
    	    	settings.selectable_location = true;
    	    	
    	    },
    	    
    	    select_address : function(){
    	    	
    	    	index = jQuery(this).attr('id');
    	    	
    	    	$.each(items,function(x,y){
    	    		
    	    		y.Marker.setVisible(false);
    	    		
    	    	});
    	    	
    	    	items[index].Marker.setVisible(true);
    	    	position = items[index].Marker.getPosition();
    	    	methods.set_input_latLng(position);
    	    	$.fn.gmapplot.obj.map.setCenter(position);
    	    	
    	    },
    	    set_input_latLng: function(position){
    	    	$.fn.gmapplot.obj.lngSpan.val(position.lng());
    	    	$.fn.gmapplot.obj.latSpan.val(position.lat());
    	    },
    	    set_location_list : function ( locations ){
    	    	$($.fn.gmapplot.obj.locationListDiv).empty();
    	    	$.each(locations,function(x,y){
    	    		$.fn.gmapplot.obj.locationButtons[x] = $.fn.gmapplot.obj.locationDiv.cloneNode(true);
    	    		$.fn.gmapplot.obj.locationButtons[x].innerHTML = y.title;
    	    		$.fn.gmapplot.obj.locationButtons[x].title = y.title;
    	    		$.fn.gmapplot.obj.locationButtons[x].setAttribute('name',x);
		    		$.fn.gmapplot.obj.locationListDiv.appendChild($.fn.gmapplot.obj.locationButtons[x]);
		    		
		    		google.maps.event.addDomListener($.fn.gmapplot.obj.locationButtons[x], 'click', function() {
		    			x = $(this).attr('name');
		    			$.fn.gmapplot.obj.map.setCenter(items[x].Marker.getPosition());
		    			google.maps.event.trigger(items[x].Marker, 'click');
		    		});
    	    	});
    	    	$.fn.gmapplot.obj.locationListDiv.style.height = ($.fn.gmapplot.obj.locationButtons.length * 22)+'px';
    	    },
    	    set_selection : function ( locations ){
    	    	$.fn.gmapplot.obj.addTableBody.empty();
    	    	tr = '';
    	    	$.each(locations,function(x,y){
    	    		tr += '<tr class="address_result_'+x+'" title="'+y.content+'">';
    	    		tr += '<td style="padding:1px;border:solid 1px #aaa;"><input type="radio" name="address-results" class="address-result-radio" id="'+x+'" /></td>';
    	    		tr += '<td style=" font-size: 11px;padding:1px;border:solid 1px #aaa;width:100%;max-width:100%;"><div style="overflow:hidden;max-height:15px;">'+y.content+'</div> </td>';
    	    		tr += '</tr>';
    	    	});
    	    	$.fn.gmapplot.obj.addTableBody.append(tr);
    	    	$('.address-result-radio').bind('click', methods.select_address);
    	    	$('.address-result-radio:first').click();
    	    },
    	    clear_locations : function(){
    	    	if(items.length){
    	    		$.each(items,function(x,y){
//    	    			map.removeOverlay(y.Marker);
    	    			google.maps.event.clearListeners(y.Marker);
    	    			y.Marker.setMap(null);
    	    		});
    	    		delete items;
    	    	}
    	    },
    	    plot : function( locations ) {
    	    	
    	    	methods.clear_locations();
    	    	var lat,lng;
    	    	items = [];
    	    	$.each( locations , function(x,y){
    	    		
    	    		if(checkCoords(y)){
    	        		lat = y.lat;
    	        		lng = y.lng;
    	    		}else
    	    			return true;
    	    		
    	    		if(y.color == undefined)
    	    			y.color = 'red';
    	    		if(y.visibility == undefined)
    	    			y.visibility = true;
    	    		if(y.hasInfoWindow == undefined)
    	    			y.hasInfoWindow = true;
    	    		
    	    		items[x] = {};
    	    		items[x].Raw = y;
    	    		items[x].Marker = new google.maps.Marker({
    	    			position: new google.maps.LatLng(lat,lng),
    	    			title:y.title,
//    	    			icon: new google.maps.MarkerImage(
//	    				    'http://maps.google.com/intl/en_us/mapfiles/ms/micons/'+y.color+'-dot.png',
//	    				    new google.maps.Size(30, 30),
//	    				    new google.maps.Point(0, 0),
//	    				    new google.maps.Point(0, 24)
//	    				),
    	    			draggable: y.draggable
	    			});
    	    		items[x].Marker.setMap($.fn.gmapplot.obj.map);
    	    		
    	    		items[x].Marker.setVisible(y.visibility);
    	    		
    	    		if(y.hasInfoWindow)
	    	    		google.maps.event.addListener(items[x].Marker, 'click', function(){
	    	    			itemInfoWindow.close();
	    	    			itemInfoWindow.setContent('<p style="color:#000;">'+y.content+'</p>');
	    	    			itemInfoWindow.open($.fn.gmapplot.obj.map,items[x].Marker);
	    	    		});
    	    		
    	    		if(y.draggable)
    	    			google.maps.event.addListener(items[x].Marker, 'dragend', function() {
    	    				methods.set_input_latLng(items[index].Marker.getPosition());
    	    			});
    	    		
    	    	});
    	    	if(lat != undefined && lng != undefined)
    	    		$.fn.gmapplot.obj.map.setCenter(new google.maps.LatLng(lat,lng));
    	    	
    	    	if(settings.selectable_location)
    	    		methods.set_selection( locations );
    	    	
    	    	if(settings.list_location)
    	    		methods.set_location_list( locations );
    	    },
    	    locate : function( address ){
    	      $.fn.gmapplot.obj.geocoder.geocode( { 'address': address}, function(results, status) {
    	          if (status == google.maps.GeocoderStatus.OK){
    	        	locations = [];
    	        	$.each(results,function(a,b){
    	        		address = [];
    	    	        $.each(results[a].address_components,function(c,d){
    	    	        	address[c] = d['long_name'];
    	    	        });
    	    	        locations[locations.length] = {
	    	    	        lat : results[a].geometry.location.lat(),
	    	    	        lng : results[a].geometry.location.lng(),
	    	    	        title : 'Result '+ (a+1),
	    	    	        content : address.join(', '),
	    	    	        visibility: false,
	    	    	        hasInfoWindow:false,
	    	    	        draggable:true
	    	    	    };
    	    	        $.fn.gmapplot.obj.map.setCenter(results[a].geometry.location);
    	    	    });
    	        	methods.plot( locations );
    	        	
    	          } else {
    	        	  alert("Geocode was not able to locate '"+address+"' \nReason:" + status);
    	          }
    	        });
    	    },
    	    plot_location : function( location ) { 
    	    	
    	    }
    	  };
	
    var checkCoords = function(item){
    	if(item.lat != undefined && !isNaN(parseFloat(item.lat)) && item.lng != undefined && !isNaN(parseFloat(item.lng)))
    		return true;
    	return false;
    };
	
	$.fn.gmapplot = function( method ) {
	    
	    // Method calling logic
	    if ( methods[method] ) {
	      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
	    } else if ( typeof method === 'object' || ! method ) {
	      return methods.init.apply( this, arguments );
	    } else {
	      $.error( 'Method ' +  method + ' does not exist on $.gmapplot' );
	    }    
	  
	  };	
 
})(jQuery);