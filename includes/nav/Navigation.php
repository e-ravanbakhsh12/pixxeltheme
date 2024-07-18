<?php
namespace PixxelTheme\includes\nav;

class Navigation
{

    function __construct()
    {
        global $pixxel_mega_menu_items;
        $pixxel_mega_menu_items = [];
    }

    public function getMenuIcon()
    {
        if (isset($_GET['id'])) {
            $image = wp_get_attachment_image(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT), 'medium', false);
            $data = array(
                'image'    => $image,
            );
            wp_send_json_success($data);
        } else {
            wp_send_json_error();
        }
    }


    public function addAdditionalClassOnMenuLi($classes, $item, $args, $depth)
    {
        global $pixxel_mega_menu_items;

        if ($depth == 0) {
            if (get_post_meta($item->ID, '_pixxel_is_mega', true)) {
                $pixxel_mega_menu_items[] = $item->ID;
            }
        }
        if ($depth == 1 &&  isset($args->add_drop_class)) {
            $classes[] = $args->add_drop_class;
        }
        if ($depth == 1 &&  isset($args->add_mega_class)) {
            if (in_array($item->menu_item_parent, $pixxel_mega_menu_items)) {
                $classes[] = $args->add_mega_class;
            }
        }
        if (isset($args->add_li_class)) {
            $classes[] = $args->add_li_class;
        }
        return $classes;
    }

    public function menuCustomFields($item_id, $menu_item, $depth, $args, $current_object_id)
    {

        if ($depth == 0 || $depth == 1) {
            wp_nonce_field('pixxel_menu_nonce', 'pixxel_menu_nonce_name');
            $is_mega_menu = get_post_meta($item_id, '_pixxel_is_mega', true);
            $badge = get_post_meta($item_id, '_pixxel_menu_badge', true);
            $menu_icon = get_post_meta($item_id, '_pixxel_menu_icon', true);
?>
            <div class="field-custom_menu_meta description-wide" style="margin: 5px 0;">
                <span class="description"><?php _e("Extra Field", 'pixxel'); ?></span>
                <br />
                <input type="hidden" class="nav-menu-id" value="<?php echo $item_id; ?>" />
                <?php if ($depth == 0) : ?>
                    <div class="pixxel-menu-section select-hover-color">
                        <label class="pixxel-label" for=""><?php esc_html_e('آیا زیر منوهای این ایتم به صورت مگامنو باشد؟ (سطح 1)', 'pixxel') ?></label>
                        <input type="checkbox" class="" data-alpha-enabled="true" name="is_mega[<?php echo $item_id; ?>]" id="is-mega-for<?php echo $item_id; ?>" <?php checked(!empty($is_mega_menu)) ?> />
                    </div>
                    <div class="pixxel-menu-section select-hover-color">
                        <label class="pixxel-label" for=""><?php esc_html_e('نمایش بج (سطح1) ', 'pixxel') ?></label>
                        <input type="text" id="edit-menu-item-category-<?php echo $item_id ?>" class="widefat" name="badge[<?php echo $item_id ?>]" value="<?php echo $badge ?>">
                    </div>
                <?php endif ?>
            </div>

<?php
        }
    }

    public function navUpdate($menu_id, $menu_item_db_id)
    {
        // Verify this came from our screen and with proper authorization.
        // if (!isset($_POST['pixxel_menu_nonce_name']) || !wp_verify_nonce($_POST['pixxell_menu_nonce_name'], 'pixxel_menu_nonce')) {
        //     return $menu_id;
        // }
        if (isset($_POST['is_mega'][$menu_item_db_id])) {
            update_post_meta($menu_item_db_id, '_pixxel_is_mega', true);
        } else {
            update_post_meta($menu_item_db_id, '_pixxel_is_mega', false);
        }
        if (isset($_POST['is_mega_content'][$menu_item_db_id])) {
            update_post_meta($menu_item_db_id, '_pixxel_is_mega_content', true);
        } else {
            update_post_meta($menu_item_db_id, '_pixxel_is_mega_content', false);
        }
        if (isset($_POST['badge'][$menu_item_db_id])) {
            $sanitized_data = sanitize_text_field($_POST['badge'][$menu_item_db_id]);
            update_post_meta($menu_item_db_id, '_pixxel_menu_badge', $sanitized_data);
        }

        if (isset($_POST['menu_icon'][$menu_item_db_id])) {
            $sanitized_data = sanitize_text_field($_POST['menu_icon'][$menu_item_db_id]);
            update_post_meta($menu_item_db_id, '_pixxel_menu_icon', $sanitized_data);
        }
    }

    public function registerMenuWalker()
    {
        require_once PIXXEL_DIR . '/includes/nav/navWalker.php';
    }


    public function navUpdateCache($menu_id, $menu_data = null)
    {
        delete_transient('pixxel_menu_list');
    }
}
