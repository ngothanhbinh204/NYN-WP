<!DOCTYPE html>
<html <?= language_attributes() ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=6.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= get_template_directory_uri() ?>/styles/woocommerce.css">
  <?php wp_head(); ?>
  <?= get_field('field_config_head', 'options') ?>
</head>
<?php
// ===== VARIABLES SECTION =====
// User and authentication
$current_user = wp_get_current_user();
$is_user_logged_in = is_user_logged_in();

// URLs
$template_directory = get_template_directory_uri();
$cart_url = wc_get_cart_url();
$myaccount_url = get_permalink(get_option('woocommerce_myaccount_page_id'));
$login_page_url = get_page_link_by_template('template-woocommerce/page-login.php');

// Logo
$custom_logo_id = get_theme_mod('custom_logo');
$logo_image = wp_get_attachment_image_src($custom_logo_id, 'full');

// Cart and checkout
$is_checkout = is_checkout() || is_cart();
$cart_items_count = WC()->cart->get_cart_contents_count();
$cart_count_display = $cart_items_count ? $cart_items_count : 0;

// Site info
$site_name = get_bloginfo('name');
?>
<body <?php body_class(get_field('add_class_body', get_the_ID())) ?>>
<header class="header">
    <!--Header Logo-->
    <div class="header-logo h-full flex place-content-center">
        <a href="<?= home_url() ?>" class="">
            <img src="<?= $logo_image[0]; ?>" alt="<?= $site_name ?>">
        </a>
    </div>
    <!--Header Search-->
    <div class="header-search header-search-form">
        <div class="wrap-form-search-result">
            <form class="search-form searchform" action="<?= bloginfo('url') ?>/" method="GET" role="form">
                <div class="wrap-form">
                    <input type="text" class="w-full" placeholder="<?= _e('Tìm kiếm sản phẩm...', 'canhcamtheme') ?>" name="s"
                           class="form-control">
                    <button type="submit" class="flex items-center justify-center" aria-label="<?= _e('Tìm kiếm', 'canhcamtheme') ?>">
                        <img src="<?= $template_directory ?>/img/search.svg" alt="">
                    </button>
                </div>
            </form>
            <div class="header-search-suggest">
            </div>
        </div>
    </div>
    <!--  Header Cart  -->
  <?php if ($is_checkout) : ?>
    <a class="header-cart header-button disabled" href="<?= $cart_url ?>">
        <img src="<?= $template_directory ?>/img/cart.svg" alt="">
        <p><span class="text-cart"><?= _e('Giỏ hàng', 'canhcamtheme') ?> </span>
            <span class="count-cart">(<?= $cart_count_display ?>)</span></p>
    </a>
  <?php else : ?>
    <div class="header-cart header-button"><img src="<?= $template_directory ?>/img/cart.svg" alt="">
        <p>
            <span class="text-cart"><?= _e('Giỏ hàng', 'canhcamtheme') ?> </span>
            <span class="count-cart">(<?= $cart_count_display ?>)</span></p>
    </div>
  <?php endif; ?>
    <!--  Header Login -->
  <?php if ($is_user_logged_in) : ?>
    <a class="header-login header-button" href="<?= esc_url($myaccount_url) ?>">
        <i class="fa-light fa-user"></i>
        <span><?= esc_html($current_user->display_name) ? $current_user->display_name : _e('Tài khoản', 'canhcamtheme'); ?></span>
    </a>
  <?php else : ?>
    <a class="header-login header-button" href="<?= $login_page_url ?>">
        <img src="<?= $template_directory ?>/img/right-to-bracket.svg" alt="">
        <span><?= _e('Đăng nhập', 'canhcamtheme'); ?></span><span>/</span><span><?= _e('Đăng ký', 'canhcamtheme') ?></span>
    </a>
  <?php endif; ?>
    <!--Header Menu-->
    <?php wp_nav_menu([
        "theme_location" => "header-menu",
        "container" => "false",
        "menu_id" => "header-menu",
    ]); ?>
</header>
<div class="mini-cart-wrapper">
    <div class="top-mini-cart">
        <p><?= _e('Giỏ hàng', 'canhcamtheme') ?></p>
        <button class="close" aria-label="<?= _e('Đóng', 'canhcamtheme') ?>"><i class="fa-light fa-xmark"></i></button>
    </div>
    <div class="wrap-mini-cart widget_shopping_cart_content">
      <?php woocommerce_mini_cart() ?>
    </div>
</div>
<div class="cart-overlay"></div>
<main>