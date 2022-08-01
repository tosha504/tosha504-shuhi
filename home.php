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
		$title = $banner['title'];
		$sub_title = $banner['sub_title'];
		$delivery = $banner["delivery"];
		$name = $delivery["name"];
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
						<div class="banner__content_text">
							<?php if($title) {?><h1 class="banner__content_title"><?php echo $title; ?></h1><?php } ?>
							<?php if($sub_title) {?><p class="banner__content_sub-title"><?php echo $sub_title; ?></p><?php } ?>
						</div>

						<div class="banner__delivery">
							<div class="banner__delivery_wrap">
								<?php if($name) {?><p class="banner__delivery_name"><?php echo $name; ?></p><?php } ?>
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

		<?php 
		$rolki = get_field('rolki');
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
						<a class="btn btn__transparent" href="#" data-cat="<?php echo $term->term_id; ?>">
							<?php echo esc_attr($term->name); ?>
						</a>
					</div>
				<?php } } ?>
				</div>

				<?php $loop = new WP_Query( array( 
					'post_type' => 'product', 
					'posts_per_page' => -1,
					'orderby' => 'id', 
					'order' => 'ASC',));
				?>
				<div class="rolls">
					<?php  while ( $loop->have_posts() ): $loop->the_post(); ?>
					<?php 
					
					global $product;
					$trimWords = 3;
					$post_thumbnail_id = $product->get_image_id(); 
					$catTerms = get_the_terms( $product->ID, 'product_cat' );
					$word_count = wp_trim_words( get_the_title($loop->id)  ,$trimWords );
					foreach ($catTerms  as $termy  ) {                    
						$product_cat_name = $termy->name;
						$product_cat_id = $termy->term_id;        
						break;
					} ?> 
					<div class="rolls__wrap cat_<?php echo $product_cat_id; ?>">
						<p class="rolls__wrap_catname"><?php  echo $product_cat_name; ?></p>
						<h2 class="rolls__wrap_title" ><?php echo $word_count; ?></h2> 
						<p class="rolls__wrap_excerpt"><?php echo wp_trim_words( get_the_excerpt(), 7 ) ?></p>
						<div class="rolls__wrap_image" > 
							<?php echo wp_get_attachment_image($post_thumbnail_id, 'gallery-thumbnail-2') ?>
						</div>
						<div class="rolls__wrap_order">
							<div class="rolls__wrap_order-price">
								<?php echo $product->get_price();?><?php echo get_woocommerce_currency_symbol(); ?>
							</div>
							<div class="rolls__wrap_order-btns">
							<div class="box"></div>
							<form class="cart" action="<?php echo esc_url($product->add_to_cart_url()); ?>" method="post" enctype="multipart/form-data">
								<a class="categories__btn btn btn__primary add_to_cart_btn" data-id="<?php echo $product->id   ?>" href="#">kup</a>
							</form>
							<a href="#"
							class="rolls__btn btn btn__transparent btn__popup"  
							data-title="<?php echo get_the_title($loop->id); ?>" 
							data-exc="<?php echo get_the_excerpt(); ?>"
							data-image="<?php echo wp_get_attachment_image_url($post_thumbnail_id, 'gallery-thumbnail-2') ?>"
							data-price="<?php echo $product->get_price(); echo get_woocommerce_currency_symbol(); ?>"
							data-id="<?php echo $product->id;?>" 
							>wiecej</a>
							</div>
						</div>		
					</div>
					<?php endwhile; wp_reset_query(); ?>
				</div> 
			</div>
		</section><!-- Rolly end -->

		<?php builder_template(); ?>

	</main><!-- #main -->

<?php
get_footer();
