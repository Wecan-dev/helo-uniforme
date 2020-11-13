<?php 

add_action( 'wp_enqueue_scripts', 'wi_child_enqueue_styles');
function wi_child_enqueue_styles() {
	
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_filter( 'woocommerce_sale_flash', 'dinapyme_wc_modificar_texto_oferta' );

function dinapyme_wc_modificar_texto_oferta( $texto ) {
    //cabia el valor del texto original 'Sale!' de WooCommerce por el texto '¡Promoción!'
    return str_replace( __( 'Sale!', 'woocommerce' ), __( 'Compra', 'woocommerce' ), $texto );
}
?>
