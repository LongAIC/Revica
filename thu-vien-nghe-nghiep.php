<?php
/*
Template Name: Thư viện nghề nghiệp
*/
?>
<?php get_header(); ?>
<main id="main">
    <?php while (have_posts()) : the_post();setPostViews($post->ID); ?>
    <div id="zek_library_page">
        <?php $chas = get_field('banner');
        if($chas) { ?>
        <?php foreach ($chas as $cha) { ?>
        <div class="zek_library_banner">
            <div class="container-fluid">
                <div class="zek_block zek_background zek_position" style="background-image: url(<?php echo $cha['bg'];  ?>);">
                    <div class="inner">
                        <h1 class="title"><?php echo $cha['title'];  ?></h1>
                        <ul class="list">
                            <?php
                            if($cha['list']) {
                            foreach ($cha['list'] as $con) { ?>
                            <li><?php echo $con['text']; ?></li>
                            <?php } } ?>
                        </ul>
                        <?php
                        if($cha['cta']) {
                        foreach ($cha['cta'] as $con) { ?>
                        <div class="zek_button">
                            <a href="<?php echo $con['link']; ?>"><?php echo $con['text']; ?></a>
                        </div>
                        <?php } } ?>
                    </div>
                    <div class="img">
                        <img src="<?php echo $cha['img'];  ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
        <?php } } ?>
        <div class="zek_library_body">
            <div class="container">
                <?php $chas = get_field('section1');
                if($chas) { ?>
                <?php foreach ($chas as $cha) {$text = $cha['text']; ?>
                <div class="zek_library_sec1">
                    <div class="zek_home_title">
                        <div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt=""></div>
                        <h2 class="title"><?php echo $cha['title'];  ?></h2>
                        <?php if ($text):?>
                        <p class="text"><?php echo $text ?></p>
                        <?php endif;?>
                    </div>
                    <div class="list flex">
                        <?php
                        if($cha['list']) {
                        $x=0;foreach ($cha['list'] as $con) {$x++; ?>
                        <div class="col-item <?php if ($x>=7) { ?>hidden_item<?php } ?>">
                            <div class="item zek_position zek_background" style="background-image: url(<?php echo $con['img']; ?>);">
                                <div class="overlay"></div>
                                <a href="<?php echo $con['link']; ?>" class="zek_linkfull"></a>
                                <div class="inner text-center">
                                    <h3 class="name"><?php echo $con['name']; ?></h3>
                                    <div class="sub"><?php echo $con['sub']; ?></div>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                    </div>
                    <?php
                    if($cha['list']) {
                    $x=0;foreach ($cha['list'] as $con) {$x++; ?>
                    <?php if ($x==7) { ?>
                    <div class="button_showmore">
                        <button></button>
                    </div>
                    <?php } ?>
                    <?php } } ?>
                </div>
                <?php } } ?>
                <?php $chas = get_field('section2');
                if($chas) { ?>
                <?php foreach ($chas as $cha) {$text = $cha['text']; ?>
                <div class="zek_library_sec2">
                    <div class="zek_home_title">
                        <div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt=""></div>
                        <h2 class="title"><?php echo $cha['title'];  ?></h2>
                        <?php if ($text):?>
                        <p class="text"><?php echo $text ?></p>
                        <?php endif;?>
                    </div>
                    <div class="list flex">
                        <?php
                        if($cha['list']) {
                        $x=0;foreach ($cha['list'] as $con) {$x++; ?>
                        <div class="col-item">
                            <div class="item zek_position">
                                <div class="icon"><img src="<?php echo $con['icon']; ?>" alt=""></div>
                                <h3 class="name"><?php echo $con['name']; ?></h3>
                                <div class="content">
                                    <?php echo $con['content']; ?>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                    </div>
                </div>
                <?php } } ?>
            </div>
        </div>
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