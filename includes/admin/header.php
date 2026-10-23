<div class="purchase_block">
    <div class="purchase_block_txt">Get Creative Image Slider Commercial and gain access to <b style="color: rgb(9, 24, 201); text-shadow: -1px 1px 0px rgba(0,0,0,0.33);">Unlimited Items, Unlimited Sliders, NO Copyright, Professional Support.</b></div>
    <a href="http://creative-solutions.net/wordpress/creative-image-slider" id="wpcis_buy_pro" target="_blank">Get Creative Image Slider Commercial</a>
</div>

<?php
$page = $_GET["page"] ?? "creativeimageslider";
$act = $_GET["act"] ?? "";
$id = (int) ($_REQUEST["id"] ?? 0);

// Get the active text
$active_text = match ($page) {
    "creativeimageslider" => "Overview",
    "cis_sliders" => $act === ""
        ? "Sliders"
        : ($act === "new"
            ? "Sliders : New"
            : "Sliders : Edit"),
    "cis_items" => $act === ""
        ? "Items"
        : ($act === "new"
            ? "Items : New"
            : "Items : Edit"),
    "cis_categories" => "Categories",
    default => "Overview",
};
?>

<div id="wpcis_logo" class="icon32"></div>
<h2>Creative Image Slider: <?php echo esc_html($active_text); ?></h2>
<p></p>
<div id="wpcis-toolbar">
    <ul id="wpcis-toolbar-links">
        <li>
            <div class="wpcis-toolbar-link-bg" id="wpcis-toolbar-link-overview<?php echo $page ===
            "creativeimageslider"
                ? "_active"
                : ""; ?>" style="margin-left: 5px;"></div>
            <a class="<?php echo $page === "creativeimageslider"
                ? "wpcis-toolbar-active"
                : ""; ?>" href="admin.php?page=creativeimageslider">Overview</a>
        </li>
        <li>
            <div class="wpcis-toolbar-link-bg" id="wpcis-toolbar-link-sliders<?php echo $page ===
            "cis_sliders"
                ? "_active"
                : ""; ?>"></div>
            <a class="<?php echo $page === "cis_sliders"
                ? "wpcis-toolbar-active"
                : ""; ?>" href="admin.php?page=cis_sliders">Sliders</a>
        </li>
        <li>
            <div class="wpcis-toolbar-link-bg" id="wpcis-toolbar-link-items<?php echo $page ===
            "cis_items"
                ? "_active"
                : ""; ?>"></div>
            <a class="<?php echo $page === "cis_items"
                ? "wpcis-toolbar-active"
                : ""; ?>" href="admin.php?page=cis_items">Items</a>
        </li>
        <li>
            <div class="wpcis-toolbar-link-bg" id="wpcis-toolbar-link-categories<?php echo $page ===
            "cis_categories"
                ? "_active"
                : ""; ?>"></div>
            <a class="<?php echo $page === "cis_categories"
                ? "wpcis-toolbar-active"
                : ""; ?>" href="admin.php?page=cis_categories">Categories</a>
        </li>
    </ul>
</div>
<div style="clear:both;"></div>
