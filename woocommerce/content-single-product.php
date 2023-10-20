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
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */
defined('ABSPATH') || exit;
global $product;
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */

do_action('woocommerce_before_single_product');
if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
    <div class="zek_service_detail_banner">
        <div class="container-fluid">
            <div class="banner zek_background <?php if (get_field('onoff_form') == 1) { ?>form_layout<?php } ?>" style="background-image: url(https://revica.org/wp-content/uploads/2023/05/82722f826d982fdb10fb4f5e55d477cb-1-scaled.jpg);">
                <div class="zek_block">
                    <div class="flex">
                        <div class="img image-product">
                            <?php
                            /**
                             * Hook: woocommerce_before_single_product_summary.
                             *
                             * @hooked woocommerce_show_product_sale_flash - 10
                             * @hooked woocommerce_show_product_images - 20
                             */
                            do_action('woocommerce_before_single_product_summary');
                            ?>
                        </div>
                        <div class="inner">
                            <div class="box">
                                <?php get_template_part('breadcrums'); ?>
                                <h1 class="product_title title"><?php if (get_field('title2')) : ?><?php the_field('title2'); ?><?php else : ?><?php the_title(); ?><?php endif; ?></h1>
                                <div class="divider"></div>
                                <?php
                                /**
                                 * Hook: woocommerce_single_product_summary.
                                 *
                                 * @hooked woocommerce_template_single_title - 5
                                 * @hooked woocommerce_template_single_rating - 10
                                 * @hooked woocommerce_template_single_price - 10
                                 * @hooked woocommerce_template_single_excerpt - 20
                                 * @hooked woocommerce_template_single_add_to_cart - 30
                                 * @hooked woocommerce_template_single_meta - 40
                                 * @hooked woocommerce_template_single_sharing - 50
                                 * @hooked WC_Structured_Data::generate_product_data() - 60
                                 */
                                do_action('woocommerce_single_product_summary');
                                ?>
                            </div>
                        </div>
                        <div class="form">
                            <?php echo do_shortcode('[ninja_form id=1]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="zek_service_detail_body">
        <?php $chas = get_field('top_layout');
        if ($chas) { ?>
            <?php foreach ($chas as $cha) {
                $layout_center = $cha['layout_center']; ?>
                <div class="zek_service_detail_sec1">
                    <div class="container">
                        <div class="zek_home_title">
                            <div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt=""></div>
                            <h2 class="title"><?php echo $cha['title'];  ?></h2>
                        </div>
                        <?php if ($layout_center == 2) : ?>
                            <div class="inner_full">
                                <div class="content-post clearfix text-center">
                                    <?php echo $cha['content'];  ?>
                                </div>
                                <div class="image text-center">
                                    <img src="<?php echo $cha['img'];  ?>" alt="">
                                </div>
                                <?php
                                if ($cha['cta']) {
                                    foreach ($cha['cta'] as $con) { ?>
                                        <div class="zek_button text-center">
                                            <a href="<?php echo $con['link']; ?>"><?php echo $con['text']; ?></a>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        <?php else : ?>
                            <div class="flex flex-center">
                                <div class="img">
                                    <img src="<?php echo $cha['img'];  ?>" alt="">
                                </div>
                                <div class="inner">
                                    <div class="content-post clearfix">
                                        <?php echo $cha['content'];  ?>
                                    </div>
                                    <?php
                                    if ($cha['cta']) {
                                        foreach ($cha['cta'] as $con) { ?>
                                            <div class="zek_button">
                                                <a href="<?php echo $con['link']; ?>"><?php echo $con['text']; ?></a>
                                            </div>
                                    <?php }
                                    } ?>
                                </div>
                            </div>

                        <?php endif; ?>
                    </div>
                </div>
        <?php }
        } ?>
        <?php $chas = get_field('content_layout');
        if ($chas) { ?>
            <?php foreach ($chas as $cha) {
                $layout = $cha['layout']; ?>
                <div class="zek_service_detail_sec2">
                    <div class="container-fluid">
                        <div class="zek_block">
                            <div class="container">
                                <?php if ($layout == 3) : ?>
                                    <div class="box_group3">
                                        <?php
                                        if ($cha['group13']) {
                                            foreach ($cha['group13'] as $con) { ?>
                                                <div class="group4">
                                                    <div class="list">
                                                        <?php
                                                        if ($con['list']) {
                                                            $x = 0;
                                                            foreach ($con['list'] as $con2) {
                                                                $x++; ?>
                                                                <div class="item">
                                                                    <div class="row row-margin flex-center">
                                                                        <div class="col-xl-6 col-lg-6 col-12">
                                                                            <?php if ($x == 1) { ?><h2 class="title"><?php echo $con['title'];  ?></h2><?php } ?>
                                                                            <div class="content-post clearfix">
                                                                                <?php echo $con2['content']; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12">
                                                                            <div class="img">
                                                                                <img src="<?php echo $con2['img']; ?>" alt="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        <?php }
                                                        } ?>
                                                    </div>
                                                </div>
                                        <?php }
                                        } ?>
                                    </div>
                                <?php elseif ($layout == 2) : ?>
                                    <div class="box_group2">
                                        <?php
                                        if ($cha['group12']) {
                                            foreach ($cha['group12'] as $con) { ?>
                                                <div class="group4">
                                                    <div class="list">
                                                        <?php
                                                        if ($con['list']) {
                                                            $x = 0;
                                                            foreach ($con['list'] as $con2) {
                                                                $x++; ?>
                                                                <div class="item">
                                                                    <div class="row row-margin flex-center">
                                                                        <div class="col-xl-6 col-lg-6 col-12">
                                                                            <?php if ($x == 1) { ?><h3 class="title"><?php echo $con['title'];  ?></h3><?php } ?>
                                                                            <div class="content-post clearfix">
                                                                                <?php echo $con2['content']; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12">
                                                                            <div class="img not_border">
                                                                                <img src="<?php echo $con2['img']; ?>" alt="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        <?php }
                                                        } ?>
                                                    </div>
                                                </div>
                                        <?php }
                                        } ?>
                                        <?php
                                        if ($cha['group22']) {
                                            foreach ($cha['group22'] as $con) { ?>
                                                <div class="group2">
                                                    <h2 class="title"><?php echo $con['title']; ?></h2>
                                                    <div class="flex">
                                                        <?php
                                                        if ($con['list']) {
                                                            foreach ($con['list'] as $con2) { ?>
                                                                <div class="inner">
                                                                    <div class="content-post clearfix">
                                                                        <?php echo $con2['content']; ?>
                                                                    </div>
                                                                </div>
                                                        <?php }
                                                        } ?>
                                                    </div>
                                                </div>
                                        <?php }
                                        } ?>
                                        <?php
                                        if ($cha['group32']) { ?>
                                            <div class="group3">

                                                <div class="hidden_gr">
                                                    <?php foreach ($cha['group32'] as $con) { ?>
                                                        <div class="block">
                                                            <h2 class="title"><?php echo $con['title']; ?></h2>
                                                            <div class="content-post clearfix">
                                                                <?php echo $con['content']; ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="zek_button text-center">
                                                    <a href="" class="button_click"><span class="lv1">Tìm hiểu thêm</span><span class="lv2">Thu gọn</span></a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php else : ?>
                                    <div class="box_group1">
                                        <?php
                                        if ($cha['group11']) {
                                            foreach ($cha['group11'] as $con) { ?>
                                                <div class="group4">
                                                    <div class="list">
                                                        <?php
                                                        if ($con['list']) {
                                                            $x = 0;
                                                            foreach ($con['list'] as $con2) {
                                                                $x++; ?>
                                                                <div class="item">
                                                                    <div class="row row-margin flex-center">
                                                                        <div class="col-xl-6 col-lg-6 col-12">
                                                                            <?php if ($x == 1) { ?><h3 class="title"><?php echo $con['title'];  ?></h3><?php } ?>
                                                                            <div class="content-post clearfix">
                                                                                <?php echo $con2['content']; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-6 col-12">
                                                                            <div class="img not_border">
                                                                                <img src="<?php echo $con2['img']; ?>" alt="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        <?php }
                                                        } ?>
                                                    </div>
                                                </div>
                                        <?php }
                                        } ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
        <?php if (get_field('onoff_form2') == 1) { ?>
            <?php $chas = get_field('section4', 'option');
            if ($chas) { ?>
                <?php foreach ($chas as $cha) { ?>
                    <div class="zek_home_sec4 zek_position">
                        <div class="background"></div>
                        <div class="container">
                            <div class="row row-margin flex-center">
                                <div class="col-xl-6 col-lg-6 col-md-7 col-12">
                                    <div class="inner">
                                        <h2 class="title"><?php echo $cha['title'];  ?></h2>
                                        <ul class="list">
                                            <?php
                                            if ($cha['list']) {
                                                foreach ($cha['list'] as $con) { ?>
                                                    <li><?php echo $con['text']; ?></li>
                                            <?php }
                                            } ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-5 col-12">
                                    <div class="form">
                                        <?php echo do_shortcode('[ninja_form id=1]'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        <?php } ?>
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
    </div>
    <?php if (have_rows('flash_sale', 'option')) : ?>
        <?php while (have_rows('flash_sale', 'option')) : the_row(); ?>
            <div class="zek_flashsale">
                <div class="container-fluid">
                    <div class="zek_block zek_position">
                        <div class="img zek_position">
                            <div class="dot dot1"></div>
                            <div class="dot dot2"></div>
                            <img src="<?php the_sub_field('img'); ?>" alt="">
                        </div>
                        <div class="inner zek_position">
                            <div class="zek_background" style="background-image: url(<?php the_sub_field('bg'); ?>);"></div>
                            <div class="box">
                                <h2 class="title"><?php the_sub_field('title'); ?></h2>
                                <p class="text"><?php the_sub_field('text'); ?></p>
                                <div class="flashsale">
                                    <?php the_sub_field('coutdown'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>

</div>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/qty.js"></script>
<?php do_action('woocommerce_after_single_product'); ?>