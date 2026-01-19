<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans+Flex:opsz,wght@6..144,1..1000&amp;display=swap"
        rel="stylesheet">
    <!-- Core and Main CSS from HTML -->
    <!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/template-woocommerce/css/core.min.css"> -->
    <!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/template-woocommerce/css/main.min.css"> -->
    <!-- Existing WooCommerce CSS -->
    <!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/woocommerce.css"> -->
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="header">
        <div class="header-nav-top">
            <p><?php echo get_field('header_top_text', 'options') ?: 'Ưu đãi cuối năm – Áp dụng trong thời gian giới hạn'; ?></p>
        </div>
        <div class="container-fluid">
            <div class="header-wrapper">
                <div class="wrapper-mobile">
                    <div class="header-bar"><i class="fa-regular fa-bars"></i></div>
                    <div class="header-button-website">
                        <button class="btn btn-website"><span>Website DE </span>
                            <div class="icon"> <i class="fa-regular fa-chevron-right"></i></div>
                        </button>
                    </div>
                </div>
                <div class="header-left">
                    <div class="header-menu">
                        <div class="header-mobile-login md:hidden flex items-center gap-2 mt-5"> 
                            <a class="btn btn-primary" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">Đăng nhập</a>
                            <a class="btn btn-primary" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">Đăng ký</a>
                        </div>
                        <div class="header-button-website">
                            <button class="btn btn-website"><span>Website DE </span>
                                <div class="icon"> <i class="fa-regular fa-chevron-right"></i></div>
                            </button>
                        </div>
                        
                        <?php 
                        wp_nav_menu(array(
                            'theme_location' => 'header-menu',
                            'container'      => false,
                            'menu_class'     => 'header-nav',
                            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'walker'         => new Header_Menu_Walker(), // Use the clean walker
                        )); 
                        ?>
                        
                    </div>
                </div>
                <div class="header-logo">
                    <a href="<?php echo home_url(); ?>" alt="<?php bloginfo('name'); ?>"> 
                        <?php 
                        $logo_id = get_theme_mod( 'custom_logo' );
                        $logo = wp_get_attachment_image_src( $logo_id , 'full' );
                        if ( has_custom_logo() ) {
                            echo '<img class="logo-default" src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                            echo '<img class="logo-active" src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">'; // Assuming logic for active logo might differ, for now use same
                        } else {
                            // Fallback to static images if no custom logo, referencing template dir
                            echo '<img class="logo-default" src="' . get_template_directory_uri() . '/template-woocommerce/img/logo-white.png" alt="logo">';
                            echo '<img class="logo-active" src="' . get_template_directory_uri() . '/template-woocommerce/img/logo-black.png" alt="logo">';
                        }
                        ?>
                    </a>
                </div>
                <div class="header-right">
                    <div class="header-right-inner">
                        <div class="header-button-website">
                            <button class="btn btn-website"><span>Website DE </span>
                                <div class="icon"> <i class="fa-regular fa-chevron-right"></i></div>
                            </button>
                        </div>
                        <div class="header-auth">
                            <div class="header-cart"> 
                                <a href="<?php echo wc_get_cart_url(); ?>">
                                    <i class="fa-light fa-bag-shopping"></i>
                                    <?php if (WC()->cart->get_cart_contents_count() > 0) : ?>
                                        <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="header-user"> 
                                <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"><i class="fa-light fa-user"></i></a>
                            </div>
                            <div class="header-language">
                                <div class="header-language-active">
                                    <ul>
                                        <li class="wpml-ls-current-language"><a href="#"> <span class="wpml-ls-native">VN</span></a></li>
                                        <ul>
                                            <li> <a href="#"> <span>EN</span></a></li>
                                        </ul>
                                    </ul>
                                </div>
                                <!-- WPML logic would go here -->
                            </div>
                            <div class="header-search">
                                <i class="fa-light fa-magnifying-glass"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="header-overlay"></div>
    <div class="header-search-form">
        <div class="close flex items-center justify-center absolute top-0 right-0 bg-white text-3xl cursor-pointer w-12.5 h-12.5">
            <i class="fa-light fa-xmark"></i></div>
        <div class="container">
            <div class="wrap-form-search-product">
                <div class="productsearchbox">
                    <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Tìm kiếm thông tin', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" />
                        <button type="submit" class="search-submit"><i class="fa-light fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>