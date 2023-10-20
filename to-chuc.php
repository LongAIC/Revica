<?php
/*
Template Name: Tổ chức
*/
?>
<?php get_header(); ?>
<main id="main">
    <?php while (have_posts()) : the_post();setPostViews($post->ID); ?>
    <h1 class="zek_page_title" style="display: none;"><?php the_title(); ?></h1>
    <div id="zek_organi_page">
        <?php $chas = get_field('banner');
        if($chas) { ?>
        <?php foreach ($chas as $cha) { ?>
        <div class="zek_organi_banner">
            <div class="container-fluid">
                <div class="zek_block flex zek_background" style="background-image: url(<?php echo $cha['bg'];  ?>);">
                    <div class="inner_left">
                        <div class="inner">
                            <h2 class="title"><?php echo $cha['title'];  ?></h2>
                            <ul class="list">
                                <?php
                                if($cha['list_content']) {
                                foreach ($cha['list_content'] as $con) { ?>
                                <li><span><?php echo $con['text']; ?></span></li>
                                <?php } } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="inner_right">
                        <div class="line1"></div>
                        <div class="line2"></div>
                        <div class="image">
                            <img src="<?php echo $cha['img'];  ?>" alt="">
                        </div>
                        <ul class="list">
                            <?php
                            if($cha['list_icon']) {
                            foreach ($cha['list_icon'] as $con) { ?>
                            <li><a href="<?php echo $con['link']; ?>"><img src="<?php echo $con['icon']; ?>" alt=""></a></li>
                            <?php } } ?>
                        </ul>
                        <div class="re"><img src="<?php bloginfo('template_url'); ?>/images/RE.png" alt=""></div>
                        <div class="vi"><img src="<?php bloginfo('template_url'); ?>/images/VI.png" alt=""></div>
                        <div class="ca"><img src="<?php bloginfo('template_url'); ?>/images/CA.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } } ?>
        <div class="zek_organi_body">
            <div class="container">
                <?php $chas = get_field('sec1');
                if($chas) { ?>
                <?php foreach ($chas as $cha) { ?>
                <div class="zek_organi_sec1">
                    <div class="zek_block">
                        <div class="inner">
                            <h2 class="title"><?php echo $cha['title'];  ?></h2>
                            <ul class="list">
                                <?php
                                if($cha['list']) {
                                foreach ($cha['list'] as $con) { ?>
                                <li>
                                    <span class="icon"><img src="<?php echo $con['icon']; ?>" alt=""></span>
                                    <span class="text"><?php echo $con['text']; ?></span>
                                </li>
                                <?php } } ?>
                            </ul>
                            <div class="zek_button">
                                <a href="<?php echo $cha['link'];  ?>">Tìm hiểu thêm</a>
                            </div>
                        </div>
                        <div class="group video">
                            <div id="vid1" style="width:100%;height:400px" class="ytdefer" data-src="<?php echo $cha['video'];  ?>"></div>
                        </div>
                    </div>
                </div>
                <?php } } ?>
                <?php $chas = get_field('sec2');
                if($chas) { ?>
                <?php foreach ($chas as $cha) { ?>
                <div class="zek_organi_sec1 zek_organi_sec2">
                    <div class="zek_block">
                        <div class="group image">
                            <?php
                            if($cha['group']) {
                            foreach ($cha['group'] as $con) { ?>
                            <div class="background">
                                <img src="<?php echo $con['bg']; ?>" alt="">
                            </div>
                            
                            <div class="box">
                                <img src="<?php bloginfo('template_url'); ?>/images/dot.svg" class="dot" alt>
                                <div class="icon_user">
                                    <img src="<?php bloginfo('template_url'); ?>/images/ic_users.svg" alt>
                                </div>
                                <div class="imgs">
                                    <div class="img1 img">
                                        <img src="<?php echo $con['img1']; ?>" alt="">
                                    </div>
                                    <div class="img2 img">
                                        <img src="<?php echo $con['img2']; ?>" alt="">
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="txt">
                                        <div class="name"><?php echo $con['name']; ?></div>
                                        <p class="text"><?php echo $con['text']; ?></p>
                                    </div>
                                    <div class="cta">
                                        <a href="<?php echo $con['link']; ?>">Khám phá</a>
                                    </div>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                        <div class="inner">
                            <h2 class="title"><?php echo $cha['title'];  ?></h2>
                            <ul class="list">
                                <?php
                                if($cha['list']) {
                                foreach ($cha['list'] as $con) { ?>
                                <li>
                                    <span class="icon"><img src="<?php echo $con['icon']; ?>" alt=""></span>
                                    <span class="text"><?php echo $con['text']; ?></span>
                                </li>
                                <?php } } ?>
                            </ul>
                            <div class="zek_button">
                                <a href="<?php echo $cha['link'];  ?>">Tìm hiểu thêm</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <?php } } ?>
        
            </div>
        </div>
        <?php $chas = get_field('sec3');
        if($chas) { ?>
        <?php foreach ($chas as $cha) { ?>
        <div class="zek_organi_sec3 zek_position">
            <div class="zek_background" style="background-image: url(<?php echo $cha['bg'];  ?>);"></div>
            <div class="inner text-center">
                <div class="zek_home_title">
                    <h2 class="title"><?php echo $cha['title'];  ?></h2>
                    <p class="text"><?php echo $cha['text'];  ?></p>
                    <?php
                    if($cha['cta']) {
                    foreach ($cha['cta'] as $con) { ?>
                    <a href="<?php echo $con['link']; ?>" class="link"><?php echo $con['text']; ?></a>
                    <?php } } ?>
                </div>
            </div>
        </div>
        <?php } } ?>
    </div>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>