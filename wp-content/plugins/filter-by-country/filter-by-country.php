<?php
/*
Plugin Name: Filter-by-country
Description: Allow 1 login per country (multiple users feature), i.e. one user “argentina”, one user “brazil”, etc, each of these users should be able to manage content only for the country to which the user belongs, not to other countries, not to the whole website, just for that country.  The superadmin can reset the password for the users if needed.
Version: 1.0
Author: Freddy Garcia
License: GPL2
*/

// Exit if accessed directly
defined('ABSPATH') || exit;

class filterByUserCountry
{
    public function __construct()
    {
        add_action('init', [$this, 'initialize']);
    }

    public function activate()
    {
        $this->initialize();
        flush_rewrite_rules();
    }

    public function deactivate()
    {
        flush_rewrite_rules();
    }

    public function uninstall()
    {
    }

    public function initialize()
    {
        //add country input field to user profile page
        add_action('user_new_form', [$this, 'extra_user_profile_fields']);
        add_action('show_user_profile', [$this, 'extra_user_profile_fields']);
        add_action('edit_user_profile', [$this, 'extra_user_profile_fields']);

        //save country input field when edit/save user profile
        add_action('user_register', [$this, 'save_extra_user_profile_fields']);
        add_action('personal_options_update', [$this, 'save_extra_user_profile_fields']);
        add_action('edit_user_profile_update', [$this, 'save_extra_user_profile_fields']);

        //add custom column to user table
        add_filter('manage_users_columns', [$this, 'custom_user_columns']);
        //set custom column value of user table
        add_filter('manage_users_custom_column', [$this, 'custom_user_column_content'], 10, 3);

        //custom sidebar of admin page by login user
        // add_action('admin_menu', [$this, 'custom_admin_menu']);

        //show only user's country in country page
        add_action('pre_get_terms', [$this, 'filter_country_list']);

        //filter data by login-user country
        add_action('pre_get_posts', [$this, 'filter_posts_page']);
        //hide country meta box in post editor
        add_action('admin_enqueue_scripts', [$this, 'hide_disable_post_fields']);
        //set login-user country when insert new post
        add_action('save_post', [$this, 'set_default_country'], 10, 3);
    }

    public function set_default_country($post_id, $post, $update)
    {
        if (wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
            return;
        }

        $user = wp_get_current_user();
        $user_country = get_user_meta($user->ID, 'country', true);
        $user_roles = $user->roles;
        if ($update == false && !in_array('administrator', $user_roles) && $user_country != '') {
            $fixed_term = $user_country;
            $taxonomy = 'pais';
            $term_id = get_term_by('slug', $fixed_term, $taxonomy)->term_id;
            wp_set_object_terms($post_id, $term_id, $taxonomy);
        }
    }

    public function extra_user_profile_fields($user)
    {
        if (isset($user->ID)) {
            $country = get_user_meta($user->ID, 'country', true);
        } else {
            $country = '';
        }
        $current_language = get_locale();
        $all_countries = get_terms([
            'taxonomy' => 'pais',
            'hide_empty' => false,
            'lang' => $current_language,
        ]);
        // $all_countries = get_terms('pais');?>
        
        <table class="form-table">
            <tr>
                <th><label for="country"><?php _e('Country'); ?></label></th>
                <td>
                    <select name="country" id="country" class="regular-text">
                        <option value=""></option>
                        <?php foreach ($all_countries as $item) { ?>
                        <?php if ($country == $item->slug) { ?>
                            <option selected value=<?php echo $item->slug; ?>><?php echo $item->name; ?></option>
                        <?php } else { ?>
                            <option value=<?php echo $item->slug; ?>><?php echo $item->name; ?></option>
                        <?php }?>
                        <?php } ?>
                    </select>
                    
                </td>
            </tr>
        </table>
        <?php
    }

    public function save_extra_user_profile_fields($user_id)
    {
        // if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'update-user_'.$user_id)) {
        //     return;
        // }

        if (!current_user_can('edit_user', $user_id)) {
            return;
        }

        update_user_meta($user_id, 'country', sanitize_text_field($_POST['country']));
    }

