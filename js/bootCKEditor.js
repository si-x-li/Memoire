/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
const editorName = "mainEditor";
const CKEditorRibbonHeight = 75;
const CKEditorStatusBarHeight = 27;
const fileNameHeight = 54;

/** Disable manual resize for CKEditor */
CKEDITOR.config.resize_enabled = false;

/** Configure CKEDITOR for extra plugins */
CKEDITOR.config.extraPlugins = 'autosave';
CKEDITOR.config.extraPlugins = 'notification';

sizeEditorScreen();

/** Sizes the editor screen appropriately */
function sizeEditorScreen() {
    /** Resizes CKEditor for the content on screen*/
    CKEDITOR.config.height = window.innerHeight 
            - recordBarHeight - navigatorHeight - statusBarHeight
            - CKEditorRibbonHeight - CKEditorStatusBarHeight - fileNameHeight;
    
    document.getElementById(recordBarID).style.height = 
            recordBarHeight;
}
