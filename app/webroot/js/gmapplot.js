
(function($) {
    // Default configuration properties.
    var defaults = {
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
    }, windowLoaded = false;

    var upImage = '<img src="https://maps.gstatic.com/mapfiles/arrow-up.png" draggable="false" style="-webkit-user-select: none; top: -10; border: 0px; padding: 0px; margin: 0px 0px 6px 0px;width: 7px; height: 4px;">',
		downImage = '<img src="https://maps.gstatic.com/mapfiles/arrow-down.png" draggable="false" style="-webkit-user-select: none; top: -10; border: 0px; padding: 0px; margin: 0px 0px 6px 0px;width: 7px; height: 4px;">';
	
    
    /**
     * The jCarousel object.
     *
     * @constructor
     * @class gmapplot
     * @param e {HTMLElement} The element to create the carousel for.
     * @param o {Object} A set of key/value pairs to set as configuration properties.
     * @cat Plugins/jCarousel
     */
    $.gmapplot = function(e, o, locations) {
    	this.options    = $.extend(true,{}, defaults, o || {});
    	this.map = null;
    	this.items = [];
    	this.geocoder = null;
    	this.addTable = null;
    	this.addTableBody = null;
    	this.lngSpan = null;
    	this.latSpan = null;
    	this.locationListDiv = null;
    	this.locationDiv = null;
    	this.locationsDiv = null;
    	this.locationButtons = [];
    	
    	$(e).html('<div style="width:100%;height:100%;" class="gmapplot-target-area"></div>');
		//if(locations == undefined)
    	//	locations = [];
		
		//if($.fn.gmapplot.obj.locationButtons == undefined)
		//	$.fn.gmapplot.obj.locationButtons = [];

    	if(locations.length && checkCoords(locations[0])){
    		cntr = new google.maps.LatLng(locations[0].lat, locations[0].lng);
    	}else
    		cntr = new google.maps.LatLng(14.636739,121.050625);

    	this.options.mapOptions.center = cntr;
    	this.map = new google.maps.Map($(e).find('.gmapplot-target-area').get(0),this.options.mapOptions);
	 	this.geocoder = new google.maps.Geocoder();
    	itemInfoWindow = new google.maps.InfoWindow();
    	
    	if(locations.length)
    		methods.plot(locations);
    	
    	if(this.options.selectable_location){
    		this.addTable = $('<table />',{ id:'addresses',style:'height:50px;max-height:50px;'});
    		this.addTableBody = $('<tbody />',{ style:'overflow:auto;height:50px;max-height:50px;width:100%;max-width:100%;display:block'});
    		$(e).append(this.addTable);
    		this.addTable.append(this.addTableBody);
    		this.addTable.wrap('<div style="width:100%;bottom:80px;position:relative;height:50px; hidden;background: #fffae4;border: 1px solid #aaa;"></div>');
    		
    		this.lngSpan = $('<input />',this.options.lngInputAttr);
    		this.latSpan = $('<input />',this.options.latInputAttr);
    		
    		$(e).append(this.lngSpan);
    		this.lngSpan.wrap('<div style="width: 100%;bottom: 80px;position: relative;background: #fffae4;height: 25px;border: 1px solid #aaa;padding:0px;margin:0px;"></div>');
    		this.lngSpan.parent().append(this.latSpan);
    		$('<label>',{text:'Lat:'}).insertBefore(this.latSpan);
    		$('<label>',{text:'Lng:'}).insertBefore(this.lngSpan);
    		
//    		this.addTable.parent().resizable({
//    			handles:'n'
//    		});
    	}
    	if(this.options.list_location){
    		
    		this.locationsDiv = document.createElement('div'); //$('<div />',{ id:'location_list_div',style:'width:200px;min-height:50px;'});
    		this.locationsDiv.style.width = '180px';
    		this.locationsDiv.style.background = '#fff';
    		this.locationsDiv.style.margin = '4px 10px';
    		this.locationsDiv.style['text-align'] = 'center';
    		this.locationsDiv.style['box-shadow'] = "rgba(0, 0, 0, 0.398438) 0px 2px 4px"; 
    		this.locationsDiv.style['-webkit-box-shadow'] = "rgba(0, 0, 0, 0.398438) 0px 2px 4px";
    		
    		titleDiv = document.createElement('div');//titleDiv = $('<div />',{id:'location_list_title',style:'width:95%;height:50px;border:solid 1px;'});
    		titleDiv.style.width = '99%';
    		titleDiv.style.height = '15px';
    		titleDiv.style.padding = '1px';
    		titleDiv.style.border = '1px solid #888';
    		titleDiv.innerHTML = '<strong>'+this.options.list_location_title+'</strong>';
    		titleDiv.style['background'] = "-webkit-linear-gradient(top,rgb(255,255,255),rgb(230,230,230))"; 
    		
    		this.locationListDiv = document.createElement('div');
    		this.locationListDiv.style.width = '99%';
    		this.locationListDiv.style.padding = '3px';
    		this.locationListDiv.style.display = 'none';
    		this.locationListDiv.style['min-height'] = '50px';
    		this.locationListDiv.style['max-height'] = ($(e).height()- 60) +'px';
    		this.locationListDiv.style['overflow'] = 'auto';
    		this.locationListDiv.style['overflow-x'] = 'none';
    		this.locationListDiv.align = 'center';
    		
    		buttonDiv = document.createElement('div');
    		buttonDiv.style.width = '99%';
    		buttonDiv.style.height = '8px';
    		buttonDiv.style.padding = '1px';
    		buttonDiv.style.border = '1px solid #888';
    		buttonDiv.style.background = '#fff';
    		buttonDiv.innerHTML = downImage;
    		buttonDiv.style.cursor = 'pointer';
    		buttonDiv.style['background'] = "-webkit-linear-gradient(top,rgb(255,255,255),rgb(230,230,230))"; 
    		
    		this.locationDiv = document.createElement('div');
    		this.locationDiv.style.width = '90%';
    		this.locationDiv.style['overflow'] = 'hidden';
    		this.locationDiv.style['white-space'] = 'nowrap';
    		this.locationDiv.style['text-overflow'] = 'ellipsis';
    		this.locationDiv.style.border = '1px #ccc solid';
    		this.locationDiv.style.height = '15px';
    		this.locationDiv.style.padding = '1px 1px';
    		this.locationDiv.style.margin = '1px';
    		this.locationDiv.style.cursor = 'pointer';
    		this.locationDiv.style['text-align'] = 'left';
    		this.locationDiv["class"] = "location-btn";
    		this.locationDiv.innerHTML = "Heart Center";
    		
    		jc = this;
    		google.maps.event.addDomListener(buttonDiv, 'click', function() {
    			if(jc.locationListDiv.style.display == 'none'){
    				//$(this.locationListDiv).slideDown('slow');
    				jc.locationListDiv.style.display = 'block';
    				buttonDiv.innerHTML = upImage;
    			}else{
    				//$(this.locationListDiv).slideUp('slow');
    				jc.locationListDiv.style.display = 'none';
    				buttonDiv.innerHTML = downImage;
    			}
    		});
    		
    		
    		
    		this.locationsDiv.appendChild(titleDiv);
    		this.locationsDiv.appendChild(this.locationListDiv);
    		this.locationsDiv.appendChild(buttonDiv);
    		
    		this.locationListDiv.appendChild(this.locationDiv);
    		this.map.controls[google.maps.ControlPosition.TOP_RIGHT].push(this.locationsDiv);
    		
    	}
    	if(this.options.resizable){
	    	$(e).resizable({
	    		maxHeight: $(e).height()* 2,
	    		maxWidth: $(e).width() *2,
	    		minHeight: $(e).height(),
	    		minWidth: $(e).width()
	    	});
	    	
    	}
    	$(e).resize(function(){
    		if(jc.options.resizable)
    			google.maps.event.trigger(jc.map, "resize");
    		jc.locationListDiv.style['max-height'] = ($(e).height()- 60) +'px';
    	});
    	
    };

    // Create shortcut for internal use
    var $jc = $.gmapplot;

    $jc.fn = $jc.prototype = {
        gmapplot: '0.2.8'
    };

    $jc.fn.extend = $jc.extend = $.extend;

    $jc.fn.extend({
        /**
         * Setups the carousel.
         *
         * @method setup
         * @return undefined
         */
        setup: function() {
        	
        },
        hide_selectable_location : function(){
	    	
        	this.options.selectable_location = false;

	    	if(this.addTable != undefined){
    	    	this.addTable.parent().hide();
    	    	this.lngSpan.parent().hide();
    	    	this.addTableBody.empty();
	    	}
	    	
	    },
	    
	    show_selectable_location : function(){
	    	
	    	this.addTable.parent().show();
	    	this.lngSpan.parent().show();
	    	this.options.selectable_location = true;
	    	
	    },
	    
	    select_address : function(event){
	    	
	    	jc = event.data.jc;
	    	index = $(this).attr('id');
	    	if(jc.items){
		    	$.each(jc.items,function(x,y){
		    		
		    		y.Marker.setVisible(false);
		    		
		    	});
	    	
		    	jc.items[index].Marker.setVisible(true);
		    	position = jc.items[index].Marker.getPosition();
		    	jc.set_input_latLng(position);
		    	jc.map.setCenter(position);
	    	}
	    	
	    },
        set_input_latLng: function(position){
	    	this.lngSpan.val(position.lng());
	    	this.latSpan.val(position.lat());
	    },
	    set_location_list : function ( locations ){
	    	$(this.locationListDiv).empty();
	    	jc = this;
	    	$.each(locations,function(x,y){
	    		jc.locationButtons[x] = jc.locationDiv.cloneNode(true);
	    		jc.locationButtons[x].innerHTML = y.title;
	    		jc.locationButtons[x].title = y.title;
	    		jc.locationButtons[x].setAttribute('name',x);
	    		jc.locationListDiv.appendChild(jc.locationButtons[x]);
	    		
	    		google.maps.event.addDomListener(jc.locationButtons[x], 'click', function() {
	    			x = $(this).attr('name');
	    			jc.map.setCenter(jc.items[x].Marker.getPosition());
	    			google.maps.event.trigger(jc.items[x].Marker, 'click');
	    		});
	    	});
	    	this.locationListDiv.style.height = (this.locationButtons.length * 22)+'px';
	    },
	    set_selection : function ( locations ){
	    	this.addTableBody.empty();
	    	tr = '';
	    	$.each(locations,function(x,y){
	    		tr += '<tr class="address_result_'+x+'" title="'+y.content+'">';
	    		tr += '<td style="padding:1px;border:solid 1px #aaa;"><input type="radio" name="address-results" class="address-result-radio" id="'+x+'" /></td>';
	    		tr += '<td style=" font-size: 11px;padding:1px;border:solid 1px #aaa;width:100%;max-width:100%;"><div style="overflow:hidden;max-height:15px;">'+y.content+'</div> </td>';
	    		tr += '</tr>';
	    	});
	    	this.addTableBody.append(tr);
	    	
	    	$('.address-result-radio').bind('click',{jc:this}, this.select_address);
	    	$('.address-result-radio:first').click();
	    },
	    clear_locations : function(){
	    	if(this.items.length){
	    		$.each(this.items,function(x,y){
//	    			map.removeOverlay(y.Marker);
	    			google.maps.event.clearListeners(y.Marker);
	    			y.Marker.setMap(null);
	    		});
	    		delete this.items;
	    	}
	    },
        plot : function(locations){
        
        	this.clear_locations();
	    	var lat,lng;
	    	this.items = [];
	    	this.locationButtons = [];
	    	
	    	jc = this;
	    	
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
	    		
	    		jc.items.push({});
	    		jc.items[x].Raw = y;
	    		jc.items[x].Marker = new google.maps.Marker({
	    			position: new google.maps.LatLng(lat,lng),
	    			title:y.title,
//	    			icon: new google.maps.MarkerImage(
//    				    'http://maps.google.com/intl/en_us/mapfiles/ms/micons/'+y.color+'-dot.png',
//    				    new google.maps.Size(30, 30),
//    				    new google.maps.Point(0, 0),
//    				    new google.maps.Point(0, 24)
//    				),
	    			draggable: y.draggable
    			});
	    		jc.items[x].Marker.setMap(jc.map);
	    		
	    		jc.items[x].Marker.setVisible(y.visibility);
	    		
	    		if(y.hasInfoWindow)
    	    		google.maps.event.addListener(jc.items[x].Marker, 'click', function(){
    	    			itemInfoWindow.close();
    	    			itemInfoWindow.setContent('<p style="color:#000;">'+y.content+'</p>');
    	    			itemInfoWindow.open(jc.map,jc.items[x].Marker);
    	    		});
	    		
	    		if(y.draggable)
	    			google.maps.event.addListener(jc.items[x].Marker, 'dragend', function() {
	    				jc.set_input_latLng(jc.items[x].Marker.getPosition());
	    			});
	    		
	    	});
	    	if(lat != undefined && lng != undefined)
	    		this.map.setCenter(new google.maps.LatLng(lat,lng));
	    	
	    	if(this.options.selectable_location)
	    		this.set_selection( locations );
	    	
	    	if(this.options.list_location)
	    		this.set_location_list( locations );
        },

        locate:function( address ){
        	jc = this;
        	this.geocoder.geocode( { 'address': address}, function(results, status) {
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
  	    	      
  	    	        jc.map.setCenter(results[a].geometry.location);
  	    	    });
  	        	jc.plot( locations );
  	        	
  	          } else {
  	        	//flashErrorMessage("Geocode was not able to locate '"+address+"' \nReason:" + status);
  	          }
  	        });
        }
    });
    
    var checkCoords = function(item){
    	if(item.lat != undefined && !isNaN(parseFloat(item.lat)) && item.lng != undefined && !isNaN(parseFloat(item.lng)))
    		return true;
    	return false;
    };
    
    $jc.extend({
        /**
         * Gets/Sets the global default configuration properties.
         *
         * @method defaults
         * @return {Object}
         * @param d {Object} A set of key/value pairs to set as configuration properties.
         */
        defaults: function(d) {
            return $.extend(true,defaults, d || {});
        }

        
    });

    /**
     * Creates a carousel for all matched elements.
     *
     * @example $("#mycarousel").gmapplot();
     * @before <ul id="mycarousel" class="gmapplot-skin-name"><li>First item</li><li>Second item</li></ul>
     * @result
     *
     * <div class="gmapplot-skin-name">
     *   <div class="gmapplot-container">
     *     <div class="gmapplot-clip">
     *       <ul class="gmapplot-list">
     *         <li class="gmapplot-item-1">First item</li>
     *         <li class="gmapplot-item-2">Second item</li>
     *       </ul>
     *     </div>
     *     <div disabled="disabled" class="gmapplot-prev gmapplot-prev-disabled"></div>
     *     <div class="gmapplot-next"></div>
     *   </div>
     * </div>
     *
     * @method gmapplot
     * @return jQuery
     * @param o {Hash|String} A set of key/value pairs to set as configuration properties or a method name to call on a formerly created instance.
     */
    $.fn.gmapplot = function(o, locations) {
    	if(locations == undefined)
    		locations = [];
        if (typeof o == 'string') {
            var instance = $(this).data('gmapplot'), args = Array.prototype.slice.call(arguments, 1);
            return instance[o].apply(instance, args);
        } else {
            return this.each(function() {
                var instance = $(this).data('gmapplot');
                if (instance) {
                    if (o) {
                        $.extend(instance.options, o);
                    }
                    instance.reload();
                } else {
                    $(this).data('gmapplot', new $jc(this, o, locations));
                }
            });
        }
    };

})(jQuery);
