<?php
/*
Template Name: Chi tiết Tổ chức
*/
?>
<?php get_header(); ?>
<main id="main">
    <?php while (have_posts()) : the_post();setPostViews($post->ID); ?>
    <div id="zek_organi_detail">
        <?php if( have_rows('banner') ): ?>
        <?php while( have_rows('banner') ) : the_row();?>
        <div class="zek_organi_detail_banner">
            <div class="container-fluid">
                <div class="zek_block zek_background zek_position" style="background-image: url(<?php the_sub_field('bg'); ?>);">
                    <div class="overlay"></div>
                    <div class="inner text-center">
                        <h1 class="title"><?php the_sub_field('title'); ?></h1>
                        <p class="text"><?php the_sub_field('text'); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile;?>
        <?php endif;?>
        <?php $chas = get_field('group_section');
        if($chas) { ?>
        <div class="zek_organi_detail_body">
            <div class="container">
                <?php foreach ($chas as $cha) { ?>
                <div class="zek_block">
                    <div class="row row-margin">
                        <div class="col-xl-5 col-lg-5 col-12">
                            <?php
                            if($cha['group1']) {
                            foreach ($cha['group1'] as $con) { ?>
                            <div class="inner_left">
                                <div class="sub"><?php echo $con['sub']; ?></div>
                                <h2 class="title"><?php echo $con['title']; ?></h2>
                                <p class="text"><?php echo $con['text']; ?></p>
                                <div class="zek_button">
                                    <a href="<?php echo $con['link']; ?>">Tìm hiểu thêm</a>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                        <div class="col-xl-7 col-lg-7 col-12">
                            <?php
                            if($cha['group2']) {
                            foreach ($cha['group2'] as $con) { ?>
                            <div class="inner_right">
                                <div class="img">
                                    <div class="zek_background" style="background-image: url(<?php echo $con['img']; ?>);"></div>
                                </div>
                                <div class="box">
                                    <p class="text"><?php echo $con['text']; ?></p>
                                    <div class="info">
                                        <div class="name"><?php echo $con['name']; ?></div>
                                        <div class="sub"><?php echo $con['sub']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        <?php $chas = get_field('bottom_section');
        if($chas) { ?>
        <?php foreach ($chas as $cha) { ?>
        <div class="zek_organi_detail_bottom zek_position">
            <div class="zek_background" style="background-image: url(<?php echo $cha['bg'];  ?>);"></div>
            <div class="zek_overlay"></div>
            <div class="container-fluid">
                <div class="zek_block">
                    <div class="inner_left">
                        <div class="inner">
                            <h2 class="title"><?php echo $cha['title'];  ?></h2>
                            <p class="text"><?php echo $cha['text'];  ?></p>
                            <div class="form">
                                <?php echo do_shortcode('[ninja_form id=3]'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="inner_right">
                        <div class="inner">
                            <h3 class="capt"><?php echo $cha['capt'];  ?></h3>
                            <?php
                            if($cha['cta']) {
                            foreach ($cha['cta'] as $con) { ?>
                            <div class="zek_button">
                                <a href="<?php echo $con['link']; ?>"><?php echo $con['text']; ?></a>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } } ?>
    </div>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>