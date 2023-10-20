<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<?php if(get_field( 'session')=='macdinh'): ?>
<?php if ( $product->get_price() ) : ?>
    <div class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'sub price alo' ) ); ?>">
        <span class="capt">Giá chỉ từ</span> <?php echo $product->get_price_html(); ?>
    </div>
<?php else : ?>
    <div class="sub price">
        <span class="amount"><?php the_field('gia_tuy_bien'); ?></span>
    </div>
<?php endif; ?>

<?php elseif (get_field('session')=='online'): ?>
<div class="flex flex-center flex_sub">
    <div class="sub">Online Session</div>
    <?php if ( $product->get_price() ) : ?>
    <div class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'sub price alo' ) ); ?>">
        <span class="capt">Giá chỉ từ</span> <?php echo $product->get_price_html(); ?>
    </div>
<?php else : ?>
    <div class="sub price">
        <span class="amount"><?php the_field('gia_tuy_bien'); ?></span>
    </div>
<?php endif; ?>

</div>       
<?php elseif (get_field('session') == 'offline'): ?>
<div class="sub">Offline Session</div>
<?php else: ?>
<?php if ( $product->get_price() ) : ?>
    <div class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'sub price alo' ) ); ?>">
        <span class="capt">Giá chỉ từ</span> <?php echo $product->get_price_html(); ?>
    </div>
<?php else : ?>
    <div class="sub price">
        <span class="amount"><?php the_field('gia_tuy_bien'); ?></span>
    </div>
<?php endif; ?>

<?php endif; ?>