    public function custom_user_column_content($value, $column_name, $user_id)
    {
        if ('country' == $column_name) {
            // Add your custom content here
            $value = get_user_meta($user_id, 'country', true);
            $term_data = get_term_by('slug', $value, 'pais');
            if (isset($term_data) && isset($term_data->name)) {
                $value = $term_data->name;
            }
        }

        return $value;
    }

    // Add custom column to user page
    public function custom_user_columns($columns)
    {
        $columns['country'] = __('País', 'textdomain');

        return $columns;
    }

    public function custom_admin_menu()
    {
        $user = wp_get_current_user();
        $user_country = get_user_meta($user->ID, 'country', true);
        $user_roles = $user->roles;
        if (!in_array('administrator', $user_roles) && $user_country != '') {
            //remove countries sub menu---------------------
            global $submenu;
            foreach ($submenu as $menu_key => $menu_items) {
                foreach ($menu_items as $key => $item) {
                    if (strpos($item[2], 'edit-tags.php?taxonomy=pais') !== false) {
                        unset($submenu[$menu_key][$key]);
                    }
                }
            }
            //------------------------------------------------
            // $args = [
            //     'tax_query' => [
            //         [
            //             'taxonomy' => 'pais',
            //             'order' => 'ASC',
            //             'field' => 'name',
            //             'terms' => [$user_country],
            //             'operator' => 'IN',
            //         ],
            //     ],
            //     'post_type' => 'post',
            //     'posts_per_page' => -1,
            // ];

            // $custom_query = new WP_Query($args);

            // if ($custom_query->have_posts()) {
            //     while ($custom_query->have_posts()) {
            //         $custom_query->the_post();
            //     }
            // }
            // wp_reset_postdata();
        }
    }

    public function filter_country_list($query)
    {
        $user = wp_get_current_user();
        $user_country = get_user_meta($user->ID, 'country', true);
        $user_roles = $user->roles;
        if (is_admin() && !in_array('administrator', $user_roles) && $user_country != '') {
            $screen = get_current_screen();
            if ($screen && isset($screen->id) && $screen->id == 'edit-pais') {
                $query->query_vars['slug'] = $user_country;
            }
        }
    }

    public function filter_posts_page($query)
    {
        $user = wp_get_current_user();
        $user_country = get_user_meta($user->ID, 'country', true);
        $user_roles = $user->roles;
        if (is_admin() && !in_array('administrator', $user_roles) && $user_country != '') {
            if (!($query->get('post_type') === 'attachment')) {
                $screen = get_current_screen();
                if (!($screen && isset($screen->id) && $screen->id == 'edit-pais')) {
                    $user_country_name = get_term_by('slug', $user_country, 'pais')->name;
                    $query->set('pais', $user_country_name);
                }
            }
        }
    }

    public function hide_disable_post_fields()
    {
        $user = wp_get_current_user();
        $user_country = get_user_meta($user->ID, 'country', true);
        $user_roles = $user->roles;
        if (!in_array('administrator', $user_roles) && $user_country != '') {
            global $post;
            // Hide or disable the desired post fields
            if (isset($post)) {
                wp_enqueue_script('filter-by-country', plugin_dir_url(__FILE__).'/js/filter-by-country.js', ['jquery'], '1.0', true);
            }
        }
    }

    public function custom_default_post_meta_box_hidden($hidden, $screen)
    {
        $user = wp_get_current_user();
        $user_country = get_user_meta($user->ID, 'country', true);
        $user_roles = $user->roles;
        if (!in_array('administrator', $user_roles) && $user_country != '') {
            if ($screen->post_type == 'post') {
                $hidden = ['postcustom', 'trackbacksdiv', 'commentstatusdiv', 'commentsdiv'];
            }

            return $hidden;
        }
    }
}

$plugin = new filterByUserCountry();

register_activation_hook(__FILE__, [$plugin, 'activate']);
register_deactivation_hook(__FILE__, [$plugin, 'deactivate']);
