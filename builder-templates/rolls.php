<?php
/**
 * Cat-rolls
 *
 * @package  SushiHero
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; 


$rolki = get_sub_field('rolki');
$rolki_title = $rolki['title'];
$menu = $rolki['menu']; ?>
<!-- Rolly start -->
<section id="rolki" class="rolly">
    <div class="container">
        <?php if($rolki_title) { ?><h3 class="rolly__title title"><?php echo $rolki_title; ?></h3><?php } ?>
        <div class="rolly__categories">
        <?php	
        if($menu) {
        foreach ($menu as $key => $value) {
        $term = get_term_by( 'id', $value, 'product_cat' );
        $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id ); ?>
            <div class="rolly__categories_item">
                <a class="btn btn__transparent" href="#" data-cat="<?php echo $term->slug; ?>">
                    <?php echo esc_attr($term->name); ?>
                </a>
            </div>
        <?php } } ?>
        </div>
        <div id="rollsResponse">
        </div>
        <div class="resp-box"></div>

    </div>
</section><!-- Rolly end -->
