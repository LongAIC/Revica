<?php get_header(); ?>
<?php $term = get_queried_object(); ?>
<main id="main">
    <div id="zek_library_taxonomy_page">
        <?php $chas = get_field('banner',$term);
        if($chas) { ?>
        <?php foreach ($chas as $cha) { ?>
        <div class="zek_library_detail_banner">
            <div class="container-fluid">
                <div class="zek_block zek_position zek_background" style="background-image: url(<?php echo  $cha['bg'] ?>);">
                    <div class="inner">
                        <h1 class="title"><?php echo $cha['title'];  ?></h1>
                        <p class="text"><?php echo  $cha['text'] ?></p>
                        <?php
                        if($cha['cta']) {
                        foreach ($cha['cta'] as $con) { ?>
                        <div class="zek_button">
                            <a href="<?php echo $con['link']; ?>"><?php echo $con['text']; ?></a>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="img"><img src="<?php echo  $cha['img'] ?>" alt=""></div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
        <div class="zek_library_taxonomy_body zek_library_detail_body">
            <div class="container">
                <?php $chas = get_field('overview',$term);
                if($chas) { ?>
                <?php foreach ($chas as $cha) { ?>
                <div class="zek_library_taxonomy_overview zek_block">
                    <div class="zek_home_title">
                        <div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt=""></div>
                        <div class="title">Tổng quan</div>
                    </div>
                    <div class="zek_tab_content">
                        <ul id="myTab" role="tablist" class="tab-title">
                            <?php
                            if($cha['list']) {
                            $x=0;foreach ($cha['list'] as $con) {$x++; ?>
                            <li role="presentation">
                                <button class="nav-link <?php if ($x==1) { ?>active<?php } ?>" id="lib-tab<?php echo $x?>" data-bs-toggle="tab" data-bs-target="#lib<?php echo $x?>" type="button" role="tab" aria-controls="lib<?php echo $x?>" aria-selected="true"><h3><?php echo $con['name'];  ?></h3></button>
                            </li>
                            <?php } ?>
                            <?php } ?>
                        </ul>
                        <div class="tab-content">
                            <?php
                            if($cha['list']) {
                            $x=0;foreach ($cha['list'] as $con) {$x++; ?>
                            <div class="tab-pane <?php if ($x==1) { ?>active<?php } ?>" id="lib<?php echo $x?>" role="tabpanel" aria-labelledby="lib-tab<?php echo $x?>">
                                <div class="content-post clearfix">
                                    <?php echo $con['content'];  ?>
                                </div>
                            </div>
                            <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php } ?>
                <div class="zek_block zek_library_taxonomy_list">
                    <div class="zek_home_title">
                        <div class="title">Thông tin nghề nghiệp</div>
                    </div>
                    <div class="block_test">
                        <div id="page_container">
                            <div id="accordion_search_bar_container" class="zek_library_form zek_position">
                                <input type="search" class="search-input" id="accordion_search_bar" placeholder="Nhập từ khóa tìm kiếm. Ví dụ: IT, Lập trình viên, Kinh doanh, Nhân viên kinh doanh.." value="" onkeyup="this.setAttribute('value', this.value);">
                                <input type="submit" class="submit-input" alt="Search" value="Search" />
                                <a></a>
                            </div>
                            <div class="panel-group zek_library_list" id="accordion" role="tablist" aria-multiselectable="true">
                                <?php
                                $terms = get_terms( 'danh-muc-thu-vien-nghe-nghiep', array(
                                    'hide_empty' => 0,
                                    'parent' => get_queried_object_id()
                                ) );
                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                $x=0;foreach ( $terms as $term ) {$x++;
                                ?>
                                <div class="group accordion-item">
                                    <div class="accordion-header" id="heading<?php echo $x?>">
                                        <button class="accordion-button <?php if ($x>=2) { ?>collapsed<?php } ?>" type="button" data-bs-toggle="collapse" data-bs-target="#taxo<?php echo $x?>" aria-expanded="true" aria-controls="taxo<?php echo $x?>"><h2><?php echo $term->name;?><span class="cout"> - <?php echo $term->count; ?> công việc liên quan</span></h2></button>
                                    </div>
                                    <div id="taxo<?php echo $x?>" class="accordion-collapse collapse <?php if ($x==1) { ?>show<?php } ?>" aria-labelledby="heading<?php echo $x?>" data-bs-parent="#accordion">
                                        <div class="accordion-body ">
                                            <?php
                                            $args = array('post_type' => 'thu-vien-nghe-nghiep',
                                                    'showposts' => -1,
                                            'tax_query' => array(
                                            array(
                                            'taxonomy' => 'danh-muc-thu-vien-nghe-nghiep',
                                            'field' => 'ID',
                                            'terms' => $term->term_id,
                                            ),
                                            ),
                                            );
                                            $loop = new WP_Query($args);
                                            while($loop->have_posts()) : $loop->the_post();
                                                        $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'shop_catalog', false, '' );
                                            ?>
                                            <div class="item">
                                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            </div>
                                            <?php
                                            endwhile;
                                            wp_reset_query();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } } else { ?>
                                <div class="group">
                                    <?php global $query_string; query_posts("{$query_string}&posts_per_page=9"); if(have_posts()){ while(have_posts()):the_post();$format=get_post_format();setPostViews($post->ID); ?>
                                    <div class="item">
                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    </div>
                                    <?php endwhile;wp_reset_postdata();?>
                                    <?php }?>
                                </div>
                                <?php } ?>
                                
                            </div>
                            <!-- chiusura panel group -->
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
    
</main>
<?php get_footer(); ?>