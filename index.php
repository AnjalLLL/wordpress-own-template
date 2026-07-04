<?php
/**
 * The main template file — Finexiah
 */
get_header();
?>

<div class="container" style="margin-top: 2rem;">
	<div class="layout-with-sidebar">
		<div class="main-col">
			<div class="section-heading">
				<h2><?php esc_html_e( 'All Updates', 'finexiah' ); ?></h2>
			</div>

			<?php if ( have_posts() ) : ?>
				<div class="article-list">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/article-row' );
					endwhile;
					?>
				</div>

				<div class="pagination" style="margin-top: 2rem;">
					<?php
					echo paginate_links( array(
						'prev_text' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 6l-6 6 6 6"/></svg>',
						'next_text' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6"/></svg>',
					) );
					?>
				</div>
			<?php else : ?>
				<p><?php esc_html_e( 'No stories found.', 'finexiah' ); ?></p>
			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php
get_footer();
