<?php
/*
Template Name: Giới thiệu
*/
?>
<?php get_header(); ?>
<main id="main">
    <div id="zek_about_page">
        <div class="zek_about_banner">
            <div class="container-fluid">
                <div class="img">
                    <img src="<?php the_field('banner'); ?>" alt="">
                </div>
            </div>
        </div>
        <?php if( have_rows('sec1') ): ?>
        <?php while( have_rows('sec1') ) : the_row();?>
        <div class="zek_about_sec1">
            <div class="container">
                <div class="zek_block">
                    <div class="zek_home_title">
                        <div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt=""></div>
                        <h1 class="title"><?php the_sub_field('title'); ?></h1>
                    </div>
                    <div class="content-post clearfix">
                        <?php the_sub_field('content'); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile;?>
        <?php endif;?>
        <?php $chas = get_field('sec2');
        if($chas) { ?>
        <?php foreach ($chas as $cha) { ?>
        <div class="zek_about_sec2 zek_position">
            <div class="zek_background" style="background-image: url(<?php echo $cha['bg'];  ?>);"></div>
            <div class="container">
                <h2 class="title"><?php echo $cha['title'];  ?></h2>
                <div class="row row-margin">
                    <?php
                    if($cha['list']) {
                    foreach ($cha['list'] as $con) { ?>
                    <div class="col-item col-xl-3 col-lg-3 col-md-6 col-6 col-item">
                        <div class="item text-center">
                            <div class="alphabet"><?php echo $con['sub']; ?></div>
                            <div class="icon"><img src="<?php echo $con['icon']; ?>" alt=""></div>
                            <h3 class="name"><?php echo $con['name']; ?></h3>
                            <div class="text"><?php echo $con['text']; ?></div>
                        </div>
                    </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
        <?php } } ?>
        <?php $chas = get_field('sec3');
        if($chas) { ?>
        <?php foreach ($chas as $cha) { ?>
        <div class="zek_about_sec3">
            <div class="container">
                <div class="flex">
                    <div class="image">
                        <img src="<?php echo $cha['img'];  ?>" alt="">
                    </div>
                    <div class="inner">
                        <?php
                        if($cha['group1']) {
                        foreach ($cha['group1'] as $con) { ?>
                        <div class="group_top">
                            <h2 class="title"><?php echo $con['name'];  ?></h2>
                            <p class="text"><?php echo $con['text'];  ?></p>
                        </div>
                        <?php } } ?>
                        <?php
                        if($cha['group2']) {
                        foreach ($cha['group2'] as $con) { ?>
                        <div class="group_bot">
                            <h2 class="title"><?php echo $con['name'];  ?></h2>
                            <ul class="list">
                                <?php
                                if($con['list']) {
                                foreach ($con['list'] as $con2) { ?>
                                <li><?php echo $con2['text'];  ?></li>
                                <?php } } ?>
                            </ul>
                        </div>
                        <?php } } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } } ?>
        <?php $chas = get_field('section4','option');
        if($chas) { ?>
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
                                if($cha['list']) {
                                foreach ($cha['list'] as $con) { ?>
                                <li><?php echo $con['text']; ?></li>
                                <?php } }?>
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
        <?php } }?>
    </div>
</main>
<?php get_footer(); ?>