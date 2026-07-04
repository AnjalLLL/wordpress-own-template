<?php
/**
 * The template for displaying comments — Finexiah
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-section">

	<div class="comments-head">
		<h3><?php esc_html_e( 'Community Insights', 'finexiah' ); ?></h3>
		<span class="chip chip--outline" style="border-radius: var(--radius-full); font-size: 12px; padding: .2rem .75rem;">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				printf( esc_html__( '%s Comment', 'finexiah' ), number_format_i18n( $comments_number ) );
			} else {
				printf( esc_html__( '%s Comments', 'finexiah' ), number_format_i18n( $comments_number ) );
			}
			?>
		</span>
	</div>

	<?php if ( have_comments() ) : ?>
		<ul class="comment-list" style="list-style: none; padding: 0; margin-bottom: 2.5rem;">
			<?php
			wp_list_comments( array(
				'callback'   => 'finexiah_comment',
				'style'      => 'ul',
				'short_ping' => true,
			) );
			?>
		</ul>

		<?php
		the_comments_navigation( array(
			'next_text' => esc_html__( 'Newer Comments', 'finexiah' ) . ' &rarr;',
			'prev_text' => '&larr; ' . esc_html__( 'Older Comments', 'finexiah' ),
		) );
		?>

	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments" style="text-align: center; color: var(--slate); font-style: italic; font-size: 14px;">
			<?php esc_html_e( 'Comments are closed.', 'finexiah' ); ?>
		</p>
	<?php endif; ?>

	<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );

	comment_form( array(
		'title_reply'        => __( 'Post a Comment', 'finexiah' ),
		'title_reply_to'     => __( 'Post a Comment to %s', 'finexiah' ),
		'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title" style="font-size:18px; margin-bottom:1.5rem; text-align:left;">',
		'title_reply_after'  => '</h3>',
		'class_form'         => 'comment-form',
		'comment_field'      => '<div style="margin-bottom: 1rem;"><textarea id="comment" name="comment" cols="45" rows="4" aria-required="true" placeholder="' . esc_attr__( 'Write your comment...', 'finexiah' ) . '" required style="width: 100%; border: 1px solid var(--outline-variant); border-radius: var(--radius-md); padding: .85rem 1rem; font-size: 14px; font-family: inherit; resize: vertical;"></textarea></div>',
		'submit_button'      => '<button name="%1$s" type="submit" id="%2$s" class="%3$s btn-primary" style="background: var(--navy); color: #fff; border: none; padding: .75rem 1.75rem; border-radius: var(--radius-md); font-weight: 700; font-size: 14px; cursor: pointer; width: 100%; transition: background 0.2s;">%4$s</button>',
		'submit_field'       => '<div class="form-submit" style="margin-top: 1rem;">%1$s %2$s</div>',
		'fields'             => array(
			'author' => '<div style="display: grid; grid-template-columns: 1fr; gap: .75rem; margin-bottom: .85rem;"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_attr__( 'Name *', 'finexiah' ) . '" required style="width: 100%; border: 1px solid var(--outline-variant); border-radius: var(--radius-md); padding: .75rem .9rem; font-size: 14px;" /></div>',
			'email'  => '<div style="margin-bottom: .85rem;"><input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_attr__( 'Email *', 'finexiah' ) . '" required style="width: 100%; border: 1px solid var(--outline-variant); border-radius: var(--radius-md); padding: .75rem .9rem; font-size: 14px;" /></div>',
		)
	) );
	?>

</div>
