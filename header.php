<?php
/**
 * The header for Finexiah theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="top-bar">
	<div class="container">
		<div class="top-bar__left">
			<span><?php echo esc_html( date_i18n( 'l, F j, Y' ) ); ?></span>
			<span class="top-bar__ticker">
				<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M3 17l6-6 4 4 8-8"/></svg>
				BTC: $68,432.12 (+2.4%)
			</span>
		</div>
		<div class="top-bar__right">
			<?php if ( is_user_logged_in() ) : ?>
				<a href="<?php echo esc_url( admin_url() ); ?>"><?php esc_html_e( 'Dashboard', 'finexiah' ); ?></a>
			<?php else : ?>
				<a href="<?php echo esc_url( wp_login_url() ); ?>"><?php esc_html_e( 'Sign In', 'finexiah' ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</div>

<header class="site-header">
	<div class="container">
		<?php if ( has_custom_logo() ) : ?>
			<div class="site-logo"><?php the_custom_logo(); ?></div>
		<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo"><?php bloginfo( 'name' ); ?></a>
		<?php endif; ?>

		<nav class="primary-nav-wrap" aria-label="<?php esc_attr_e( 'Primary Navigation', 'finexiah' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'primary-nav',
					'depth'          => 1,
				) );
			} else {
				finexiah_fallback_menu();
			}
			?>
		</nav>

		<div class="header-actions">
			<form role="search" method="get" class="header-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
				<input type="search" name="s" placeholder="Search Markets&hellip;" value="<?php echo esc_attr( get_search_query() ); ?>">
			</form>
			<a href="<?php echo esc_url( home_url( '/subscribe' ) ); ?>" class="btn-subscribe"><?php esc_html_e( 'Subscribe', 'finexiah' ); ?></a>
			<button class="menu-toggle" aria-label="<?php esc_attr_e( 'Toggle menu', 'finexiah' ); ?>" aria-expanded="false">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
			</button>
		</div>
	</div>
</header>

<div id="mobile-menu" class="mobile-menu" hidden>
	<div class="container">
		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'mobile-nav-list',
				'depth'          => 1,
			) );
		}
		?>
		<form role="search" method="get" class="header-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="width:100%;margin-top:1rem;">
			<input type="search" name="s" placeholder="Search Markets&hellip;" style="width:100%;">
		</form>
	</div>
</div>

<main id="main-content">
