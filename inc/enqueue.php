<?php
/**
 * Theme enqueue scripts and styles.
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if( ! function_exists('sushihero_scripts')){
    function sushihero_scripts() {
        $theme_uri = get_template_directory_uri();
        // include custom jQuery
        wp_deregister_script('jquery');
        wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), null, true);
        

        // Custom JS
        wp_enqueue_script('sushihero_functions', $theme_uri . '/src/index.js', [], "my ver", true);
        // wp_enqueue_script('sushihero_functions', $theme_uri . '/src/index.min.js', [], "my ver", true);
        wp_localize_script('sushihero_functions', 'localizedObject', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('ajax_more_nonce_name'),
        ]);



        //Slick	slider 
        wp_enqueue_script('slick_theme_functions', $theme_uri . '/libery/slick.min.js', [], false, true);
        // wp_enqueue_script('slider_theme_functions', $theme_uri . '/src/slider.js', [],'my_ver', true);
       
        //Throttle-debounce
        wp_enqueue_script('throttle_functions', $theme_uri . '/libery/jquery.ba-throttle-debounce.min.js', [], false, true);

        // Custom css
        wp_enqueue_style('sushihero_style', $theme_uri . '/src/index.css');

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

    }
}
add_action( 'wp_enqueue_scripts', 'sushihero_scripts' );

/**
 * AJAX
 */

add_action( 'wp_ajax_ajax_more', 'ajax_more_callback' );
add_action( 'wp_ajax_nopriv_ajax_more', 'ajax_more_callback' );

function ajax_more_callback() {
    cart();   
    
    die();
}

add_action("wp_ajax_woocommerce_ajax_add_to_cart", "woocommerce_ajax_add_to_cart");
add_action("wp_ajax_nopriv_woocommerce_ajax_add_to_cart", "woocommerce_ajax_add_to_cart");
function woocommerce_ajax_add_to_cart()
{

    $product_id = apply_filters("woocommerce_add_to_cart_product_id", absint($_POST["product_id"]));
    $quantity = empty($_POST["quantity"]) ? 1 : wc_stock_amount($_POST["quantity"]);
    $variation_id = absint($_POST["variation_id"]);
    $passed_validation = apply_filters("woocommerce_add_to_cart_validation", true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && "publish" === $product_status) {

        do_action("woocommerce_ajax_added_to_cart", $product_id);

        if ("yes" === get_option("woocommerce_cart_redirect_after_add")) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }

        WC_AJAX::get_refreshed_fragments();
    } else {

        $data = array(
            "error" => true,
            "product_url" => apply_filters("woocommerce_cart_redirect_after_error", get_permalink($product_id), $product_id)
        );

        echo wp_send_json($data);
    }

    wp_die();
}

