<?php get_header(); ?>

<?php wi_portfolio_single_item_title( 'new' ); ?>

<div id="page-wrapper">
    
    <div class="container">
        
        <?php if( have_posts() ):

        while(have_posts()) : the_post(); 
        
        $layout = get_post_meta( get_the_ID(), '_withemes_project_layout', true );

        if ( ! $layout ) $layout = get_option( 'withemes_project_layout' );

        if ( 'half' != $layout ) $layout = 'full';
        ?>  
        <?php if ( 'full' == $layout ) : ?>
        
        <?php /* -------------------- Header -------------------- */?>
        
        <?php $old_or_new = get_option( 'withemes_page_title_style', 'new' ); if ( $old_or_new !== 'new' ) { ?>
        
        <header class="entry-header">
            
            <?php wi_portfolio_single_item_title( 'old' ); ?>
            
        </header><!-- .entry-header -->
        
        <?php } ?>
        
        <?php
		// Post thumbnail.
        if ( function_exists( 'withemes_post_thumbnail' ) && 'true' !== get_post_meta( get_the_ID(), '_withemes_disable_thumbnail', true ) ) {
            
            withemes_post_thumbnail();
            
        }
        ?>

        <div class="entry-content">
            
            <?php
                the_content();

                wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'simple-elegant' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'simple-elegant' ) . ' </span>%',
                    'separator'   => '<span class="screen-reader-text">, </span>',
                ) );
            ?>
            
        </div><!-- .entry-content -->
        
        <?php else : // half layout ?>
        
        <div class="project-half">
        
            <div class="thumbnail-area">
            
                <?php
                // Post thumbnail.
                if ( function_exists('withemes_post_thumbnail') && 'true' !== get_post_meta( get_the_ID(), '_withemes_disable_thumbnail', true ) ) {
                  withemes_post_thumbnail();
                }
                ?>
            
            </div><!-- .thumbnail-area -->
            
            <div class="content-area">
                
                <?php /* -------------------- Header -------------------- */?>
                <?php $old_or_new = get_option( 'withemes_page_title_style', 'new' ); if ( $old_or_new !== 'new' ) { ?>
                <header class="entry-header">
                    
                    <?php wi_portfolio_single_item_title( 'old' ); ?>
                    <?php withemes_entry_meta(); ?>
                    
                </header>
                <?php } ?>
            
                <div class="entry-content">
                    <?php
                        the_content();

                        wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'simple-elegant' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                            'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'simple-elegant' ) . ' </span>%',
                            'separator'   => '<span class="screen-reader-text">, </span>',
                        ) );
                    ?>
                </div><!-- .entry-content -->
            
            </div><!-- .content-area -->
        
        </div><!-- .project-half -->
        
        <?php endif; // layout half or full ?>
        
        <?php if ( 'true' !== get_post_meta( get_the_ID(), '_withemes_disable_related', true ) ) include SIMPLE_ELEGANT_PORTFOLIO_PATH . 'templates/related-projects.php'; ?>

        <?php endwhile; endif; ?>
        
        <?php if ( 'true' !== get_post_meta( get_the_ID(), '_withemes_disable_nav', true ) ) the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'simple-elegant' ) . '</span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'simple-elegant' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous', 'simple-elegant' ) . '</span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'simple-elegant' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );
        ?>
        
    </div><!-- .container -->
    
</div><!-- #page-wrapper -->

<?php get_footer(); ?>