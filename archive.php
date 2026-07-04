<?php
/**
 * Archive Template — Finexiah (category, tag, generic archive)
 */
get_header();
$current_cat = is_category() ? get_queried_object() : null;
?>

<div class="container">
	<nav class="breadcrumb">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'finexiah' ); ?></a>
		<span class="sep">/</span>
		<span><?php the_archive_title(); ?></span>
	</nav>

	<header class="archive-header">
		<span class="chip chip--outline"><?php esc_html_e( 'Archive', 'finexiah' ); ?></span>
		<h1 class="archive-title"><?php the_archive_title( '', false ); ?></h1>
		<?php if ( category_description() ) : ?>
			<div class="archive-desc"><?php echo wp_kses_post( category_description() ); ?></div>
		<?php else : ?>
			<p class="archive-desc"><?php esc_html_e( 'In-depth reporting on the stories shaping tech and finance.', 'finexiah' ); ?></p>
		<?php endif; ?>

		<?php
		$children = $current_cat ? get_categories( array( 'parent' => $current_cat->term_id, 'hide_empty' => false ) ) : array();
		if ( $children ) :
			?>
			<nav class="archive-tabs">
				<a href="<?php echo esc_url( get_category_link( $current_cat ) ); ?>" class="active"><?php echo esc_html( $current_cat->name ); ?></a>
				<?php foreach ( $children as $child ) : ?>
					<a href="<?php echo esc_url( get_category_link( $child ) ); ?>"><?php echo esc_html( $child->name ); ?></a>
				<?php endforeach; ?>
			</nav>
		<?php endif; ?>
	</header>
</div>

<div class="container">
	<div class="layout-with-sidebar">
		<div class="main-col">
			<div class="archive-toolbar">
				<span></span>
				<span class="sort-label">
					<?php esc_html_e( 'Sorted by: Newest First', 'finexiah' ); ?>
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M6 12h12M10 18h4"/></svg>
				</span>
			</div>

			<?php if ( have_posts() ) : ?>
				<div class="card-grid">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/card-news' );
					endwhile;
					?>
				</div>

				<div class="pagination">
					<?php
					echo paginate_links( array(
						'prev_text' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 6l-6 6 6 6"/></svg>',
						'next_text' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6"/></svg>',
					) );
					?>
				</div>
			<?php else : ?>
				<p><?php esc_html_e( 'No stories found in this section yet.', 'finexiah' ); ?></p>
			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
