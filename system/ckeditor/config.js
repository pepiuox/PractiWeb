/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    // CKEDITOR.plugins.load('pgrfilemanager');

    /*
     * config.extraPlugins = 'filebrowser';
     config.config.extraPlugins = 'filebrowser';extraPlugins = 'imagebrowser';
     config.extraPlugins = 'imageuploader';    
     config.extraPlugins = 'uploadimage';    
     config.extraPlugins = 'uploadwidget';
     config.extraPlugins = 'notificationaggregator';
     config.extraPlugins = 'notification';
     config.extraPlugins = 'toolbar';
     config.extraPlugins = 'button';
     config.extraPlugins = 'filetools';
     config.extraPlugins = 'clipboard';
     config.extraPlugins = 'dialog';
     config.extraPlugins = 'dialogui';
     config.extraPlugins = 'widget';
     config.extraPlugins = 'lineutils';
     */

    config.filebrowserBrowseUrl = 'elFinder/elfinder.html';
    /*
     config.filebrowserBrowseUrl = '/kcfinder/browse.php?opener=ckeditor&type=files';
     config.filebrowserImageBrowseUrl = '/kcfinder/browse.php?opener=ckeditor&type=images';
     config.filebrowserFlashBrowseUrl = '/kcfinder/browse.php?opener=ckeditor&type=flash';
     config.filebrowserUploadUrl = '/kcfinder/upload.php?opener=ckeditor&type=files';
     config.filebrowserImageUploadUrl = '/kcfinder/upload.php?opener=ckeditor&type=images';
     config.filebrowserFlashUploadUrl = '/kcfinder/upload.php?opener=ckeditor&type=flash';
     */
};
