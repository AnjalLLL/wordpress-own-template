<?php
/**
 * Template part: News Card (used in archive/category grids)
 */
$cat = finexiah_primary_category();
?>
<article <?php post_class( 'news-card' ); ?>>
	<a href="<?php the_permalink(); ?>" class="news-card__img">
		<?php if ( $cat ) : ?>
			<span class="chip <?php echo esc_attr( finexiah_chip_class( $cat->slug ) ); ?>"><?php echo esc_html( $cat->name ); ?></span>
		<?php endif; ?>
		<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'finexiah-card' ); else : ?>
			<div style="width:100%;height:100%;background:var(--navy);"></div>
		<?php endif; ?>
	</a>
	<div class="news-card__body">
		<div class="news-card__meta">
			<span><?php the_author(); ?></span>
			<span>&middot;</span>
			<span><?php echo esc_html( get_the_date() ); ?></span>
		</div>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?></p>
		<a class="read-more" href="<?php the_permalink(); ?>">
			<?php esc_html_e( 'Read Full Article', 'finexiah' ); ?>
			<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
		</a>
	</div>
</article>
