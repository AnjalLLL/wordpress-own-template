<?php
/**
 * Template part: Article Row (horizontal list item)
 */
$cat = finexiah_primary_category();
?>
<article <?php post_class( 'article-row' ); ?>>
	<a href="<?php the_permalink(); ?>" class="article-row__img">
		<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'finexiah-card' ); else : ?>
			<div style="width:100%;height:100%;background:var(--navy);"></div>
		<?php endif; ?>
	</a>
	<div>
		<div class="article-row__meta-top">
			<?php if ( $cat ) : ?>
				<span class="eyebrow"><?php echo esc_html( $cat->name ); ?></span>
				<span>&middot;</span>
			<?php endif; ?>
			<span><?php echo esc_html( get_the_date() ); ?></span>
		</div>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
		<div class="article-row__author">
			<span class="avatar-dot"><?php echo get_avatar( get_the_author_meta( 'ID' ), 22 ); ?></span>
			<span><?php the_author(); ?></span>
		</div>
	</div>
</article>
