<?php get_header(); $a=get_query_var('cat' );?>
<main id="main">
    <?php get_template_part('breadcrums'); ?>
    <div id="content_pages">
        <div class="container">
            <div class="all_box">
                <div class="row">
                    <div class="col-md-9">
                    	<h1 class="title_pages">
                    		Tìm kiếm: "<?php echo get_search_query(); ?>"
                    	</h1>
                        <div class="list_news">
                            <?php if(have_posts()){ while(have_posts()):the_post();$format=get_post_format();setPostViews($post->ID); ?>
                            <?php get_template_part('loop'); ?>
                            <?php endwhile;wp_reset_postdata(); ?>
                            <?php }?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="sidebar">
                            <?php get_template_part('sidebar'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>