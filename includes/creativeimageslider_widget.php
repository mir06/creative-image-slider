<?php
class creativeimageslider_widget extends WP_Widget
{
    // Constructor
    public function __construct()
    {
        $widget_ops = [
            "classname" => "creativeimageslider_widget",
            "description" => "Add Creative Image Slider widget.",
        ];
        $control_ops = ["id_base" => "creativeimageslider_widget"];
        parent::__construct(
            "creativeimageslider_widget",
            "Creative Image Slider",
            $widget_ops,
            $control_ops,
        );
    }

    // Widget Content
    public function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters("widget_title", $instance["title"] ?? "");

        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . esc_html($title) . $after_title;
        }

        wpcis_enqueue_front_scripts($instance["slider_id"] ?? 0);
        echo wpcis_render_slider($instance["slider_id"] ?? 0);

        echo $after_widget;
    }

    // Update Widget Settings
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance["title"] = !empty($new_instance["title"])
            ? $new_instance["title"]
            : "";
        $instance["slider_id"] = !empty($new_instance["slider_id"])
            ? (int) $new_instance["slider_id"]
            : 0;
        return $instance;
    }

    // Widget Control Panel
    public function form($instance)
    {
        $defaults = [
            "title" => "",
            "slider_id" => 0,
        ];
        $instance = wp_parse_args((array) $instance, $defaults);
        global $wpdb;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id(
                "title",
            ); ?>">Title:</label>
            <input class="widefat" id="<?php echo $this->get_field_id(
                "title",
            ); ?>"
                   name="<?php echo $this->get_field_name("title"); ?>"
                   type="text" value="<?php echo esc_attr(
                       $instance["title"],
                   ); ?>"/>

            <label for="<?php echo $this->get_field_id(
                "slider_id",
            ); ?>">Select a Slider:</label>
            <select name="<?php echo $this->get_field_name("slider_id"); ?>"
                    id="<?php echo $this->get_field_id("slider_id"); ?>"
                    style="width:225px;">
                <option value="0">- Select a Slider -</option>
                <?php
                $ids_creativeimageslider = $wpdb->get_results(
                    "SELECT * FROM " .
                        $wpdb->prefix .
                        "cis_sliders ORDER BY `id` DESC",
                );
                foreach (
                    $ids_creativeimageslider
                    as $arr_creativeimageslider
                ) { ?>
                    <option value="<?php echo (int) $arr_creativeimageslider->id; ?>"
                        <?php selected(
                            $instance["slider_id"],
                            (int) $arr_creativeimageslider->id,
                        ); ?>>
                        <?php echo esc_html($arr_creativeimageslider->name); ?>
                    </option>
                    <?php }?>
            </select>
        </p>
        <?php
    }
}

// Register the widget using an action hook
function register_creativeimageslider_widget()
{
    register_widget("creativeimageslider_widget");
}
add_action("widgets_init", "register_creativeimageslider_widget");
