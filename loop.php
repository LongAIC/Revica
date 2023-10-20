<article class="zek_item_news zek_position">
	<a href="<?php the_permalink()?>" class="zek_linkfull"></a>
	<div class="img">
		<?php the_post_thumbnail('medium'); ?>
	</div>
	<div class="info">
		<div class="box">
			<h3 class="name"><?php the_title(); ?></h3>
			<div class="desc"><?php the_excerpt() ;?></div>
		</div>
		<div class="flex flex-center">
            <div class="meta">
                <span class="date"><?php the_time('d'); ?> Tháng <?php the_time('m, Y'); ?></span>
            </div>
            <div class="category">
                <?php   $categories = get_the_category(); if ( ! empty( $categories ) ) {echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';}?>
            </div>
        </div>
	</div>
</article>