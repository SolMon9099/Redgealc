<?php

/**
 * @param bool  $echo
 * @param array $params
 *
 * @return string|null
 *
 * Using Bootstrap 4? see https://gist.github.com/mtx-z/f95af6cc6fb562eb1a1540ca715ed928
 *
 * Accepts a WP_Query instance to build pagination (for custom wp_query()),
 * or nothing to use the current global $wp_query (eg: taxonomy term page)
 * - Tested on WP 5.7.1
 * - Tested with Bootstrap 5.0 (https://getbootstrap.com/docs/5.0/components/pagination/)
 * - Tested on Sage 9.0.9
 *
 * INSTALLATION:
 * add this file content to your theme function.php or equivalent
 *
 * USAGE:
 *     <?php echo bootstrap_pagination(); ?> //uses global $wp_query
 * or with custom WP_Query():
 *     <?php
 *      $query = new \WP_Query($args);
 *       ... while(have_posts()), $query->posts stuff ... endwhile() ...
 *       echo bootstrap_pagination($query);
 *     ?>
 */
function bootstrap_pagination(WP_Query $wp_query = null, $echo = true, $params = [])
{
    if (null === $wp_query) {
        global $wp_query;
    }

    $add_args = [];

    //add query (GET) parameters to generated page URLs
    /*if (isset($_GET[ 'sort' ])) {
        $add_args[ 'sort' ] = (string)$_GET[ 'sort' ];
    }*/

    $pages = paginate_links(
        array_merge([
            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'type' => 'array',
            'show_all' => false,
            'end_size' => 3,
            'mid_size' => 1,
            'prev_next' => true,
            'prev_text' => __('« Ant'),
            'next_text' => __('Sig »'),
            'add_args' => $add_args,
            'add_fragment' => '',
        ], $params)
    );

    if (is_array($pages)) {
        //$current_page = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
        $pagination = '<nav aria-label="Page navigation"><ul class="pagination">';

        foreach ($pages as $page) {
            $pagination .= '<li class="page-item'.(strpos($page, 'current') !== false ? ' active' : '').'"> '.str_replace('page-numbers', 'page-link', $page).'</li>';
        }

        $pagination .= '</ul></nav>';

        if ($echo) {
            echo $pagination;
        } else {
            return $pagination;
        }
    }

    return null;
}

/*
 * Notes:
 * AJAX:
 * - When used with wp_ajax (generate pagination HTML from ajax) you'll need to provide base URL (or it'll be admin-ajax URL)
 * - Example for a term page: bootstrap_pagination( $query, false, ['base' => get_term_link($term) . '?paged=%#%'] )
 *
 * Images as next/prev:
 * - You can use image as next/prev buttons
 * - Example: 'prev_text' => '<img src="' . get_stylesheet_directory_uri() . '/assets/images/prev-arrow.svg">',
 *
 * Add query parameters to page URLs
 * - If you need custom URL parameters on your page URLS, use the "add_args" attribute
 * - Example (before paginate_links() call):
 * $arg = [];
 * if (isset($_GET[ 'sort' ])) {
 *  $args[ 'sort' ] = (string)$_GET[ 'sort' ];
 * }
 * ...
 * 'add_args'     => $args,
 */

add_action('widgets_init', 'my_register_sidebars');

function my_register_sidebars()
{
    /* Register the '1' sidebar. */
    register_sidebar(
        [
            'id' => 'footer_1',
            'name' => __('Footer 1 Sidebar'),
            //'description'   => __( 'A short description of the sidebar.' ),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h5>',
            'after_title' => '</h5>',
        ]
    );
    /* Register the '2' sidebar. */
    register_sidebar(
        [
            'id' => 'footer_2',
            'name' => __('Footer 2 Sidebar'),
            //'description'   => __( 'A short description of the sidebar.' ),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h5>',
            'after_title' => '</h5>',
        ]
    );
    register_sidebar(
        [
            'id' => 'footer_3_1',
            'name' => __('Footer pages block 1'),
            //'description'   => __( 'A short description of the sidebar.' ),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h5>',
            'after_title' => '</h5>',
        ]
    );
    register_sidebar(
        [
            'id' => 'footer_3_2',
            'name' => __('Footer pages block 2'),
            //'description'   => __( 'A short description of the sidebar.' ),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h5>',
            'after_title' => '</h5>',
        ]
    );
    register_sidebar(
        [
            'id' => 'footer_3_3',
            'name' => __('Footer pages block 3'),
            //'description'   => __( 'A short description of the sidebar.' ),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h5>',
            'after_title' => '</h5>',
        ]
    );
    register_sidebar(
        [
            'id' => 'footer_3_4',
            'name' => __('Footer pages block 4'),
            //'description'   => __( 'A short description of the sidebar.' ),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h5>',
            'after_title' => '</h5>',
        ]
    );
    /* Register the '3' sidebar. */
    register_sidebar(
        [
            'id' => 'header_1',
            'name' => __('Header Sidebar'),
            //'description'   => __( 'A short description of the sidebar.' ),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h5>',
            'after_title' => '</h5>',
        ]
    );

    /* Register the '4' sidebar. */
    register_sidebar(
        [
            'id' => 'sidebar_1',
            'name' => __('Sidebar 1'),
            //'description'   => __( 'A short description of the sidebar.' ),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h5>',
            'after_title' => '</h5>',
        ]
    );

    /* Register the '5' sidebar. */
    register_sidebar(
        [
            'id' => 'sidebar_2',
            'name' => __('Sidebar 2'),
            // 'description'   => __( 'A short description of the sidebar.' ),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h5>',
            'after_title' => '</h5>',
        ]
    );
    /* Repeat register_sidebar() code for additional sidebars. */
}

