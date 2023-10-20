<?php get_header(); $a=get_query_var('cat' ); $term = get_queried_object();if($term->parent==0){$catname=$term->name;$catid=$term->term_id;}else{ $catname = get_cat_name($term->parent);$catid=$term->parent;} //var_dump($term);?>
<main id="main">
    <div id="zek_archive_page">
                        
        <div class="zek_single_top">
            <div class="container-fluid">
                <div class="swiper mySwiper_home_banner">
                    <div class="swiper-wrapper">
                        <?php
                        $args = array(
                        'showposts' => '3',
                        'meta_key'       => 'post_views_count','cat'=> $a,
                        'orderby' => 'meta_value_num',

                        'order' => 'DESC'
                        );
                        $query = new WP_Query( $args );
                        while ($query->have_posts()) : $query->the_post();
                        $x++;?>
                        <div class="swiper-slide">
                            <div class="zek_block zek_position">
                                <a href="<?php the_permalink()?>" class="zek_linkfull"></a>
                                <div class="img"><?php the_post_thumbnail('full'); ?></div>
                                <div class="info">
                                    <div class="container">
                                        <h3 class="zek_single_title"><?php the_title();?></h3>
                                        <div class="flex flex-center">
                                            <div class="zek_single_meta">
                                                <span class="date"><?php the_time('d'); ?> Tháng <?php the_time('m, Y'); ?></span>
                                                <span class="author">Tác giả: <?php the_author(); ?></span>
                                            </div>
                                            <div class="zek_single_category">
                                                <?php   $categories = get_the_category(); if ( ! empty( $categories ) ) {echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';}?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
        
        <div class="zek_archive_body">
            <div class="container">
                <h1 class="zek_page_title" style="display: none;"><?php echo single_cat_title();?></h1>
                <div class="zek_archive_menu">
                    <?php wp_nav_menu( array( 'container' => '','theme_location' => 'category','menu_class' => 'menu' ) ); ?>
                </div>
                <div class="row row-margin">
                    <div class="col-xl-8 col-lg-8 col-md-12 col-12">
                        <div class="zek_archive_list">
                            <div class="row row-margin">
                                <?php
                                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                                $args = array(
                                'post_type' => 'post',
                                'cat' => $a,
                                'orderby' => 'date',
                                'order' => 'ASC',
                                'posts_per_page' => 9,
                                'paged' => $paged
                                );
                                $query = new WP_Query( $args );
                                ?>
                                <?php if ( $query->have_posts() ) : $x=0; while ( $query->have_posts() ) :  $query->the_post();$format=get_post_format();$x++; ?>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-6 col-item">
                                    <?php get_template_part('loop'); ?>
                                </div>
                                <?php endwhile; wp_reset_postdata(); endif; ?>
                            </div>
                        </div>
                        <?php get_template_part( 'pagination' ); ?>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-12">
                        <div class="zek_sidebar">
                            <div class="widget random-post">
                                <div class="zek_sidebar_title">Bài viết khác</div>
                                <div class="zek_sidebar_post">
                                    <?php 
                                    $args = array(
                                    'post_status' => 'publish', // Chỉ lấy những bài viết được publish
                                    'post_type' => 'post', // Lấy những bài viết thuộc post, nếu lấy những bài trong 'trang' thì để là page 
                                    'showposts' => 4, // số lượng bài viết
                                    'orderby' =>'rand',
                                    );
                                    ?>
                                    <?php $getposts = new WP_query($args); ?>
                                    <?php global $wp_query; $wp_query->in_the_loop = true; ?>
                                    <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
                                    <div class="item zek_position flex flex-center">
                                        <a href="<?php the_permalink()?>" class="zek_linkfull"></a>
                                        <div class="img">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </div>
                                        <div class="info">
                                            <h4 class="name"><?php the_title(); ?></h4>
                                            <div class="flex flex-center">
                                                <div class="meta">
                                                    <span class="date"><?php the_time('d'); ?> Tháng <?php the_time('m, Y'); ?></span>
                                                </div>
                                                <div class="category">
                                                    <?php   $categories = get_the_category(); if ( ! empty( $categories ) ) {echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';}?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endwhile; wp_reset_postdata(); ?>
                                </div>
                            </div>
                            <div class="widget video-sidebar">
                                <div class="zek_sidebar_title">Video nổi bật</div>
                                <div class="zek_sidebar_video">
                                    <div id="vid1" style="width:100%;height:230px" class="ytdefer" data-src="<?php the_field('video_sidebar','option') ?>"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if( have_rows('join_in','option') ): ?>
        <?php while( have_rows('join_in','option') ) : the_row();?>
        <div class="zek_archive_bottom">
            <div class="container container-big">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-5 col-12">
                        <div class="inner">
                            <h2 class="title"><?php the_sub_field('title'); ?></h2>
                            <p class="text"><?php the_sub_field('text'); ?></p>
                            <div class="form">
                                <?php echo do_shortcode('[ninja_form id=3]'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-7 col-12">
                        <div class="img"><img src="<?php the_sub_field('img'); ?>" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile;?>
        <?php endif;?>
    </div>
</main>
<?php get_footer(); ?>