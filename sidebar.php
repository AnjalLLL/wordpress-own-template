<?php
/**
 * Template part: Standard editorial sidebar
 * Used on single.php, archive.php, category.php, index.php
 */
?>
<aside class="sidebar">

	<div class="widget">
		<h3 class="widget-title"><?php esc_html_e( 'Market Insights', 'finexiah' ); ?></h3>
		<p class="widget-subtitle"><?php esc_html_e( 'Live Tech & Finance Updates', 'finexiah' ); ?></p>
		<ul class="widget-list">
			<li class="widget-list-item">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 17l6-6 4 4 8-8"/></svg>
				<a href="<?php echo esc_url( home_url( '/popular' ) ); ?>"><?php esc_html_e( 'Popular', 'finexiah' ); ?></a>
			</li>
			<li class="widget-list-item">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2 3 14h7l-1 8 10-12h-7l1-8z"/></svg>
				<a href="<?php echo esc_url( home_url( '/trending' ) ); ?>"><?php esc_html_e( 'Trending', 'finexiah' ); ?></a>
			</li>
			<li class="widget-list-item">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18"/></svg>
				<a href="<?php echo esc_url( home_url( '/news' ) ); ?>"><?php esc_html_e( 'News', 'finexiah' ); ?></a>
			</li>
			<li class="widget-list-item">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18M7 14l4-4 3 3 5-6"/></svg>
				<a href="<?php echo esc_url( home_url( '/analysis' ) ); ?>"><?php esc_html_e( 'Analysis', 'finexiah' ); ?></a>
			</li>
		</ul>
	</div>

	<div class="widget widget--newsletter">
		<h3 class="widget-title"><?php esc_html_e( 'Get the Edge', 'finexiah' ); ?></h3>
		<p class="widget-subtitle"><?php esc_html_e( 'Join 50k+ professionals receiving our weekly deep dives.', 'finexiah' ); ?></p>
		<form class="newsletter-form" method="post" action="<?php echo esc_url( get_theme_mod( 'finexiah_newsletter_action', '#' ) ); ?>">
			<input type="email" name="email" placeholder="email@example.com" required>
			<button type="submit"><?php esc_html_e( 'Join Newsletter', 'finexiah' ); ?></button>
		</form>
	</div>

	<?php
	$trending_query = new WP_Query( array(
		'posts_per_page' => 2,
		'meta_key'       => 'finexiah_views',
		'orderby'        => array( 'meta_value_num' => 'DESC', 'date' => 'DESC' ),
		'ignore_sticky_posts' => true,
	) );
	if ( $trending_query->have_posts() ) :
	?>
	<div class="widget">
		<h3 class="widget-title" style="font-size:14px;letter-spacing:.05em;text-transform:uppercase;"><?php esc_html_e( 'Trending in Finance', 'finexiah' ); ?></h3>
		<div class="widget-list" style="margin-top:.75rem;">
			<?php while ( $trending_query->have_posts() ) : $trending_query->the_post(); ?>
				<div class="popular-post">
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'finexiah-thumb' ); ?></a>
					<?php endif; ?>
					<div>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<div class="date"><?php echo esc_html( human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?> ago</div>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
	<?php endif; ?>

	<?php
	$popular_query = new WP_Query( array( 'posts_per_page' => 3, 'orderby' => 'comment_count', 'order' => 'DESC', 'ignore_sticky_posts' => true ) );
	if ( $popular_query->have_posts() ) :
	?>
	<div class="widget">
		<h3 class="widget-title"><?php esc_html_e( 'Popular', 'finexiah' ); ?></h3>
		<div class="widget-list" style="margin-top:.5rem;">
			<?php $i = 1; while ( $popular_query->have_posts() ) : $popular_query->the_post(); ?>
				<div class="popular-post">
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'finexiah-thumb' ); ?></a>
					<?php endif; ?>
					<div>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<div class="date"><?php echo esc_html( get_the_date() ); ?></div>
					</div>
				</div>
			<?php $i++; endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
	<?php endif; ?>

	<div class="widget">
		<h3 class="widget-title"><?php esc_html_e( 'Labels', 'finexiah' ); ?></h3>
		<div class="label-pills" style="margin-top:.75rem;">
			<?php
			$requested_labels = array( 'AI', 'Cybersecurity', 'Programming', 'Research', 'Sci-Tech', 'Finance', 'Technology' );
			foreach ( $requested_labels as $label_name ) {
				$tag = get_term_by( 'name', $label_name, 'post_tag' );
				$link = $tag ? get_tag_link( $tag ) : '#';
				echo '<a class="label-pill" href="' . esc_url( $link ) . '">&gt; ' . esc_html( $label_name ) . '</a>';
			}
			?>
		</div>
	</div>

	<?php if ( is_active_sidebar( 'sidebar-article' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-article' ); ?>
	<?php endif; ?>

</aside>
