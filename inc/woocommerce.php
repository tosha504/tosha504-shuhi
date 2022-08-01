<?php 
function header_add_to_cart_fragment($fragments)
{
    global $woocommerce;
    ob_start();
?>
    <div class="header__menu-shop_count"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></div>
<?php
    $fragments[".header__menu-shop_count"] = ob_get_clean();
    return $fragments;
}
add_filter("woocommerce_add_to_cart_fragments", "header_add_to_cart_fragment");

function grd_woocommerce_script_cleaner() {
	
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
	
		wp_dequeue_style( 'woocommerce-layout' );
		wp_dequeue_style( 'woocommerce-general');
		wp_dequeue_style( 'woocommerce_frontend_styles' );
		wp_dequeue_style( 'woocommerce-smallscreen' );
		wp_dequeue_style( 'woocommerce_fancybox_styles' );
		wp_dequeue_style( 'woocommerce_chosen_styles' );
		wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
		wp_dequeue_script( 'selectWoo' );

		wp_deregister_script( 'selectWoo' );
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );

}
add_action( 'wp_enqueue_scripts', 'grd_woocommerce_script_cleaner', 99 );

// remove_action( 'woocommerce_cart_collaterals' , 'woocommerce_cart_totals', 10 );
