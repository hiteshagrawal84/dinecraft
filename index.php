<?php
/**
 * Default index template.
 *
 * @package YourRestaurant
 */

get_header();
?>
<section class="yr-section">
	<div class="yr-container">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'yr-content-block' ); ?>>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
				</article>
			<?php endwhile; ?>
			<div class="yr-pagination"><?php the_posts_pagination(); ?></div>
		<?php else : ?>
			<p><?php esc_html_e( 'No content found.', 'your-restaurant' ); ?></p>
		<?php endif; ?>
		<?php get_sidebar(); ?>
	</div>
</section>
<?php
get_footer();
