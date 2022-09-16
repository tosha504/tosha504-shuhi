<?php
/**
 * Categories
 *
 * @package  SushiHero
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; 


$products = get_sub_field('products');
$select = get_sub_field('select');
$_catname = strtolower($products->slug);

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'orderby'   => 'meta_value_num',
        'meta_key'  => '_price',
        'order' => 'asc',
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $_catname,
            )
        ) 
    );

$products_list = new WP_Query( $args );
$count = $products_list->found_posts ;
if($products->count !== 0) { ?>
<!-- Categories start -->
<section id="<?php echo $_catname; ?>" class="category">
    <div class="container">
        <div class="categories" data-id="<?php echo $_catname;?>">
        <?php 
        sub_builder() ;
        while ( $products_list->have_posts() ) {
        $products_list->the_post();
        $trimWords = 2;
        $_product = wc_get_product(get_the_ID());
        $post_thumbnail_id = $_product->get_image_id(); 
        $catTerms = get_the_terms( $_product->id, 'product_cat' );
        $word_count = wp_trim_words( get_the_title($_product->id)  ,$trimWords );
            foreach ($catTerms  as $term  ) {                    
                $product_cat_name = $term->name;
                $product_cat_id = $term->term_id;            
            break;
            } ?> 
            <div class="categories__wrap">
                <p class="categories__wrap_catname"><?php  echo $product_cat_name; ?></p>
                <div class="categories__wrap_wrap">
                    <h2 class="categories__wrap_title" ><?php echo $word_count; ?></h2> 
                    <p class="categories__wrap_excerpt"><?php echo wp_trim_words( get_the_excerpt(), 7 ) ?></p>
                    <div class="categories__wrap_image" > 
                        <?php echo wp_get_attachment_image($post_thumbnail_id, 'gallery-thumbnail-2') ?>
                    </div>
                </div>

                <div class="categories__wrap_order">
                    <div class="categories__wrap_order-price">
                        <?php  echo $_product->get_price();?><?php echo get_woocommerce_currency_symbol(); ?>
                    </div>
                    <div class="categories__wrap_order-btns">
                    <div class="box"></div>
                    <form class="cart" action="<?php echo esc_url($_product->add_to_cart_url()); ?>" method="post" enctype="multipart/form-data">
                        <a class="categories__btn btn btn__primary add_to_cart_btn" data-id="<?php echo $_product->id   ?>" href="#">kup</a>
                    </form>
                    <a href="#"
                    class="categories__btn btn btn__transparent btn__popup"  
                    data-title="<?php echo get_the_title($_product->id); ?>" 
                    data-exc="<?php echo get_the_excerpt($_product->id); ?>"
                    data-image="<?php echo wp_get_attachment_image_url($post_thumbnail_id, 'gallery-thumbnail-2') ?>"
                    data-price="<?php echo $_product->get_price(); echo get_woocommerce_currency_symbol(); ?>"
                    data-id="<?php echo $_product->id;?>" 
                    >wiecej</a> 
                    </div>
                </div>		
            </div>
        <?php }
        wp_reset_postdata(); ?>
        </div>
    </div>
    
</section><!-- Categories end -->
<?php }