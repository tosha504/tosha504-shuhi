<?php
/**
 * Template Name: Home
 * @package SushiHero
 */

get_header(); ?>

	<main id="primary" class="site-main">

		<?php 
		$banner = get_field('banner');
		$bg_image = $banner['bg_image'];
		$delivery = $banner["delivery"];
		$delivery_title = $delivery["title"];
		$name = $delivery["name"];
		$time = $delivery["time"];
		$delivery_time = $delivery["delivery_time"];
		$buttons = $delivery["buttons"]; ?>
		<!-- Banner start -->
		<seciton class="banner">
			<div class="container">
				<div class="banner__content" <?php if( $bg_image){ echo 'style="background: url(' .wp_get_attachment_image_url( $bg_image, 'full') .')no-repeat center/cover"' ; }?>>
					<div class="banner__content_wrap">
						<div class="banner__delivery">
							<div class="banner__delivery_wrap">
								<?php if($delivery_title) {?><p class="banner__delivery_title"><?php echo $delivery_title; ?></p><?php } ?>
								<div class="banner__delivery_buttons">
									<?php
									if ( $buttons ) {  
									foreach ($buttons as $button) {	
									$color = $button["color_btn"];
									$btn = $button['button'];
									$link_url = $btn['url'];
									$link_title = $btn['title'];
									$link_target = $btn['target'] ? $btn['target'] : '_self';?>
										<a class="btn <?php echo $color?>" href="<?php echo esc_url( $link_url ); ?>" data-target="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
									<?php } } ?>
								</div>
								<?php if($time) {?><p class="banner__delivery_time"><?php echo $time; ?></p><?php } ?>
							</div>
							<?php if($delivery_time) {?><p class="banner__delivery_delivery-time"><?php echo $delivery_time; ?></p><?php } ?>
						</div>
					</div>
				</div>
			</div>

		</seciton><!-- Banner end -->

		<?php 
		$categories = get_field('categories'); ?>
		<!-- Choose-sets start -->
		<section class="choose-sets">
			<div class="container">
				<?php   foreach ($categories as $key => $value) {  
				$term = get_term_by( 'id', $value, 'product_cat' );
				$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
				$image = wp_get_attachment_url( $thumbnail_id );
				$id  = $term->slug;  
				// var_dump($term->slug);?>
					<div class="choose-sets__link">
						<a class="choose-sets-item" href="#<?php echo  $id ?>">
							<img loading="lazy" src="<?php echo $image ?>" alt="">
							<p class="choose-sets__link_title"><?php echo  $term->name; ?></p>
							<p class="choose-sets__link_count"><?php echo  sprintf ( _nx('%s product', '%s productów', $term->count, '', 'SushiHero') , $term->count ) ; ?></p>
						</a>
					</div>
				<?php  } ?>
			</div>
		</section><!-- Choose-sets end -->

		<?php 
		$sale = get_field('sale');
		$sale_title = $sale['title'];
		$images = $sale['images']; ?>
		<!-- Sale start -->
		<section id="sale" class="sale">
			<div class="container">
				<?php if($sale_title) {?><h3 class="sale__title title"><?php echo $sale_title; ?></h3><?php } ?>
				<div class="sale__slider">
					<?php 
					if($images) {
					foreach ($images as $key => $value) { ?>
						<div class="sale__slide">
							<?php echo wp_get_attachment_image( $value['image'], 'full'); ?>
						</div>
					<?php } } ?>
				</div>
			</div>
		</section><!-- Sale end -->
        
		<?php 
		$new = get_field('new'); 
		$new_bgImage = $new['bg_image'];
		$new_image = $new['image'];
		$new_content = $new['content'];
		$new_title = $new['title'];
		$new_description = $new_content['description'];
		$new_news = $new_content['sushi']; ?>
		<!-- New start -->
		<section id="new" class="new">
			<div class="new__wrap">
				<div class="new__image">
					<?php if($new_image) echo wp_get_attachment_image( $new_image, 'gallery-thumbnail'); ?>
				</div>
				<div class="new__content"  <?php if( $new_bgImage){ echo 'style="background: url(' .wp_get_attachment_image_url( $new_bgImage, 'full') .')no-repeat center/cover"' ; }?>>
					<?php if($new_title) { ?><h3 class="new__content_title"><?php echo $new_title; ?></h3><?php } ?>
					<?php if($new_description) { ?><p class="new__content_description"><?php echo $new_description; ?></p><?php } ?>
					<div class="new__content_newses">
						<?php 
						foreach ($new_news as $key => $value) {
							$term = get_term_by( 'id', $value, 'product_cat' );
							$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
							$image = wp_get_attachment_url( $thumbnail_id ); ?>
							<a href="#<?php echo  $term->slug ?>">
								<div class="new__content_news">
									<?php if($term->name) { ?><p class="new__content_news-custom-name"><?php echo $term->name; ?></p><?php } ?>
									<?php if($term->name) { ?><h4 class="new__content_news-title"><?php echo $term->name; ?></h4><?php } ?>
									<?php if($term->description) { ?><p class="new__content_descr"><?php echo $term->description; ?></p><?php } ?>
									<img loading="lazy" src="<?php echo $image ?>" alt="">
								</div>
							</a>
						<?php }?>
					</div>
				</div>
			</div>
		</section><!-- New end -->

		
		<?php builder_template(); ?>

	</main><!-- #main -->

<?php
get_footer();
