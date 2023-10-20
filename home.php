<?php
/*
 Template Name: Home
 */
 ?>
<?php get_header(); ?>
<main id="main">
    <?php $chas = get_field('banner','option');
    if($chas) { ?>
    <div class="zek_home_banner">
        <div class="container-fluid">
            <div class="swiper mySwiper_home_banner">
                <div class="swiper-wrapper">
                    <?php foreach ($chas as $cha) {$choise = $cha['choise']; ?>
                    <div class="swiper-slide">
                        <?php if ($choise==3):?>
                        <div class="item3 zek_background" style="background-image: url(<?php echo $cha['bg3'];  ?>);">
                            <div class="inner_left text-center">
                                <div class="title"><?php echo $cha['title3'];  ?></div>
                                <div class="list">
                                    <?php
                                    if($cha['list3']) {
                                    foreach ($cha['list3'] as $con) { ?>
                                    <div class="it zek_position">
                                        <a href="<?php echo $con['link'];  ?>" class="zek_linkfull"></a>
                                        <div class="icon"><img src="<?php echo $con['icon'];  ?>" alt="icon"></div>
                                        <div class="name"><?php echo $con['name'];  ?></div>
                                    </div>
                                    <?php } } ?>
                                </div>
                                <?php
                                if($cha['cta3']) {
                                foreach ($cha['cta3'] as $con) { ?>
                                <div class="zek_button">
                                    <a href="<?php echo $con['link'];  ?>"><?php echo $con['text'];  ?></a>
                                </div>
                                <?php } } ?>
                            </div>
                            <div class="inner_right">
                                <div class="box_img1">
                                    <div class="img"><img src="<?php echo $cha['img13'];  ?>" alt="img1"><img src="<?php bloginfo('template_url' ); ?>/images/baocao.png" alt="line1" class="line"></div>
                                </div>
                                <div class="box_img2">
                                    <div class="img"><img src="<?php echo $cha['img23'];  ?>" alt="img2"><img src="<?php bloginfo('template_url' ); ?>/images/revica.png" alt="line2" class="line"></div>
                                    <div class="rating"><i></i><?php echo $cha['rating3'];  ?></div>
                                </div>
                            </div>
                        </div>
                        <?php elseif ($choise==2): ?>
                        <div class="item2 zek_background zek_position" style="background-image: url(<?php echo $cha['bg2'];  ?>);">
                            <img src="<?php bloginfo('template_url' ); ?>/images/line_banner2.png" alt="" class="line_bn">
                            <div class="inner_left">
                                <div class="img"><img src="<?php echo $cha['img2'];  ?>" alt=""></div>
                                <img src="<?php bloginfo('template_url' ); ?>/images/line_img1.png" alt="line1" class="line_img1">
                                <img src="<?php bloginfo('template_url' ); ?>/images/line_img2.png" alt="line2" class="line_img2">
                                <img src="<?php bloginfo('template_url' ); ?>/images/line_img3.png" alt="line3" class="line_img3">
                                <img src="<?php bloginfo('template_url' ); ?>/images/line_plane1.png" alt="line4" class="line_img4">
                                <img src="<?php bloginfo('template_url' ); ?>/images/line_plane2.png" alt="line5" class="line_img5">
                            </div>
                            <div class="inner_right text-center">
                                <div class="title"><?php echo $cha['title2'];  ?></div>
                                <div class="sub"><?php echo $cha['sub_title2'];  ?></div>
                                <div class="price"><?php echo $cha['price2'];  ?></div>
                                <?php
                                if($cha['cta2']) {
                                foreach ($cha['cta2'] as $con) { ?>
                                <div class="zek_button">
                                    <a href="<?php echo $con['link'];  ?>"><?php echo $con['text'];  ?></a>
                                </div>
                                <?php } } ?>
                            </div>
                        </div>
                        <?php else : ?>
                        <div class="item zek_background" style="background-image: url(<?php echo $cha['bg'];  ?>);">
                            <div class="inner left">
                                <ul>
                                    <?php
                                    if($cha['left']) {
                                    foreach ($cha['left'] as $con) { ?>
                                    <li><?php echo $con['text']; ?></li>
                                    <?php } } ?>
                                </ul>
                            </div>
                            <div class=" center text-center">
                                <div class="img"><img src="<?php echo $cha['img'];  ?>" alt="img_center"></div>
                                <div class="bot">
                                    <div class="name"><?php echo $cha['title'];  ?></div>
                                    <?php
                                    if($cha['cta']) {
                                    foreach ($cha['cta'] as $con) { ?>
                                    <div class="zek_button">
                                        <a href="<?php echo $con['link'];  ?>"><?php echo $con['text'];  ?></a>
                                    </div>
                                    <?php } } ?>
                                </div>
                            </div>
                            <div class="inner right">
                                <ul>
                                    <?php
                                    if($cha['right']) {
                                    foreach ($cha['right'] as $con) { ?>
                                    <li><?php echo $con['text']; ?></li>
                                    <?php } } ?>
                                </ul>
                            </div>
                            <div class="inner inner_mb">
                                <ul>
                                    <?php
                                    if($cha['left']) {
                                    foreach ($cha['left'] as $con) { ?>
                                    <li><?php echo $con['text']; ?></li>
                                    <?php } } ?>
                                </ul>
                                <ul>
                                    <?php
                                    if($cha['right']) {
                                    foreach ($cha['right'] as $con) { ?>
                                    <li><?php echo $con['text']; ?></li>
                                    <?php } } ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                    <?php } ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php $chas = get_field('section1','option');
    if($chas) { ?>
    <?php foreach ($chas as $cha) { ?>
    <div class="zek_home_sec1">
        <div class="container">
            <div class="list flex">
                <?php
                if($cha['list']) {
                foreach ($cha['list'] as $con) { ?>
                <div class="item text-center">
                    <div class="icon"><img src="<?php echo $con['img']; ?>" alt="img_sec1"></div>
                    <h4 class="name"><?php echo $con['name']; ?></h4>
                    <p class="text"><?php echo $con['text']; ?></p>
                </div>
                <?php } }?>
            </div>
        </div>
    </div>
    <?php } }?>
    <?php $chas = get_field('section2','option');
    if($chas) { ?>
    <?php foreach ($chas as $cha) {$text = $cha['text']; ?>
    <div class="zek_home_sec2">
        <div class="container">
            <div class="zek_home_title">
                <div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt="icon star"></div>
                <h2 class="title"><?php echo $cha['title'];  ?></h2>
                <?php if ($text):?>
                <p class="text"><?php echo $text ?></p>
                <?php endif;?>
            </div>
            <div class="list flex">
                <?php
                if($cha['list']) {
                foreach ($cha['list'] as $con) { ?>
                <div class="item text-center">
                    <div class="box zek_position">
                        <a href="<?php echo $con['link']; ?>" class="zek_linkfull"></a>
                        <div class="icon"><img src="<?php echo $con['icon']; ?>" alt="icon"></div>
                        <h4 class="name"><?php echo $con['name']; ?></h4>
                        <p class="text"><?php echo $con['text']; ?></p>
                    </div>
                </div>
                <?php } }?>
            </div>
        </div>
    </div>
    <?php } }?>
    <?php $chas = get_field('section3','option');
    if($chas) { ?>
    <?php foreach ($chas as $cha) {$text = $cha['text']; ?>
    <div class="zek_home_sec3">
        <div class="container">
            <div class="zek_home_title">
                <div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt="icon star"></div>
                <h2 class="title"><?php echo $cha['title'];  ?></h2>
                <?php if ($text):?>
                <p class="text"><?php echo $text ?></p>
                <?php endif;?>
            </div>
            <div class="zek_block zek_position">
                <?php
                if($cha['group_left']) {
                foreach ($cha['group_left'] as $con) { ?>
                <div class="image">
                    <div class="img">
                        <img src="<?php echo $con['img']; ?>" alt="img sec3">
                    </div>
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="rating"><i></i><?php echo $con['rating']; ?></div>
                    <ul class="list">
                        <?php
                        if($con['list']) {
                        foreach ($con['list'] as $con2) { ?>
                        <li><a href="<?php echo $con2['link']; ?>"><img src="<?php echo $con2['icon']; ?>" alt="icon"></a></li>
                        <?php } }?>
                    </ul>
                </div>
                <?php } }?>
                <?php
                if($cha['group_right']) {
                foreach ($cha['group_right'] as $con) { ?>
                <div class="inner">
                    <div class="box">
                        <h3 class="title"><?php echo $con['name']; ?></h3>
                        <?php
                        if($con['price']) {
                        foreach ($con['price'] as $con2) { ?>
                        <div class="price">
                            <span><?php echo $con2['capt']; ?></span>
                            <del><?php echo $con2['old']; ?></del>
                            <ins><?php echo $con2['new']; ?></ins>
                        </div>
                        <?php } }?>
                        <ul class="list">
                            <?php
                            if($con['list']) {
                            foreach ($con['list'] as $con2) { ?>
                            <li><?php echo $con2['text']; ?></li>
                            <?php } }?>
                        </ul>
                        <?php
                        if($con['cta']) {
                        foreach ($con['cta'] as $con2) { ?>
                        <div class="zek_button">
                            <a href="<?php echo $con2['link']; ?>"><?php echo $con2['text']; ?></a>
                        </div>
                        <?php } }?>
                    </div>
                </div>
                <?php } }?>
            </div>
        </div>
    </div>
    <?php } }?>
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
    <?php $chas = get_field('section5','option');
    if($chas) { ?>
    <?php foreach ($chas as $cha) {$text = $cha['text']; ?>
    <div class="zek_home_sec5">
        <div class="container">
            <div class="zek_home_title">
                <div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt="icon star"></div>
                <h2 class="title"><?php echo $cha['title'];  ?></h2>
                <?php if ($text):?>
                <p class="text"><?php echo $text ?></p>
                <?php endif;?>
            </div>
            <div class="hidden_mobile">
                <div class="block">
                    <div class="zek_block zek_position">
                        <div class="img"><img src="<?php bloginfo('template_url'); ?>/images/line_gadient.png" alt="img line gadient"></div>
                        <div class="logo  wow fadeIn animated" data-wow-delay="100ms" data-wow-duration="6000ms"><img src="<?php echo $cha['logo'];  ?>" alt="logo revica"></div>
                        <div class="list_info">
                            <?php
                            if($cha['list']) {
                            $x=0;foreach ($cha['list'] as $con) {$x++; ?>
                            <div class="it it<?php echo $x?>">
                                <h4 class="name"><?php echo $x?>. <?php echo $con['name']; ?></h4>
                                <div class="text"><?php echo $con['text']; ?></div>
                            </div>
                            <?php } }?>
                        </div>
                        <div class="list_icon">
                            <?php
                            if($cha['list']) {
                            $x=0;foreach ($cha['list'] as $con) {$x++; ?>
                            <div class="icon icon<?php echo $x?>">
                                <img src="<?php echo $con['icon']; ?>" alt="icon">
                            </div>
                            <?php } }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } }?>
    <?php $chas = get_field('section6','option');
    if($chas) { ?>
    <?php foreach ($chas as $cha) {$text = $cha['text']; ?>
    <div class="zek_home_sec6">
        <div class="container">
            <div class="zek_block zek_position">
                <div class="zek_home_title">
                    <div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt="icon star"></div>
                    <h2 class="title"><?php echo $cha['title'];  ?></h2>
                    <?php if ($text):?>
                    <p class="text"><?php echo $text ?></p>
                    <?php endif;?>
                </div>
                <div class="swiper mySwiper_scroll1">
                    <div class="swiper-wrapper">
                        <?php
                        if($cha['list']) {
                        foreach ($cha['list'] as $con) { ?>
                        <div class="swiper-slide">
                            <?php
                            if($con['group']) {
                            foreach ($con['group'] as $con2) { ?>
                            <div class="item zek_position">
                                <div class="flex">
                                    <a href="<?php echo $con2['link']; ?>" class="zek_linkfull"></a>
                                    <div class="icon"><img src="<?php echo $con2['icon']; ?>" alt="icon"></div>
                                    <h3 class="name"><?php echo $con2['name']; ?></h3>
                                </div>
                            </div>
                            <?php } }?>
                        </div>
                        <?php } }?>
                    </div>
                    <div class="swiper-scrollbar"></div>
                </div>
                <div class="zek_button">
                    <a href="<?php echo $cha['link_all'];  ?>">Xem tất cả</a>
                </div>
            </div>
        </div>
    </div>
    <?php } }?>
    <?php $rows = get_field('section7','option');
    if($rows){foreach($rows as $row){ 
    $cat = $row['category'];
    ?>
    <div class="zek_home_sec7">
        <div class="container">
            <div class="zek_home_title">
                <div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt="icon star"></div>
                <h2 class="title"><a href="<?php echo get_category_link($cat )?>"><?php echo get_cat_name($cat); ?></a></h2>
            </div>
            <div class="swiper mySwiper_scroll3">
                <div class="swiper-wrapper">
                    <?php
                    $args = array(
                    'cat'=> $cat,
                    'posts_per_page'=>'3',
                    'orderby' => 'ID',
                    'order' => 'DESC'
                    );
                    $posts = new WP_Query( $args );  while($posts->have_posts()) : $posts->the_post();?>
                    <div class="swiper-slide">
                        <?php get_template_part('loop'); ?>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="zek_button text-center">
                <a href="<?php echo get_category_link($cat )?>">Xem tất cả</a>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } ?>
    <?php $chas = get_field('section8','option');
    if($chas) { ?>
    <?php foreach ($chas as $cha) {$text = $cha['text']; ?>
    <div class="zek_home_sec8">
        <div class="container">
            <div class="zek_home_title">
                <div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt="icon star"></div>
                <h2 class="title"><?php echo $cha['title'];  ?></h2>
                <?php if ($text):?>
                <p class="text"><?php echo $text ?></p>
                <?php endif;?>
            </div>
            <div class="swiper mySwiper_scroll2">
                <div class="swiper-wrapper">
                    <?php
                    if($cha['list']) {
                    foreach ($cha['list'] as $con) { ?>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="info flex">
                                <div class="avata zek_position">
                                    <img src="<?php echo $con['avata']; ?>" alt="<?php echo $con['name']; ?>">
                                </div>
                                <div class="box">
                                    <div class="name"><?php echo $con['name']; ?></div>
                                    <div class="sub"><?php echo $con['sub']; ?></div>
                                </div>
                            </div>
                            <div class="content"><?php echo $con['text']; ?></div>
                        </div>
                    </div>
                    <?php } }?>
                </div>
                <div class="swiper-scrollbar"></div>
            </div>
        </div>
    </div>
    <?php } }?>
</main>
<?php get_footer(); ?>