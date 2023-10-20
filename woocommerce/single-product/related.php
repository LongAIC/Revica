<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */
global $product;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<div class="zek_service_detail_sec3">
		<div class="container">
			
            
			<?php
			$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

			if ( $heading ) :
				?>
			<div class="zek_home_title">
                <div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt=""></div>
                <h2 class="title">Top bài đánh giá năng lực khác</h2>
            </div>
			<?php endif; ?>
			
			<div class="zek_slider zek_position">
            	<div class="swiper mySwiper_service">
            		<div class="swiper-wrapper">

						<?php foreach ( $related_products as $related_product ) : ?>

						<?php
						$post_object = get_post( $related_product->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
						?>
						<div class="swiper-slide">
                            <div class="item text-center zek_position">
                                <a href="<?php the_permalink(); ?>" class="zek_linkfull"></a>
                                <div class="img">
                                    <?php the_post_thumbnail('medium'); ?>
                                </div>
                                <h3 class="name"><?php the_title(); ?></h3>
                            </div>
                        </div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="swiper-button-next swiper-button-next-rl"></div>
				<div class="swiper-button-prev swiper-button-prev-rl"></div>
			</div>
			<div class="zek_button text-center">
                <?php
				$product_categories = wp_get_post_terms( get_the_ID(), 'product_cat' );
				if ( ! empty( $product_categories ) ) {
				    $category_link = get_term_link( $product_categories[0]->term_id, 'product_cat' ); // Lấy link danh mục từ ID của term
				}

				// Hiển thị link danh mục
				if ( isset( $category_link ) ) {
				    echo '<a href="' . esc_url( $category_link ) . '">Tìm hiểu thêm các dịch vụ khác</a>';
				}
                 ?>
            </div>
		</div>

	</div>
	<?php
endif;

wp_reset_postdata();
