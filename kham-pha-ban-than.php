<?php
/*
Template Name: Khám phá bản thân
*/
?>
<?php get_header(); ?>
<main id="main">
    <?php while (have_posts()) : the_post();setPostViews($post->ID); ?>
    <div id="zek_service_page">
        <?php $rows=get_field( 'banner'); if($rows) ?>
        <?php { ?>
        <?php $x=0;foreach($rows as $row) {$x++; ?>
        <div class="zek_service_banner">
            <div class="container-fluid">
                <div class="banner zek_background" style="background-image: url(<?php echo  $row['bg'] ?>);">
                    <div class="inner text-center">
                        <div class="box">
                            <h1 class="title"><?php echo  $row['title'] ?></h1>
                            <p class="text"><?php echo  $row['text'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="gallery">
                    <?php $images = $row['gallery'];?>
                    <div class="row row-margin">
                        <div class="col-left">
                            <div class="img"><img src="<?php echo $images[1]['url']; ?>" alt="<?php echo $image['alt']; ?>"></div>
                            <div class="img"><img src="<?php echo $images[2]['url']; ?>" alt="<?php echo $image['alt']; ?>"></div>
                        </div>
                        <div class="col-center">
                            <div class="img img_center"><img src="<?php echo $images[0]['url']; ?>" alt="<?php echo $image['alt']; ?>"></div>
                        </div>
                        <div class="col-right">
                            <div class="img"><img src="<?php echo $images[3]['url']; ?>" alt="<?php echo $image['alt']; ?>"></div>
                            <div class="img"><img src="<?php echo $images[4]['url']; ?>" alt="<?php echo $image['alt']; ?>"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
        <?php $chas = get_field('group_section');
        if($chas) { ?>
        
        <div class="zek_service_body">
            <div class="container">
                <?php foreach ($chas as $cha) {$text = $cha['text']; ?>
                <div class="zek_block zek_service_list">
                    <div class="zek_home_title">
                        <div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt=""></div>
                        <h2 class="title"><?php echo $cha['title'];  ?></h2>
                        <?php if ($text):?>
                        <p class="text"><?php echo $text ?></p>
                        <?php endif;?>
                    </div>
                    <div class="row row-margin">
                        <?php
                        if($cha['list']) {
                        foreach ($cha['list'] as $con) {$sub = $con['sub']; ?>
                        <div class="col-item col-xl-4 col-lg-4 col-md-6 col-12">
                            <div class="zek_item_service">
                                <div class="image">
                                    <img src="<?php echo $con['img']; ?>" alt="">
                                </div>
                                <div class="info">
                                    <h3 class="name text-center"><?php echo $con['name']; ?><?php if ($sub):?><br><span class="sub">(<?php echo $sub ?>)</span><?php endif;?></h3>
                                    <div class="text"><?php echo $con['text']; ?></div>
                                    <div class="zek_button text-center">
                                        <a href="<?php echo $con['link']; ?>">Tìm hiểu thêm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
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
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>