var pos=0;
var cap;
var ctx;
var image;
var camloaded=false;
var canvas;
var ctx;
var images = [];
jQuery(document).ready(function(){
	
	newwidth = 320;
	newheight = 240;
	// check if we have canvas support
	canvas = document.createElement("canvas");
	canvas.width = newwidth-5;
	canvas.height = newheight;
	ctx = canvas.getContext("2d");
	var bHasCanvas = false;
	try
	{
		var oCanvas = document.createElement("canvas");
		if (oCanvas.getContext("2d")) {
			bHasCanvas = true;
		}		
	} catch (err)
	{
		
	}
	
	if (bHasCanvas)
	{
		jQuery('#capture').click(function(){
			//jQuery("#status").html("");
			webcam.capture(0);
			return false;
		});	
		jQuery('#save-image').click(function(src){
			if(typeof(src) != 'string'){
				src = jQuery('#preview').attr('src');
			}
			jQuery('.webcam-input').val(src);
			jQuery('#idpic').attr('src',src);
			jQuery('#dt-login-form #side_id_pic').attr('src',src);
			
			jQuery("#webcam-dialog").dialog('close');
			if(uploadType != undefined){
				uploadType = 1;
			}
		});
		jQuery( "#webcam-dialog" ).dialog({
			title:'Take a Photo',
			autoOpen:false,
			modal:true,
			resizable:false,
			width:880,
			height:430,
			open: function(){	
				jQuery('#webcam').webcam(
						{
							width: newwidth,
							height: newheight,
							mode: "callback",
							swffile: filelocation,
							onCapture:function(){
									webcam.save();
								},
							onLoad: function(){
									var cams = webcam.getCameraList();
									
									if (cams.length>0)
									{
		
										for(var i in cams)
										{
											  jQuery('#cameraselect').append('<option value="'+i.toString()+'">'+cams[i]+'</option>');
										}								
										
										jQuery('#cameraselect').change(function(){
											webcam.setCamera(jQuery('#cameraselect').val());
										});
										
										image = ctx.getImageData(0, 0, newwidth, newheight);
										
									} else
									{
										window.alert("Unable to detect camera driver, please refresh page.");
									}
									
									camloaded=true;
		
								},
							onSave: function(data){
									var col = data.split(";");
		
							        var img = image;
		
							            for(var i = 0; i < newwidth; i++) {
							                var tmp = parseInt(col[i]);
							                
							                img.data[pos + 0] = (tmp>>16) & 0xff;
							                img.data[pos + 1] = (tmp>>8) & 0xff;
							                img.data[pos + 2] = tmp & 0xff;
							                img.data[pos + 3] = 0xff;
							                pos+=4;
							        }
							        if (pos >= (4 * newwidth * newheight)) {
								            ctx.putImageData(img, 0, 0);
								            pos = 0;
								            src = canvas.toDataURL("image/jpeg");
								            images.push(src);
											setPreview(src);
											setThumbnails();
									}else{
							        	jQuery("#status").append('error');
								    }
									
								},
							 debug: function (type, string) {
		
								if (type=="error") {
									window.alert(string);
									
								}
								else{
									jQuery("#status").html(type + ": " + string);
							}
						}						
					});
				},
				close:function(){
					jQuery('#webcam').empty();
					jQuery('#cameraselect').empty();
					if(jQuery('.webcam-input').val().length == 0){
						alert('No image was selected.');
					}					
				}
		});
	}
	setPreview = function(src){
		if(typeof(src) != 'string'){
			src = jQuery(this).attr('src');
		}
		jQuery('#preview').attr('src',src);	
	};
});
function setThumbnails(){
	if(images.length < 4){
		thumbnail = new Image();
		thumbnail.src = src;
		jQuery('#shots_thumbnail').append(thumbnail);
		jQuery(thumbnail).bind('click',setPreview);
	}else{
		images.shift();
		jQuery('#shots_thumbnail img').each(function(x,y){
			jQuery(this).attr('src',images[x]);
		})
	}
}