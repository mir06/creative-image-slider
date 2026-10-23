<?php

function wpcis_admin(): void
{
    global $wpcis_options;
    ob_start();
    ?>
    <div class="wrap">
        <?php include "dictionary.php"; ?>
        <?php include "admin/header.php"; ?>
        <?php include "admin/content.php"; ?>
        <?php include "admin/footer.php"; ?>
    </div>
    <?php echo ob_get_clean();
}

function wpcis_add_options_link(): void
{
    $icon_url = plugins_url(
        "/images/Box_tool_creativeimageslider_16.png",
        __FILE__,
    );

    add_menu_page(
        "Creative Image Slider",
        "Creative Image Slider",
        "manage_options",
        "creativeimageslider",
        "wpcis_admin",
        $icon_url,
    );

    $page1 = add_submenu_page(
        "creativeimageslider",
        "Overview : Creative Image Slider",
        "Overview",
        "manage_options",
        "creativeimageslider",
        "wpcis_admin",
    );
    $page2 = add_submenu_page(
        "creativeimageslider",
        "Sliders : Creative Image Slider",
        "Sliders",
        "manage_options",
        "cis_sliders",
        "wpcis_admin",
    );
    $page3 = add_submenu_page(
        "creativeimageslider",
        "Items : Creative Image Slider",
        "Items",
        "manage_options",
        "cis_items",
        "wpcis_admin",
    );
    $page4 = add_submenu_page(
        "creativeimageslider",
        "Categories : Creative Image Slider",
        "Categories",
        "manage_options",
        "cis_categories",
        "wpcis_admin",
    );

    add_action("admin_print_scripts-" . $page1, "wpcis_load_overview_scripts");
    add_action("admin_print_scripts-" . $page2, "wpcis_load_sliders_scripts");
    add_action("admin_print_scripts-" . $page3, "wpcis_load_items_scripts");
    add_action(
        "admin_print_scripts-" . $page4,
        "wpcis_load_categories_scripts",
    );
}

function wpcis_register_settings(): void
{
    register_setting("wpcis_settings_group", "wpcis_settings");
}

function wpcis_load_overview_scripts(): void
{
    wp_enqueue_style(
        "wpcis-styles1",
        plugin_dir_url(__FILE__) . "css/admin.css",
    );
}

function wpcis_load_sliders_scripts(): void
{
    wp_enqueue_style(
        "wpcis-styles1",
        plugin_dir_url(__FILE__) . "css/creativecss-ui.css",
    );
    wp_enqueue_style(
        "wpcis-styles2",
        plugin_dir_url(__FILE__) . "css/colorpicker.css",
    );
    wp_enqueue_style(
        "wpcis-styles3",
        plugin_dir_url(__FILE__) . "css/layout.css",
    );
    wp_enqueue_style(
        "wpcis-styles4",
        plugin_dir_url(__FILE__) . "css/admin.css",
    );
    wp_enqueue_style(
        "wpcis-styles5",
        plugin_dir_url(__FILE__) . "assets/css/main.css",
    );
    wp_enqueue_style(
        "wpcis-styles6",
        plugin_dir_url(__FILE__) . "assets/css/creative_buttons.css",
    );

    wp_enqueue_script(
        "wpcis-script1",
        plugin_dir_url(__FILE__) . "js/admin.js",
        ["jquery", "jquery-ui-core", "jquery-ui-sortable", "jquery-ui-slider"],
    );
    wp_enqueue_script(
        "wpcis-script2",
        plugin_dir_url(__FILE__) . "js/colorpicker.js",
        ["jquery", "jquery-ui-core"],
    );
    wp_enqueue_script(
        "wpcis-script3",
        plugin_dir_url(__FILE__) . "assets/js/mousewheel.js",
        ["jquery", "jquery-ui-core"],
    );
    wp_enqueue_script(
        "wpcis-script4",
        plugin_dir_url(__FILE__) . "assets/js/easing.js",
        ["jquery", "jquery-ui-core"],
    );
    wp_enqueue_script(
        "wpcis-script5",
        plugin_dir_url(__FILE__) . "js/creativeimageslider.js",
        ["jquery", "jquery-ui-core"],
    );
}

function wpcis_load_items_scripts(): void
{
    wp_enqueue_media();

    wp_enqueue_style(
        "wpcis-styles1",
        plugin_dir_url(__FILE__) . "css/creativecss-ui.css",
    );
    wp_enqueue_style(
        "wpcis-styles2",
        plugin_dir_url(__FILE__) . "css/colorpicker.css",
    );
    wp_enqueue_style(
        "wpcis-styles3",
        plugin_dir_url(__FILE__) . "css/layout.css",
    );
    wp_enqueue_style(
        "wpcis-styles4",
        plugin_dir_url(__FILE__) . "css/admin.css",
    );
    wp_enqueue_style(
        "wpcis-styles5",
        plugin_dir_url(__FILE__) . "assets/css/main.css",
    );
    wp_enqueue_style(
        "wpcis-styles6",
        plugin_dir_url(__FILE__) . "assets/css/creative_buttons.css",
    );

    wp_enqueue_script(
        "wpcis-script1",
        plugin_dir_url(__FILE__) . "js/admin.js",
        ["jquery", "jquery-ui-core", "jquery-ui-sortable", "jquery-ui-slider"],
    );
    wp_enqueue_script(
        "wpcis-script2",
        plugin_dir_url(__FILE__) . "js/colorpicker.js",
        ["jquery", "jquery-ui-core"],
    );
    wp_enqueue_script(
        "wpcis-script3",
        plugin_dir_url(__FILE__) . "assets/js/mousewheel.js",
        ["jquery", "jquery-ui-core"],
    );
    wp_enqueue_script(
        "wpcis-script4",
        plugin_dir_url(__FILE__) . "assets/js/easing.js",
        ["jquery", "jquery-ui-core"],
    );
}

function wpcis_load_categories_scripts(): void
{
    wp_enqueue_style(
        "wpcis-styles2",
        plugin_dir_url(__FILE__) . "css/admin.css",
    );
    wp_enqueue_style(
        "wpcis-styles3",
        plugin_dir_url(__FILE__) . "css/options_styles.css",
    );

    wp_enqueue_script(
        "wpcis-script1",
        plugin_dir_url(__FILE__) . "js/admin.js",
        ["jquery"],
    );
    wp_enqueue_script(
        "wpcis-script2",
        plugin_dir_url(__FILE__) . "js/options_functions.js",
        [
            "jquery",
            "jquery-ui-core",
            "jquery-ui-sortable",
            "jquery-ui-dialog",
            "jquery-ui-tabs",
        ],
    );
}

add_action("admin_menu", "wpcis_add_options_link");
add_action("admin_init", "wpcis_register_settings");
