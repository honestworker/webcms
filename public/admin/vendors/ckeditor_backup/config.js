/**

 * @license Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.

 * For licensing, see LICENSE.html or http://ckeditor.com/license

 */



CKEDITOR.editorConfig = function( config ) {

	// Define changes to default configuration here.

	// For the complete reference:

	// http://docs.ckeditor.com/#!/api/CKEDITOR.config



	// The toolbar groups arrangement, optimized for two toolbar rows.

	config.toolbarGroups = [

		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },

		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },

		{ name: 'links' },

		{ name: 'insert' },

		{ name: 'forms' },

		{ name: 'tools' },

		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },

		{ name: 'others' },

		'/',

		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },

		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },

		{ name: 'styles' },

		{ name: 'colors' },

		{ name: 'about' }

	];



	// Remove some buttons, provided by the standard plugins, which we don't

	// need to have in the Standard(s) toolbar.

	config.removeButtons = 'Underline,Subscript,Superscript';
	
	config.extraPlugins = 'flash,youtube';
	//config.extraPlugins = 'flash';
	
	
	

	// allow i tags to be empty (for font awesome)
	
	CKEDITOR.dtd.$removeEmpty['i'] = false
	
	//config.filebrowserImageBrowseUrl = '/public/admin/vendors/ckeditor/pdw_file_browser/index.php?editor=ckeditor&filter=image';
	//config.filebrowserFlashBrowseUrl = '/public/admin/vendors/ckeditor/pdw_file_browser/index.php?editor=ckeditor&filter=flash';
	//config.filebrowserBrowseUrl = '/public/admin/vendors/ckeditor/pdw_file_browser/index.php?editor=ckeditor';
	
	
	
	
	config.filebrowserBrowseUrl = '/public/admin/vendors/ckeditor/filemanager/browser/default/browser.html?Connector=http://shop.tbm.com.my/public/admin/vendors/ckeditor/filemanager/connectors/php/connector.php',
    config.filebrowserImageBrowseUrl = '/public/admin/vendors/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=http://shop.tbm.com.my/public/admin/vendors/ckeditor/filemanager/connectors/php/connector.php',
    config.filebrowserFlashBrowseUrl = '/public/admin/vendors/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=http://shop.tbm.com.my/public/admin/vendors/ckeditor/filemanager/connectors/php/connector.php',
	config.filebrowserUploadUrl = 'http://shop.tbm.com.my/public/admin/vendors/ckeditor/filemanager/connectors/php/upload.php?Type=File',
	config.filebrowserImageUploadUrl = 'http://shop.tbm.com.my/public/admin/vendors/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
	config.filebrowserFlashUploadUrl = 'http://shop.tbm.com.my/public/admin/vendors/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
	
};

