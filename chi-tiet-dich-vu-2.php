<?php
/*
Template Name: Chi tiết Dịch vụ 2
*/
?>
<?php get_header(); ?>
<main id="main">
    <?php while (have_posts()) : the_post();setPostViews($post->ID); ?>
    <div id="zek_service_detail_page">
        <?php $rows=get_field( 'banner'); if($rows) ?>
        <?php { ?>
        <?php foreach($rows as $row) {$sub = $row['sub'];$title = $row['title']; ?>
        <div class="zek_service_detail_banner">
            <div class="container-fluid">
                <div class="banner <?php if( get_field('onoff_form') == 1 ) { ?>form_layout<?php } ?> zek_background" style="background-image: url(<?php echo  $row['bg'] ?>);">
                    <div class="zek_block ">
                        <div class="flex">
                            <div class="img">
                                <img src="<?php echo  $row['img'] ?>" alt="">
                            </div>
                            <div class="inner">
                                <div class="box">
                                    <div class="bread"><?php echo  $row['breadcrum'] ?></div>
                                    <h1 class="title"><?php if ($title):?><?php echo $title ?><?php else : ?><?php the_title(); ?><?php endif;?></h1>
                                    <div class="divider"></div>
                                    <?php if ($sub):?>
                                    <div class="sub"><?php echo $sub ?></div>
                                    <?php endif;?>
                                    <p class="text"><?php echo  $row['text'] ?></p>
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
        <div class="form_banner_detail">
            <?php echo do_shortcode('[ninja_form id=1]'); ?>
        </div>
        <?php } ?>
        <?php } ?>
        <div class="zek_service_detail_body">
            <?php $chas = get_field('sec1');
            if($chas) { ?>
            <?php foreach ($chas as $cha) { ?>
            <div class="zek_service_detail_sec1">
                <div class="container">
                    <div class="zek_home_title">
                        <div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt=""></div>
                        <h2 class="title"><?php echo $cha['title'];  ?></h2>
                    </div>
                    <div class="content-post clearfix">
                        <?php echo $cha['content'];  ?>
                    </div>
                    <?php
                    if($cha['cta']) {
                    foreach ($cha['cta'] as $con) { ?>
                    <div class="zek_button text-center">
                        <a href="<?php echo $con['link']; ?>"><?php echo $con['text']; ?></a>
                    </div>
                    <?php } }?>
                </div>
            </div>
            <?php } }?>
            <?php $chas = get_field('section2');
            if($chas) { ?>
            <?php foreach ($chas as $cha) { ?>
            <div class="zek_service_detail_sec2">
                <div class="container-fluid">
                    <div class="zek_block">
                        <div class="container">
                            <div class="group4">
                                <div class="list">
                                    <?php
                                    if($cha['list']) {
                                    $x=0;foreach ($cha['list'] as $con) {$x++; ?>
                                    <div class="item">
                                        <div class="row row-margin flex-center">
                                            <div class="col-xl-6 col-lg-6 col-12">
                                                <?php if ($x==1) { ?><h2 class="title"><?php echo $cha['title'];  ?></h2><?php } ?>
                                                <div class="content-post clearfix">
                                                    <?php echo $con['content']; ?>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-12">
                                                <div class="img">
                                                    <img src="<?php echo $con['img']; ?>" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } }?>
            <?php $chas = get_field('section3');
            if($chas) { ?>
            <?php foreach ($chas as $cha) { ?>
            <div class="zek_service_detail_sec3">
                <div class="container">
                    <div class="zek_home_title">
                        <div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt=""></div>
                        <h2 class="title"><?php echo $cha['title'];  ?></h2>
                    </div>
                    <div class="zek_slider">
                        <div class="swiper mySwiper_service">
                            <div class="swiper-wrapper">
                                <?php
                                if($cha['list']) {
                                foreach ($cha['list'] as $con) { ?>
                                <div class="swiper-slide">
                                    <div class="item text-center zek_position">
                                        <a href="<?php echo $con['link']; ?>" class="zek_linkfull"></a>
                                        <div class="img">
                                            <img src="<?php echo $con['img']; ?>" alt="">
                                        </div>
                                        <h3 class="name"><?php echo $con['name']; ?></h3>
                                    </div>
                                </div>
                                <?php } }?>
                            </div>
                        </div>
                    </div>
                    <div class="zek_button text-center">
                        <a href="<?php echo $cha['link'];  ?>">Tìm hiểu thêm các dịch vụ khác</a>
                    </div>
                </div>
            </div>
            <?php } }?>
        </div>
        <?php if( have_rows('flash_sale','option') ): ?>
        <?php while( have_rows('flash_sale','option') ) : the_row();?>
        <div class="zek_flashsale">
            <div class="container-fluid">
                <div class="zek_block zek_position">
                    <div class="img zek_position">
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
        <?php endwhile;?>
        <?php endif;?>
    </div>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>