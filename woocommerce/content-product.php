<?php
/**
* The template for displaying product content within loops
*
* This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
* @see     https://docs.woocommerce.com/document/template-structure/
* @package WooCommerce/Templates
* @version 3.6.0
*/
defined( 'ABSPATH' ) || exit;
global $product;
// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div class="col-item col-xl-4 col-lg-4 col-md-6 col-12 col-item">
	<div class="zek_item_service">
        <div class="image">
            <?php the_post_thumbnail('medium'); ?>
        </div>
        <div class="info">
            <h3 class="name text-center"><?php  if ( get_field ( 'title' )): ?><?php the_field('title'); ?><?php else: ?><?php the_title(); ?><?php endif; ?></h3>
            <div class="text"><?php  if ( get_field ( 'desc' )): ?><?php the_field('desc'); ?><?php else: ?><?php the_excerpt() ;?><?php endif; ?></div>
            <div class="zek_button text-center">
                <a href="<?php the_permalink(); ?>">Tìm hiểu thêm</a>
            </div>
        </div>
    </div>
</div>