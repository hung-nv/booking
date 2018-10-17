/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

    config.language = 'en';

    config.toolbar = [
        {name: 'basicstyles', groups: ['basicstyles', 'cleanup'], items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']},
        {name: 'styles', items: ['Format', 'Font']},
        {name: 'colors', items: ['TextColor']},
        {name: 'links', items: ['Link', 'Unlink']},
        {name: 'paragraph', groups: ['list', 'blocks', 'align'], items: ['NumberedList', 'BulletedList', '-', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
        {name: 'insert', items: ['Image', 'Table', 'Iframe']},
        {name: 'tools', items: ['Maximize']},
        {name: 'document', groups: ['mode'], items: ['Source']},
        {name: 'others', items: ['-']},
    ];

// Toolbar groups configuration.
    config.toolbarGroups = [
        {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
        {name: 'styles'},
        {name: 'colors'},
        {name: 'links'},
        {name: 'paragraph', groups: ['list', 'align']},
        {name: 'insert'},
        {name: 'tools'},
        {name: 'document', groups: ['mode']},
        {name: 'others'},
    ];

    config.height = 400;

    // Remove some buttons provided by the standard plugins, which are
    // not needed in the Standard(s) toolbar.
    config.removeButtons = '';

    // Set the most common block elements.
    config.format_tags = 'p;h1;h2;h3;pre';

    // Simplify the dialog windows.
    config.removeDialogTabs = 'image:advanced;link:advanced';
};
