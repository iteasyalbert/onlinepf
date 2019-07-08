/*
 * Google Map Plot
 */

(function($) {
	
    var settings;
    var obj = {
		_map:null,
		_items:[],
		_geocoder:null,
		_addTable:null,
		_addTableBody:null,
		_lngSpan:null,
		_latSpan:null,
		_locationListDiv:null,
		_locationDiv:null,
		_locationsDiv:null,
		_upImage:null,
		_downImage:null,
		_locationButtons:null
	};
    
//	var obj._map;
//	var obj._items = [];
//	var obj._geocoder;
//	var obj._addTable, obj._addTableBody;
//	var obj._lngSpan, obj._latSpan;
//	var obj._locationListDiv;
//	var obj._locationDiv;
//	var obj._locationsDiv;
//	var obj._upImage;
//	var obj._downImage;
//	var obj._locationButtons;
    
	var methods = {
			
    	    init : function( options , locations ) { 
    	    	
    	    	if(locations == undefined)
    	    		locations = [];
    	    	
    	    	//if(obj._locationButtons == undefined)
    	    	//	obj._locationButtons = [];
    	    	//obj._items = [];
    	    	
    	    	settings = $.extend(true,{
			      selectable_location       : false,
			      list_location				: false,
			      list_location_title		: "Plotted Locations",
			      resizable:false,
			      mapOptions				:{
					  zoom					: 15,
				      mapTypeId 			: google.maps.MapTypeId.ROADMAP
				  },
				  lngInputAttr				:{ 
					  'class'				:'current-lng-tb',
					  readonly				:'readonly',
					  style					:'border:solid 1px #999;width:80px;padding:2px;background-color: #fbf2ce;border: 1px solid #bbaf9b;'
				  },
				  latInputAttr				:{ 
					  'class'				:'current-lat-tb',
					  readonly				:'readonly',
					  style					:'border:solid 1px #999; width:80px;padding:2px;background-color: #fbf2ce;border: 1px solid #bbaf9b;'
				  }
			    }, options);
				
				obj._upImage = '<img src="https://maps.gstatic.com/mapfiles/arrow-up.png" draggable="false" style="-webkit-user-select: none; top: -10; border: 0px; padding: 0px; margin: 0px 0px 6px 0px;width: 7px; height: 4px;">';
				obj._downImage = '<img src="https://maps.gstatic.com/mapfiles/arrow-down.png" draggable="false" style="-webkit-user-select: none; top: -10; border: 0px; padding: 0px; margin: 0px 0px 6px 0px;width: 7px; height: 4px;">';
				$this = this;
				this.data("gmapplot", $(this.get(0)).attr('id') );
				return this.each(function() {
					
					$(this).data('test',$(this).attr('id'));
					id = $(this).attr('id');

					setPrivateData("test",id);
					
					$(this).html('<div style="width:100%;height:100%;" class="gmapplot-target-area"></div>');
					
					if(locations == undefined)
			    		locations = [];
					
					if(obj._locationButtons == undefined)
						obj._locationButtons = [];

			    	if(locations.length && checkCoords(locations[0]))
			    		cntr = new google.maps.LatLng(locations[0].lat, locations[0].lng);
			    	else
			    		cntr = new google.maps.LatLng(14.636739,121.050625);

			    	settings.mapOptions.center = cntr;
				 	
			    	obj._map = new google.maps.Map($(this).find('.gmapplot-target-area').get(0),settings.mapOptions);
				 	
			    	obj._geocoder = new google.maps.Geocoder();
			    	itemInfoWindow = new google.maps.InfoWindow();
			    	
			    	if(locations.length)
			    		methods.plot(locations);
			    	
			    	if(settings.selectable_location){
			    		obj._addTable = $('<table />',{ id:'addresses',style:'height:50px;max-height:50px;'});
			    		obj._addTableBody = $('<tbody />',{ style:'overflow:auto;height:50px;max-height:50px;width:100%;max-width:100%;display:block'});
			    		$(this).append(obj._addTable);
			    		obj._addTable.append(obj._addTableBody);
			    		obj._addTable.wrap('<div style="width:100%;bottom:80px;position:relative;height:50px; hidden;background: #fffae4;border: 1px solid #aaa;"></div>');
			    		
			    		obj._lngSpan = $('<input />',settings.lngInputAttr);
			    		obj._latSpan = $('<input />',settings.latInputAttr);
			    		
			    		$(this).append(obj._lngSpan);
			    		obj._lngSpan.wrap('<div style="width: 100%;bottom: 80px;position: relative;background: #fffae4;height: 25px;border: 1px solid #aaa;padding:0px;margin:0px;"></div>');
			    		obj._lngSpan.parent().append(obj._latSpan);
			    		$('<label>',{text:'Lat:'}).insertBefore(obj._latSpan);
			    		$('<label>',{text:'Lng:'}).insertBefore(obj._lngSpan);
			    		
			    	}
			    	if(settings.list_location){
			    		
			    		obj._locationsDiv = document.createElement('div'); //$('<div />',{ id:'location_list_div',style:'width:200px;min-height:50px;'});
			    		obj._locationsDiv.style.width = '180px';
			    		obj._locationsDiv.style.background = '#fff';
			    		obj._locationsDiv.style.margin = '4px 10px';
			    		obj._locationsDiv.style['text-align'] = 'center';
			    		obj._locationsDiv.style['box-shadow'] = "rgba(0, 0, 0, 0.398438) 0px 2px 4px"; 
			    		obj._locationsDiv.style['-webkit-box-shadow'] = "rgba(0, 0, 0, 0.398438) 0px 2px 4px";
			    		
			    		titleDiv = document.createElement('div');//titleDiv = $('<div />',{id:'location_list_title',style:'width:95%;height:50px;border:solid 1px;'});
			    		titleDiv.style.width = '99%';
			    		titleDiv.style.height = '15px';
			    		titleDiv.style.padding = '1px';
			    		titleDiv.style.border = '1px solid #888';
			    		titleDiv.innerHTML = '<strong>'+settings.list_location_title+'</strong>';
			    		titleDiv.style['background'] = "-webkit-linear-gradient(top,rgb(255,255,255),rgb(230,230,230))"; 
			    		
			    		obj._locationListDiv = document.createElement('div');
			    		obj._locationListDiv.style.width = '99%';
			    		obj._locationListDiv.style.padding = '3px';
			    		obj._locationListDiv.style.display = 'none';
			    		obj._locationListDiv.style['min-height'] = '50px';
			    		obj._locationListDiv.style['max-height'] = ($(this).height()- 60) +'px';
			    		obj._locationListDiv.style['overflow'] = 'auto';
			    		obj._locationListDiv.style['overflow-x'] = 'none';
			    		obj._locationListDiv.align = 'center';
			    		
			    		buttonDiv = document.createElement('div');
			    		buttonDiv.style.width = '99%';
			    		buttonDiv.style.height = '8px';
			    		buttonDiv.style.padding = '1px';
			    		buttonDiv.style.border = '1px solid #888';
			    		buttonDiv.style.background = '#fff';
			    		buttonDiv.innerHTML = obj._downImage;
			    		buttonDiv.style.cursor = 'pointer';
			    		buttonDiv.style['background'] = "-webkit-linear-gradient(top,rgb(255,255,255),rgb(230,230,230))"; 
			    		
			    		obj._locationDiv = document.createElement('div');
			    		obj._locationDiv.style.width = '90%';
			    		obj._locationDiv.style['overflow'] = 'hidden';
			    		obj._locationDiv.style['white-space'] = 'nowrap';
			    		obj._locationDiv.style['text-overflow'] = 'ellipsis';
			    		obj._locationDiv.style.border = '1px #ccc solid';
			    		obj._locationDiv.style.height = '15px';
			    		obj._locationDiv.style.padding = '1px 1px';
			    		obj._locationDiv.style.margin = '1px';
			    		obj._locationDiv.style.cursor = 'pointer';
			    		obj._locationDiv.style['text-align'] = 'left';
			    		obj._locationDiv["class"] = "location-btn";
			    		obj._locationDiv.innerHTML = "Heart Center";
			    		
			    		google.maps.event.addDomListener(buttonDiv, 'click', function() {
			    			if(obj._locationListDiv.style.display == 'none'){
			    				//$(obj._locationListDiv).slideDown('slow');
			    				obj._locationListDiv.style.display = 'block';
			    				buttonDiv.innerHTML = obj._upImage;
			    			}else{
			    				//$(obj._locationListDiv).slideUp('slow');
			    				obj._locationListDiv.style.display = 'none';
			    				buttonDiv.innerHTML = obj._downImage;
			    			}
			    		});
			    		
			    		
			    		
			    		obj._locationsDiv.appendChild(titleDiv);
			    		obj._locationsDiv.appendChild(obj._locationListDiv);
			    		obj._locationsDiv.appendChild(buttonDiv);
			    		
			    		obj._locationListDiv.appendChild(obj._locationDiv);
			    		obj._map.controls[google.maps.ControlPosition.TOP_RIGHT].push(obj._locationsDiv);
			    		
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
			    			google.maps.event.trigger(obj._map, "resize");
			    		//obj._locationListDiv.style['max-height'] = ($(this).height()- 60) +'px';
			    		
			    	});
			    	$(this).click(function(){alert(getPrivateData("test"));});
			    	
//		    		$(this).data('gmapplot',
//	    				obj
//	    			);
//		    		obj = $(this).data('gmapplot');
			    });
			},
    	    
    	    hide_selectable_location : function(){
    	    	settings.selectable_location = false;

    	    	if(obj._addTable != undefined){
	    	    	obj._addTable.parent().hide();
	    	    	obj._lngSpan.parent().hide();
	    	    	obj._addTableBody.empty();
    	    	}
    	    	
    	    },
    	    
    	    show_selectable_location : function(){
    	    	
    	    	obj._addTable.parent().show();
    	    	obj._lngSpan.parent().show();
    	    	settings.selectable_location = true;
    	    	
    	    },
    	    
    	    select_address : function(){
    	    	
    	    	index = jQuery(this).attr('id');
    	    	
    	    	$.each(obj._items,function(x,y){
    	    		
    	    		y.Marker.setVisible(false);
    	    		
    	    	});
    	    	
    	    	obj._items[index].Marker.setVisible(true);
    	    	position = obj._items[index].Marker.getPosition();
    	    	methods.set_input_latLng(position);
    	    	obj._map.setCenter(position);
    	    	
    	    },
    	    set_input_latLng: function(position){
    	    	obj._lngSpan.val(position.lng());
    	    	obj._latSpan.val(position.lat());
    	    },
    	    set_location_list : function ( locations ){
    	    	$(obj._locationListDiv).empty();
    	    	$.each(locations,function(x,y){
    	    		obj._locationButtons[x] = obj._locationDiv.cloneNode(true);
    	    		obj._locationButtons[x].innerHTML = y.title;
    	    		obj._locationButtons[x].title = y.title;
    	    		obj._locationButtons[x].setAttribute('name',x);
		    		obj._locationListDiv.appendChild(obj._locationButtons[x]);
		    		
		    		google.maps.event.addDomListener(obj._locationButtons[x], 'click', function() {
		    			x = $(this).attr('name');
		    			obj._map.setCenter(obj._items[x].Marker.getPosition());
		    			google.maps.event.trigger(obj._items[x].Marker, 'click');
		    		});
    	    	});
    	    	obj._locationListDiv.style.height = (obj._locationButtons.length * 22)+'px';
    	    },
    	    set_selection : function ( locations ){
    	    	obj._addTableBody.empty();
    	    	tr = '';
    	    	$.each(locations,function(x,y){
    	    		tr += '<tr class="address_result_'+x+'" title="'+y.content+'">';
    	    		tr += '<td style="padding:1px;border:solid 1px #aaa;"><input type="radio" name="address-results" class="address-result-radio" id="'+x+'" /></td>';
    	    		tr += '<td style=" font-size: 11px;padding:1px;border:solid 1px #aaa;width:100%;max-width:100%;"><div style="overflow:hidden;max-height:15px;">'+y.content+'</div> </td>';
    	    		tr += '</tr>';
    	    	});
    	    	obj._addTableBody.append(tr);
    	    	$('.address-result-radio').bind('click', methods.select_address);
    	    	$('.address-result-radio:first').click();
    	    },
    	    clear_locations : function(){
    	    	if(obj._items.length){
    	    		$.each(obj._items,function(x,y){
//    	    			map.removeOverlay(y.Marker);
    	    			google.maps.event.clearListeners(y.Marker);
    	    			y.Marker.setMap(null);
    	    		});
    	    		delete obj._items;
    	    	}
    	    },
    	    plot : function( locations ) {
    	    	
    	    	methods.clear_locations();
    	    	var lat,lng;
    	    	obj._items = [];
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
    	    		
    	    		obj._items[x] = {};
    	    		obj._items[x].Raw = y;
    	    		obj._items[x].Marker = new google.maps.Marker({
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
    	    		obj._items[x].Marker.setMap(obj._map);
    	    		
    	    		obj._items[x].Marker.setVisible(y.visibility);
    	    		
    	    		if(y.hasInfoWindow)
	    	    		google.maps.event.addListener(obj._items[x].Marker, 'click', function(){
	    	    			itemInfoWindow.close();
	    	    			itemInfoWindow.setContent('<p style="color:#000;">'+y.content+'</p>');
	    	    			itemInfoWindow.open(obj._map,obj._items[x].Marker);
	    	    		});
    	    		
    	    		if(y.draggable)
    	    			google.maps.event.addListener(obj._items[x].Marker, 'dragend', function() {
    	    				methods.set_input_latLng(obj._items[index].Marker.getPosition());
    	    			});
    	    		
    	    	});
    	    	if(lat != undefined && lng != undefined)
    	    		obj._map.setCenter(new google.maps.LatLng(lat,lng));
    	    	
    	    	if(settings.selectable_location)
    	    		methods.set_selection( locations );
    	    	
    	    	if(settings.list_location)
    	    		methods.set_location_list( locations );
    	    },
    	    locate : function( address ){
    	    	
    	    	alert(address);
    	    	//alert($this.id);
    	    	//alert($(this.get(0)).data('test'));
    	    	obj._geocoder.geocode( { 'address': address}, function(results, status) {
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
    	    	        	obj._map.setCenter(results[a].geometry.location);
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
	setPrivateData = function(name,value){
		$.data(this,"gmapplot",{name:value});
	};
	getPrivateData = function(name){
		return $.data(this,"gmapplot").name;
	};
    var checkCoords = function(item){
    	if(item.lat != undefined && !isNaN(parseFloat(item.lat)) && item.lng != undefined && !isNaN(parseFloat(item.lng)))
    		return true;
    	return false;
    };
	
	$.fn.gmapplot = function( method ) {
		
		if ( methods[method] ) {
			return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
	    } else if ( typeof method === 'object' || ! method ) {
	    	$.data(this,"gmapplot",{test:""});
	    	return methods.init.apply( this, arguments );
	    } else {
	    	$.error( 'Method ' +  method + ' does not exist on $.gmapplot' );
	    }    
	  
	  };	
	  
})(jQuery);