add_theme_support('post-thumbnails');

add_image_size('home-thumb', 756, 756, true); //resize, crop in functions.php
add_image_size('person-thumb', 180, 180, true); //resize, crop in functions.php

function featured_image_support()
{
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'featured_image_support');

function add_bcn_manage_options_to_admin()
{
    // gets the administrator role
    $role = get_role('administrator');

    // would allow the administrator to manage breadcrumbs. Fix needed due the conflict in Breadcrumb NavXT version 7 with some other plugin.
    $role->add_cap('bcn_manage_options');
}
add_action('admin_init', 'add_bcn_manage_options_to_admin');

function themename_custom_logo_setup()
{
    $defaults = [
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
        'header-text' => ['site-title', 'site-description'],
        'unlink-homepage-logo' => true,
    ];

    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'themename_custom_logo_setup');

function cortar($texto, $tamano = 150, $puntos = '...')
{
    $texto = strip_tags($texto);
    if (strlen($texto) <= $tamano) {
        return $texto;
    }
    $body = explode(' ', $texto);
    $output = $body[0];
    $i = 1;

    while ((strlen($output) + strlen($body[$i]) + 1) <= $tamano and $body[$i]) {
        $output .= ' '.$body[$i];
        ++$i;
    }

    return $output.$puntos;
}

/**
 * CSDev - Bootstrap 5 wp_nav_menu walker
 * Supports WP MultiLevel menus
 * Based on https://github.com/AlexWebLab/bootstrap-5-wordpress-navbar-walker
 * Requires additional CSS fixes
 * CSS at https://gist.github.com/cdsaenz/d401330ba9705cfe7c18b19634c83004
 * CHANGE: removed custom display_element. Just call the menu with a $depth of 3 or more.
 */
class bs5_Walker extends Walker_Nav_menu
{
    private $current_item;
    private $dropdown_menu_alignment_values = [
        'dropdown-menu-start',
        'dropdown-menu-end',
        'dropdown-menu-sm-start',
        'dropdown-menu-sm-end',
        'dropdown-menu-md-start',
        'dropdown-menu-md-end',
        'dropdown-menu-lg-start',
        'dropdown-menu-lg-end',
        'dropdown-menu-xl-start',
        'dropdown-menu-xl-end',
        'dropdown-menu-xxl-start',
        'dropdown-menu-xxl-end',
    ];

