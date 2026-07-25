<?php
/**
 * Search results template.
 *
 * @package DineCraft
 */

get_header();
?>

<section class="yr-section">
	<div class="yr-container">
		<h1 class="yr-heading">
			<?php
			printf(
				/* translators: %s: search query. */
				esc_html__( 'Search results for: %s', 'dinecraft' ),
				'<em>' . esc_html( get_search_query() ) . '</em>'
			);
			?>
		</h1>

		<div style="max-width:32rem;margin-bottom:2.5rem;">
			<?php get_search_form(); ?>
		</div>

		<?php if ( have_posts() ) : ?>
			<div class="yr-grid-3">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/blog', 'card' );
				endwhile;
				?>
			</div>
			<div class="yr-pagination"><?php the_posts_pagination(); ?></div>
		<?php else : ?>
			<p class="yr-empty"><?php esc_html_e( 'No results found. Please try a different search.', 'dinecraft' ); ?></p>
		<?php endif; ?>

		<?php get_sidebar(); ?>
	</div>
</section>

<?php
get_footer();
