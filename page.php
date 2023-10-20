<?php get_header(); ?>
<main id="main">
    <?php while (have_posts()) : the_post();setPostViews($post->ID); ?>
    <div id="zek_page_default">
        <div class="container">
            <div class="zek_block_page">
                
                <h1 class="zek_pagedefaul_title"><?php the_title();?></h1>
                <div class="zek_page_content">
                    <div class="content-post clearfix">
                        <?php the_content(); ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>