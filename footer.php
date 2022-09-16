<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SushiHero
 */



$footer = get_field( 'footer', 'options' ); 
$header = get_field( 'header', 'options' ); 
$phone = $header['phone'];
$footer_contact = get_field( 'contact', 'options' ); 
$socials_footer = $footer_contact['socials']; 
$footer_pay = get_field( 'paynemt', 'options' ); 
$preFotter_btns = $footer_pay['links'];
$footer_info = get_field( 'info', 'options' ); 
$map_popup = get_field( 'map', 'options' );?>

	<footer id="colophon" class="site-footer">
		<div class="footer__pre">
			<div class="container">
				<div id="contact" class="footer__pre_contact">
					<?php if($footer_contact['title']) echo  '<h6 class="footer__pre_contact-title">' . $footer_contact['title'] . '</h6>'; 
					if($footer_contact['adress']) echo  '<p class="footer__pre_contact-adress">' . $footer_contact['adress'] . '</p>'; 
					$phoneLinkFooter = preg_replace('/[^0-9]/', '', $phone);
					if( $phoneLinkFooter )  echo  '<a href="tel:+' . $phoneLinkFooter . '" class="footer__pre_contact-phone">' . $phone . '</a>'; 
					if($footer_contact['email']) echo  '<a href="mailto:" class="footer__pre_contact-email">' . $footer_contact['email'] . '</a>'; 
					if($socials_footer)	{ ?>
						<div class="footer__pre_contact-socials">
						<?php foreach ($socials_footer as $key => $value) { ?>
							<a href="<?php echo $value["link"]; ?>" target="_blank"><?php echo wp_get_attachment_image($value['image'], 'full'); ?></a>
						<?php } ?>
						</div>
					<?php } ?>
				</div>
				<div class="footer__pre_paynemt">
					<?php if($footer_pay['logo']) echo wp_get_attachment_image($footer_pay['logo'], 'full'); 
					if($footer_pay['description']) echo '<p class="footer__pre_paynemt-descr">' . $footer_pay['description'] . '</p>'
					?>
					<div class="footer__pre_paynemt-buttons">
						<?php
							foreach ($preFotter_btns as $key => $value) {
							$color = $value["color_btn"];
							$btn = $value['link'];
							$link_url = $btn['url'];
							$link_title = $btn['title'];
							$link_target = $btn['target'] ? $btn['target'] : '_self';?>
								<a class="btn <?php echo  $color; ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						<?php } ?>
					</div>
				</div>

				<div class="_cart-info">
					<div class="_cart-info__box">
						<?php if($footer_info['name']) {?><p class="categories__wrap_catname _cart-info__catname"><?php echo $footer_info['name']; ?></p><?php } ?>
						<?php if($footer_info['mini_img']) echo wp_get_attachment_image($footer_info['mini_img'], 'full') ?>
					</div>
					<?php if($footer_info['title']) {?><h5 class="_cart-info__title"><?php echo $footer_info['title']; ?></h5><?php } ?>
					<?php if($footer_info['title_time']) {?><h5 class="_cart-info__title-time"><?php echo $footer_info['title_time']; ?></h5><?php } ?>
					<?php if($footer_info['time']) {?><p class="banner__delivery_time _cart-info__time"><?php echo $footer_info['time']; ?></p><?php } ?>
				</div>
			</div>
		</div>

		<div class="footer">
			<?php echo $footer; ?> <a href="https://thenewlook.pl/" target="_blank">THE NEW LOOK</a>
		</div>
	</footer><!-- #footer -->
	
	<div class="popup">
		<div class="popup__overlay"></div>
		<div class="popup__body">
			<div class="popup__close"></div>

			<div class="popup__body_image">
				<img id="myImageID" src="" alt="">
			</div>
			<div class="popup__body_content">
				<h2 class="popup__body_content-title"></h2>
				<p class="popup__body_content-description"></p>
				<p class="popup__body_content-price"></p>
				<div class="popup__body_content-btn">
					<a class ="btn btn__primary add_to_cart_btn" data-id="" href="#">Kup</a>
				</div>
				<div class="box"></div>
			</div>
		</div>
	</div>

	<?php if($map_popup) { ?>
		<div class="popup-map">
		<div class="popup-map__overlay"></div>
			<div class="popup-map__body">
				<div class="popup-map__close"></div>

				<div class="popup-map__image">
					<?php echo wp_get_attachment_image( $map_popup['image'], 'full' )?>
				</div>
				<div class="popup-map__content">
					<?php echo $map_popup['descr']; ?>
				</div>
			</div>
		</div>
	<?php } ?>	

	<div class="arrowUp"><img src="<?php echo get_template_directory_uri() . '/assets/img/up-arrow.svg'?>" alt=""></div>


	<div class="cookies">
		<div class="cookies__flex">
			<p>Używamy plików cookie, aby poprawić komfort korzystania z naszej witryny. Przeglądając tę stronę, zgadzasz się na używanie przez nas plików cookie.</p>	
			<a href="javascript:;"  class="cookies__btn btn btn__light submit">Akceptuję</a>
		</div>
	</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
