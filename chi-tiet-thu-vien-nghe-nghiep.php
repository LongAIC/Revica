<?php
/*
Template Name: Chi tiết Thư viện nghề nghiệp
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
        <div class="zek_library_detail_body">
            <div class="container">
                
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
<script type="text/javascript">
(function($) {
'use strict';
jQuery(document).ready(function() {
var noItemMsg = "Load more button hidden because no more item to load";
//wrapper 1
// end wrapper 1
//wrapper 2
// end wrapper 2
// wrapper 3
// end wrapper 3
//wraper 4
// end wrapper 4
//wrapper 5
// end wrapper 5
//wrapper 6


// Append the Load More Button
$(".zek_library_sec1 .list").append('<button id="loadMores"><span>Xem thêm</span></button>');
$(".zek_library_sec1 .list .col-item").hide();
// Show the initial visible items
$(".zek_library_sec1 .list .col-item").slice(0, 6).css({ 'display': 'block' });
// Calculate the hidden items
$(document).find(".zek_library_sec1 .list #loadMores").text( $(".zek_library_sec1 .list .col-item:hidden").length );
// Button Click Trigger
$(".zek_library_sec1 .list").find("#loadMores").on('click', function (e) {
e.preventDefault();
// Show the hidden items
$(".zek_library_sec1 .list .col-item:hidden").slice(0, 100).css({ 'display': 'block' });
// Hide if no more to load
if ( $(".zek_library_sec1 .list .col-item:hidden").length == 0 ) {
$(this).fadeOut('slow');
}
// ReCalculate the hidden items
$(document).find(".zek_library_sec1 .list #loadMores").text( $(".zek_library_sec1 .list .col-item:hidden").length );
});
// Hide on initial if no div to show
if ( $(".zek_library_sec1 .list .col-item:hidden").length == 0 ) {
$(".zek_library_sec1 .list").find("#loadMores").fadeOut('slow');
console.log( noItemMsg );
}
// end wrapper 6
});
})(jQuery);
</script>
<?php get_footer(); ?>