    /**
     * Start Level.
     */
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $dropdown_menu_class[] = '';
        foreach ($this->current_item->classes as $class) {
            if (in_array($class, $this->dropdown_menu_alignment_values)) {
                $dropdown_menu_class[] = $class;
            }
        }
        $indent = str_repeat("\t", $depth);
        // CSDEV changed sub-menu  for dropdown-submenu
        $submenu = ($depth > 0) ? ' dropdown-submenu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu ".esc_attr(implode(' ', $dropdown_menu_class))." depth_$depth\">\n";
    }

    /**
     * Start Element.
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $this->current_item = $item;

        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $li_attributes = '';
        $class_names = $value = '';

        $classes = empty($item->classes) ? [] : (array) $item->classes;

        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        $classes[] = 'nav-item';
        $classes[] = 'nav-item-'.$item->ID;
        // CSDev added dropdown-menu-child-item & at_depth classes
        if ($depth && $args->walker->has_children) {
            $classes[] = 'dropdown-menu-child-item dropdown-menu-end at_depth_'.$depth;
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = ' class="'.esc_attr($class_names).'"';

        $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
        $id = strlen($id) ? ' id="'.esc_attr($id).'"' : '';

        $output .= $indent.'<li '.$id.$value.$class_names.$li_attributes.'>';

        $attributes = !empty($item->attr_title) ? ' title="'.esc_attr($item->attr_title).'"' : '';
        $attributes .= !empty($item->target) ? ' target="'.esc_attr($item->target).'"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="'.esc_attr($item->xfn).'"' : '';
        $attributes .= !empty($item->url) ? ' href="'.esc_attr($item->url).'"' : '';

        $active_class = ($item->current || $item->current_item_ancestor || in_array('current_page_parent', $item->classes, true) || in_array('current-post-ancestor', $item->classes, true)) ? 'active' : '';
        $nav_link_class = ($depth > 0) ? 'dropdown-item ' : 'nav-link ';

        if ($args->walker->has_children) {
            // CSDEV added data-bs-auto-close
            $attributes .= ' class="'.$nav_link_class.$active_class.' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" data-bs-auto-close="outside" aria-expanded="false"';
        } else {
            $attributes .= ' class="'.$nav_link_class.$active_class.'"';
        }

        $item_output = $args->before;
        $item_output .= '<a'.$attributes.'>';
        $item_output .= $args->link_before.apply_filters('the_title', $item->title, $item->ID).$args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

// register a new menu
register_nav_menu('main-menu', 'Main menu');

function wpk_paginate_links($args = '')
{
    global $wp_query, $wp_rewrite;
    // Setting up default values based on the current URL.
    $pagenum_link = html_entity_decode(get_pagenum_link());
    $url_parts = explode('?', $pagenum_link);
    // Get max pages and current page out of the current query, if available.
    $total = isset($wp_query->max_num_pages) ? $wp_query->max_num_pages : 1;
    $current = get_query_var('paged') ? (int) get_query_var('paged') : 1;
    // Append the format placeholder to the base URL.
    $pagenum_link = trailingslashit($url_parts[0]).'%_%';
    // URL base depends on permalink settings.
    $format = $wp_rewrite->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base.'/%#%', 'paged') : '?paged=%#%';
    $defaults = [
        'base' => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below).
        'format' => $format, // ?page=%#% : %#% is replaced by the page number.
        'total' => $total,
        'current' => $current,
        'aria_current' => 'page',
        'show_all' => false,
        'prev_next' => true,
        'prev_text' => __('&laquo; Previous'),
        'next_text' => __('Next &raquo;'),
        'end_size' => 1,
        'mid_size' => 2,
        'type' => 'plain',
        'add_args' => [], // Array of query args to add.
        'add_fragment' => '',
        'before_page_number' => '',
        'after_page_number' => '',
    ];
    $args = wp_parse_args($args, $defaults);
    if (!is_array($args['add_args'])) {
        $args['add_args'] = [];
    }
    // Merge additional query vars found in the original URL into 'add_args' array.
    if (isset($url_parts[1])) {
        // Find the format argument.
        $format = explode('?', str_replace('%_%', $args['format'], $args['base']));
        $format_query = isset($format[1]) ? $format[1] : '';
        wp_parse_str($format_query, $format_args);
        // Find the query args of the requested URL.
        wp_parse_str($url_parts[1], $url_query_args);
        // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
        foreach ($format_args as $format_arg => $format_arg_value) {
            unset($url_query_args[$format_arg]);
        }
        $args['add_args'] = array_merge($args['add_args'], urlencode_deep($url_query_args));
    }
    // Who knows what else people pass in $args.
    $total = (int) $args['total'];
    if ($total < 2) {
        return;
    }
    $current = (int) $args['current'];
    $end_size = (int) $args['end_size']; // Out of bounds? Make it the default.
    if ($end_size < 1) {
        $end_size = 1;
    }
    $mid_size = (int) $args['mid_size'];
    if ($mid_size < 0) {
        $mid_size = 2;
    }
    $add_args = $args['add_args'];
    $r = '';
    $page_links = [];
    $dots = false;
    if ($args['prev_next'] && $current && 1 < $current) {
        $link = str_replace('%_%', 2 == $current ? '' : $args['format'], $args['base']);
        $link = str_replace('%#%', $current - 1, $link);
        if ($add_args) {
            $link = add_query_arg($add_args, $link);
        }
        $link .= $args['add_fragment'];
        $page_links[] = sprintf(
            '<a class="prev page-numbers page-link" href="%s">%s</a>',
        /*
         * Filters the paginated links for the given archive pages.
         *
         * @since 3.0.0
         *
         * @param string $link The paginated link URL.
         */
        esc_url(apply_filters('paginate_links', $link)),
            $args['prev_text']
        );
    }
    for ($n = 1; $n <= $total; ++$n) {
        if ($n == $current) {
            //$page_links[] = sprintf(
            //'<span aria-current="%s" class="page-numbers active">%s</span>',
            // esc_attr( $args['aria_current'] ),
            // $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number']
            //);

            $page_links[] = sprintf(
                //'aria-current="%s" class="page-numbers active">%s',
                '<span class="page-link active" aria-current="%s">%s</span>',
                esc_attr($args['aria_current']),
                $args['before_page_number'].number_format_i18n($n).$args['after_page_number']
            );

            $dots = true;
        } else {
            if ($args['show_all'] || ($n <= $end_size || ($current && $n >= $current - $mid_size && $n <= $current + $mid_size) || $n > $total - $end_size)) {
                $link = str_replace('%_%', 1 == $n ? '' : $args['format'], $args['base']);
                $link = str_replace('%#%', $n, $link);
                if ($add_args) {
                    $link = add_query_arg($add_args, $link);
                }
                $link .= $args['add_fragment'];
                $page_links[] = sprintf(
                    '<a class="page-numbers page-link" href="%s">%s</a>',
        /* This filter is documented in wp-includes/general-template.php */
        esc_url(apply_filters('paginate_links', $link)),
                    $args['before_page_number'].number_format_i18n($n).$args['after_page_number']
                );
                $dots = true;
            } elseif ($dots && !$args['show_all']) {
                $page_links[] = '<span class="page-link disabled dots">'.__('&hellip;').'</span>';
                $dots = false;
            }
        }
    }
    if ($args['prev_next'] && $current && $current < $total) {
        $link = str_replace('%_%', $args['format'], $args['base']);
        $link = str_replace('%#%', $current + 1, $link);
        if ($add_args) {
            $link = add_query_arg($add_args, $link);
        }
        $link .= $args['add_fragment'];
        $page_links[] = sprintf(
            '<a class="next page-numbers page-link" href="%s">%s</a>',
        /* This filter is documented in wp-includes/general-template.php */
        esc_url(apply_filters('paginate_links', $link)),
            $args['next_text']
        );
    }
    switch ($args['type']) {
        case 'array':
            return $page_links;
        case 'list':
            $r .= "<ul class='pagination'>\n\t<li class='page-item'>";
            $r .= implode("</li>\n\t<li class='page-item'>", $page_links);
            $r .= "</li>\n</ul>\n";
            break;
        default:
            $r = implode("\n", $page_links);
            break;
    }
    /**
     * Filters the HTML output of paginated links for archives.
     *
     * @since 5.7.0
     *
     * @param string $r    HTML output
     * @param array  $args An array of arguments. See paginate_links()
     *                     for information on accepted arguments.
     */
    $r = apply_filters('paginate_links_output', $r, $args);

    return $r;
}

