<?php
/**
 * Single Post Template — Finexiah
 */
get_header();
?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		$cat = finexiah_primary_category();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="container">
				<nav class="breadcrumb">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'finexiah' ); ?></a>
					<?php if ( $cat ) : ?>
						<span class="sep">/</span>
						<a href="<?php echo esc_url( get_category_link( $cat ) ); ?>"><?php echo esc_html( $cat->name ); ?></a>
					<?php endif; ?>
					<span class="sep">/</span>
					<span><?php the_title(); ?></span>
				</nav>

				<header class="article-header">
					<?php if ( $cat ) : ?>
						<span class="chip <?php echo esc_attr( finexiah_chip_class( $cat->slug ) ); ?>"><?php echo esc_html( $cat->name ); ?></span>
					<?php endif; ?>
					<h1><?php the_title(); ?></h1>
					
					<div class="article-byline">
						<div class="article-byline__author">
							<span class="avatar-dot" style="width:42px;height:42px;">
								<?php echo get_avatar( get_the_author_meta( 'ID' ), 42 ); ?>
							</span>
							<div>
								<div class="author-name"><?php the_author(); ?></div>
								<div class="author-role">
									<?php 
									$role = get_the_author_meta( 'finexiah_role' );
									echo esc_html( $role ? $role : __( 'Senior Markets Editor', 'finexiah' ) ); 
									?>
									&middot;
									<span><?php echo esc_html( get_the_date() ); ?></span>
								</div>
							</div>
						</div>
						<div class="article-share">
							<button aria-label="<?php esc_attr_e( 'Share on Twitter', 'finexiah' ); ?>">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
							</button>
							<button aria-label="<?php esc_attr_e( 'Bookmark article', 'finexiah' ); ?>">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"/></svg>
							</button>
							<button aria-label="<?php esc_attr_e( 'Export / Share link', 'finexiah' ); ?>">
								<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8M16 6l-4-4-4 4M12 2v13"/></svg>
							</button>
						</div>
					</div>
				</header>
			</div>

			<div class="container">
				<div class="layout-with-sidebar">
					<div class="main-col">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="article-featured-img">
								<?php the_post_thumbnail( 'finexiah-hero' ); ?>
							</div>
							<?php 
							$caption = wp_get_attachment_caption( get_post_thumbnail_id() );
							if ( $caption ) :
								?>
								<div class="article-caption"><?php echo esc_html( $caption ); ?></div>
							<?php endif; ?>
						<?php endif; ?>

						<div class="article-body">
							<?php the_content(); ?>
						</div>

						<?php
						$tags = get_the_tags();
						if ( $tags ) :
							?>
							<div class="tag-row">
								<?php foreach ( $tags as $tag ) : ?>
									<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="label-pill">#<?php echo esc_html( strtoupper( $tag->name ) ); ?></a>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<!-- Related Stories Section -->
						<?php
						$related_args = array(
							'posts_per_page' => 2,
							'post__not_in'   => array( get_the_ID() ),
							'ignore_sticky_posts' => true,
						);
						if ( $cat ) {
							$related_args['category__in'] = array( $cat->term_id );
						}
						$related_query = new WP_Query( $related_args );
						if ( $related_query->have_posts() ) :
							?>
							<div class="section-heading" style="margin-top: 3.5rem;">
								<h2><?php esc_html_e( 'Related Stories', 'finexiah' ); ?></h2>
							</div>
							<div class="related-grid" style="margin-bottom: 2rem;">
								<?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
									<div class="related-post">
										<a href="<?php the_permalink(); ?>" style="display:block; margin-bottom:.75rem;">
											<?php if ( has_post_thumbnail() ) : ?>
												<?php the_post_thumbnail( 'finexiah-card', array( 'style' => 'border-radius: var(--radius-md); aspect-ratio: 16/9; object-fit: cover;' ) ); ?>
											<?php else : ?>
												<div style="width:100%; height:160px; background:var(--navy); border-radius: var(--radius-md);"></div>
											<?php endif; ?>
										</a>
										<h3 style="font-size:16px; margin-bottom:.5rem; line-height:1.4;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<div style="font-size:12px; color:var(--slate);">
											<?php echo esc_html( get_the_date() ); ?> &middot; <?php echo esc_html( finexiah_reading_time() ); ?> Min Read
										</div>
									</div>
								<?php endwhile; wp_reset_postdata(); ?>
							</div>
						<?php endif; ?>

						<!-- Comments Section -->
						<?php 
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
						?>
					</div>

					<?php get_sidebar(); ?>
				</div>
			</div>
		</article>
		<?php
	endwhile;
endif;
?>

<?php
get_footer();
