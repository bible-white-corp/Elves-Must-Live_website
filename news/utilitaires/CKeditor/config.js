/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	/* KCEditor (GRATUIT !) : explorateur de fichiers */
	config.filebrowserBrowseUrl 		= '../../utilitaires/KCfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl 	= '../../utilitaires/KCfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl 	= '../../utilitaires/KCfinder/browse.php?type=flash';
	config.filebrowserUploadUrl 		= '../../utilitaires/KCfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl 	= '../../utilitaires/KCfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl 	= '../../utilitaires/KCfinder/upload.php?type=flash';

	/* TOOLBAR (intégré) */
//	config.toolbar = 'Full';
//	config.toolbar = 'Basic';

	/* TOOLBAR PERSONNALISEE */
	config.toolbar = 'ToolbarArticle';

	config.toolbar_ToolbarArticle =
	[
	{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
	{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
	'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
	{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
	{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
	'/',
	{ name: 'colors', items : [ 'TextColor','BGColor' ] },
	{ name: 'styles', items : [ 'Format','Font' ] },
	{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
//	{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar' ] },
//	{ name: 'document', items : [ 'Source', 'ShowBlocks','Preview' ] }
	{ name: 'document', items : [ 'Source' ] }
	];
};
