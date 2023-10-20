<?php
/*
Template Name: Từ điển năng lực
*/
?>
<?php get_header(); ?>
<main id="main">
    <?php while (have_posts()) : the_post();setPostViews($post->ID); ?>
    <div id="zek_library_page">
        <?php $chas = get_field('banner');
        if($chas) { ?>
        <?php foreach ($chas as $cha) { ?>
        <div class="zek_dictionary_banner">
            <div class="container-fluid">
                <div class="zek_block zek_background zek_position" style="background-image: url(<?php echo $cha['bg'];  ?>);">
                    <div class="image text-center">
                        <img src="<?php echo $cha['img'];  ?>" alt="">
                    </div>
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
                    
                </div>
            </div>
        </div>
        <?php } } ?>
        <div class="zek_dictionary_body">
            <div class="container">
                <?php $rows=get_field( 'section1'); if($rows) ?>
                <?php { ?>
                <?php foreach($rows as $row) { ?>
                <div class="zek_dictionary_sec1">
                    <div class="zek_home_title">
                        <div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt=""></div>
                        <h2 class="title"><?php echo  $row['title'] ?></h2>
                    </div>
                    <div class="content-post clearfix">
                        <?php echo $row['content'];  ?>
                    </div>
                </div>
                <?php } }?>
                <div class="zek_dictionary_sec2">
                    <div class="row row-margin">
                        <div class="col-4 col-left">
                            <div id="accordion">
                                <?php $chas = get_field('section2');
                                if($chas) { ?>
                                <?php $y=0;foreach ($chas as $cha) {$y++; ?>
                                <div class="accordion-item">
                                    <div class="accordion-header" id="heading<?php echo $y?>">
                                        <button class="accordion-button <?php if ($y>=2) { ?>collapsed<?php } ?>" type="button" data-bs-toggle="collapse" data-bs-target="#tdnl<?php echo $y?>" aria-expanded="true" aria-controls="tdnl<?php echo $y?>"><?php echo $cha['titlemain'];  ?></button>
                                    </div>
                                    <div id="tdnl<?php echo $y?>" class="accordion-collapse collapse <?php if ($y==1) { ?>show<?php } ?>" aria-labelledby="heading<?php echo $y?>" data-bs-parent="#accordion">
                                        <div class="accordion-body">
                                            <ul id="myTab<?php echo $y?>" role="tablist" class="tab-title">
                                                <?php
                                                if($cha['list']) {
                                                $x=0;foreach ($cha['list'] as $con) {$x++; ?>
                                                <li role="presentation">
                                                    <button class="nav-link <?php if ($y==1) { ?><?php if ($x==1) { ?>active<?php } ?><?php } ?>" id="dic-tab<?php echo $y?><?php echo $x?>" data-bs-toggle="tab" data-bs-target="#dic<?php echo $y?><?php echo $x?>" type="button" role="tab" aria-controls="dic<?php echo $y?><?php echo $x?>" aria-selected="true"><?php echo $con['title']; ?></button>
                                                </li>
                                                <?php } } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php } } ?>
                            </div>
                        </div>
                        <div class="col-8 col-right">
                            <div class="tab-content">
                                <?php $chas = get_field('section2');
                                if($chas) { ?>
                                <?php $y=0;foreach ($chas as $cha) {$y++; ?>
                                <?php
                                if($cha['list']) {
                                $x=0;foreach ($cha['list'] as $con) {$x++;$group4 = $con['group4']; ?>
                                <div class="tab-pane <?php if ($y==1) { ?><?php if ($x==1) { ?>active show<?php } ?><?php } ?>" id="dic<?php echo $y?><?php echo $x?>" role="tabpanel" aria-labelledby="dic-tab<?php echo $y?><?php echo $x?>">
                                    <h3 class="title"><?php echo $con['title']; ?></h3>
                                    <div class="zek_block">
                                        <?php
                                        if($con['group1']) {
                                        foreach ($con['group1'] as $con2) { ?>
                                        <div class="group1">
                                            <div class="row">
                                                <div class="col-xl-7 col-lg-7 col-md-7 col-12">
                                                    <h4 class="caption"><?php echo $con2['name']; ?></h4>
                                                    <p class="text"><?php echo $con2['text']; ?></p>
                                                </div>
                                                <div class="col-xl-5 col-lg-5 col-md-5 col-12">
                                                    <div class="image text-end">
                                                        <img src="<?php echo $con2['img']; ?>" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } } ?>
                                        <?php
                                        if($con['group2']) {
                                        foreach ($con['group2'] as $con2) { ?>
                                        <div class="group2">
                                            <h4 class="caption"><?php echo $con2['name']; ?></h4>
                                            <p class="text"><?php echo $con2['text']; ?></p>
                                            <div class="img">
                                                <img src="<?php echo $con2['img']; ?>" alt="">
                                            </div>
                                            <ul class="list">
                                                <?php
                                                if($con2['list']) {
                                                foreach ($con2['list'] as $con3) { ?>
                                                <li>
                                                    <div class="key"><?php echo $con3['key']; ?></div>
                                                    <div class="value"><?php echo $con3['value']; ?></div>
                                                </li>
                                                <?php } } ?>
                                            </ul>
                                        </div>
                                        <?php } } ?>
                                        <?php
                                        if($con['group3']) {
                                        foreach ($con['group3'] as $con2) { ?>
                                        <div class="group3">
                                            <h4 class="caption"><?php echo $con2['name']; ?></h4>
                                            <div class="image text-center">
                                                <img src="<?php echo $con2['img']; ?>" alt="">
                                            </div>
                                            <ul class="list">
                                                <?php
                                                if($con2['list']) {
                                                foreach ($con2['list'] as $con3) { ?>
                                                <li><?php echo $con3['text']; ?></li>
                                                <?php } } ?>
                                            </ul>
                                        </div>
                                        <?php } } ?>
                                        <?php if ($group4):?>
                                        <div class="group4">
                                            <div class="content-post clearfix">
                                                <?php echo $group4 ?>
                                            </div>
                                        </div>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <?php } } ?>
                                <?php } } ?>
                            </div>
                        </div>
                    </div>
                </div>
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