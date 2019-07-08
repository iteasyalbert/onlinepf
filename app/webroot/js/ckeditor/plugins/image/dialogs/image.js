/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
(function()
{
        var imageDialog = function( editor, dialogType )
        {
        	var IMAGE = 1,resized = '', datauri = '',width = 100, height = 100, lastUploadedCont, newimage;
			LINK = 2,
			PREVIEW = 4,
			CLEANUP = 8,
			regexGetSize = /^\s*(\d+)((px)|\%)?\s*$/i,
			regexGetSizeOrEmpty = /(^\s*(\d+)((px)|\%)?\s*$)|^$/i,
			pxLengthRegex = /^\d+px$/;
        	
			var previewImage, uploadInput, urlInput , uploadRadio, urlRadio,
        		widthInput, heightInput, marginInput, paddingInput, borderInput, altInput, styleInput, alignInput, idInput, classInput;

        
		var onSizeChange = function()
		{
			var value = this.getValue(),	// This = input element.
				dialog = this.getDialog(),
				aMatch  =  value.match( regexGetSize );	// Check value
			if ( aMatch )
			{
				if ( aMatch[2] == '%' )			// % is allowed - > unlock ratio.
					switchLockRatio( dialog, false );	// Unlock.
				value = aMatch[1];
			}

			// Only if ratio is locked
			if ( dialog.lockRatio ) {
				var oImageOriginal = dialog.originalElement;
				if ( oImageOriginal.getCustomData( 'isReady' ) == 'true' )
				{
					if ( this.id == 'txtHeight' )
					{
						if ( value && value != '0' )
							value = Math.round( oImageOriginal.$.width * ( value  / oImageOriginal.$.height ) );
						if ( !isNaN( value ) )
							dialog.setValueOf( 'info', 'txtWidth', value );
					}
					else//this.id = txtWidth.
					{
						if ( value && value != '0' )
							value = Math.round( oImageOriginal.$.height * ( value  / oImageOriginal.$.width ) );
						if ( !isNaN( value ) )
							dialog.setValueOf( 'info', 'txtHeight', value );
					}
				}
			}
			updatePreview( dialog );
		};

		var updatePreview = function( dialog )
		{
			//Don't load before onShow.
			if ( !dialog.originalElement || !dialog.preview )
				return 1;

			// Read attributes and update imagePreview;
			dialog.commitContent( PREVIEW, dialog.preview );
			return 0;
		};

		// Custom commit dialog logic, where we're intended to give inline style
		// field (txtdlgGenStyle) higher priority to avoid overwriting styles contribute
		// by other fields.
		function commitContent()
		{
//			alert('commitContent');
			var args = arguments;
			jQuery.each(args,function(aa,bb){alert(aa+'->'+bb);});
			var inlineStyleField = this.getContentElement( 'advanced', 'txtdlgGenStyle' );
			inlineStyleField && inlineStyleField.commit.apply( inlineStyleField, args );

			this.foreach( function( widget )
			{
				if ( widget.commit &&  widget.id != 'txtdlgGenStyle' )
					widget.commit.apply( widget, args );
			});
		}

		// Avoid recursions.
		var incommit;

		// Synchronous field values to other impacted fields is required, e.g. border
		// size change should alter inline-style text as well.
		function commitInternally( targetFields )
		{
//			alert('commitInternally');
			if ( incommit )
				return;

			incommit = 1;

			var dialog = this.getDialog(),
				element = dialog.imageElement;
			if ( element )
			{
				// Commit this field and broadcast to target fields.
				this.commit( IMAGE, element );

				targetFields = [].concat( targetFields );
				var length = targetFields.length,
					field;
				for ( var i = 0; i < length; i++ )
				{
					field = dialog.getContentElement.apply( dialog, targetFields[ i ].split( ':' ) );
					// May cause recursion.
					field && field.setup( IMAGE, element );
				}
			}

			incommit = 0;
		}

		var switchLockRatio = function( dialog, value )
		{
			if ( !dialog.getContentElement( 'info', 'ratioLock' ) )
				return null;

			var oImageOriginal = dialog.originalElement;

			// Dialog may already closed. (#5505)
			if( !oImageOriginal )
				return null;

			// Check image ratio and original image ratio, but respecting user's preference.
			if ( value == 'check' )
			{
				if ( !dialog.userlockRatio && oImageOriginal.getCustomData( 'isReady' ) == 'true'  )
				{
					var width = dialog.getValueOf( 'info', 'txtWidth' ),
						height = dialog.getValueOf( 'info', 'txtHeight' ),
						originalRatio = oImageOriginal.$.width * 1000 / oImageOriginal.$.height,
						thisRatio = width * 1000 / height;
					dialog.lockRatio  = false;		// Default: unlock ratio

					if ( !width && !height )
						dialog.lockRatio = true;
					else if ( !isNaN( originalRatio ) && !isNaN( thisRatio ) )
					{
						if ( Math.round( originalRatio ) == Math.round( thisRatio ) )
							dialog.lockRatio = true;
					}
				}
			}
			else if ( value != undefined )
				dialog.lockRatio = value;
			else
			{
				dialog.userlockRatio = 1;
				dialog.lockRatio = !dialog.lockRatio;
			}

			var ratioButton = CKEDITOR.document.getById( btnLockSizesId );
			if ( dialog.lockRatio )
				ratioButton.removeClass( 'cke_btn_unlocked' );
			else
				ratioButton.addClass( 'cke_btn_unlocked' );

			ratioButton.setAttribute( 'aria-checked', dialog.lockRatio );

			// Ratio button hc presentation - WHITE SQUARE / BLACK SQUARE
			if ( CKEDITOR.env.hc )
			{
				var icon = ratioButton.getChild( 0 );
				icon.setHtml(  dialog.lockRatio ? CKEDITOR.env.ie ? '\u25A0': '\u25A3' : CKEDITOR.env.ie ? '\u25A1' : '\u25A2' );
			}

			return dialog.lockRatio;
		};

		var resetSize = function( dialog )
		{
			var oImageOriginal = dialog.originalElement;
			if ( oImageOriginal.getCustomData( 'isReady' ) == 'true' )
			{
				var widthField = dialog.getContentElement( 'info', 'txtWidth' ),
					heightField = dialog.getContentElement( 'info', 'txtHeight' );
				widthField && widthField.setValue( oImageOriginal.$.width );
				heightField && heightField.setValue( oImageOriginal.$.height );
			}
			updatePreview( dialog );
		};
		
		
		var setupDimension = function( type, element )
		{
			if ( type != IMAGE )
				return;

			function checkDimension( size, defaultValue )
			{
				var aMatch  =  size.match( regexGetSize );
				if ( aMatch )
				{
					if ( aMatch[2] == '%' )				// % is allowed.
					{
						aMatch[1] += '%';
						switchLockRatio( dialog, false );	// Unlock ratio
					}
					return aMatch[1];
				}
				return defaultValue;
			}

			var dialog = this.getDialog(),
				value = '',
				dimension = this.id == 'txtWidth' ? 'width' : 'height',
				size = element.getAttribute( dimension );

			if ( size )
				value = checkDimension( size, value );
			value = checkDimension( element.getStyle( dimension ), value );

			this.setValue( value );
		};

		var previewPreloader;

		var onImgLoadEvent = function()
		{
			// Image is ready.
			var original = this.originalElement;
			original.setCustomData( 'isReady', 'true' );
			original.removeListener( 'load', onImgLoadEvent );
			original.removeListener( 'error', onImgLoadErrorEvent );
			original.removeListener( 'abort', onImgLoadErrorEvent );

			// Hide loader
			CKEDITOR.document.getById( imagePreviewLoaderId ).setStyle( 'display', 'none' );

			// New image -> new domensions
			if ( !this.dontResetSize )
				resetSize( this );

			if ( this.firstLoad )
				CKEDITOR.tools.setTimeout( function(){ switchLockRatio( this, 'check' ); }, 0, this );

			this.firstLoad = false;
			this.dontResetSize = false;
			
		};

		var onImgLoadErrorEvent = function()
		{
			// Error. Image is not loaded.
			var original = this.originalElement;
			original.removeListener( 'load', onImgLoadEvent );
			original.removeListener( 'error', onImgLoadErrorEvent );
			original.removeListener( 'abort', onImgLoadErrorEvent );

			// Set Error image.
			var noimage = CKEDITOR.getUrl( editor.skinPath + 'images/noimage.png' );

			if ( this.preview )
				this.preview.setAttribute( 'src', noimage );

			// Hide loader
			CKEDITOR.document.getById( imagePreviewLoaderId ).setStyle( 'display', 'none' );
			switchLockRatio( this, false );	// Unlock.
		};

		var numbering = function( id )
			{
				return CKEDITOR.tools.getNextId() + '_' + id;
			},
			btnLockSizesId = numbering( 'btnLockSizes' ),
			btnResetSizeId = numbering( 'btnResetSize' ),
			imagePreviewLoaderId = numbering( 'ImagePreviewLoader' ),
			imagePreviewBoxId = numbering( 'ImagePreviewBox' ),
			previewLinkId = numbering( 'previewLink' ),
			previewImageId = numbering( 'previewImage' );
			
		var imageCanvasResize = function(){
			
			newwidth = newimage.width;
			newheight = newimage.height;
			if(newwidth != undefined && newheight != undefined){
				var canvas = document.createElement('canvas');
				canvas.width = newwidth;
				canvas.height = newheight;
				var ctx = canvas.getContext("2d");
				ctx.drawImage(newimage, 0, 0, newwidth, newheight);
				newimage.src = canvas.toDataURL("image/jpeg");
				
			}
			
		};
		evaluateCss = function(str){
			// test regex for css text
			if(str.toString().match(/([\sA-Za-z0-9]+:[A-Za-z0-9\s]+;$)+/i))
				return true;
			else
				return false;
		};
		
		displayStyles = function(){
			
			widthInput.value = newimage.width;
			heightInput.value = newimage.height;
			
		};
		applyStyles = function(){
			
			if(parseInt(widthInput.value) > 0){
				newimage.style.width = widthInput.value.toString() + "px";
				newimage.width = widthInput.value;
			}
			
			if(parseInt(heightInput.value) > 0){
				newimage.style.height = heightInput.value.toString() + "px";
				newimage.height = heightInput.value;
			}
			
			if(borderInput.value.length > 0)
				newimage.style.border = borderInput.value.toString() + "px solid";
			
			if(alignInput.value.length > 0)
				newimage.style.float = alignInput.value;
			else
				newimage.style.float = "none";
			
			if(altInput.value.length > 0)
				newimage.alt = altInput.value;
			
			if(marginInput.value.length > 0)
				newimage.style.margin = marginInput.value.toString() + "px";
			
			if(paddingInput.value.length > 0)
				newimage.style.padding = paddingInput.value.toString() + "px";
			
			if(idInput.value.length > 0)
				newimage.id = idInput.value;
			
			newimage.setAttribute("class",classInput.value);
			
			if(styleInput.value.length > 0 && evaluateCss(styleInput.value)){
//				newimage.style.cssText = styleInput.value;
				styles = styleInput.value.toString().split(';');
				
				for(i = 0;i < styles.length;i++){
					styl = styles[i].split(":");
					newimage.style[styl[0]] = styl[1];
				}
			}
		};
		return {
			title : 'Add Image',//editor.lang.image[ dialogType == 'image' ? 'title' : 'titleButton' ],
			minWidth : 420,
			minHeight : 360,
			resize:false,
			onShow : function()
			{
				this.imageElement = false;
				this.linkElement = false;

				// Default: create a new element.
				this.imageEditMode = false;
				this.linkEditMode = false;

				this.lockRatio = true;
				this.userlockRatio = 0;
				this.dontResetSize = false;
				this.firstLoad = true;
				this.addLink = false;

				var editor = this.getParentEditor(),
					sel = this.getParentEditor().getSelection(),
					element = sel.getSelectedElement(),
					link = element && element.getAscendant( 'a' );
				
				if(element != null){
					newimage.src = element.getAttribute('src');
				}
				

				//Hide loader.
//				CKEDITOR.document.getById( imagePreviewLoaderId ).setStyle( 'display', 'none' );
				// Create the preview before setup the dialog contents.
				previewPreloader = new CKEDITOR.dom.element( 'img', editor.document );
				this.preview = CKEDITOR.document.getById( previewImageId );

				// Copy of the image
				this.originalElement = editor.document.createElement( 'img' );
				this.originalElement.setAttribute( 'alt', '' );
				this.originalElement.setCustomData( 'isReady', 'false' );

				if ( link )
				{
					this.linkElement = link;
					this.linkEditMode = true;

					// Look for Image element.
					var linkChildren = link.getChildren();
					if ( linkChildren.count() == 1 )			// 1 child.
					{
						var childTagName = linkChildren.getItem( 0 ).getName();
						if ( childTagName == 'img' || childTagName == 'input' )
						{
							this.imageElement = linkChildren.getItem( 0 );
							if ( this.imageElement.getName() == 'img' )
								this.imageEditMode = 'img';
							else if ( this.imageElement.getName() == 'input' )
								this.imageEditMode = 'input';
						}
					}
					// Fill out all fields.
					if ( dialogType == 'image' )
						this.setupContent( LINK, link );
				}

				if ( element && element.getName() == 'img' && !element.data( 'cke-realelement' )
					|| element && element.getName() == 'input' && element.getAttribute( 'type' ) == 'image' )
				{
					this.imageEditMode = element.getName();
					this.imageElement = element;
				}

				if ( this.imageEditMode )
				{
					// Use the original element as a buffer from  since we don't want
					// temporary changes to be committed, e.g. if the dialog is canceled.
					this.cleanImageElement = this.imageElement;
					this.imageElement = this.cleanImageElement.clone( true, true );

					// Fill out all fields.
					this.setupContent( IMAGE, this.imageElement );
				}
				else
					this.imageElement =  editor.document.createElement( 'img' );

				// Refresh LockRatio button
				switchLockRatio ( this, true );

				// Dont show preview if no URL given.
				if ( !CKEDITOR.tools.trim( this.getValueOf( 'info', 'txtUrl' ) ) )
				{
					this.preview.removeAttribute( 'src' );
					this.preview.setStyle( 'display', 'none' );
				}
			},
			onOk : function()
			{
				//if(datauri!= ''){
					image = editor.document.createElement('img');
					imageCanvasResize();
					image.setAttribute('src',newimage.src);
					image.setAttribute('id',newimage.id);
					image.setAttribute('class',newimage.getAttribute("class"));
					image.setAttribute('alt',newimage.alt);
					image.setAttribute('style',newimage.getAttribute("style"));
					editor.insertElement( image );
				//}
				
				uploadInput.value = '';
				urlInput.value = '';
				return;
				
				// Edit existing Image.
				alert('ok na');
				if ( this.imageEditMode )
				{
					var imgTagName = this.imageEditMode;

					// Image dialog and Input element.
					if ( dialogType == 'image' && imgTagName == 'input' && confirm( editor.lang.image.button2Img ) )
					{
						// Replace INPUT-> IMG
						imgTagName = 'img';
						this.imageElement = editor.document.createElement( 'img' );
						this.imageElement.setAttribute( 'alt', '' );
						editor.insertElement( this.imageElement );
					}
					// ImageButton dialog and Image element.
					else if ( dialogType != 'image' && imgTagName == 'img' && confirm( editor.lang.image.img2Button ))
					{
						// Replace IMG -> INPUT
						imgTagName = 'input';
						this.imageElement = editor.document.createElement( 'input' );
						this.imageElement.setAttributes(
							{
								type : 'image',
								alt : ''
							}
						);
						editor.insertElement( this.imageElement );
					}
					else
					{
						// Restore the original element before all commits.
						this.imageElement = this.cleanImageElement;
						delete this.cleanImageElement;
					}
				}
				else	// Create a new image.
				{
					// Image dialog -> create IMG element.
					if ( dialogType == 'image' )
						this.imageElement = editor.document.createElement( 'img' );
					else
					{
						this.imageElement = editor.document.createElement( 'input' );
						this.imageElement.setAttribute ( 'type' ,'image' );
					}
					this.imageElement.setAttribute( 'alt', '' );
				}

				// Create a new link.
				if ( !this.linkEditMode )
					this.linkElement = editor.document.createElement( 'a' );

				// Set attributes.
				this.commitContent( IMAGE, this.imageElement );
				this.commitContent( LINK, this.linkElement );

				// Remove empty style attribute.
				if ( !this.imageElement.getAttribute( 'style' ) )
					this.imageElement.removeAttribute( 'style' );

				// Insert a new Image.
				if ( !this.imageEditMode )
				{
					if ( this.addLink )
					{
						//Insert a new Link.
						if ( !this.linkEditMode )
						{
							editor.insertElement( this.linkElement );
							this.linkElement.append( this.imageElement, false );
						}
						else	 //Link already exists, image not.
							editor.insertElement( this.imageElement );
					}
					else
						editor.insertElement( this.imageElement );
				}
				else		// Image already exists.
				{
					//Add a new link element.
					if ( !this.linkEditMode && this.addLink )
					{
						editor.insertElement( this.linkElement );
						this.imageElement.appendTo( this.linkElement );
					}
					//Remove Link, Image exists.
					else if ( this.linkEditMode && !this.addLink )
					{
						editor.getSelection().selectElement( this.linkElement );
						editor.insertElement( this.imageElement );
					}
				}
			},
			onLoad : function()
			{
				if ( dialogType != 'image' )
					this.hidePage( 'Link' );//Hide Link tab.
				var doc = this._.element.getDocument();

				if ( this.getContentElement( 'info', 'ratioLock' ) )
				{
					this.addFocusable( doc.getById( btnResetSizeId ), 5 );
					this.addFocusable( doc.getById( btnLockSizesId ), 5 );
				}

				this.commitContent = commitContent;
				newimage = document.createElement('img');//new Image();
				newimage.onload = function(){
					displayStyles();
	        	};
	        	
				infoPane = document.getElementsByName("info_source")[0];
				targetPane = document.getElementsByName("info_url")[0];
				
				uploadInput = document.createElement('input'); //$('<div />',{ id:'location_list_div',style:'width:200px;min-height:50px;'});
				uploadInput.type = 'file';
				uploadInput.name = 'uploadimage';
				uploadInput.id = 'uploadimage';
				uploadInput.size = 38;
				
				urlInput = document.createElement('input'); 
				urlInput.type = 'text';
				urlInput.name = 'urlimage';
				urlInput.id = 'urlimage';
				urlInput.style.padding = '0.5px';
				urlInput.style.margin = 0;
				urlInput.style.background = 'none';
				
				previewImage = document.createElement("div");
				previewImage.style.width = '420px';
				previewImage.style['max-width'] = '420px';
				previewImage.style.height = '420px';
				previewImage.style['max-height'] = '420px';
				previewImage.style.background = '#fff';
				previewImage.style.border = 'solid 1px #999';
				previewImage.id = 'imagepreview';
				
	        	previewImage.appendChild(newimage);
				
				uploadRadio = document.createElement('input');
				uploadRadio.type = 'radio';
				uploadRadio.name = 'image_source_type';
				uploadRadio.value = 2;
				uploadRadio.style['vertical-align'] = "center";
				uploadRadio.style.margin = "10px";
				
				urlRadio = document.createElement('input');
				urlRadio.type = 'radio';
				urlRadio.name = 'image_source_type';
				urlRadio.value = 1;
				urlRadio.checked = true;
				urlRadio.style['vertical-align'] = "center";
				urlRadio.style.margin = "10px";
				
				infoPane.appendChild(uploadInput);
				infoPane.appendChild(urlInput);
				
				infoPane.innerHTML = '<table cellpadding="10" border="1"> \
					<tbody style="width:100px;"> \
					<tr style="padding:10px !important"><td rowspan="2" style="vertical-align:center" ></td><td><p style="width:380px;"><b>Link</b></p></td></tr> \
					<tr style="padding:10px !important"><td style="padding:10px !important"></td></tr> \
					<tr style="padding:10px !important"><td rowspan="2" style="vertical-align:center" ></td><td>Browse Image</td></tr> \
					<tr style="padding:10px !important"><td style="padding:10px !important"></td></tr> \
					</tbody> \
					</table>';
				
				
				infoPaneTds = infoPane.getElementsByTagName('td');
				
				infoPaneTds[0].appendChild(urlRadio);
				infoPaneTds[2].appendChild(urlInput);
				infoPaneTds[3].appendChild(uploadRadio);
				infoPaneTds[5].appendChild(uploadInput);
				
				widthInput = document.createElement('input');
				widthInput.type = 'text';
				widthInput.style.margin = "0px";
				widthInput.style.padding = "0px";
				widthInput.style.background = "#fff";
				
				heightInput = document.createElement('input');
				heightInput.type = 'text';
				heightInput.style.margin = "0px";
				heightInput.style.padding = "0px";
				heightInput.style.background = "#fff";
				
				altInput = document.createElement('input');
				altInput.type = "text";
				altInput.style.margin = "0px";
				altInput.style.padding = "0px";
				altInput.style.width = "330px";
				altInput.style.background = "#fff";
				
				borderInput = document.createElement('input');
				borderInput.type = 'text';
				borderInput.style.margin = "0px";
				borderInput.style.padding = "0px";
				borderInput.style.background = "#fff";
				
				alignInput = document.createElement('select');
				alignInput.innerHTML = '<option value="" >..not set..</option><option value="right"> Right </option> <option value="left"> Left </option>';
				alignInput.style.margin = "0px";
				alignInput.style.width = "140px";
				
				marginInput = document.createElement('input');
				marginInput.type = 'text';
				marginInput.style.margin = "0px";
				marginInput.style.padding = "0px";
				marginInput.style.background = "#fff";
				
				paddingInput = document.createElement('input');
				paddingInput.type = 'text';
				paddingInput.style.margin = "0px";
				paddingInput.style.padding = "0px";
				paddingInput.style.background = "#fff";
				
				idInput = document.createElement('input');
				idInput.type = 'text';
				idInput.style.margin = "0px";
				idInput.style.padding = "0px";
				idInput.style.background = "#fff";
				
				classInput = document.createElement('input');
				classInput.type = 'text';
				classInput.style.margin = "0px";
				classInput.style.padding = "0px";
				classInput.style.background = "#fff";
				
				styleInput = document.createElement('input');
				styleInput.type = 'text';
				styleInput.style.margin = "0px";
				styleInput.style.padding = "0px";
				styleInput.style.width = "330px";
				styleInput.style.background = "#fff";
				
				
				targetPane.parentNode.insertBefore(previewImage, targetPane.nextSibling);
				
				targetPane.innerHTML = '<table> \
					<tbody border="1" style="width:100%;border:solid 1px #eee;padding:5px;"> \
					<tr ><td>Width</td><td></td><td>Height</td><td></td></tr> \
					<tr ><td>Border</td><td></td><td>Alignment</td><td></td></tr> \
					<tr ><td>Alternate Text</td><td colspan="3"></td></tr> \
					</tbody> \
					</table> \
					<br /> \
					<hr /> \
					<table style="border:solid 1px #eee;padding:5px;"> \
					<thead style="width:100%;"><tr><th style="text-align: right; cursor:pointer;width:380px;text-shadow:none;" > &#8595; Advance</th> </tr></thead><tbody style="width:100%;display:none;"> \
					<tr ><td>Margin</td><td></td><td>Padding</td><td></td></tr> \
					<tr ><td>Id</td><td></td><td>Class</td><td></td></tr> \
					<tr ><td>CSS Style</td><td colspan="3"></td></tr> \
					</tbody> \
					</table><br />';
				
				targetAdvanceHead = targetPane.getElementsByTagName('thead')[0];
				
				targetPaneTds = targetPane.getElementsByTagName('td');
				targetPaneTds[1].appendChild(widthInput);
				targetPaneTds[3].appendChild(heightInput);
				targetPaneTds[5].appendChild(borderInput);
				targetPaneTds[7].appendChild(alignInput);
				targetPaneTds[9].appendChild(altInput);
				targetPaneTds[11].appendChild(marginInput);
				targetPaneTds[13].appendChild(paddingInput);
				targetPaneTds[15].appendChild(idInput);
				targetPaneTds[17].appendChild(classInput);
				targetPaneTds[19].appendChild(styleInput);
				
				targetAdvanceHead.onclick = function(){
					if(targetAdvanceHead.nextSibling.style.display == "none"){
						targetAdvanceHead.nextSibling.style.display = "block";
						targetAdvanceHead.firstChild.firstChild.innerHTML = "&#8593; Advance";
					}else{
						targetAdvanceHead.nextSibling.style.display = "none";
						targetAdvanceHead.firstChild.firstChild.innerHTML = "&#8595; Advance";
					}
				};
				
				uploadInput.onchange = function(event){
					files = event.target.files;
					for (var i = 0, f; f = files[i]; i++) {
						if (!f.type.match('image.*')) {
							continue;
						}
						var reader = new FileReader();
						reader.onload = (function(theFile) {
							return function(e) {
								newimage.src = e.target.result;
								lastUploadedCont = e.target.result;
								uploadRadio.checked = true;
								urlRadio.checked = false;
								
							   };
				      	})(f);
				      	reader.readAsDataURL(f);
					}
				};
				
				urlInput.onblur = function(event){
					
					newimage.src = urlInput.value;
					
					uploadRadio.checked = false;
					urlRadio.checked = true;
					
				};
				
				urlRadio.onclick = function(){
					
					if(urlRadio.checked){
						urlInput.focus();
						if(urlInput.value.length > 0)
							newimage.src = urlInput.value;
					}
					
				};
				
				uploadRadio.onclick = function(){
					
					if(uploadRadio.checked){
						uploadInput.focus();
						if(lastUploadedCont != undefined && lastUploadedCont.length > 0)
							newimage.src = lastUploadedCont;
					}
					
				};
				
				widthInput.onblur = applyStyles;
				heightInput.onblur = applyStyles;
				marginInput.onblur = applyStyles;
				paddingInput.onblur = applyStyles;
				borderInput.onblur = applyStyles;
				altInput.onblur = applyStyles;
				styleInput.onblur = applyStyles;
				alignInput.onchange = applyStyles;
				idInput.onblur = applyStyles;
				classInput.onblur = applyStyles;
				
			},
			onHide : function()
			{
				if ( this.preview )
					this.commitContent( CLEANUP, this.preview );

				if ( this.originalElement )
				{
					this.originalElement.removeListener( 'load', onImgLoadEvent );
					this.originalElement.removeListener( 'error', onImgLoadErrorEvent );
					this.originalElement.removeListener( 'abort', onImgLoadErrorEvent );
					this.originalElement.remove();
					this.originalElement = false;		// Dialog is closed.
				}

				delete this.imageElement;
				
				
				
			},
			
			contents:[
					{
						id : 'info_source',
						label : "Source",
						elements :
							[]
					},
					{
						id : 'info_url',
						label : "Style",
						elements :
							[]
					}
				]
			};
			
        };
        
        CKEDITOR.dialog.add( 'image', function( editor )
                {
                        return imageDialog( editor, 'image' );
                });
        CKEDITOR.dialog.add( 'imagebutton', function( editor )
                {
                        return imageDialog( editor, 'imagebutton' );
                });
        
        
        
})();