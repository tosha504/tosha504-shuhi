<?php
/**
 * Info-card
 *
 * @package  SushiHero
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;  


$name = get_sub_field("name");
$title = get_sub_field("title");
$image = get_sub_field("mini_img");
$time = get_sub_field("time");
$buttons = get_sub_field("buttons"); ?>
<div class="categories__wrap _cart-info">
    <div class="_cart-info__box">
        <?php if($name) {?><p class="categories__wrap_catname _cart-info__catname"><?php echo $name; ?></p><?php } ?>
        <?php if($image) echo wp_get_attachment_image($image, 'full') ?>
    </div>
    <?php if($title) {?><p class="banner__delivery_title"><?php echo $title; ?></p><?php } ?>
    <div class="banner__delivery_buttons _cart-info__buttons">
        <?php
        if ( $buttons ) {  
        foreach ($buttons as $button) {	
        $color = $button["color_btn"];
        $btn = $button['button'];
        $link_url = $btn['url'];
        $link_title = $btn['title'];
        $link_target = $btn['target'] ? $btn['target'] : '_self';?>
            <a class="btn <?php echo  $color; ?>" href="<?php echo esc_url( $link_url ); ?>" data-target="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
        <?php } } ?>
    </div>
    <?php if($time) {?><p class="banner__delivery_time _cart-info__time"><?php echo $time; ?></p><?php } ?>
</div>