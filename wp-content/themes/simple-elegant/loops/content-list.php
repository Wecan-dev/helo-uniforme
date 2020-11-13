<?php
/**
 * The default template for displaying blog list content
 *
 * Used for index/archive.
 *
 * @package Simple & Elegant
 * @since Simple & Elegant 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-list' ); ?> itemscope itemtype="https://schema.org/CreativeWork">
    
    <?php if ( has_post_thumbnail() ) : ?>
    
    <figure class="post-list-thumbnail">
    
        <a href="<?php the_permalink(); ?>">
            
            <?php the_post_thumbnail( 'thumbnail-medium' ); ?>
            
        </a>
    
    </figure><!-- .post-list-thumbnail -->
    
    <?php endif; ?>
	
    <div class="list-section">
        
        <header class="list-header">

            <?php the_title( sprintf( '<h2 class="list-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

            <?php withemes_grid_meta(); ?>

        </header><!-- .list-header -->

        <div class="list-content" itemprop="text">

            <?php the_excerpt(); ?>

        </div><!-- .list-content -->
        
    </div>

</article><!-- #post-## -->
