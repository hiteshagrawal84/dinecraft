<?php
/**
 * Testimonial card.
 *
 * @package YourRestaurant
 */

$testimonial = $args['testimonial'] ?? null;
if ( ! $testimonial ) {
	return;
}

$quote  = yr_meta( $testimonial->ID, '_yr_quote', $testimonial->post_content );
$title  = yr_meta( $testimonial->ID, '_yr_title' );
$rating = (int) yr_meta( $testimonial->ID, '_yr_rating', 5 );
?>
<article class="yr-testimonial-card yr-reveal">
	<div class="yr-testimonial-card__stars">
		<?php for ( $i = 0; $i < $rating; $i++ ) : ?>
			<?php echo yr_icon( 'star', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php endfor; ?>
	</div>
	<blockquote>&ldquo;<?php echo esc_html( $quote ); ?>&rdquo;</blockquote>
	<div class="yr-testimonial-card__footer">
		<div class="yr-testimonial-card__name"><?php echo esc_html( $testimonial->post_title ); ?></div>
		<?php if ( $title ) : ?>
			<div class="yr-testimonial-card__role"><?php echo esc_html( $title ); ?></div>
		<?php endif; ?>
	</div>
</article>
