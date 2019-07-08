function Converter(){
	this.unit_ratio = {
		'height' : {
	    	'm' : 1, // meter based
			'ft' : 3.280839895013,
			'in' : 39.37007874016
		},
	    'weight' : {
	    	'g' : 1, // gram based
	    	'kg' : 0.001,
	    	'lbs' : 0.002204623
	    },
	    'distance' : {
	    	'm' : 1, // meter based
			'ft' : 3.280839895013,
			'in' : 39.37007874016,
	    	'yd' : 1.093613298338,
	    	'nm' : 1000000000,
	    	'mm' : 1000,
	    	'mi' : 0.0006213711922373,
	    	'km' : 0.001,
	    	'dm' : 10,
	    	'cm' : 100
	    }
	};
	var previous_unit = {};
	var instance = this;
	
	this.convert = function($type,$value,$from,$to){
    	if($type == null
    		|| $value == null
    		|| $from == null
    		|| $to == null
    		|| this.unit_ratio[$type] == undefined
    		|| this.unit_ratio[$type][$from] == undefined
    		|| this.unit_ratio[$type][$to] == undefined){
    		return null;
    	}else{
    		return $value*(1/this.unit_ratio[$type][$from])*this.unit_ratio[$type][$to];
    	}	
    }
	
	this.computeBMI = function($weight,$height,$weightunit,$heightunit){
		if($weight == null || $weight.length == 0 || $weight == '0' || isNaN(parseInt($weight))
    		|| $height == null || $height.length == 0 || $height == '0' || isNaN(parseInt($height))
    		|| $weightunit == null
    		|| $heightunit == null){
			return null;
    	}else{
    		return  this.convert('weight',$weight,$weightunit,'kg')/Math.pow(this.convert('height',$height,$heightunit,'m'),2);
    	}
	};
	
	var focusHandler = function(event){
		if(event.data.x != undefined)
			previous_unit[event.data.x] = jQuery(this).val();
	}
	var changeHandler = function(event){
		if(event.data.x != undefined)
			if(previous_unit[event.data.x] != undefined){
				from = previous_unit[event.data.x];
				to = jQuery(this).val();
				amount = jQuery('.'+event.data.x).val();
				if(amount.length == 0 || amount == '0' || isNaN(parseInt(amount))){
					
				}else{
					if(to != from){
						jQuery('.'+event.data.x).val(instance.convert(event.data.x,amount,from,to));
						previous_unit[event.data.x] = to;
					}
				}
			}
	};
	this.bindConversionEvents = function(){
		// assumes that there are input fields with x and x+"_unit" as class where x is the unit name
		jQuery.each(this.unit_ratio,function(x,y){
			if(jQuery('.'+x).length && jQuery('.'+x+'_unit').length){
				jQuery('.'+x+'_unit').bind('focus',{x:x},focusHandler);
				jQuery('.'+x+'_unit').bind('change',{x:x},changeHandler);
			}
		});
		
	};
};