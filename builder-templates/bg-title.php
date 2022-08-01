<?php
/**
 * Bg-title
 *
 * @package  SushiHero
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; 


$title = get_sub_field('title'); 
$bg_image = get_sub_field('bg');?>


<div class="categories__wrap _image" 
    <?php if( $bg_image){ echo 'style="background: url(' .wp_get_attachment_image_url( $bg_image, 'full') .')no-repeat center/cover"' ; }?>>
        <div class="categories__wrap_overlay"></div>
    <?php if($title) { ?><h4 class="category__title"><?php echo $title; ?></h4><?php } ?>
</div>