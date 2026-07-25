<?php
/**
 * Archive template.
 *
 * @package DineCraft
 */

get_header();
?>
<?php
get_template_part( 'template-parts/page', 'header', array(
	'eyebrow'  => __( 'Journal', 'dinecraft' ),
	'title'    => __( 'Our Blog', 'dinecraft' ),
	'subtitle' => __( 'Stories from the kitchen and beyond', 'dinecraft' ),
) );
?>

<section class="yr-section">
	<div class="yr-container">
		<?php if ( have_posts() ) : ?>
			<div class="yr-grid-3">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/blog', 'card' ); ?>
				<?php endwhile; ?>
			</div>
			<div class="yr-pagination"><?php the_posts_pagination(); ?></div>
		<?php else : ?>
			<p class="yr-empty"><?php esc_html_e( 'No blog posts yet.', 'dinecraft' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
