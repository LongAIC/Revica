<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="cart-content">
	<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<?php do_action( 'woocommerce_before_cart_table' ); ?>

		<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
			<thead>
				<tr>
					<th colspan="2" class="product-name">Sản phẩm <?php
    $cart_items = WC()->cart->get_cart();
    $product_names = array();

    foreach ($cart_items as $cart_item_key => $cart_item) {
        $product = $cart_item['data'];
        $product_name = $product->get_name();
        $product_names[] = $product_name;
    }

    $product_count = count($product_names);
    
    echo '(' . $product_count . ' sản phẩm)';
?>
</th>
					<th class="product-price"><?php esc_html_e( 'Đơn giá', 'woocommerce' ); ?></th>
					<th class="product-quantity"><?php esc_html_e( 'Số lượng', 'woocommerce' ); ?></th>
					<th class="product-subtotal"><?php esc_html_e( 'Thành tiền', 'woocommerce' ); ?></th>
					<th class="product-remove">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M2.5 5H4.16667H17.5" stroke="#CE9B25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8334 5.00002V16.6667C15.8334 17.1087 15.6578 17.5326 15.3453 17.8452C15.0327 18.1578 14.6088 18.3334 14.1667 18.3334H5.83341C5.39139 18.3334 4.96746 18.1578 4.6549 17.8452C4.34234 17.5326 4.16675 17.1087 4.16675 16.6667V5.00002M6.66675 5.00002V3.33335C6.66675 2.89133 6.84234 2.4674 7.1549 2.15484C7.46746 1.84228 7.89139 1.66669 8.33341 1.66669H11.6667C12.1088 1.66669 12.5327 1.84228 12.8453 2.15484C13.1578 2.4674 13.3334 2.89133 13.3334 3.33335V5.00002" stroke="#CE9B25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33325 9.16669V14.1667" stroke="#CE9B25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.6667 9.16669V14.1667" stroke="#CE9B25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">


							<td class="product-thumbnail">
							<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $product_permalink ) {
								echo $thumbnail; // PHPCS: XSS ok.
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
							}
							?>
							</td>

							<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
							<?php
							if ( ! $product_permalink ) {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
							} else {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
							}

							do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

							// Meta data.
							echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

							// Backorder notification.
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
							}
							?>
							</td>

							<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
								<?php
									echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
								?>
							</td>

							<td class="product-quantity" data-key="<?php echo $cart_item_key; ?>" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
							<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" data-key="%s" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input(
									array(
										'input_name'   => "cart[{$cart_item_key}][qty]",
                                        'data-key'   =>  $cart_item_key,
										'input_value'  => $cart_item['quantity'],
										'max_value'    => $_product->get_max_purchase_quantity(),
										'min_value'    => '0',
										'product_name' => $_product->get_name(),
									),
									$_product,
									false
								);
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
							?>
							</td>

							<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
								<?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
								?>
							</td>
							<td class="product-remove">
								<?php
									echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M2.5 5H4.16667H17.5" stroke="#CE9B25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8334 5.00002V16.6667C15.8334 17.1087 15.6578 17.5326 15.3453 17.8452C15.0327 18.1578 14.6088 18.3334 14.1667 18.3334H5.83341C5.39139 18.3334 4.96746 18.1578 4.6549 17.8452C4.34234 17.5326 4.16675 17.1087 4.16675 16.6667V5.00002M6.66675 5.00002V3.33335C6.66675 2.89133 6.84234 2.4674 7.1549 2.15484C7.46746 1.84228 7.89139 1.66669 8.33341 1.66669H11.6667C12.1088 1.66669 12.5327 1.84228 12.8453 2.15484C13.1578 2.4674 13.3334 2.89133 13.3334 3.33335V5.00002" stroke="#CE9B25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33325 9.16669V14.1667" stroke="#CE9B25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.6667 9.16669V14.1667" stroke="#CE9B25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											esc_html__( 'Remove this item', 'woocommerce' ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() )
										),
										$cart_item_key
									);
								?>
							</td>
						</tr>
						<?php
					}
				}
				?>

				<?php do_action( 'woocommerce_cart_contents' ); ?>

				<tr>
					<td colspan="6" class="actions">

						<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

						<?php do_action( 'woocommerce_cart_actions' ); ?>

						<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
					</td>
				</tr>

				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
			</tbody>
		</table>
		<?php do_action( 'woocommerce_after_cart_table' ); ?>
	</form>

	<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

	<div class="cart-collaterals">
		<?php
			/**
			 * Cart collaterals hook.
			 *
			 * @hooked woocommerce_cross_sell_display
			 * @hooked woocommerce_cart_totals - 10
			 */
			do_action( 'woocommerce_cart_collaterals' );
		?>
		<?php if ( wc_coupons_enabled() ) { ?>
	        <form class="woocommerce-coupon-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	        	<label for="coupon_code"><?php esc_html_e( 'Mã giảm giá', 'woocommerce' ); ?></label>
	            <div class="coupon">
	                <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Nhập mã giảm giá', 'woocommerce' ); ?>" />
	                <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Áp dụng', 'woocommerce' ); ?>"><?php esc_attr_e( 'Áp dụng', 'woocommerce' ); ?></button>
	                <?php do_action( 'woocommerce_cart_coupon' ); ?>
	            </div>
	        </form>
	    <?php } ?>
	</div>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>

<script type="text/javascript">
	jQuery(document).ready(function($) {
	    $(document).on('click', '.quantity .quantity__plus', function(e) {
	        e.preventDefault();
	        var input = $(this).siblings('input.qty');
	        var val = parseInt(input.val());
	        input.val(val + 1).change();
	        //updateCart(input);
	    });

	    $(document).on('click', '.quantity .quantity__minus', function(e) {
	        e.preventDefault();
	        var input = $(this).siblings('input.qty');
	        var val = parseInt(input.val());
	        if (val > 0) {
	            input.val(val - 1).change();
	           // updateCart(input);
	        }
	    });
	    $(document).on('click',"button[name='update_cart']" , function(){
	     	$(".cout").text(getCount());
		});
		  
		$(document).on('click',".product-remove a" , function(){
		    $(".cout").text(getCount());
		});
	});
	function getCount(){
	  $count = 0;
	  $(".woocommerce-cart-form__contents tbody tr").each(function(){
	      var countItem = $(this).find(".qty").val();
	      if(countItem != null){
	        $count += Number(countItem);
	       }
	  });
	  return $count;
	}
</script>