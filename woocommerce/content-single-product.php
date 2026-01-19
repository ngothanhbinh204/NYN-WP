<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// ===== VARIABLES CONFIGURATION =====
// Product basic information
$product_id = $product->get_id();
$product_name = $product->get_name();
$product_sku = $product->get_sku() ?: 'N/A';

// Image configuration
$featured_image_id = $product->get_image_id();
$featured_image_id_of_product = get_post_thumbnail_id($product_id);
$gallery_image_ids = $product->get_gallery_image_ids();
$all_image_ids = array_merge([$featured_image_id], $gallery_image_ids);

// Product type and variations
$is_variable_product = $product->is_type('variable');
$variations = $is_variable_product ? $product->get_available_variations() : [];

// Price configuration for variable products
$variation_prices = $is_variable_product ? $product->get_variation_prices() : [];
$min_regular_price = !empty($variation_prices['regular_price']) ? min($variation_prices['regular_price']) : 0;
$max_regular_price = !empty($variation_prices['regular_price']) ? max($variation_prices['regular_price']) : 0;
$has_price_range = $min_regular_price !== $max_regular_price;

// Product availability
$is_purchasable = $product->is_purchasable();
$is_in_stock = $product->is_in_stock();

// CSS classes and attributes
$main_image_classes = 'img-ratio ratio:pt-[532_800] rounded-lg overflow-hidden';
$thumb_image_classes = 'img ratio:pt-[106_144] img-ratio rem:rounded-[16px] overflow-hidden [&_img]:rem:rounded-[16px]';
$fancybox_gallery = 'product-image';
$fancybox_main = 'img-main';

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

get_template_part('modules/common/breadcrumb');
?>
<section id="product-<?php the_ID(); ?>" <?php wc_product_class('section-product-detail section-py', $product); ?>>
	<div class="container">
		<div class="row gap-y-[30px]">
			<div class="wrap-image-slide flex flex-col gap-5 sticky top-[var(--header-height)]">
					<!-- Main Image Slider -->
					<div class="product-main-image relative">
						<div class="swiper">
							<div class="swiper-wrapper">
								<?php
								// Render variation images for variable products
								if ($is_variable_product) :
									foreach ($variations as $variation) :
										$variation_image_id = $variation['image_id'];
										$variation_id = $variation['variation_id'];
										$image_url = get_the_post_thumbnail_url($variation_id, 'full');

										if ($variation_image_id && $image_url) :
								?>
											<div class="swiper-slide"
												 data-variation-id="<?= esc_attr($variation_id) ?>"
												 data-image-id="<?= esc_attr($variation_image_id) ?>"
												 data-image-featured="<?= esc_attr($featured_image_id_of_product) ?>">
												<a class="<?= esc_attr($main_image_classes) ?>"
												   href="<?= esc_url($image_url) ?>"
												   data-fancybox="<?= esc_attr($fancybox_gallery) ?>">
													<img class="lozad"
														 data-src="<?= esc_url($image_url) ?>"
														 alt="<?= esc_attr($product_name) ?>" />
												</a>
											</div>
								<?php
										endif;
									endforeach;
								endif;

								// Render main product images
								foreach ($all_image_ids as $image_id) :
									if ($image_id) :
										$image_url = wp_get_attachment_image_src($image_id, 'full')[0];
								?>
										<div class="swiper-slide">
											<a class="<?= esc_attr($main_image_classes) ?>"
											   href="<?= esc_url($image_url) ?>"
											   data-fancybox="<?= esc_attr($fancybox_main) ?>">
												<img class="lozad"
													 data-src="<?= esc_url($image_url) ?>"
													 alt="<?= esc_attr($product_name) ?>" />
											</a>
										</div>
								<?php
									endif;
								endforeach;
								?>
							</div>
						</div>
						<div class="wrap-button-slide in-static">
							<div class="btn btn-prev btn-sw-1"></div>
							<div class="btn btn-next btn-sw-1"></div>
						</div>
					</div>
					<!-- Thumbnail Slider -->
					<div class="product-thumb-image">
						<div class="swiper">
							<div class="swiper-wrapper">
								<?php
								// Render variation thumbnails for variable products
								if ($is_variable_product) :
									foreach ($variations as $variation) :
										$variation_image_id = $variation['image_id'];
										$variation_id = $variation['variation_id'];
										$image_url = get_the_post_thumbnail_url($variation_id, 'full');

										if ($variation_image_id && $image_url) :
								?>
											<div class="swiper-slide"
												 data-variation-id="<?= esc_attr($variation_id) ?>"
												 data-image-id="<?= esc_attr($variation_image_id) ?>"
												 data-image-featured="<?= esc_attr($featured_image_id_of_product) ?>">
												<div class="<?= esc_attr($thumb_image_classes) ?>">
													<img class="lozad"
														 data-src="<?= esc_url($image_url) ?>"
														 alt="<?= esc_attr($product_name) ?>" />
												</div>
											</div>
								<?php
										endif;
									endforeach;
								endif;

								// Render main product thumbnails
								foreach ($all_image_ids as $image_id) :
									if ($image_id) :
										$image_url = wp_get_attachment_image_src($image_id, 'full')[0];
								?>
										<div class="swiper-slide">
											<div class="<?= esc_attr($thumb_image_classes) ?>">
												<img class="lozad"
													 data-src="<?= esc_url($image_url) ?>"
													 alt="<?= esc_attr($product_name) ?>" />
											</div>
										</div>
								<?php
									endif;
								endforeach;
								?>
							</div>
						</div>
					</div>
				</div>

			<!-- Right Column: Product Details -->
			<div class="col lg:w-5/12">
				<div class="product-col-right">
					<h1 class="product-title title-48"><?= esc_html($product_name) ?></h1>
					<div class="product-price-wrap loading">
						<div class="product-price">
							<?php do_action('woocommerce_custom_price'); ?>
						</div>
					</div>
					<?php do_action('woocommerce_single_product_summary'); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
/**
 * Hook: woocommerce_after_single_product_summary. 
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_upsell_display - 15
 * @hooked woocommerce_output_related_products - 20
 */
do_action('woocommerce_after_single_product_summary');
?>
<?php do_action('woocommerce_after_single_product'); ?>
<style>
	.woocommerce-variation-description {
		display: none !important;
	}

    .added_to_cart {
        display: none;
    }

	.section-product-detail .product-col-right .variations_form label {
		text-align: left;
	}
</style>