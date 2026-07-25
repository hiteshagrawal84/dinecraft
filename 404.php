<?php
/**
 * 404 template.
 *
 * @package DineCraft
 */

get_header();
?>

<section class="yr-section">
	<div class="yr-container" style="max-width:40rem;text-align:center;">
		<h1 class="yr-heading"><?php esc_html_e( 'Page Not Found', 'dinecraft' ); ?></h1>
		<p class="yr-text"><?php esc_html_e( 'The page you are looking for is no longer on the menu. Try a search instead.', 'dinecraft' ); ?></p>
		<?php get_search_form(); ?>
		<p style="margin-top:2rem;">
			<a class="yr-btn yr-btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php esc_html_e( 'Back to Home', 'dinecraft' ); ?>
			</a>
		</p>
	</div>
</section>

<?php
get_footer();
