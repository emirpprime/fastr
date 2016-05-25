<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package fastr
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'flatr' ); ?></a>
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header text-center" role="banner">
		<div class="container">
			<?php
			if ( is_home() ) :
				// Display Custom Logo if set, else Gravatar.
				$custom_logo = get_custom_logo();
				if ( $custom_logo ) {
					// Custom logo set - let's output.
					echo wp_kses_post( $custom_logo );
				} else {
					// Fallback to Gravatar / discussion image.
					$header_image = '';
					// Get default from Discussion Settings.
					$default = get_option( 'avatar_default', 'mystery' ); // Mystery man default.
					if ( 'mystery' == $default ) :
						$default = 'mm';
					elseif ( 'gravatar_default' == $default ) :
						$default = '';
					endif;

					$protocol = ( is_ssl() ) ? 'https://secure.' : 'http://';
					$url = sprintf( '%1$sgravatar.com/avatar/%2$s/', $protocol, md5( get_option( 'admin_email' ) ) );
					$url = add_query_arg( array(
						's' => 120,
						'd' => urlencode( $default ),
					), $url );

					$header_image = esc_url_raw( $url );
					if ( ! empty( $header_image ) ) : ?>
						<a class="site-logo"  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<img src="<?php echo $header_image; ?>" alt="" class="header-image" />
						</a>
					<?php endif;
				}
			endif; ?>
			<div class="site-branding text-center">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php if ( is_home() ) : ?>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				<?php endif; ?>
			</div>
		</div>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content container">
