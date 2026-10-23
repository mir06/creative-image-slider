<?php
/*
Plugin Name: Creative Image Slider
Plugin URI: http://creative-solutions.net/wordpress/creative-image-slider/
Description: Creative Image Slider is a responsive jQuery image slider with amazing visual effects.
Author: Creative Solutions
Author URI: http://creative-solutions.net/
Version: 1.0.4
*/

// Start session with error handling
if (session_id() === "") {
    if (!session_start()) {
        error_log("Failed to start session.");
    }
}

// Define global variables with type hints
global $wpcis_db_version;
$plugin_version = "1.0.4";
$wpcis_db_version = "1.0.4";

// Define constants
define("WPCIS_PLUGINS_URL", plugins_url());
define("WPCIS_FOLDER", basename(dirname(__FILE__)));
define("WPCIS_SITE_URL", get_site_url());

/******************************
 * includes
 ******************************/

if (isset($_GET["act"]) && $_GET["act"] === "cis_submit_data") {
    if (isset($_GET["holder"]) && $_GET["holder"] === "sliders") {
        include "includes/admin/slider_submit.php";
    } elseif (isset($_GET["holder"]) && $_GET["holder"] === "items") {
        include "includes/admin/item_submit.php";
    } elseif (isset($_GET["holder"]) && $_GET["holder"] === "categories") {
        include "includes/admin/category_submit.php";
    } elseif (isset($_GET["holder"]) && $_GET["holder"] === "creativeajax") {
        include "includes/admin/creativeajax.php";
    } elseif (
        isset($_GET["holder"]) &&
        $_GET["holder"] === "creativextrachecking" &&
        !isset($_REQUEST["cis_reset"])
    ) {
        include "includes/admin/creativechecks.php";
        include "includes/admin/creativeajax.php";
    }
    exit();
}

include "includes/display-functions.php"; // display content functions
include "includes/creativeimageslider_widget.php"; // widget
include "includes/admin-page.php"; // the plugin options page HTML and save functions

/**
 * Install function for the plugin.
 *
 * @return void
 */
function wpcis_on_install(): void
{
    include "includes/install/install.sql.php"; // install
}

register_activation_hook(__FILE__, "wpcis_on_install");

/**
 * Uninstall function for the plugin.
 *
 * @return void
 */
function wpcis_on_uninstall(): void
{
    include "includes/install/uninstall.sql.php"; // uninstall
}

register_uninstall_hook(__FILE__, "wpcis_on_uninstall");

/**
 * Enqueue admin scripts for the plugin.
 *
 * @return void
 */
function wpcis_manager_admin_scripts(): void
{
    wp_enqueue_script("media-upload");
    wp_enqueue_script("thickbox");
    wp_enqueue_script("jquery");
}

/**
 * Enqueue admin styles for the plugin.
 *
 * @return void
 */
function wpcis_manager_admin_styles(): void
{
    wp_enqueue_style("thickbox");
}

// Register hooks
add_action("admin_print_scripts", "wpcis_manager_admin_scripts");
add_action("admin_print_styles", "wpcis_manager_admin_styles");
