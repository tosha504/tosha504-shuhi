<?php
/**
 * Min-value
 *
 * @package  SushiHero
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


$values_bg = get_sub_field('bg_image');
$values_title = get_sub_field('title');
$values_dystance = get_sub_field('dystance');
$values_atantion = get_sub_field('atantion'); ?>
<!-- Values start -->
<section class="values">
    <div class="values__content">
        <div class="values__content_text">
            <?php if($values_title) { ?><h3 class="values__content_text-title"><?php echo $values_title; ?></h3><?php } ?>
            <?php if($values_dystance) { ?>
                <div class="values__content_text-dystance">
                    <?php echo $values_dystance; ?>
                </div>
            <?php } ?>
            <?php if($values_atantion) { ?>
                <div class="values__content_text-atantion">
                    <?php echo $values_atantion; ?>
                </div>
            <?php } ?>
        </div>
        <div class="values__content_image" <?php if( $values_bg){ echo 'style="background: url(' .wp_get_attachment_image_url( $values_bg, 'full') .')no-repeat center/cover"' ; }?>></div>
    </div>
</section>
<!-- Values end -->