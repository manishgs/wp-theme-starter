<?php
$prefix = 'video_';

$meta_boxes[] = array(

    'id' => 'standard',
    'title' => __('Meta',SITE_DOMAIN),
    'pages' => array( 'video'),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(

        array(
            'name' => __('YouTube ID',SITE_DOMAIN),
            'id'   => $prefix . 'youtube_id',
            'type' => 'text',
            'desc'  => '',
        ),
    ),
);


function register_meta_boxes()
{
    if ( !class_exists( 'RW_Meta_Box' ) )
        return;

    global $meta_boxes;
    foreach ( $meta_boxes as $meta_box )
    {
        new RW_Meta_Box( $meta_box );
    }
}
add_action( 'admin_init', 'register_meta_boxes' );
