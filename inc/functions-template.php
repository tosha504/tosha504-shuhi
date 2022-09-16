<?php
/**
 * Custom functions
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function builder_template(){
	if ( have_rows( 'builder' ) ) { while ( have_rows( 'builder' ) ) 
		{ the_row();		
			if( get_row_layout() == 'categories'){
				get_template_part('builder-templates/categories');
			} elseif( get_row_layout() == 'min-value'){
				get_template_part('builder-templates/min-value');
			} elseif( get_row_layout() == 'cat_rolls'){
				get_template_part('builder-templates/rolls');
			}
		}	
	}

}



function sub_builder() {
	if ( have_rows( 'select' ) ) { while ( have_rows( 'select' ) ) 
		{ the_row();		
            if( get_row_layout() == 'bg_title'){
				get_template_part('builder-templates/bg-title');
			}
            if( get_row_layout() == 'info_card'){
				get_template_part('builder-templates/info-card');
			}
		}	
	}
}


function cart() { 
	if ( isset($_POST['cat_slug']) && !empty($_POST['cat_slug']) ) {
        $cat_slug = sanitize_text_field( $_POST['cat_slug'] );
        $posts = get_posts(
            array(
                'post_type' => 'product',
                'order' => "DESC",
                'offset' => 3,
                'numberposts' => 0,
                'tax_query' =>
                    array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug',
                            'terms' => $cat_slug,
                            
                        )
                    )
            )       
        );
    }
    foreach ($posts as $p) {
		$trimWords = 2;
		$_product = wc_get_product($p->ID);
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
	<h2 class="categories__wrap_title" ><?php echo $word_count; ?></h2> 
	<p class="categories__wrap_excerpt"><?php echo wp_trim_words( get_the_excerpt($_product->id), 7 ); ?></p>
	<div class="categories__wrap_image" > 
		<?php echo wp_get_attachment_image($post_thumbnail_id, 'gallery-thumbnail-2') ?>

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
			data-id="<?php echo $_product->id ;?>" 
			>wiecej</a> 
		</div>
	</div>		
</div>
<?  }} 


function slide() {
	if(isset( $_POST['cat_id']) && !empty( $_POST['cat_id'])) {
        $cat_id = sanitize_text_field( $_POST['cat_id']);
		$loop = new WP_Query( array( 
			'post_type' => 'product', 
			'posts_per_page' => -1,
			'order' => 'ASC',
			'tax_query' =>
			array(
				array(
					'taxonomy' => 'product_cat',
					'field' => 'slug',
					'terms' =>  $cat_id,
					
				)
			))
				);
		
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
<?php } }