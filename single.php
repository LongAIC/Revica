<?php get_header();wp_reset_query();  $format = get_post_format();?>
<?php $term_list = wp_get_post_terms($post->ID, 'category', array("fields" => "ids"));$a=$post->ID; ?>
<main id="main">
    <?php while (have_posts()) : the_post(); setPostViews($post->ID);?>
    <div id="zek_single_page">
        <div class="zek_single_top">
            <div class="container-fluid">
                <div class="zek_block">
                    <div class="img"><?php the_post_thumbnail('full'); ?></div>
                    <div class="info">
                        <div class="container">
                            <h1 class="zek_single_title"><?php the_title();?></h1>
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
        </div>
        <div class="zek_single_body">
            <div class="zek_single_content">
                <div class="container">
                    <div class="content-post clearfix">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
            <div class="zek_single_related">
                <div class="container">
                    <h2 class="title">Bài viết nổi bật khác</h2>
                    <div class="swiper mySwiper_scroll3">
                        <div class="swiper-wrapper">
                            <?php
                            $categories = get_the_category(get_the_ID());
                            if ($categories){
                            
                            $category_ids = array();
                            foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                            $args=array(
                            'category__in' => $category_ids,
                            'post__not_in' => array(get_the_ID()),
                            'posts_per_page' => 3,
                            );
                            $my_query = new wp_query($args);
                            if( $my_query->have_posts() ):
                            while ($my_query->have_posts()):$my_query->the_post();
                            ?>
                            <div class="swiper-slide">
                                <?php get_template_part('loop'); ?>
                            </div>
                            <?php
                            endwhile;
                            endif; wp_reset_query();
                            }
                            ?>
                        </div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>