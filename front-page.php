<?php
/**
 * Front Page Template — Finexiah
 */
get_header();

$hero_query = new WP_Query( array( 'posts_per_page' => 4, 'ignore_sticky_posts' => true ) );
$hero_posts = $hero_query->posts;
$main_hero  = ! empty( $hero_posts ) ? $hero_posts[0] : null;
$side_heroes = array_slice( $hero_posts, 1, 3 );

$latest_query = new WP_Query( array( 'posts_per_page' => 3, 'offset' => 4, 'ignore_sticky_posts' => true ) );
?>

<div class="container">
	<a href="<?php echo esc_url( home_url( '/news' ) ); ?>" class="breaking-strip"><?php esc_html_e( '&nbsp;&nbsp;BREAKING&nbsp;&nbsp;', 'finexiah' ); ?></a>
</div>

<div class="container">
	<div class="hero-grid">

		<?php if ( $main_hero ) : setup_postdata( $main_hero ); ?>
			<?php $cat = finexiah_primary_category( $main_hero->ID ); ?>
			<a href="<?php echo esc_url( get_permalink( $main_hero ) ); ?>"
			   class="hero-feature"
			   style="background-image:url('<?php echo esc_url( get_the_post_thumbnail_url( $main_hero, 'finexiah-hero' ) ); ?>');">
				<div class="hero-feature__content">
					<?php if ( $cat ) : ?>
						<span class="chip chip--blue" style="background:rgba(255,255,255,.15);color:#fff;"><?php echo esc_html( $cat->name ); ?></span>
					<?php endif; ?>
					<h1><?php echo esc_html( get_the_title( $main_hero ) ); ?></h1>
					<p><?php echo esc_html( wp_trim_words( get_the_excerpt( $main_hero ), 24 ) ); ?></p>
					<div class="hero-feature__meta">
						<span>By <?php echo esc_html( get_the_author_meta( 'display_name', $main_hero->post_author ) ); ?></span>
						<span>&middot;</span>
						<span><?php echo esc_html( finexiah_reading_time( $main_hero->ID ) ); ?> Min Read</span>
					</div>
				</div>
			</a>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>

		<div class="hero-side">
			<?php foreach ( $side_heroes as $p ) :
				$cat = finexiah_primary_category( $p->ID );
				?>
				<a href="<?php echo esc_url( get_permalink( $p ) ); ?>"
				   class="hero-side__card"
				   style="background-image:url('<?php echo esc_url( get_the_post_thumbnail_url( $p, 'finexiah-card' ) ); ?>');">
					<div class="inner">
						<?php if ( $cat ) : ?><span class="eyebrow"><?php echo esc_html( $cat->name ); ?></span><?php endif; ?>
						<h3><?php echo esc_html( get_the_title( $p ) ); ?></h3>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<div class="container">
	<div class="layout-with-sidebar">
		<div class="main-col">
			<div class="section-heading">
				<h2><?php esc_html_e( 'Latest Updates', 'finexiah' ); ?></h2>
				<a href="<?php echo esc_url( home_url( '/news' ) ); ?>"><?php esc_html_e( 'View All', 'finexiah' ); ?>
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
			</div>
			<div class="article-list">
				<?php
				if ( $latest_query->have_posts() ) :
					while ( $latest_query->have_posts() ) : $latest_query->the_post();
						get_template_part( 'template-parts/article-row' );
					endwhile;
					wp_reset_postdata();
				else :
					?>
					<p><?php esc_html_e( 'No stories published yet — check back soon.', 'finexiah' ); ?></p>
					<?php
				endif;
				?>
			</div>
		</div>

		<?php get_template_part( 'template-parts/sidebar' ); ?>
	</div>
</div>

<?php get_footer(); ?>
