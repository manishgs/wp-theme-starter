<div class="post-item post-item-<?php the_ID(); ?>">
    <div class="post-item-header">
          <h2>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
          </h2>
            <span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
            <span class="author"><?php _e( 'Published by', SITE_DOMAIN); ?> <?php the_author_posts_link(); ?></span>
            <?php the_tags( __( 'Tags: ', SITE_DOMAIN ), ', ', '<br>');?>
            <p><?php _e( 'Categorised in: ', SITE_DOMAIN ); the_category(', '); ?></p>
            <p><?php _e( 'This post was written by ', SITE_DOMAIN ); the_author(); ?></p>
    </div>

    <div class="post-item-content">
            <?php if ( has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail(array( 300,200)); ?>
                </a>
            <?php endif; ?>
        <?php excerpt(); ?>
        <?php edit_post_link();?>
    </div>
</div>