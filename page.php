<?php
/**
 * Page template.
 *
 * @package YourRestaurant
 */

get_header();
?>
<section class="yr-section">
	<div class="yr-container yr-content">
		<?php while ( have_posts() ) : the_post(); ?>
			<h1 class="yr-page-title"><?php the_title(); ?></h1>
			<?php
			the_content();
			wp_link_pages(
				array(
					'before' => '<nav class="yr-page-links"><span class="yr-page-links__label">' . esc_html__( 'Pages:', 'your-restaurant' ) . '</span> ',
					'after'  => '</nav>',
				)
			);
			?>
		<?php endwhile; ?>
	</div>
</section>
<?php
get_footer();
