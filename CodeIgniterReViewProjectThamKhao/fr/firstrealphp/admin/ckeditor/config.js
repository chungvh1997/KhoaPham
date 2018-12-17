/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	// Define changes to default configuration here. For example:
	 config.language = 'vi';
	config.extraPlugins = 'youtube,widget,btgrid,lineutils';
	// config.uiColor = '#AADC6E';
	config.youtube_width = '500';
	config.youtube_height = '480';
	config.youtube_related = true;
	config.youtube_older = false;
	config.youtube_privacy = false;

config.allowedContent = true;
config.bootstrapTab_managePopupContent = true;
config.mj_variables_allow_html = false;
};
