<?php
/**
 * Template Name: Home Page
 */
get_header(); ?>

<main>
    <!-- Section 1: Hero Slider -->
    <section class="home-1 relative">
        <div class="home-1-slide relative">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php if (have_rows('home_1_slider')): ?>
                        <?php while (have_rows('home_1_slider')): the_row();
                            $type = get_sub_field('type');
                            $video = get_sub_field('video');
                            $image = get_sub_field('image');
                            $title_1 = get_sub_field('title_1');
                            $title_2 = get_sub_field('title_2');
                            $sub_title = get_sub_field('sub_title');
                            $button = get_sub_field('button');
                            ?>
                            <div class="swiper-slide">
                                <a class="play-icon" href="#"> <i class="fa-light fa-pause"></i></a>
                                <div class="home-1-banner relative">
                                    <a class="rem:h-[920px] block lozad" href="<?php echo $button ? esc_url($button['url']) : '#'; ?>">
                                        <?php if ($type == 'video' && $video): ?>
                                            <video class="w-full h-full object-cover" src="<?php echo esc_url($video); ?>" autoplay muted playsinline loop></video>
                                        <?php elseif ($image): ?>
                                            <img class="lozad object-cover w-full h-full" data-src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
                                        <?php endif; ?>
                                    </a>
                                    <div class="home-1-content">
                                        <div class="container-fluid">
                                            <div class="content-left">
                                                <div class="wrap-title">
                                                    <h2 class="title-1"><?php echo esc_html($title_1); ?></h2>
                                                    <div class="line"> </div>
                                                    <h2 class="title-2"><?php echo esc_html($title_2); ?></h2>
                                                </div>
                                                <h3 class="sub-title body-5 font-normal"><?php echo esc_html($sub_title); ?></h3>
                                                <?php if ($button): ?>
                                                    <div class="wrap-button mt-base">
                                                        <a class="btn btn-secondary" href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_attr($button['target'] ?: '_self'); ?>">
                                                            <span><?php echo esc_html($button['title']); ?></span>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="wrap-pagination">
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Section 2: Core Values -->
    <section class="home-2 relative section-py !pb-0">
        <div class="container-160">
            <div class="wrapper grid lg:grid-cols-4 grid-cols-2 gap-base">
                <?php if (have_rows('home_2_items')): ?>
                    <?php while (have_rows('home_2_items')): the_row();
                        $icon = get_sub_field('icon');
                        $title = get_sub_field('title');
                        ?>
                        <div class="item flex items-center justify-center flex-col">
                            <div class="icon mb-6 rem:w-[92px] rem:h-[92px] inline-flex items-center justify-center">
                                <?php if ($icon): ?>
                                    <img class="img-svg w-full h-full" src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($title); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="content text-center">
                                <div class="title heading-5 font-medium font-secondary text-Utility-Black"><?php echo esc_html($title); ?></div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="wrapper-content text-center xl:my-20 my-10 rem:max-w-[960px] mx-auto">
                <h2 class="title heading-1 block-title font-semibold font-secondary text-Utility-Black"><?php echo esc_html(get_field('home_2_main_title') ?: 'Lối sống, được chọn lọc.'); ?></h2>
                <div class="desc mt-6 body-1 font-normal">
                    <?php echo wp_kses_post(get_field('home_2_main_desc')); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Highlight Sections -->
    <section class="home-3 section-py !pt-0">
        <div class="container-fluid">
            <h2 class="title heading-1 block-title font-semibold font-secondary text-Utility-Black text-center xl:mb-20 mb-base">
                <?php echo esc_html(get_field('home_3_main_title') ?: 'NOTICE YOUR NEEDS'); ?>
            </h2>
            <div class="wrapper-main">
                <?php if (have_rows('home_3_sections')): ?>
                    <?php while (have_rows('home_3_sections')): the_row();
                        $image = get_sub_field('image');
                        $title = get_sub_field('title');
                        $desc = get_sub_field('description');
                        $prod_img = get_sub_field('product_image');
                        $button = get_sub_field('button');
                        ?>
                        <div class="wrapper-inner flex md:even:flex-row-reverse md:flex-row flex-col">
                            <div class="col-left md:w-1/2 w-full" data-aos="fade-right" data-aos-delay="100" data-aos-duration="800">
                                <div class="img">
                                    <div class="img-ratio ratio:pt-[850_800] zoom-img">
                                        <?php if ($image): ?>
                                            <img class="lozad" data-src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-right md:w-1/2 w-full" data-aos="fade-left" data-aos-delay="200" data-aos-duration="800">
                                <div class="wrap-content-top text-center xl:mb-16 mb-base">
                                    <h3 class="title heading-2 font-medium font-secondary mb-4"><?php echo esc_html($title); ?></h3>
                                    <div class="desc body-1 font-normal">
                                        <p><?php echo esc_html($desc); ?></p>
                                    </div>
                                </div>
                                <div class="wrap-content-bottom">
                                    <div class="product text-center">
                                        <div class="img">
                                            <div class="img-ratio ratio:pt-[408_336] zoom-img">
                                                <?php if ($prod_img): ?>
                                                    <img class="lozad" data-src="<?php echo esc_url($prod_img['url']); ?>" alt="<?php echo esc_attr($prod_img['alt']); ?>"/>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php if ($button): ?>
                                            <div class="button-more xl:mt-16 mt-base">
                                                <a class="btn btn-primary" href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_attr($button['target'] ?: '_self'); ?>">
                                                    <span><?php echo esc_html($button['title']); ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Section 4: Testimonials -->
    <section class="home-4 section-py bg-Utility-50">
        <div class="container">
            <h2 class="title block-title font-secondary heading-1 font-semibold text-center mb-base"><?php echo esc_html(get_field('home_4_title') ?: 'Những cảm nhận từ cộng đồng NYN'); ?></h2>
            <div class="swiper-column-auto relative">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php if (have_rows('home_4_testimonials')): ?>
                            <?php while (have_rows('home_4_testimonials')): the_row();
                                $icon = get_sub_field('icon');
                                $content = get_sub_field('content');
                                $avatar = get_sub_field('avatar');
                                $info = get_sub_field('info');
                                ?>
                                <div class="swiper-slide">
                                    <div class="item xl:p-6 p-4 shadow-shadow-4 bpd-1">
                                        <div class="content-top">
                                            <div class="icon mb-2">
                                                <?php if ($icon): ?>
                                                    <img class="img-svg w-full h-full" src="<?php echo esc_url($icon); ?>" alt="icon">
                                                <?php else: ?>
                                                    <img class="img-svg w-full h-full" src="<?php echo get_template_directory_uri(); ?>/template-woocommerce/img/icon-2.svg" alt="">
                                                <?php endif; ?>
                                            </div>
                                            <div class="desc body-1 font-normal xl:rem:min-h-[232px] h-full">
                                                <p><?php echo esc_html($content); ?></p>
                                            </div>
                                        </div>
                                        <div class="content-bottom xl:mt-12 mt-base pt-4 border-t border-t-Utility-100 flex items-center gap-4">
                                            <div class="avatar rem:h-[43px] rem:w-[43px]">
                                                <div class="img-avatar img-ratio rounded-full">
                                                    <?php if ($avatar): ?>
                                                        <img class="lozad" data-src="<?php echo esc_url($avatar['url']); ?>" alt="<?php echo esc_attr($avatar['alt']); ?>"/>
                                                    <?php else: ?>
                                                        <img class="lozad" data-src="<?php echo get_template_directory_uri(); ?>/template-woocommerce/img/1.jpg" alt=""/>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="info body-1 font-normal"><?php echo esc_html($info); ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Selected Products -->
    <section class="home-5 section-py">
        <div class="container">
            <h2 class="title block-title font-secondary heading-1 font-semibold text-center mb-base"><?php echo esc_html(get_field('home_5_title') ?: 'Sản phẩm được chọn lọc'); ?></h2>
            <div class="swiper-column-auto relative">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php 
                        $selected_products = get_field('home_5_products');
                        if ($selected_products): 
                            $count = 0;
                            foreach ($selected_products as $post):
                                setup_postdata($post);
                                global $product;
                                // Pass delay to template via a temporary global or global variable
                                $GLOBALS['nyn_aos_delay'] = ($count % 4) * 100;
                                ?>
                                <div class="swiper-slide">
                                    <?php wc_get_template_part('content', 'product'); ?>
                                </div>
                                <?php
                                $count++;
                            endforeach;
                            wp_reset_postdata();
                            unset($GLOBALS['nyn_aos_delay']);
                        endif; ?>
                    </div>
                </div>
            </div>
            <div class="sub-title mt-base pt-4 border-t border-t-Utility-100 text-center body-1 font-normal" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                <p><?php echo esc_html(get_field('home_5_bottom_text') ?: 'Sản phẩm được phát triển theo tiêu chuẩn rõ ràng · Thông tin minh bạch · Giá trị được tạo nên từ chất lượng'); ?></p>
            </div>
        </div>
    </section>

    <!-- Section 6: Commitments -->
    <section class="home-6 section-py !pt-0">
        <div class="container">
            <h2 class="title block-title font-secondary heading-1 font-semibold text-center mb-base"><?php echo esc_html(get_field('home_6_title') ?: 'Cam kết từ NYN'); ?></h2>
            <div class="wrapper-list grid lg:grid-cols-4 grid-cols-2 gap-6">
                <?php if (have_rows('home_6_items')): ?>
                    <?php $delay = 0; while (have_rows('home_6_items')): the_row();
                        $icon = get_sub_field('icon');
                        $title = get_sub_field('title');
                        ?>
                        <div class="item flex items-center justify-center flex-col text-center" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>" data-aos-duration="1000">
                            <div class="icon sq-16 inline-flex items-center justify-center">
                                <?php if ($icon): ?>
                                    <img class="img-svg w-full h-full" src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($title); ?>">
                                <?php else: ?>
                                    <img class="img-svg w-full h-full" src="<?php echo get_template_directory_uri(); ?>/template-woocommerce/img/icon.svg" alt="">
                                <?php endif; ?>
                            </div>
                            <div class="content mt-8 xl:px-12">
                                <div class="title heading-5 font-medium font-secondary"><?php echo esc_html($title); ?></div>
                            </div>
                        </div>
                    <?php $delay += 100; endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Section 7: Connect -->
    <section class="home-7 overflow-hidden">
        <div class="wrapper grid md:grid-cols-2 grid-cols-1">
            <div class="col-left item-slide-left" data-aos="fade-right" data-aos-delay="100" data-aos-duration="800">
                <div class="img">
                    <?php $h7_img = get_field('home_7_image'); ?>
                    <?php if ($h7_img): ?>
                        <div class="img-ratio ratio:pt-[670_960]">
                            <img class="lozad" data-src="<?php echo esc_url($h7_img['url']); ?>" alt="<?php echo esc_attr($h7_img['alt']); ?>"/>
                        </div>
                    <?php else: ?>
                        <div class="img-ratio ratio:pt-[670_960]">
                           <img class="lozad" data-src="<?php echo get_template_directory_uri(); ?>/template-woocommerce/img/1.jpg" alt=""/>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-right bg-[#383838] section-py xl:pl-20 xl:rem:pr-[260px] px-5 text-white" data-aos="fade-left" data-aos-delay="200" data-aos-duration="800">
                <div class="content">
                    <div class="content-top">
                        <div class="wrap-heading mb-8">
                            <h3 class="title heading-2 font-medium font-secondary mb-2"><?php echo esc_html(get_field('home_7_heading') ?: 'Kết nối cùng NYN'); ?></h3>
                            <div class="desc body-1 font-normal text-white/50">
                                <p><?php echo esc_html(get_field('home_7_desc')); ?></p>
                            </div>
                        </div>
                        <div class="wrap-bottom mt-8">
                            <div class="title heading-5 font-medium font-secondary"><?php echo esc_html(get_field('home_7_quote') ?: 'NYN tin vào sự kết nối – không đại trà, mà có chọn lọc.'); ?></div>
                        </div>
                    </div>
                    <div class="content-bottom xl:pt-16 xl:mt-16 mt-base border-t border-t-white/20">
                        <div class="wrap">
                            <h3 class="title heading-2 font-medium font-secondary mb-2"><?php echo esc_html(get_field('home_7_support_title') ?: 'Cần hỗ trợ thêm?'); ?></h3>
                            <div class="sub body-1 font-normal text-white/50"><?php echo esc_html(get_field('home_7_support_sub') ?: 'Team NYN luôn sẵn sàng lắng nghe và tư vấn.'); ?></div>
                        </div>
                        <div class="wrapper-contact mt-5 flex justify-between flex-wrap">
                            <?php if (have_rows('home_7_contacts')): ?>
                                <?php while (have_rows('home_7_contacts')): the_row();
                                    $label = get_sub_field('label');
                                    $type = get_sub_field('type');
                                    $icon = get_sub_field('icon');
                                    $link = get_sub_field('link');
                                    ?>
                                    <div class="item">
                                        <div class="label text-white/50 font-normal mb-2"><?php echo esc_html($label); ?></div>
                                        <div class="value body-2 font-bold">
                                            <?php if ($type == 'messenger'): ?>
                                                <div class="img sq-8">
                                                    <a class="img-ratio" href="<?php echo $link ? esc_url($link['url']) : '#'; ?>" target="<?php echo $link && $link['target'] ? esc_attr($link['target']) : '_blank'; ?>">
                                                        <img class="lozad" data-src="<?php echo $icon ?: get_template_directory_uri() . '/template-woocommerce/img/mess.svg'; ?>" alt=""/>
                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                <?php if ($link): ?>
                                                    <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"><?php echo esc_html($link['title']); ?></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
