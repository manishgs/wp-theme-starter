<?php

function partial($file)
{
    get_template_part('partials/' . $file);
}

function theme_url($value = '')
{
    return get_template_directory_uri() . '/' . trim($value, '/');
}

function is_ajax_request()
{
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    } else {
        return false;
    }
}

function excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}


function pagination()
{
    global $wp_query;

    if(is_search()) {
        $format = '&page=%#%';
        $page = $_GET['paged'];
        $base = @add_query_arg('paged', '%#%');
    } else {
        $format = '/page/%#%';
        $page = get_query_var('paged');
        $base = get_pagenum_link(1) . '%_%';
    }

    $total_pages = $wp_query->max_num_pages;
    if($total_pages > 1) {
        $current_page = max(1, $page);
        echo '<div class="aligncenter"><ul class="pagination">';
        $nav = paginate_links(array(
            'base'      => $base,
            'format'    => $format,
            'current'   => $current_page,
            'total'     => $total_pages,
            'prev_text' => 'Prev',
            'next_text' => 'Next'
        ));

        echo str_replace(array('a class', '</a>', '<span', '</span>'), array('li> <a rel="link" class', '</li></a>', '<li><span', '</span></li>'), $nav);

        echo '</ul></div>';
    }
}


function get_wp_menu($menu_location)
{
    $nav = '';

    $args = array(
        'order'                  => 'ASC',
        'orderby'                => 'menu_order',
        'post_type'              => 'nav_menu_item',
        'post_status'            => 'publish',
        'output'                 => ARRAY_A,
        'output_key'             => 'menu_order',
        'nopaging'               => true,
        'update_post_term_cache' => false,
        'menu_item_parent'       => '0'
    );

    $items = wp_get_nav_menu_items($menu_location, $args);

    foreach ($items as $item):
        if($item->menu_item_parent != 0) continue;
        $nav .= '<li><a rel="link" href="' . $item->url . '">' . $item->title . '</a>';
        $nav .= "<ul class='submenu'>";
        foreach ($items as $i):
            if($item->ID == $i->menu_item_parent) :
                $nav .= '<li><a rel="link" href="' . $i->url . '">' . $i->title . '</a></li>';
            endif;
        endforeach;
        $nav .= "</ul>";
        $nav .= "</li>";
    endforeach;

    return $nav;
}