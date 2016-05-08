<?php get_header(); ?>

<div class="container">

 <div class="row">
	<h1><?php _e( 'Latest Blog', SITE_DOMAIN ); ?></h1>
    <div class="col-xs-12 col-md-8">
        <?php
	        if(have_posts()) :
	            ?>
	                <?php
	                    while (have_posts()) : the_post();
	                        get_template_part('content', 'loop');
	                    endwhile;
	                   pagination();
	                ?>
	            <?php
	        else:
	            get_template_part('content', 'no-post');
	        endif;
        ?>
    </div>
</div>

<?php get_sidebar(); ?>

</div>
<?php get_footer(); ?>