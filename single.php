<?php
/**
 * Single post template.
 *
 * @package DineCraft
 */

get_header();

$image  = get_the_post_thumbnail_url( get_the_ID(), 'large' );
if ( ! $image ) {
	$image = get_post_meta( get_the_ID(), '_yr_image_url', true );
}
$author   = get_post_meta( get_the_ID(), '_yr_author_name', true ) ?: get_the_author();
$blog_url = get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog' );
?>

<section class="yr-page-header">
	<div class="yr-container">
		<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		<h1 class="yr-page-header__title"><?php the_title(); ?></h1>
		<p class="yr-page-header__subtitle"><?php echo esc_html( $author ); ?></p>
	</div>
</section>

<article class="yr-section yr-single-post">
	<div class="yr-container" style="max-width:48rem;">
		<?php if ( $image ) : ?>
			<div class="yr-single-post__image">
				<img src="<?php echo esc_url( $image ); ?>" alt="<?php the_title_attribute(); ?>" width="1200" height="630" decoding="async" />
			</div>
		<?php endif; ?>

		<?php if ( has_excerpt() ) : ?>
			<p class="yr-single-post__excerpt"><em><?php echo esc_html( get_the_excerpt() ); ?></em></p>
		<?php endif; ?>

		<div class="yr-content">
			<?php
			the_content();
			wp_link_pages(
				array(
					'before' => '<nav class="yr-page-links"><span class="yr-page-links__label">' . esc_html__( 'Pages:', 'dinecraft' ) . '</span> ',
					'after'  => '</nav>',
				)
			);
			?>
		</div>

		<?php if ( has_tag() ) : ?>
			<footer class="yr-post-tags">
				<span class="yr-post-tags__label"><?php esc_html_e( 'Tags:', 'dinecraft' ); ?></span>
				<?php the_tags( '', ', ', '' ); ?>
			</footer>
		<?php endif; ?>

		<p class="yr-back-link"><a href="<?php echo esc_url( $blog_url ); ?>">← <?php esc_html_e( 'Back to Blog', 'dinecraft' ); ?></a></p>

		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>
		<?php get_sidebar(); ?>
	</div>
</article>

<?php get_footer(); ?>
