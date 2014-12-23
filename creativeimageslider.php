<?php
/*
Plugin Name: Creative Image Slider
Plugin URI: http://creative-solutions.net/wordpress/creative-image-slider/
Description: Creative Image Slider is a responsive jQuery image slider with amazing visual effects. You will be surprised by count of all the possible features!.
Author: Creative Solutions
Author URI: http://creative-solutions.net/
Version: 1.0.3
*/

//strat session
if (session_id() == '') {
	session_start();
	//check
}
global $wpcis_db_version;
$plugin_version = '1.0.3';
$wpcis_db_version = '1.0.3';

define('WPCIS_PLUGINS_URL', plugins_url());
define('WPCIS_FOLDER', basename(dirname(__FILE__)));
define('WPCIS_SITE_URL', get_option('siteurl'));

/******************************
* includes
******************************/

if(isset($_GET['act']) && $_GET['act'] == 'cis_submit_data') {
	if(isset($_GET['holder']) && $_GET['holder'] == 'sliders')
		include('includes/admin/slider_submit.php');
	elseif(isset($_GET['holder']) && $_GET['holder'] == 'items')
		include('includes/admin/item_submit.php');
	elseif(isset($_GET['holder']) && $_GET['holder'] == 'categories')
		include('includes/admin/category_submit.php');
	elseif(isset($_GET['holder']) && $_GET['holder'] == 'creativeajax')
		include('includes/admin/creativeajax.php');

	elseif(isset($_GET['holder']) && $_GET['holder'] == 'creativextrachecking'  && (!isset($_REQUEST['cis_reset'])) ) {
		include('includes/admin/creativechecks.php');
		include('includes/admin/creativeajax.php');
	}
	exit();
}
include('includes/display-functions.php'); // display content functions
include('includes/creativeimageslider_widget.php'); // widget
include('includes/admin-page.php'); // the plugin options page HTML and save functions

function wpcis_on_install() {
	include('includes/install/install.sql.php'); // install
}

register_activation_hook(__FILE__, 'wpcis_on_install');

function wpcis_on_uninstall() {
	include('includes/install/uninstall.sql.php'); // uninstall
}

register_uninstall_hook(__FILE__, 'wpcis_on_uninstall');


function wpcis_manager_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery');
}

function wpcis_manager_admin_styles() {
	wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'wpcis_manager_admin_scripts');
add_action('admin_print_styles', 'wpcis_manager_admin_styles');

?>