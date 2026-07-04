<?php
/**
 * The template for displaying all pages — Finexiah
 */
get_header();
?>

<div class="container" style="margin-top: 2rem;">
	<div class="layout-with-sidebar">
		<div class="main-col">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="page-header" style="margin-bottom: 2rem; border-bottom: 1px solid var(--outline-variant); padding-bottom: 1rem;">
							<h1 class="page-title" style="font-size: var(--headline-lg-size); color: var(--navy);"><?php the_title(); ?></h1>
						</header>

						<?php if ( has_post_thumbnail() ) : ?>
							<div class="page-featured-img" style="border-radius: var(--radius-md); overflow: hidden; margin-bottom: 2rem;">
								<?php the_post_thumbnail( 'finexiah-hero' ); ?>
							</div>
						<?php endif; ?>

						<div class="page-content article-body">
							<?php the_content(); ?>
						</div>
					</article>
					<?php
				endwhile;
			endif;
			?>
		</div>

		<?php get_template_part( 'template-parts/sidebar' ); ?>
	</div>
</div>

<?php
get_footer();
