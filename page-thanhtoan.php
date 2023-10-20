<?php
/*
Template Name: Page Thanh toán
*/
?>
<?php get_header();

$cart = WC()->cart;

?>
<?php if (is_user_logged_in()): ?>


    <?php

    if (!isset($_GET['orderID']) && !isset($_GET['price'])) :
        session_start();
        $userItem = get_user_by('ID', get_current_user_id());
        $order_id = 0;
        if ($_SESSION['orderID'] == 0 || !isset($_SESSION['orderID'])) {
            $order = wc_create_order();
            $order_id = $order->get_id();
            $_SESSION['orderID'] = $order_id;
            $order->set_status('wc-pending');
            $order->save();
        } else {
            $order_id = $_SESSION['orderID'];
        }
    endif;
    ?>

    <input type="hidden" name="billing_address_1"
           value="<?php echo get_user_meta($userItem->data->ID, 'billing_address_1', true); ?>">
    <input type="hidden" name="last_name"
           value="<?php echo get_user_meta($userItem->data->ID, 'billing_last_name', true); ?>">
    <input type="hidden" name="phone_number"
           value="<?php echo get_user_meta($userItem->data->ID, 'billing_phone', true); ?>">
    <input type="hidden" name="email" value="<?php echo get_user_meta($userItem->data->ID, 'billing_email', true); ?>">
    <input type="hidden" name="ajakUrl" value="<?php echo admin_url('admin-ajax.php'); ?>">
    <input type="hidden" name="orderID" value="<?php echo $order_id; ?>">

    <main id="main" class="thanh-toan">
        <div id="zek_page_default">
            <div class="container">
                <div class="zek_block_page">
                    <?php while (have_posts()) : the_post();
                        setPostViews($post->ID); ?>
                        <h1 class="zek_pagedefaul_title"><?php the_title(); ?></h1>
                        <div class="zek_page_content">
                            <div class="content-post clearfix">
                                <div class="content-post-left">
                                    <div class="payment-methods">
                                        <h3>Lựa chọn phương thức thanh toán</h3>
                                        <div class="choose-payment-methods">
                                            <div class="payment-vnpay">
                                                <div class="checkbox-payment">
                                                    <input type="radio" id="thanh-toan-online" name="thanh-toan-online">
                                                    <label for="thanh-toan-online">
                                                        <img class="logo-vnpay"
                                                             src="<?php echo get_stylesheet_directory_uri() ?>/images/logo-vnpay.png"/>
                                                        <span>Thanh toán online qua <img class="vnpay"
                                                                                         src="<?php echo get_stylesheet_directory_uri() ?>/images/vnpay.png"/> (dành cho khách hàng doanh nghiệp có xuất hóa đơn & những đơn hàng có tổng giá trị từ 500.000 đ trở lên)</span>
                                                    </label>
                                                </div>
                                                <a class="huongdan-tt"
                                                   href="https://www.revica.org/huong-dan-thanh-toan-vnpay-tren-website/">Hướng
                                                    dẫn thanh toán VNPAY</a>
                                                <div class="more-paymen-vnpay">
                                                    <p>Xuất hóa đơn công ty (cho những đơn hàng có giá trị từ 500.000 đ
                                                        trở lên)</p>
                                                    <div class="form-vat-vnpay">
                                                        <div class="row-form">
                                                            <input type="text" name="ten_cong_ty"
                                                                   placeholder="Tên công ty">
                                                            <input type="text" name="dia_chi_congty"
                                                                   placeholder="Địa chỉ">
                                                        </div>
                                                        <div class="row-form">
                                                            <input type="tel" name="so_dien_thoai"
                                                                   placeholder="Số điện thoại">
                                                            <input type="email" name="email_hoadon" placeholder="Email">
                                                        </div>
                                                        <div class="row-form row-form-one">
                                                            <input type="text" name="ma_số_thuế"
                                                                   placeholder="Mã số thuế">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="payment-bank">
                                                <div class="checkbox-payment">
                                                    <input type="radio" id="chuyen-khoan-ngan-hang"
                                                           name="chuyen-khoan-ngan-hang">
                                                    <label for="chuyen-khoan-ngan-hang">
                                                        <img class="logo-ck"
                                                             src="<?php echo get_stylesheet_directory_uri() ?>/images/chuyenkhoan.png"/>
                                                        <span>Chuyển khoản ngân hàng</span>
                                                    </label>
                                                </div>
                                                <div class="more-paymen-bank">
                                                    <label for="xuat-hoa-don-cong-ty">
                                                        <input type="checkbox" id="xuat-hoa-don-cong-ty"
                                                               name="xuat-hoa-don-cong-ty">
                                                        <span>Xuất hóa đơn công ty (cho những đơn hàng có giá trị từ 500.000 đ trở lên) </span>
                                                    </label>
                                                    <div class="form-vat-bank">
                                                        <div class="row-form">
                                                            <input type="text" name="ten_cong_ty"
                                                                   placeholder="Tên công ty">
                                                            <input type="text" name="dia_chi_congty"
                                                                   placeholder="Địa chỉ">
                                                        </div>
                                                        <div class="row-form">
                                                            <input type="tel" name="so_dien_thoai"
                                                                   placeholder="Số điện thoại">
                                                            <input type="email" name="email_hoadon" placeholder="Email">
                                                        </div>
                                                        <div class="row-form row-form-one">
                                                            <input type="text" name="ma_số_thuế"
                                                                   placeholder="Mã số thuế">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content-enterprise">
                                        <div class="content-post-enterprise">
                                            <div class="enterprise-left">
                                                <h3>Quý khách hàng vui lòng thanh toán bằng hình thức “Chuyển khoản ngân
                                                    hàng” theo 2 bước dưới đây:</h3>
                                                <div class="step-transfer">
                                                    <div class="step-transfer-1">
                                                        <label><span>Bước 1:</span> Chọn ngân hàng giao dịch</label>
                                                        <div class="bank-name">
                                                            <b>Tên ngân hàng:</b> Ngân hàng Kỹ thương Việt Nam
                                                            (TECHCOMBANK)
                                                        </div>
                                                        <div class="account-number">
                                                            <b>Số tài khoản:</b> <span class="order-stk">338399</span>
                                                            <button class="copy-stk"><img
                                                                        src="<?php echo get_stylesheet_directory_uri() ?>/images/uil_copy.png"/>
                                                            </button>
                                                        </div>
                                                        <div class="account-holder">
                                                            <b>Chủ tài khoản:</b> CTCP DTCN VA PT HN REVICA
                                                        </div>
                                                        <div class="amount-of-money">
                                                            <b>Số tiền:</b>
                                                            <span><?php wc_cart_totals_order_total_html(); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="step-transfer-2">
                                                        <label><span>Bước 2:</span> Sao chép mã đơn hàng và nhập nội
                                                            dung chuyển khoản </label>
                                                        <div class="ma-don-hang">
                                                            Mã đơn hàng: <span
                                                                    class="order-key">RVC<?php echo $order_id; ?></span>
                                                            <button class="copy-button"><img
                                                                        src="<?php echo get_stylesheet_directory_uri() ?>/images/uil_copy.png"/>
                                                            </button>
                                                        </div>
                                                        <div class="transfer-contents">
                                                            <b>Nội dung chuyển khoản:</b> [số điện thoại]_[mã đơn hàng]
                                                        </div>
                                                        <div class="for-example">
                                                            <b>Ví dụ:</b> 0987123456_O29U15K590
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="enterprise-right">
                                                <img class="logo-qrcode-desktop"
                                                     src="<?php echo get_stylesheet_directory_uri() ?>/images/qrcode.png"/>
                                                <img class="logo-qrcode-mobile"
                                                     src="<?php echo get_stylesheet_directory_uri() ?>/images/tech_mobile.png"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content-individual">
                                        <div class="content-post-individual">
                                            <div class="individual-left">
                                                <h3>Quý khách hàng vui lòng thanh toán bằng hình thức “Chuyển khoản ngân
                                                    hàng” theo 2 bước dưới đây:</h3>
                                                <div class="step-transfer">
                                                    <div class="step-transfer-1">
                                                        <label><span>Bước 1:</span> Chọn ngân hàng giao dịch</label>
                                                        <div class="bank-name">
                                                            <b>Tên ngân hàng:</b> Ngân hàng TMCP Tiên Phong (TPBank)
                                                        </div>
                                                        <div class="account-number">
                                                            <b>Số tài khoản:</b> <span
                                                                    class="order-stktp">6715 3168 888</span>
                                                            <button class="copy-stktp"><img
                                                                        src="<?php echo get_stylesheet_directory_uri() ?>/images/uil_copy.png"/>
                                                            </button>
                                                        </div>
                                                        <div class="account-holder">
                                                            <b>Chủ tài khoản:</b> HOANG MANH TRUNG
                                                        </div>
                                                        <div class="amount-of-money">
                                                            <b>Số tiền:</b>
                                                            <span><?php wc_cart_totals_order_total_html(); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="step-transfer-2">
                                                        <label><span>Bước 2:</span> Sao chép mã đơn hàng và nhập nội
                                                            dung chuyển khoản </label>
                                                        <div class="ma-don-hang">
                                                            Mã đơn hàng: <span
                                                                    class="order-key">RVC<?php echo $order_id ?></span>
                                                            <button class="copy-button"><img
                                                                        src="<?php echo get_stylesheet_directory_uri() ?>/images/uil_copy.png"/>
                                                            </button>
                                                        </div>
                                                        <div class="transfer-contents">
                                                            <b>Nội dung chuyển khoản:</b> [số điện thoại]_[mã đơn hàng]
                                                        </div>
                                                        <div class="for-example">
                                                            <b>Ví dụ:</b> 0987123456_O29U15K590
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="individual-right">
                                                <img class="logo-qrcode-desktop"
                                                     src="<?php echo get_stylesheet_directory_uri() ?>/images/tpbank.png"/>
                                                <img class="logo-qrcode-mobile"
                                                     src="<?php echo get_stylesheet_directory_uri() ?>/images/tp_mobile.png"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-post-right">
                                    <div id="order-review">
                                        <h3 id="order_review_heading">Chi tiết hóa đơn</h3>
                                        <?php
                                        $total_items = 0; // Tạo một biến để tính tổng số sản phẩm
                                        do_action('woocommerce_review_order_before_cart_contents');
                                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                                $total_items += $cart_item['quantity']; // Tính tổng số lượng sản phẩm
                                            }
                                        }
                                        ?>
                                        <div class="count-product">
                                            <div class="product-count"><?php echo $total_items . ' sản phẩm'; ?></div>
                                            <div class="view-more">
                                                <span>Xem chi tiết</span>
                                                <img class="arrow-icon"
                                                     src="<?php echo get_template_directory_uri() . '/images/chevron-down.svg'; ?>"
                                                     alt="">
                                            </div>
                                            <a class="thaydoi" href="https://www.revica.org/gio-hang/">Thay đổi</a>
                                        </div>
                                        <div class="list-product">
                                            <?php
                                            // Tiếp tục hiển thị các sản phẩm trong giỏ hàng
                                            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

                                                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                                    ?>
                                                    <div class="content-product">
                                                        <div class="cout-inproduct">
                                                            <?php echo $cart_item['quantity'] . 'x'; ?>
                                                        </div>
                                                        <div class="product-name">
                                                            <?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) . '&nbsp;'; ?>
                                                            <?php echo wc_get_formatted_cart_item_data($cart_item); ?>
                                                        </div>
                                                        <div class="product-total">
                                                            <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="cart-subtotal">
                                            <div class="ma-don-hang">
                                                Mã đơn hàng: <span class="order-key">RVC<?php echo $order_id ?></span>
                                                <button class="copy-button"><img
                                                            src="<?php echo get_stylesheet_directory_uri() ?>/images/uil_copy.png"/>
                                                </button>
                                            </div>
                                            <div class="list-subtotal">
                                                <div class="subtotal">
                                                    <div class="title">Tạm tính:</div>
                                                    <div class="content"><?php wc_cart_totals_subtotal_html(); ?></div>
                                                </div>
                                                <?php
                                                $coupons = WC()->cart->get_coupons();
                                                $has_valid_coupon = false;

                                                foreach ($coupons as $code => $coupon) {
                                                    if ($coupon->is_valid()) {
                                                        $has_valid_coupon = true;
                                                        break;
                                                    }
                                                }
                                                ?>
                                                <div class="cart-discount">
                                                    <div class="title">Giảm giá:</div>
                                                    <div class="content">
                                                        <?php
                                                        if ($has_valid_coupon) {
                                                            foreach ($coupons as $code => $coupon) {
                                                                if ($coupon->is_valid()) {
                                                                    echo '<div class="coupon-' . esc_attr(sanitize_title($code)) . '">';
                                                                    wc_cart_totals_coupon_html($coupon);
                                                                    echo '</div>';
                                                                }
                                                            }
                                                        } else {
                                                            echo '<div class="content">0 ₫</div>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="fee">
                                                    <div class="title">VAT:</div>
                                                    <div class="content">0%</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="order-total">
                                            <div class="title"><?php esc_html_e('Tổng cộng:', 'woocommerce'); ?></div>
                                            <div class="content"><?php echo wc_cart_totals_order_total_html(); ?></div>
                                        </div>
                                        <button id="button-checkout">Tiến hành thanh toán</button>
                                    </div>
                                    <?php if (wc_coupons_enabled()) { ?>
                                        <form class="woocommerce-coupon-form"
                                              action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
                                            <label for="coupon_code"><?php esc_html_e('Mã giảm giá', 'woocommerce'); ?></label>
                                            <div class="coupon">
                                                <input type="text" name="coupon_code" class="input-text"
                                                       id="coupon_code" value=""
                                                       placeholder="<?php esc_attr_e('Nhập mã giảm giá', 'woocommerce'); ?>"/>
                                                <button type="submit" class="button" name="apply_coupon"
                                                        value="<?php esc_attr_e('Áp dụng', 'woocommerce'); ?>"><?php esc_attr_e('Áp dụng', 'woocommerce'); ?></button>
                                                <?php do_action('woocommerce_cart_coupon'); ?>
                                            </div>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </main>
    <!-- Popup Thanh toán Online -->
    <div id="confirmationPopup" class="overlay">
        <div class="popup-content">
            <div class="header-popup">
                <h2>Hoàn tất chuyển khoản</h2>
                <p>Bạn đã hoàn thành bước chuyển khoản chưa?</p>
            </div>
            <div class="button-confirm">
                <button class="closePopupButton">Chưa thanh toán</button>
                <button class="confirm-button ">Đã thanh toán</button>
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function ($) {
            $(".view-more").click(function () {
                $(".list-product").toggle();

                if ($(".list-product").is(":hidden")) {
                    $(this).find('.arrow-icon').removeClass('rotate-icon');
                    $(this).find('span').text("Xem chi tiết");
                } else {
                    $(this).find('.arrow-icon').addClass('rotate-icon');
                    $(this).find('span').text("Thu gọn");
                }
            });


            // Khởi tạo biến kiểm tra
            let contentVisible = false;
            $("#button-checkout").on("click", function (event) {
                event.preventDefault();

                const paymentMethod = $(".checkbox-payment input[type='radio']:checked").attr("id");
                const isXuatHoaDonChecked = $("#xuat-hoa-don-cong-ty").prop("checked");

                console.log(paymentMethod);

                if (!contentVisible) {
                    if (paymentMethod === "thanh-toan-online") {
                        $(this).text("Đang xử lý");
                        contentVisible = false;
                        var data = {
                            action: "createOrderVnpay",
                            //billing
                            billing_address_1: $("input[name='billing_address_1']").val(),
                            last_name: $("input[name='last_name']").val(),
                            phone_number: $("input[name='phone_number']").val(),
                            email: $("input[name='email']").val(),

                            //ivc custommer
                            ten_cong_ty: $(".form-vat-vnpay input[name='ten_cong_ty']").val(),
                            dia_chi_congty: $(".form-vat-vnpay input[name='dia_chi_congty']").val(),
                            email_hoadon: $(".form-vat-vnpay input[name='email_hoadon']").val(),
                            so_dien_thoai: $(".form-vat-vnpay input[name='so_dien_thoai']").val(),
                            ma_số_thuế: $(".form-vat-vnpay input[name='ma_số_thuế']").val(),

                            orderID: $("input[name='orderID']").val(),
                        };
                        $.ajax({
                            url: $("input[name='ajakUrl']").val(),
                            type: "POST",
                            data: data,
                            success: function (response) {
                                window.location.href = response;

                            },
                            error: function (error) {
                                console.log("Error:", error);
                            }
                        });
                    } else if (paymentMethod === "chuyen-khoan-ngan-hang") {

                        $(".payment-methods").hide();
                        $(".content-enterprise").hide();
                        $(".content-individual").show();
                        contentVisible = true;
                        $("#button-checkout").click(function () {
                            $(this).text("Xác nhận thanh toán");
                        });
                    } else {
                        alert("Vui lòng chọn phương thức thanh toán.");
                        contentVisible = false;
                    }

                    if (isXuatHoaDonChecked) {
                        $(".content-enterprise").show();
                        $(".content-individual").hide();
                    }
                } else {
                    $("#confirmationPopup").fadeIn();
                }
            });
        });
        $(document).ready(function () {
            $('.copy-button').on('click', function () {
                var orderKey = $(this).siblings('.order-key').text();
                copyToClipboard(orderKey);
                alert('Đã sao chép mã đơn hàng: ' + orderKey);
            });
            $('.copy-stk').on('click', function () {
                var orderStk = $(this).siblings('.order-stk').text();
                copyToClipboard(orderStk);
                alert('Đã sao chép số tài khoản: ' + orderStk);
            });
            $('.copy-stktp').on('click', function () {
                var orderStktp = $(this).siblings('.order-stktp').text();
                copyToClipboard(orderStktp);
                alert('Đã sao chép số tài khoản: ' + orderStktp);
            });
            $(document).on('click','.closePopupButton.active',function (){
                window.location.href = '<?php echo home_url(); ?>'
            })
            $(document).on('click','.closePopupButton',function (){
                $("#confirmationPopup").fadeOut();
            })
            function copyToClipboard(text) {
                var tempInput = $('<input>');
                $('body').append(tempInput);
                tempInput.val(text).select();
                document.execCommand('copy');
                tempInput.remove();
            }
        });
        $(document).ready(function () {
            const paymentVnpayCheckbox = $("#thanh-toan-online");
            const morePaymenVnpayDiv = $(".more-paymen-vnpay");
            const paymentBankRadio = $("#chuyen-khoan-ngan-hang");
            const morePaymenBankDivs = $(".more-paymen-bank");
            const morePaymenBankCheckbox = $("#xuat-hoa-don-cong-ty");
            const morePaymenBankLabel = $(".more-paymen-bank > label");
            const morePaymenBankForm = $(".form-vat-bank");

            function removeThousandsSeparator(amountString) {
                return parseFloat(amountString.replace(/\./g, "").replace(",", "."));
            }

            function checkTotalAmount() {
                const totalAmountString = $("#order-review .order-total .woocommerce-Price-amount").text().trim();
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

            paymentVnpayCheckbox.on("change", function () {
                if (paymentVnpayCheckbox.prop("checked")) {
                    morePaymenVnpayDiv.show();
                    paymentBankRadio.prop("checked", false);
                    morePaymenBankDivs.hide();
                } else {
                    morePaymenVnpayDiv.hide();
                }
            });

            paymentBankRadio.on("change", function () {
                if (paymentBankRadio.prop("checked")) {
                    morePaymenBankDivs.hide();
                    $(".more-paymen-bank").eq(paymentBankRadio.index(".more-paymen-bank")).show();
                    paymentVnpayCheckbox.prop("checked", false);
                    morePaymenVnpayDiv.hide();
                }
            });

            morePaymenBankCheckbox.on("change", function () {
                if (morePaymenBankCheckbox.prop("checked")) {
                    morePaymenBankForm.show();
                } else {
                    morePaymenBankForm.hide();
                }
            });

            $(".checkbox-payment input[type='checkbox']").on("click", function (event) {
                event.stopPropagation();
                const checkbox = $(this);
                checkbox.prop("checked", !checkbox.prop("checked"));
            });
        });


        jQuery(document).ready(function ($) {


            $(".confirm-button").click(function () {

                $(this).text("Đang xử lý");
                $(this).off('click');


                var Vat = false;
                if ($("input[name='xuat-hoa-don-cong-ty']").is(":checked")) {
                    Vat = true;
                } else {
                    Vat = false;
                }

                var data = {
                    action: "createOrder",
                    vat: Vat,
                    billing_address_1: $("input[name='billing_address_1']").val(),
                    last_name: $("input[name='last_name']").val(),
                    phone_number: $("input[name='phone_number']").val(),
                    email: $("input[name='email']").val(),

                    //INV
                    ten_cong_ty: $(".form-vat-bank input[name='ten_cong_ty']").val(),
                    dia_chi_congty: $(".form-vat-bank input[name='dia_chi_congty']").val(),
                    email_hoadon: $(".form-vat-bank input[name='email_hoadon']").val(),
                    so_dien_thoai: $(".form-vat-bank input[name='so_dien_thoai']").val(),
                    ma_số_thuế: $(".form-vat-bank input[name='ma_số_thuế']").val(),


                    orderID: $("input[name='orderID']").val(),
                };


                $.ajax({
                    url: $("input[name='ajakUrl']").val(),
                    type: "POST",
                    data: data,
                    success: function (response) {
                        $(".confirm-button").addClass("linkDirect");
                        $(".linkDirect").text("Quản lý đơn hàng");
                        $(".confirm-button").removeClass("confirm-button");
                        $(".header-popup p").html("Chúng tôi sẽ kiểm tra và kích hoạt đơn hàng của bạn trong vòng 24h. Vui lòng kiểm tra email khi có thông báo mới nhất từ Revica");
                        $(".closePopupButton").text('Trang chủ');
                        $(".closePopupButton").addClass("active");
                        $(".header-popup h2").html('<img src="https://www.revica.org/wp-content/themes/themename/images/checked.png"> Tạo đơn hàng thành công');
                    },
                    error: function (error) {
                        console.log("Error:", error);
                    }
                });
            });

            $(document).on('click', '.linkDirect', function () {
                window.location.href = "https://www.revica.org/manager-order/";
            });


            const totalAmountString = $("#order-review .order-total .woocommerce-Price-amount").text().trim();
            const totalAmount = parseFloat(totalAmountString.replace(/\./g, "").replace(",", "."));
            let applyVAT = false;

            $(".checkbox-payment input[type='radio'], #xuat-hoa-don-cong-ty").on("change", function () {
                const paymentMethod = $(".checkbox-payment input[type='radio']:checked").attr("id");

                if (paymentMethod === "thanh-toan-online") {
                    applyVAT = true;
                } else if (paymentMethod === "chuyen-khoan-ngan-hang" && !$("#xuat-hoa-don-cong-ty").prop("checked")) {
                    applyVAT = false;
                } else if ($("#xuat-hoa-don-cong-ty").prop("checked")) {

                    applyVAT = true;

                }


                updateTotalAmount();
                updateVATText();
                updateAmountOfMoney();
            });


            $("#xuat-hoa-don-cong-ty, #thanh-toan-online").change(function () {
                var xuatHoaDonCongTyChecked = $("#xuat-hoa-don-cong-ty").prop("checked");
                var thanhToanOnlineChecked = $("#thanh-toan-online").prop("checked");

                if (xuatHoaDonCongTyChecked || thanhToanOnlineChecked) {
                    $(".cart-subtotal .fee").css("display", "flex");
                } else {
                    $(".cart-subtotal .fee").css("display", "none");
                }
            });

            function updateTotalAmount() {
                let newTotalAmount = totalAmount;
                if (applyVAT) {
                    const vatAmount = totalAmount * <?php echo get_field("vat", 'option') * 0.01 ?>;
                    newTotalAmount += vatAmount;
                }

                $newprice = newTotalAmount.toLocaleString();
                $("#order-review .order-total .woocommerce-Price-amount").text($newprice.replaceAll(",", ".") + " ₫ ");
            }

            function changeValidatePrice() {

                let MainPrice = totalAmount;
                $price = MainPrice.toLocaleString();
                $("#order-review .order-total .woocommerce-Price-amount").text($price.replaceAll(",", ".") + " ₫ ");
            }

            function updateVATText() {
                const vatText = applyVAT ? " <?php echo get_field("vat", 'option'); ?>%" : " 0%";
            }

            function updateAmountOfMoney() {
                let newTotalAmount = totalAmount;
                if (applyVAT) {
                    const vatAmount = totalAmount * <?php echo get_field("vat", 'option') * 0.01 ?>;
                    $newprice = vatAmount.toLocaleString();
                    $(".fee .content").text($newprice.replaceAll(",", ".") + " ₫" + ' (<?php echo get_field("vat", 'option') ?>%)');
                    newTotalAmount += vatAmount;

                }
                $newprice = newTotalAmount.toLocaleString();
                $(".amount-of-money span").text($newprice.replaceAll(",", ".") + " ₫");
            }

            updateTotalAmount();
            updateVATText();
            updateAmountOfMoney();
            changeValidatePrice();

        });
    </script>

    <?php if (isset($_GET['orderID']) && isset($_GET['price'])) :

        global $woocommerce;
        $woocommerce->cart->empty_cart();
        ?>
        <script>
            window.onload = function () {
                window.location.href = "<?php echo createLinkCheckoutVNpay($_GET['orderID'], $_GET['price']); ?>";
            };
        </script>
    <?php endif; ?>


<?php else: ?>

    <div id="confirmationPopup" class="overlay popup-dangky">
        <div class="popup-content">
            <div class="header-popup">
                <h2>
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/images/notice.svg"/>
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

    <script>
        jQuery(document).ready(function ($) {
            const popup = $('#confirmationPopup');
            const popupContent = $('.popup-content');
            const overlay = $('.overlay');
            const isLoggedIn = <?php echo is_user_logged_in() ? 'true' : 'false'; ?>;

            if (isLoggedIn) {
                window.location.href = 'thanh-toan';
            } else {
                popup.fadeIn();
                overlay.fadeIn();
            }

            overlay.click(function () {
                popup.fadeOut();
                overlay.fadeOut();
            });

            popupContent.click(function (event) {
                event.stopPropagation();
            });
        });
    </script>
<?php endif; ?>


<?php get_footer(); ?>