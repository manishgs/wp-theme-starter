<?php
function custom_login_logo()
{
    echo "<style> body {background:#12665E !important;} #loginform {border-radius:3px !important;}   h1 a { background-image:url(" . get_bloginfo('template_directory') . "/images/logo.png) !important; background-size: 200px 88px !important; width: 200px !important; height: 90px !important; }</style>";
}

add_action('login_head', 'custom_login_logo');

function custom_login_url()
{
    return site_url();
}

add_filter('login_headerurl', 'custom_login_url', 10, 4);

function login_header_title()
{
    return get_bloginfo('name');
}

add_filter('login_headertitle', 'login_header_title');

function remove_footer_admin()
{
    echo '&copy; ' . date('Y') . ' Developer :' . '<a target="_blank" href="http://manishgopalsingh.com.np">Manish Gopal Singh</a>';
}

add_filter('admin_footer_text', 'remove_footer_admin');


add_action('wp_dashboard_setup', 'dashboard_widgets');

function dashboard_widgets()
{
    global $wp_meta_boxes;
    // Today widget
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    // Last comments
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    // Incoming links
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    // Plugins
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['welcome-panel']);

    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}


function unregister_wp_widgets()
{
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Custom_Menu');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Categories');
}

add_action('widgets_init', 'unregister_wp_widgets', 1);


//cleanup
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', '_ak_framework_meta_tags');
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'rel_canonical');



function disable_admin_bar()
{
    if(!current_user_can('edit_posts')) {
        add_filter('show_admin_bar', '__return_false');
    }
}

add_action('after_setup_theme', 'disable_admin_bar');

function redirect_admin()
{
    $arr = basename($_SERVER['PHP_SELF']);
    if(!current_user_can('edit_posts')) {
        if(!in_array($arr, array('admin-ajax.php'))) {
            wp_redirect(site_url());
            exit;
        }
    }
}

add_action('admin_init', 'redirect_admin');


function site_wp_title($title, $sep)
{
    global $paged, $page;

    if(is_feed())
        return $title;

    // Add the site name.
    $title .= get_bloginfo('name');

    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if($site_description && (is_home() || is_front_page()))
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if($paged >= 2 || $page >= 2)
        $title = "$title $sep " . sprintf(__('Page %s', SITE_DOMAIN), max($paged, $page));

    return $title;
}

add_filter('wp_title', 'site_wp_title', 10, 2);

add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}


add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}


// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether