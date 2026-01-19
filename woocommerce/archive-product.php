<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

// Define all variables at the top
$term = get_queried_object();
$title_category = get_field('category_title', 'product_cat_' . $term->term_id);
$page_title = $title_category ? $title_category : $term->name;

// Shortcode variables
$product_filter_sort_shortcode = '[facetwp facet="product_filter_sort"]';
$pagination_product_shortcode = '[facetwp facet="pagination_product"]';

// Text strings
$filter_by_text = __('Lọc theo', 'canhcamtheme');
$filter_text = __('Bộ lọc', 'canhcamtheme');
$product_filter_title_text = __('Bộ lọc sản phẩm', 'canhcamtheme');

// Template directory path
$template_directory = get_template_directory_uri();

get_header('shop');
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');
?>
<?php get_template_part('modules/common/breadcrumb') ?>
<section class="section-product-list section-py !pt-0 list-product">
	<div class="container">
		<div class="wrap-title-filter flex md:justify-between md:items-center mb-8 flex-col md:flex-row flex-wrap gap-2">
			<h1 class="title-48 font-semibold [&amp;_strong]:text-Primary-Red [&amp;_strong]:[text-shadow:1px_1px_1px_rgba(0,0,0,0.4)] mb-5">
				<?= $page_title ?>
			</h1>
			<div class="wrap-filter-select flex-wrap flex items-center gap-2 justify-between md:justify-start w-full md:w-auto justify-between">
				<div class="select-filter flex items-center md:w-auto">
					<label><?= $filter_by_text ?></label> <?= do_shortcode($product_filter_sort_shortcode) ?>
				</div>
				<div class="lg:hidden">
					<div class="button-filter-product flex items-center gap-2 font-bold btn btn-primary solid whitespace-nowrap ">
						<i class="fa-regular fa-filter"></i>
						<span><?= $filter_text ?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="wrap-product-list">
			<div class="row">
				<div class="col lg:w-3/12">
					<div class="list-filter-product loading">
						<div class="filter-title text-[24px] font-semibold desktop-hidden"><?= $product_filter_title_text ?></div>
						<?php dynamic_sidebar('sidebar-product'); ?>
					</div>
				</div>
				<div class="col lg:w-9/12 ">
					<div class="facetwp-template">
						<?php if (woocommerce_product_loop()) : ?>
							<?php
							do_action('woocommerce_before_shop_loop');
							woocommerce_product_loop_start();
							if (wc_get_loop_prop('total')) {
								while (have_posts()) {
									the_post();
									/**
									 * Hook: woocommerce_shop_loop.
									 */
									do_action('woocommerce_shop_loop');
									wc_get_template_part('content', 'product');
								}
							}
							woocommerce_product_loop_end();
							do_action('woocommerce_after_shop_loop');
							?>
						<?php else: ?>
							<?php
							do_action('woocommerce_no_products_found');
							?>
						<?php endif; ?>
					</div>
					<?php echo do_shortcode($pagination_product_shortcode); ?>
					<?php do_action('woocommerce_after_main_content'); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
get_footer('shop');
?>