/*
 Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://ckeditor.com/license

CKEDITOR.dialog.add("anchor",function(c){var d=function(a){this._.selectedElement=a;this.setValueOf("info","txtName",a.data("cke-saved-name")||"")};return{title:c.lang.link.anchor.title,minWidth:300,minHeight:60,onOk:function(){var a=CKEDITOR.tools.trim(this.getValueOf("info","txtName")),a={id:a,name:a,"data-cke-saved-name":a};if(this._.selectedElement)this._.selectedElement.data("cke-realelement")?(a=c.document.createElement("a",{attributes:a}),c.createFakeElement(a,"cke_anchor","anchor").replace(this._.selectedElement)):
this._.selectedElement.setAttributes(a);else{var b=c.getSelection(),b=b&&b.getRanges()[0];b.collapsed?(CKEDITOR.plugins.link.synAnchorSelector&&(a["class"]="cke_anchor_empty"),CKEDITOR.plugins.link.emptyAnchorFix&&(a.contenteditable="false",a["data-cke-editable"]=1),a=c.document.createElement("a",{attributes:a}),CKEDITOR.plugins.link.fakeAnchor&&(a=c.createFakeElement(a,"cke_anchor","anchor")),b.insertNode(a)):(CKEDITOR.env.ie&&9>CKEDITOR.env.version&&(a["class"]="cke_anchor"),a=new CKEDITOR.style({element:"a",
attributes:a}),a.type=CKEDITOR.STYLE_INLINE,c.applyStyle(a))}},onHide:function(){delete this._.selectedElement},onShow:function(){var a=c.getSelection(),b=a.getSelectedElement();if(b)CKEDITOR.plugins.link.fakeAnchor?((a=CKEDITOR.plugins.link.tryRestoreFakeAnchor(c,b))&&d.call(this,a),this._.selectedElement=b):b.is("a")&&b.hasAttribute("name")&&d.call(this,b);else if(b=CKEDITOR.plugins.link.getSelectedLink(c))d.call(this,b),a.selectElement(b);this.getContentElement("info","txtName").focus()},contents:[{id:"info",
label:c.lang.link.anchor.title,accessKey:"I",elements:[{type:"text",id:"txtName",label:c.lang.link.anchor.name,required:!0,validate:function(){return!this.getValue()?(alert(c.lang.link.anchor.errorName),!1):!0}}]}]}});
*/

/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.dialog.add( 'anchor', function( editor )
{
	// Function called in onShow to load selected element.
	var loadElements = function( editor, selection, element )
	{
		this.editMode = true;
		this.editObj = element;

		var attributeValue = this.editObj.getAttribute( 'name' );
		if ( attributeValue )
			this.setValueOf( 'info','txtName', attributeValue );
		else
			this.setValueOf( 'info','txtName', "" );
	};

	return {
		title : editor.lang.anchor.title,
		minWidth : 300,
		minHeight : 60,
		onOk : function()
		{
			// Always create a new anchor, because of IE BUG.
			var name = this.getValueOf( 'info', 'txtName' ),
				element = CKEDITOR.env.ie && !( CKEDITOR.document.$.documentMode >= 8 ) ?
				editor.document.createElement( '<a name="' + CKEDITOR.tools.htmlEncode( name ) + '">' ) :
				editor.document.createElement( 'a' );

			// Move contents and attributes of old anchor to new anchor.
			if ( this.editMode )
			{
				this.editObj.copyAttributes( element, { name : 1 } );
				this.editObj.moveChildren( element );
			}

			// Set name.
			element.data( 'cke-saved-name', false );
			element.setAttribute( 'name', name );

			// Insert a new anchor.
			var fakeElement = editor.createFakeElement( element, 'cke_anchor', 'anchor' );
			if ( !this.editMode )
				editor.insertElement( fakeElement );
			else
			{
				fakeElement.replace( this.fakeObj );
				editor.getSelection().selectElement( fakeElement );
			}

			return true;
		},
		onShow : function()
		{
			this.editObj = false;
			this.fakeObj = false;
			this.editMode = false;

			var selection = editor.getSelection();
			var element = selection.getSelectedElement();
			if ( element && element.data( 'cke-real-element-type' ) && element.data( 'cke-real-element-type' ) == 'anchor' )
			{
				this.fakeObj = element;
				element = editor.restoreRealElement( this.fakeObj );
				loadElements.apply( this, [ editor, selection, element ] );
				selection.selectElement( this.fakeObj );
			}
			this.getContentElement( 'info', 'txtName' ).focus();
		},
		contents : [
			{
				id : 'info',
				label : editor.lang.anchor.title,
				accessKey : 'I',
				elements :
				[
					{
						type : 'text',
						id : 'txtName',
						label : editor.lang.anchor.name,
						required: true,
						validate : function()
						{
							if ( !this.getValue() )
							{
								alert( editor.lang.anchor.errorName );
								return false;
							}
							return true;
						}
					}
				]
			}
		]
	};
} );
