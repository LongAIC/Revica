<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>
	<h2>Hóa đơn</h2>
	<table cellspacing="0" class="shop_table shop_table_responsive">

		<tr class="cart-subtotal">
			<th><?php esc_html_e( 'Tạm tính:', 'woocommerce' ); ?></th>
			<td data-title="<?php esc_attr_e( 'Tạm tính:', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php
			if ( WC()->cart->get_coupons() ) {
			    foreach ( WC()->cart->get_coupons() as $code => $coupon ) {
			        ?>
			        <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
			            <th><?php esc_html_e( 'Giảm giá:', 'woocommerce' ); ?></th>
			            <td data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>">
			                <?php wc_cart_totals_coupon_html( $coupon ); ?>
			                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>?remove_coupon=<?php echo esc_attr( urlencode( $code ) ); ?>" class="remove-coupon" aria-label="<?php esc_attr_e( 'Xóa mã giảm giá', 'woocommerce' ); ?>">
			                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M2.5 5H4.16667H17.5" stroke="#CE9B25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M15.8334 5.00002V16.6667C15.8334 17.1087 15.6578 17.5326 15.3453 17.8452C15.0327 18.1578 14.6088 18.3334 14.1667 18.3334H5.83341C5.39139 18.3334 4.96746 18.1578 4.6549 17.8452C4.34234 17.5326 4.16675 17.1087 4.16675 16.6667V5.00002M6.66675 5.00002V3.33335C6.66675 2.89133 6.84234 2.4674 7.1549 2.15484C7.46746 1.84228 7.89139 1.66669 8.33341 1.66669H11.6667C12.1088 1.66669 12.5327 1.84228 12.8453 2.15484C13.1578 2.4674 13.3334 2.89133 13.3334 3.33335V5.00002" stroke="#CE9B25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.33325 9.16669V14.1667" stroke="#CE9B25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.6667 9.16669V14.1667" stroke="#CE9B25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
			                </a>
			            </td>
			        </tr>
			        <?php
			    }
			} else {
			    ?>
			    <tr class="cart-discount no-coupon">
			        <th><?php esc_html_e( 'Giảm giá:', 'woocommerce' ); ?></th>
			        <td data-title="<?php esc_attr_e( 'Giảm giá:', 'woocommerce' ); ?>"><?php esc_html_e( '0 ₫', 'woocommerce' ); ?></td>
			    </tr>
			    <?php
			}
			?>

		<?php
// Kiểm tra xem Woocommerce đã được kích hoạt hay chưa
if ( class_exists( 'WooCommerce' ) ) {
    // Lấy giá trị VAT từ đối tượng giỏ hàng của Woocommerce
    $vat_percentage = WC()->cart->get_cart_contents_total() > 0 ? ( WC()->cart->get_cart_contents_tax() / WC()->cart->get_cart_contents_total() ) * 100 : 0;

    // Hiển thị thông tin VAT trong giỏ hàng
    ?>
    <tr class="vat-subtotal">
        <th><?php esc_html_e( 'VAT:', 'woocommerce' ); ?></th>
        <td data-title="<?php esc_attr_e( 'VAT:', 'woocommerce' ); ?>"><?php echo number_format( $vat_percentage, 0 ) . ' %'; ?></td>
    </tr>
    <?php
}
?>


		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

		<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

			<tr class="shipping">
				<th><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></th>
				<td data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
			</tr>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php
		if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = '';

			if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
				/* translators: %s location. */
				$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
			}

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
				foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
					?>
					<tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<th><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
						<td data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
					<?php
				}
			} else {
				?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
					<td data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
				<?php
			}
		}
		?>

		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<tr class="order-total">
			<th><?php esc_html_e( 'Tổng cộng:', 'woocommerce' ); ?></th>
			<td data-title="<?php esc_attr_e( 'Tổng cộng:', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	</table>

	<div class="wc-proceed-to-checkout tien-hanh-thanh-toan">
        <?php  if (is_user_logged_in()): ?>
		<button id="popupPayment">Tiến hành thanh toán</button>
		<!-- <?php //do_action( 'woocommerce_proceed_to_checkout' ); ?> -->
        <?php else: ?>
        <span id="popupPayment">Tiến hành thanh toán</span>
        <?php endif; ?>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>

<div id="confirmationPopup" class="overlay popup-dangky">
  <div class="popup-content">
    <div class="header-popup">
      <h2>
      		<img src="<?php echo get_stylesheet_directory_uri()?>/images/notice.svg" />
			<span>Bạn đã có tài khoản?</span>
		</h2>
      <p>Bạn phải đăng nhập để tiến hành thanh toán</p>
    </div>
    <div class="button-confirm">
      <a href="<?php echo home_url('/dang-ky/'); ?>" class="bt-popup-dangky">Đăng ký</a>
      <a href="<?php echo home_url('/dang-nhap/'); ?>" class="bt-popup-dangnhap">Đăng nhập</a>
    </div>
  </div>
</div>

<script type="text/javascript">
  jQuery(document).ready(function($) {

    const overlay = $('.overlay');
    const isLoggedIn = <?php echo is_user_logged_in() ? 'true' : 'false'; ?>;
    
    $(document).on('click', '#popupPayment', function() {
      if (isLoggedIn) {
        window.location.href = 'thanh-toan';
      } else {
        $('#confirmationPopup').fadeIn();
        overlay.fadeIn();
      }
    });

    overlay.on('click', function() {
      $('#confirmationPopup').fadeOut();
      overlay.fadeOut();
    });

    $('.popup-content').on('click', function(event) {
      event.stopPropagation();
    });
  });
</script>

