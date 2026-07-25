<?php
/**
 * Template Name: Menu
 *
 * @package YourRestaurant
 */

get_header();

$categories = yr_get_menu_categories();
$items      = yr_get_menu_items();
?>
<?php
get_template_part( 'template-parts/page', 'header', array(
	'eyebrow'  => yr_setting( 'site_name' ),
	'title'    => __( 'Our Menu', 'your-restaurant' ),
	'subtitle' => __( 'Crafted from the finest seasonal ingredients', 'your-restaurant' ),
) );
?>

<div class="yr-menu-filters" id="yr-menu-filters">
	<div class="yr-container yr-menu-filters__inner">
		<button type="button" class="yr-filter-pill is-active" data-filter="all"><?php esc_html_e( 'All', 'your-restaurant' ); ?></button>
		<?php foreach ( $categories as $cat ) : ?>
			<button type="button" class="yr-filter-pill" data-filter="<?php echo esc_attr( $cat->slug ); ?>"><?php echo esc_html( $cat->name ); ?></button>
		<?php endforeach; ?>
	</div>
</div>

<section class="yr-section" style="padding-top:4rem;">
	<div class="yr-container">
		<div class="yr-grid-3" id="yr-menu-grid">
			<?php foreach ( $items as $item ) : ?>
				<?php
				$terms = wp_get_post_terms( $item->ID, 'yr_menu_category' );
				$slug  = ! empty( $terms[0] ) ? $terms[0]->slug : 'all';
				?>
				<div data-category="<?php echo esc_attr( $slug ); ?>">
					<?php get_template_part( 'template-parts/menu', 'card', array( 'item' => $item ) ); ?>
				</div>
			<?php endforeach; ?>
		</div>
		<?php if ( empty( $items ) ) : ?>
			<p class="yr-empty"><?php esc_html_e( 'Add menu content to display your restaurant offerings here.', 'your-restaurant' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<section class="yr-tasting-band">
	<div class="yr-tasting-band__inner yr-container">
		<p class="yr-eyebrow"><?php esc_html_e( 'A Curated Journey', 'your-restaurant' ); ?></p>
		<div class="yr-ornament" aria-hidden="true"><span class="yr-ornament__diamond"></span></div>
		<h2 class="yr-heading yr-heading--light"><?php esc_html_e( "Chef's Tasting Menu", 'your-restaurant' ); ?></h2>
		<p class="yr-text yr-text--light"><?php esc_html_e( "A six-course journey through the season's finest, personally curated by Chef Mathieu Laurent.", 'your-restaurant' ); ?></p>
		<p class="yr-tasting-band__price"><?php esc_html_e( '₹ 3,950 per person', 'your-restaurant' ); ?></p>
	</div>
</section>

<?php get_footer(); ?>
