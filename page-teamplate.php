<?php
/*
Template Name: Page Teamplate
*/
?>
<?php get_header(); ?>
<main id="main">
    <?php get_template_part('breadcrums'); ?>
    <div id="content_pages">
        <div class="container">
            <div class="all_box">
                <?php while (have_posts()) : the_post();setPostViews($post->ID); ?>
                <h1 class="title_pages"><?php the_title();?></h1>
                <div class="content-post clearfix">
                    <?php the_content(); ?>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>