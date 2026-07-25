<?php
/**
 * Comments template.
 *
 * @package DineCraft
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="yr-comments">
	<?php if ( have_comments() ) : ?>
		<h2 class="yr-comments__title">
			<?php
			$yr_comment_count = get_comments_number();
			printf(
				/* translators: 1: comment count number */
				esc_html( _n( '%1$s Comment', '%1$s Comments', $yr_comment_count, 'dinecraft' ) ),
				esc_html( number_format_i18n( $yr_comment_count ) )
			);
			?>
		</h2>

		<ol class="yr-comments__list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 56,
					'callback'    => 'yr_comment_callback',
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation(
			array(
				'prev_text' => esc_html__( 'Older comments', 'dinecraft' ),
				'next_text' => esc_html__( 'Newer comments', 'dinecraft' ),
			)
		);

		if ( ! comments_open() ) :
			?>
			<p class="yr-comments__closed"><?php esc_html_e( 'Comments are closed.', 'dinecraft' ); ?></p>
			<?php
		endif;
	endif;

	comment_form(
		array(
			'title_reply'          => esc_html__( 'Leave a Comment', 'dinecraft' ),
			'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'dinecraft' ),
			'cancel_reply_link'    => esc_html__( 'Cancel reply', 'dinecraft' ),
			'label_submit'         => esc_html__( 'Post Comment', 'dinecraft' ),
			'comment_notes_before' => '',
			'class_submit'         => 'yr-btn yr-btn--primary',
		)
	);
	?>
</div>
