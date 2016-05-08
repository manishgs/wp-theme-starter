<?php

class Content {


	public static function page($page)
	{
		 $args = array(
            'pagename' => $page,
        );

        $content = static::query($args);

        return isset($content[0]) ? $content[0] : [];
	}


    /**
     * Get Home page slider images
     * @param int $per_page
     * @return array|null
     */
    public static function slider($per_page = 3)
    {
        $args = array(
            'post_type'      => 'slider',
            'posts_per_page' => $per_page,
        );
        $Content = static::query($args);

        return $Content;
    }


    /**
     * Get Videos
     * @param int $per_page
     * @return array|null
     */
    public static function video($per_page = 5)
    {
        $args = array(
            'post_type'      => 'video',
            'posts_per_page' => $per_page,
        );
        $Content = static::query($args);

        return $Content;
    }


    /**
     * WP Query
     * @param array $args
     * @return array|null
     */
    protected static function query(array $args)
    {
	$args['category__not_in'] = 12;

        $query = new WP_Query($args);

        $Content = array();
        if($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                $query->post->permalink = get_the_permalink($query->post->ID);
                $query->post->excerpt = get_the_excerpt();
                $Content[] = $query->post;
            endwhile;

            return $Content;
            wp_reset_postdata();
        else:
            return null;
        endif;
    }
}