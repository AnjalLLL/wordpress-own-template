</main><!-- #main-content -->

<footer class="site-footer">
	<div class="container">
		<div class="footer-main">
			<div class="footer-col footer-brand-col">
				<div class="footer-brand"><?php bloginfo( 'name' ); ?></div>
				<p class="footer-desc"><?php echo esc_html( get_theme_mod( 'finexiah_footer_desc', 'Independent journalism delivering precision analysis at the intersection of Silicon Valley and Wall Street.' ) ); ?></p>
				<div class="footer-social">
					<?php
					$socials = array(
						'twitter'  => get_theme_mod( 'finexiah_social_twitter' ),
						'rss'      => get_theme_mod( 'finexiah_social_rss', get_bloginfo( 'rss2_url' ) ),
						'linkedin' => get_theme_mod( 'finexiah_social_linkedin' ),
					);
					foreach ( $socials as $net => $url ) {
						if ( $url ) {
							echo '<a href="' . esc_url( $url ) . '" aria-label="' . esc_attr( $net ) . '">';
							echo '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/></svg>';
							echo '</a>';
						}
					}
					?>
				</div>
			</div>

			<div class="footer-col">
				<h4><?php esc_html_e( 'Categories', 'finexiah' ); ?></h4>
				<ul>
					<?php
					if ( has_nav_menu( 'footer-categories' ) ) {
						wp_nav_menu( array( 'theme_location' => 'footer-categories', 'container' => false, 'items_wrap' => '%3$s' ) );
					} else {
						$cats = get_categories( array( 'number' => 5 ) );
						foreach ( $cats as $cat ) {
							echo '<li><a href="' . esc_url( get_category_link( $cat ) ) . '">' . esc_html( $cat->name ) . '</a></li>';
						}
					}
					?>
				</ul>
			</div>

			<div class="footer-col">
				<h4><?php esc_html_e( 'Company', 'finexiah' ); ?></h4>
				<ul>
					<?php
					if ( has_nav_menu( 'footer-company' ) ) {
						wp_nav_menu( array( 'theme_location' => 'footer-company', 'container' => false, 'items_wrap' => '%3$s' ) );
					} else {
						?>
						<li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'About Us', 'finexiah' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'finexiah' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/careers' ) ); ?>"><?php esc_html_e( 'Careers', 'finexiah' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/advertising' ) ); ?>"><?php esc_html_e( 'Advertising', 'finexiah' ); ?></a></li>
						<?php
					}
					?>
				</ul>
			</div>

			<div class="footer-col">
				<h4><?php esc_html_e( 'Legal', 'finexiah' ); ?></h4>
				<ul>
					<?php
					if ( has_nav_menu( 'footer-legal' ) ) {
						wp_nav_menu( array( 'theme_location' => 'footer-legal', 'container' => false, 'items_wrap' => '%3$s' ) );
					} else {
						?>
						<li><a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'finexiah' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/terms-of-service' ) ); ?>"><?php esc_html_e( 'Terms of Service', 'finexiah' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/cookie-policy' ) ); ?>"><?php esc_html_e( 'Cookie Policy', 'finexiah' ); ?></a></li>
						<?php
					}
					?>
				</ul>
			</div>
		</div>

		<div class="footer-bottom">
			<span>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved. Precision in Reporting.', 'finexiah' ); ?></span>
			<div>
				<button class="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="<?php esc_attr_e( 'Back to top', 'finexiah' ); ?>">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 15l-6-6-6 6"/></svg>
				</button>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
