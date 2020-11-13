<?php
/**
 * Template for displaying search forms in SimpleShop
 *
 * @package WordPress
 * @subpackage SimpleShop
 * @version 3.6
 */
?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<div class="searchform">
    <form method="get" action="<?php echo home_url();?>" itemprop="potentialAction" itemscope itemtype="https://schema.org/SearchAction">
        <input type="text" name="s" class="search-field" value="<?php echo get_search_query();?>" placeholder="<?php esc_html_e('Search...','simple-elegant');?>" />
        
        <input type="hidden" name="post_type" value="product" />
        
        <button class="submit" title="<?php esc_html_e('Go','simple-elegant');?>"><i class="fa fa-search"></i></button>
    </form>
</div><!-- .searchsearch -->