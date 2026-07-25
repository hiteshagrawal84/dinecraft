<?php
/**
 * Blog card.
 *
 * @package YourRestaurant
 */

$image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
if ( ! $image ) {
	$image = get_post_meta( get_the_ID(), '_yr_image_url', true );
}
$author = get_post_meta( get_the_ID(), '_yr_author_name', true ) ?: get_the_author();
?>
<article class="yr-blog-card">
	<a href="<?php the_permalink(); ?>" class="yr-blog-card__image">
		<?php if ( $image ) : ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="<?php the_title_attribute(); ?>" width="800" height="500" loading="lazy" decoding="async" />
		<?php endif; ?>
	</a>
	<div class="yr-blog-card__body">
		<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p><?php echo esc_html( get_the_excerpt() ); ?></p>
		<span class="yr-blog-card__author"><?php echo esc_html( $author ); ?></span>
	</div>
</article>
