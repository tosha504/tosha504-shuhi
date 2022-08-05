<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SushiHero
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="wrapper">

	<header id="masthead" class="header">
		<div class="header__box container">
			<?php
			$header = get_field( 'header', 'options' );
			$logo = $header['logo'];
			if( $logo ) { ?>  
				<div class="header__logo">
					<a href="<?php echo esc_url( home_url( '/' ) ) ?>">
					<img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>"></a>  
				</div>
			<?php } ?> 
				
			<nav id="site-navigation" class="header__navigation">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'header',
							'menu_id'        => '',
							'container'      => '',
							'menu_class'     => 'header__menu',					
						)
					);
				?>
				<div class="header__menu-shop">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'header_shop',
							'menu_id'        => '',
							'container'      => '',
							'menu_class'     => 'header__menu_shop',					
						)
					); ?>
					<div class="header__menu-shop_count" <?php echo wc_get_cart_url(); ?>>
					<?php
					global $woocommerce;
					echo sprintf($woocommerce->cart->cart_contents_count); ?>
					</div>
					<?php
					$phone = $header["phone"]; 
					$phoneLink = preg_replace('/[^0-9]/', '', $phone);
					if( $phoneLink ) { ?>
						<a class="btn btn__primary" href="tel:+<?php echo $phoneLink; ?>"><?php echo  $phone; ?></a>
					<?php } ?>
				</div>
			</nav><!-- #site-navigation -->

			

			

			<div class="header__burger"><span></span></div>
		</div>	
	</header><!-- #masthead -->
