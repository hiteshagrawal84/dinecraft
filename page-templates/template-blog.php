<?php
/**
 * Template Name: Blog
 *
 * @package YourRestaurant
 */

get_header();
?>
<?php
get_template_part( 'template-parts/page', 'header', array(
	'eyebrow'  => __( 'Journal', 'your-restaurant' ),
	'title'    => __( 'Our Blog', 'your-restaurant' ),
	'subtitle' => __( 'Stories from the kitchen and beyond', 'your-restaurant' ),
) );
?>

<section class="yr-section">
	<div class="yr-container">
		<?php
		$query = new WP_Query( array(
			'post_type'      => 'post',
			'posts_per_page' => 12,
			'paged'          => max( 1, get_query_var( 'paged' ) ),
		) );

		if ( $query->have_posts() ) :
			echo '<div class="yr-grid-3">';
			while ( $query->have_posts() ) :
				$query->the_post();
				get_template_part( 'template-parts/blog', 'card' );
			endwhile;
			echo '</div>';
			echo '<div class="yr-pagination">' . paginate_links( array( 'total' => $query->max_num_pages ) ) . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			wp_reset_postdata();
		else :
			?>
			<p class="yr-empty"><?php esc_html_e( 'No blog posts yet.', 'your-restaurant' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
