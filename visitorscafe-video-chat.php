<?php
/**
 * Include JavaScript widget for VisitorsCafe
 * 
 * Allows you to automatically insert the embedded code
 * 
 * @author Gigirtu Andrei
 * @version 1
 * @copyright Gigirtu Andrei
 * @since 7 December 2010
 */
/*
Plugin Name: VisitorsCafe Widget

Description: Adds a new text field in General Setting section which places javascript code of the VisitorsCafe widget in the header. In this plugin, you need to provide the widget id.  
Author: sinapticode
Version: 1
*/
    
    
 
function visitors_cafe_api_init() {
    // Add the section to general settings 
    add_settings_section('visitors_cafe_setting_section', 'VisitorsCafe Widget', 'visitors_cafe_section_callback_function', 'general');

     
    add_settings_field('visitors_cafe_code', 'Widget Code', 'visitors_cafe_callback_function', 'general', 'visitors_cafe_setting_section');

    
    register_setting('general','visitors_cafe_code');
} 
 
add_action('admin_init', 'visitors_cafe_api_init');
 
  
 
 // This function is needed if we added a new section. This function 
 // will be run at the start of our section
 //
 
 function visitors_cafe_section_callback_function() {
 	$widget_code = get_option('visitors_cafe_code');
 	if (!$widget_code) {
 	    echo 'Please paste the VisitorsCafe Widget Code. If you don\'t have your code yet, get it from <a href="http://www.visitorscafe.com/get-it?plugin=wordpress" target="_blank">Visitor Cafe website</a>';
 	}
 }
 
 // ------------------------------------------------------------------
 // Callback function 
 // ------------------------------------------------------------------
 //
 // creates a text filed to insert the code
 //
 
 function visitors_cafe_callback_function() {
 	echo '<input name="visitors_cafe_code" id="visitors_cafe_code" type="text" class="code" value="' . get_option('visitors_cafe_code') .'" />';
 }
 
 
function visitors_cafe_head() {

    $widget_code = get_option('visitors_cafe_code');
    
    if (!$widget_code) return;
     echo '<script type="text/javascript">var visitorsCafeOptions = { widget_size: "288", widget_container: "VisitorsCafe" };</script><script type="text/javascript" src="http://www.visitorscafe.com/widget.js?code='.$widget_code.'"></script>';
    //echo '<script type="text/javascript" src="http://www.visitorscafe.com/widget.js?code='.$widget_code.' <view-source:http://www.visitorscafe.com/widget.js?code='.$widget_code.'>"></script>';
     
}

add_action( 'wp_head', 'visitors_cafe_head' );

function deactivate_visitors_cafe() {
 
    unregister_setting('general','visitors_cafe_code');
     
}

function unistall_visitors_cafe() {
 
   
    delete_option('visitors_cafe_code');
}

register_deactivation_hook(__FILE__, 'deactivate_visitors_cafe');
 
register_uninstall_hook(__FILE__, 'unistall_visitors_cafe');
