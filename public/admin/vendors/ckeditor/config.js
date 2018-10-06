/**
 * @license Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	 config.allowedContent = true;
    config.extraAllowedContent = 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}';
	config.extraPlugins = 'sourcedialog,youtube';
	
    CKEDITOR.dtd.$removeEmpty.i = 0;
	
	
   config.filebrowserBrowseUrl = 'http://m1.ritzgardenhotel.com/public/admin/vendors/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
   config.filebrowserImageBrowseUrl = 'http://m1.ritzgardenhotel.com/public/admin/vendors/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
   config.filebrowserFlashBrowseUrl = 'http://m1.ritzgardenhotel.com/public/admin/vendors/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';
   config.filebrowserUploadUrl = 'http://m1.ritzgardenhotel.com/public/admin/vendors/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';
   config.filebrowserImageUploadUrl = 'http://m1.ritzgardenhotel.com/public/admin/vendors/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
   config.filebrowserFlashUploadUrl = 'http://m1.ritzgardenhotel.com/public/admin/vendors/ckeditor/upload.php?opener=ckeditor&type=flash';
};