function wpk_get_the_posts_pagination($args = [])
{
    global $wp_query;
    $total = $wp_query->max_num_pages;
    $html = '';
    // only bother with the rest if you have more than 1 page!
    if ($total > 1) {
        // get the current page
        if (!$current_page = get_query_var('paged')) {
            $current_page = 1;
        }
        // structure of "format" depends on whether we're using pretty permalinks

        if (is_search()) {
            $format = '&paged=%#%';
        } else {
            $format = 'page/%#%/';
        }
        //$format = empty( get_option('permalink_structure') ) ? '&paged=%#%' : 'page/%#%/';

        $pagination = wpk_paginate_links([
            'base' => get_pagenum_link(1).'%_%',
            'format' => $format,
            //'format' => '&paged=%#%',
            'current' => $current_page,
            'total' => $total,
            'mid_size' => 3,
            'type' => 'list',
        ]);
        $html .= '<nav aria-label="Page navigation">';
        $html .= $pagination;
        $html .= '</nav>';

        return $html;
    }
}

add_filter('redirect_canonical', function ($redirect_url) {
    if (is_paged()) {
        return false;
    }

    return $redirect_url;
}, 10, 1);

add_action('init', function () {
    pll_register_string('general_text', 'BUSCADOR');
    pll_register_string('general_text', 'Nuestras');
    pll_register_string('general_text', 'LÍNEAS DE TRABAJO');
    pll_register_string('general_text', 'Buscar en REDGEALC');
    pll_register_string('general_text', 'PAÍSES DE LA');
    pll_register_string('general_text', 'PERFILES Y ACTIVIDADES');
    pll_register_string('general_text', 'Buscar País');
    pll_register_string('general_text', 'Últimas');
    pll_register_string('general_text', 'NOTICIAS');
    pll_register_string('general_text', 'VER TODAS');
    pll_register_string('general_text', 'Destacadas');
    pll_register_string('general_text', 'Sitios de');
    pll_register_string('general_text', 'por país');
    pll_register_string('general_text', 'Últimos');
    pll_register_string('general_text', 'EVENTOS');
    pll_register_string('general_text', 'VER TODOS LOS EVENTOS');
    pll_register_string('general_text', 'Destacados');
    pll_register_string('general_text', 'Súmese a');
    pll_register_string('general_text', 'SUSCRÍBASE');
});
