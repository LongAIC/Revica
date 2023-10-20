<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */
if (!defined('ABSPATH')) {
	exit;
}
do_action('woocommerce_before_checkout_form', $checkout);
// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
	echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
	return;
}


?>



<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
	<?php if ($checkout->get_checkout_fields()) : ?>
		<?php do_action('woocommerce_checkout_before_customer_details'); ?>
		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php //do_action( 'woocommerce_checkout_billing' ); 
				?>
				<div class="payment-methods">
					<h3>Lựa chọn phương thức thanh toán</h3>
					<div class="choose-payment-methods">
						<div class="payment-vnpay">
							<div class="checkbox-payment">
								<input type="radio" id="thanh-toan-online" name="thanh-toan-online">
								<label for="thanh-toan-online">
									<img class="logo-vnpay" src="<?php echo get_stylesheet_directory_uri() ?>/images/logo-vnpay.png" />
									<span>Thanh toán online qua <img class="vnpay" src="<?php echo get_stylesheet_directory_uri() ?>/images/vnpay.png" /> (dành cho khách hàng doanh nghiệp có xuất hóa đơn & những đơn hàng có tổng giá trị từ 500.000 đ trở lên)</span>
								</label>
							</div>
							<a class="huongdan-tt" href="#1">Hướng dẫn thanh toán VNPAY</a>
							<div class="more-paymen-vnpay">
								<p>Xuất hóa đơn công ty (cho những đơn hàng có giá trị từ 500.000 đ trở lên)</p>
								<div class="form-vat-vnpay">
									<div class="row-form">
										<input type="text" name="tencongty" placeholder="Tên công ty">
										<input type="text" name="diachi" placeholder="Địa chỉ">
									</div>
									<div class="row-form">
										<input type="tel" name="sodienthoai" placeholder="Số điện thoại">
										<input type="email" name="email" placeholder="Email">
									</div>
									<div class="row-form row-form-one">
										<input type="text" name="masothue" placeholder="Mã số thuế">
									</div>
								</div>
							</div>
						</div>
						<div class="payment-bank">
							<div class="checkbox-payment">
								<input type="radio" id="chuyen-khoan-ngan-hang" name="chuyen-khoan-ngan-hang">
								<label for="chuyen-khoan-ngan-hang">
									<img class="logo-ck" src="<?php echo get_stylesheet_directory_uri() ?>/images/chuyenkhoan.png" />
									<span>Chuyển khoản ngân hàng</span>
								</label>
							</div>
							<div class="more-paymen-bank">
								<label for="xuat-hoa-don-cong-ty">
									<input type="checkbox" id="xuat-hoa-don-cong-ty" name="xuat-hoa-don-cong-ty">
									<span>Xuất hóa đơn công ty (cho những đơn hàng có giá trị từ 500.000 đ trở lên) </span>
								</label>
								<div class="form-vat-bank">
									<div class="row-form">
										<input type="text" name="tencongty" placeholder="Tên công ty">
										<input type="text" name="diachi" placeholder="Địa chỉ">
									</div>
									<div class="row-form">
										<input type="tel" name="sodienthoai" placeholder="Số điện thoại">
										<input type="email" name="email" placeholder="Email">
									</div>
									<div class="row-form row-form-one">
										<input type="text" name="masothue" placeholder="Mã số thuế">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-2">
				<?php do_action('woocommerce_checkout_shipping'); ?>
			</div>
		</div>
		<?php do_action('woocommerce_checkout_after_customer_details'); ?>
	<?php endif; ?>

	<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>


	<?php do_action('woocommerce_checkout_before_order_review'); ?>
	<div id="order_review" class="woocommerce-checkout-review-order">
		<div class="order_review_left">
			<h3 id="order_review_heading"><?php esc_html_e('Chi tiết hóa đơn', 'woocommerce'); ?></h3>
			<?php do_action('woocommerce_checkout_order_review'); ?>
		</div>
	</div>
	<?php do_action('woocommerce_checkout_after_order_review'); ?>
</form>
<?php do_action('woocommerce_after_checkout_form', $checkout); ?>

<script>
	$(document).ready(function() {
		const paymentVnpayCheckbox = $("#thanh-toan-online");
		const morePaymenVnpayDiv = $(".more-paymen-vnpay");
		const paymentBankRadio = $("#chuyen-khoan-ngan-hang");
		const morePaymenBankDivs = $(".more-paymen-bank");
		const morePaymenBankCheckbox = $("#xuat-hoa-don-cong-ty");
		const morePaymenBankLabel = $(".more-paymen-bank > label");
		const morePaymenBankForm = $(".form-vat-bank");
		const checkoutForm = $("form.checkout");
		const orderReviewHeading = $("#order_review_heading");

		// Hàm loại bỏ dấu phân cách hàng ngàn (dấu ".") từ chuỗi số
		function removeThousandsSeparator(amountString) {
			return parseFloat(amountString.replace(/\./g, "").replace(",", "."));
		}

		// Kiểm tra điều kiện Tổng số tiền sản phẩm trên trang thanh toán
		function checkTotalAmount() {
			const totalAmountString = $("#order_review .order-total .woocommerce-Price-amount").text().trim();
			const totalAmount = removeThousandsSeparator(totalAmountString);

			if (totalAmount > 500000) {
				paymentVnpayCheckbox.prop("disabled", false);
				morePaymenBankCheckbox.prop("disabled", false);
				$(".payment-vnpay").removeClass("disabled");
				$(".more-paymen-bank").removeClass("disabled");
			} else {
				paymentVnpayCheckbox.prop("disabled", true);
				if (paymentVnpayCheckbox.prop("checked")) {
					morePaymenVnpayDiv.hide();
					paymentVnpayCheckbox.prop("checked", false);
					paymentBankRadio.prop("checked", true);
				}
				morePaymenBankCheckbox.prop("disabled", true);
				$(".payment-vnpay").addClass("disabled");
				$(".more-paymen-bank").addClass("disabled");
			}
		}

		// Gọi hàm kiểm tra điều kiện khi trang tải xong
		checkTotalAmount();

		// Gọi hàm kiểm tra điều kiện mỗi khi form được ghi nhận
		checkoutForm.on("submit", function() {
			checkTotalAmount();
		});

		paymentVnpayCheckbox.on("change", function() {
			if (paymentVnpayCheckbox.prop("checked")) {
				morePaymenVnpayDiv.show();
				paymentBankRadio.prop("checked", false);
				morePaymenBankDivs.hide();
			} else {
				morePaymenVnpayDiv.hide();
			}
		});

		paymentBankRadio.on("change", function() {
			if (paymentBankRadio.prop("checked")) {
				morePaymenBankDivs.hide();
				$(".more-paymen-bank").eq(paymentBankRadio.index(".more-paymen-bank")).show();
				paymentVnpayCheckbox.prop("checked", false);
				morePaymenVnpayDiv.hide();
			}
		});

		morePaymenBankCheckbox.on("change", function() {
			if (morePaymenBankCheckbox.prop("checked")) {
				morePaymenBankForm.show();
			} else {
				morePaymenBankForm.hide();
			}
		});

		$(".checkbox-payment input[type='checkbox']").on("click", function(event) {
			event.stopPropagation();
			const checkbox = $(this);
			checkbox.prop("checked", !checkbox.prop("checked"));
		});
	});
</script>