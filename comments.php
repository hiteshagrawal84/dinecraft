<?php
/**
 * Comments template.
 *
 * @package YourRestaurant
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
				esc_html( _n( '%1$s Comment', '%1$s Comments', $yr_comment_count, 'your-restaurant' ) ),
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
				'prev_text' => esc_html__( 'Older comments', 'your-restaurant' ),
				'next_text' => esc_html__( 'Newer comments', 'your-restaurant' ),
			)
		);

		if ( ! comments_open() ) :
			?>
			<p class="yr-comments__closed"><?php esc_html_e( 'Comments are closed.', 'your-restaurant' ); ?></p>
			<?php
		endif;
	endif;

	comment_form(
		array(
			'title_reply'          => esc_html__( 'Leave a Comment', 'your-restaurant' ),
			'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'your-restaurant' ),
			'cancel_reply_link'    => esc_html__( 'Cancel reply', 'your-restaurant' ),
			'label_submit'         => esc_html__( 'Post Comment', 'your-restaurant' ),
			'comment_notes_before' => '',
			'class_submit'         => 'yr-btn yr-btn--primary',
		)
	);
	?>
</div>
