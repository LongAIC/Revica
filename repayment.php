<?php
/*
Template Name: Page Thanh toán lại
*/
?>
<?php get_header();
?>

<?php if (isset($_GET['orderID'])):
    $order_id = $_GET['orderID'];
    $order = wc_get_order($order_id);
    $payment_method = $order->get_payment_method();


    $total_ = 0;
    foreach ($order->get_items('fee') as $item_id => $item_fee) {
        $total_ += $item_fee->get_total();
    }


    //thongtinhoadon
    $ten_cong_ty = get_post_meta($order_id, 'ten_cong_ty', true);
    $dia_chi_congty = get_post_meta($order_id, 'dia_chi_congty', true);
    $so_dien_thoai = get_post_meta($order_id, 'so_dien_thoai', true);
    $email_hoadon = get_post_meta($order_id, 'email_hoadon', true);
    $ma_số_thuế = get_post_meta($order_id, 'ma_số_thuế', true);
    ?>
    <input type="hidden" name="ajakUrl" value="<?php echo admin_url('admin-ajax.php'); ?>">
    <input type="hidden" name="priceBox" value="<?php echo $order->get_total(); ?>">
    <main id="main" class="thanh-toan">
        <div id="zek_page_default">
            <div class="container">
                <div class="zek_block_page">
                    <h1 class="zek_pagedefaul_title">Thanh toán lại </h1>
                    <div class="zek_page_content">
                        <div class="content-post clearfix">
                            <div class="content-post-left">
                                <div class="payment-methods">
                                    <h3>Lựa chọn phương thức thanh toán</h3>
                                    <div class="choose-payment-methods">
                                        <div class="payment-vnpay <?php if ($payment_method == 'bankqr') {
                                            echo 'disabled';
                                        } ?>">
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
                                                               value="<?php echo $ten_cong_ty; ?>"
                                                               placeholder="Tên công ty">
                                                        <input type="text" name="dia_chi_congty"
                                                               value="<?php echo $dia_chi_congty; ?>"
                                                               placeholder="Địa chỉ">
                                                    </div>
                                                    <div class="row-form">
                                                        <input type="tel" name="so_dien_thoai"
                                                               value="<?php echo $so_dien_thoai; ?>"
                                                               placeholder="Số điện thoại">
                                                        <input type="email" name="email_hoadon" placeholder="Email"
                                                               value="<?php echo $email_hoadon; ?>">
                                                    </div>
                                                    <div class="row-form row-form-one">
                                                        <input type="text" name="ma_số_thuế"
                                                               value="<?php echo $ma_số_thuế; ?>"
                                                               placeholder="Mã số thuế">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="payment-bank <?php if ($payment_method == 'vnpay') {
                                            echo 'disabled';
                                        } ?>">
                                            <div class="checkbox-payment ">
                                                <input type="radio" id="chuyen-khoan-ngan-hang"
                                                       name="chuyen-khoan-ngan-hang">
                                                <label for="chuyen-khoan-ngan-hang">
                                                    <img class="logo-ck"
                                                         src="<?php echo get_stylesheet_directory_uri() ?>/images/chuyenkhoan.png"/>
                                                    <span>Chuyển khoản ngân hàng</span>
                                                </label>
                                            </div>
                                            <div class="more-paymen-bank <?php if ($total_ == 0) {
                                                echo 'disabled';
                                            }; ?>">
                                                <label for="xuat-hoa-don-cong-ty">
                                                    <input type="checkbox" id="xuat-hoa-don-cong-ty"
                                                           name="xuat-hoa-don-cong-ty">
                                                    <span>Xuất hóa đơn công ty (cho những đơn hàng có giá trị từ 500.000 đ trở lên) </span>
                                                </label>
                                                <div class="form-vat-bank">
                                                    <div class="row-form">
                                                        <input type="text" name="ten_cong_ty"
                                                               value="<?php echo $ten_cong_ty; ?>"
                                                               placeholder="Tên công ty">
                                                        <input type="text" name="dia_chi_congty"
                                                               value="<?php echo $dia_chi_congty; ?>"
                                                               placeholder="Địa chỉ">
                                                    </div>
                                                    <div class="row-form">
                                                        <input type="tel" name="so_dien_thoai"
                                                               value="<?php echo $so_dien_thoai; ?>"
                                                               placeholder="Số điện thoại">
                                                        <input type="email" name="email_hoadon" placeholder="Email"
                                                               value="<?php echo $email_hoadon; ?>">
                                                    </div>
                                                    <div class="row-form row-form-one">
                                                        <input type="text" name="ma_số_thuế"
                                                               value="<?php echo $ma_số_thuế; ?>"
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
                                    $items = $order->get_items();
                                    $total_items = 0; // Tạo một biến để tính tổng số sản phẩm
                                    foreach ($items as $item_id => $item_data) {
                                        $quantity = $item_data->get_quantity();
                                        $total_items += $quantity;
                                    }
                                    ?>
                                    <div class="count-product">
                                        <div class="view-more">
                                            <span>Xem chi tiết</span>
                                            <img class="arrow-icon"
                                                 src="<?php echo get_template_directory_uri() . '/images/chevron-down.svg'; ?>"
                                                 alt="">
                                        </div>

                                    </div>
                                    <div class="list-product">
                                        <?php

                                        $totalPrice = 0;
                                        foreach ($items as $item_id => $item_data) {

                                            $quantity = $item_data->get_quantity();
                                            $product_name = $item_data->get_name();
                                            $product = $item_data->get_product();
                                            $product_price = $product->get_price();
                                            $formatted_price = number_format($product_price * $quantity, 0, '.', '.');
                                            $totalPrice += ($product_price * $quantity);
                                            ?>
                                            <div class="content-product">
                                                <div class="cout-inproduct">
                                                    <?php echo $quantity . 'x'; ?>
                                                </div>
                                                <div class="product-name">
                                                    <?php echo $product_name; ?>
                                                </div>
                                                <div class="product-total">
                                                    <span><?php echo $formatted_price; ?> </span>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        foreach ($order->get_items('fee') as $item_id => $item_fee) {

                                            ?>
                                            <div class="content-product">
                                                <div class="cout-inproduct">
                                                    <?php echo 1 . 'x'; ?>
                                                </div>
                                                <div class="product-name">
                                                    <?php echo $item_fee->get_name(); ?>
                                                </div>
                                                <div class="product-total">
                                                    <span> <?php echo number_format($item_fee->get_total(), 0, '.', '.'); ?> </span>
                                                </div>
                                            </div>

                                        <?php } ?>
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
                                                <div class="content"><?php echo number_format($totalPrice, 0, '.', '.'); ?>
                                                    đ
                                                </div>
                                            </div>

                                            <?php
                                            foreach ($order->get_items('fee') as $item_id => $item_fee) {
                                                ?>

                                                <div class="fees">
                                                    <div class="title">VAT:</div>
                                                    <div class="content"><?php echo number_format($item_fee->get_total(), 0, '.', '.'); ?>
                                                        đ
                                                    </div>
                                                </div>

                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="order-total">
                                        <div class="title"><?php esc_html_e('Tổng cộng:', 'woocommerce'); ?></div>
                                        <div class="content"><?php echo number_format($order->get_total(), 0, '.', '.'); ?>
                                            đ
                                        </div>
                                    </div>
                                    <button id="button-checkout">Tiến hành thanh toán</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php if ($payment_method == 'bankqr'): ?>
        <script>
            jQuery(document).ready(function ($) {
                $(".more-paymen-bank ").show();
                $("#xuat-hoa-don-cong-ty").trigger("click");
                $(".form-vat-bank").show();
                $("#chuyen-khoan-ngan-hang").trigger("click");
                $("#chuyen-khoan-ngan-hang").attr("disabled");
                $("#xuat-hoa-don-cong-ty").prop("checked")
                $(".more-paymen-bank").off('click');
            });
        </script>
    <style>
        .payment-bank .more-paymen-bank>label span::before {
            display: block;
            background-image: url('https://www.revica.org/wp-content/themes/themename/images/checked-checkbox.svg');
            background-size: cover;
            border: none;
        }
        .form-vat-bank{
            display: block !important;
        }
    </style>
<?php endif; ?>

    <style>
        .payment-bank.disabled .checkbox-payment label, .more-paymen-bank.disabled > label {
            opacity: 0.5;
            pointer-events: none;
        }
    </style>
    <!-- Popup Thanh toán Online -->
    <div id="confirmationPopup" class="overlay">
        <div class="popup-content">
            <div class="header-popup">
                <h2>Hoàn tất chuyển khoản</h2>
                <p>Bạn đã hoàn thành bước chuyển khoản chưa?</p>
            </div>
            <div class="button-confirm">
                <button class="closePopupButton">Chưa thanh toán</button>
                <button class="confirm-button">Đã thanh toán</button>
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
                if (!contentVisible) {
                    if (paymentMethod === "thanh-toan-online") {
                        $(this).text("Đang xử lý");

                        contentVisible = false;
                        $pricetotal = $("input[name='priceBox']").val();

                        var data = {
                            action: "updateIVC",
                            orderID: '<?php echo $_GET['orderID']; ?>',

                            //IVC
                            ten_cong_ty: $(".form-vat-vnpay input[name='ten_cong_ty']").val(),
                            dia_chi_congty: $(".form-vat-vnpay input[name='dia_chi_congty']").val(),
                            email_hoadon: $(".form-vat-vnpay input[name='email_hoadon']").val(),
                            so_dien_thoai: $(".form-vat-vnpay input[name='so_dien_thoai']").val(),
                            ma_số_thuế: $(".form-vat-vnpay input[name='ma_số_thuế']").val(),
                        };

                        $.ajax({
                            url: $("input[name='ajakUrl']").val(),
                            type: "POST",
                            data: data,
                            success: function (response) {
                                window.location.href = "<?php echo home_url();?>/repayment/?orderID=<?php echo $_GET['orderID']; ?>&price=" + $pricetotal;
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
            $(document).on('click', '.closePopupButton', function () {
                $("#confirmationPopup").fadeOut();
            })
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
                // const totalAmount = $("input[name='priceBox']").val();
                //
                // if (totalAmount > 500000) {
                //     paymentVnpayCheckbox.prop("disabled", false);
                //     morePaymenBankCheckbox.prop("disabled", false);
                //     $(".payment-vnpay").removeClass("disabled");
                //     $(".more-paymen-bank").removeClass("disabled");
                // } else {
                //     paymentVnpayCheckbox.prop("disabled", true);
                //     if (paymentVnpayCheckbox.prop("checked")) {
                //         morePaymenVnpayDiv.hide();
                //         paymentVnpayCheckbox.prop("checked", false);
                //         paymentBankRadio.prop("checked", true);
                //     }
                //     morePaymenBankCheckbox.prop("disabled", true);
                //     $(".payment-vnpay").addClass("disabled");
                //     $(".more-paymen-bank").addClass("disabled");
                // }
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

                var data = {
                    action: "sendMailforRepayment",
                    orderID: '<?php echo $_GET['orderID']; ?>',

                    //IVC
                    ten_cong_ty: $(".form-vat-bank input[name='ten_cong_ty']").val(),
                    dia_chi_congty: $(".form-vat-bank input[name='dia_chi_congty']").val(),
                    email_hoadon: $(".form-vat-bank input[name='email_hoadon']").val(),
                    so_dien_thoai: $(".form-vat-bank input[name='so_dien_thoai']").val(),
                    ma_số_thuế: $(".form-vat-bank input[name='ma_số_thuế']").val(),
                };

                $.ajax({
                    url: $("input[name='ajakUrl']").val(),
                    type: "POST",
                    data: data,
                    success: function (response) {
                        console.log(response);
                        $(".confirm-button").text("Quản lý đơn hàng");
                        $(".confirm-button").addClass("linkDirect");
                        $(".confirm-button").removeClass("confirm-button");
                        $(".closePopupButton").addClass("active");
                        $(".closePopupButton").text('Trang chủ');
                        $(".header-popup p").html("Chúng tôi sẽ kiểm tra và kích hoạt đơn hàng của bạn trong vòng 24h. Vui lòng kiểm tra email khi có thông báo mới nhất từ Revica");
                        $(".header-popup h2").html('<img src="https://www.revica.org/wp-content/themes/themename/images/checked.png"> Đơn hàng đang được xác nhận ');
                    },
                    error: function (error) {
                        console.log("Error:", error);
                    }
                });
            });

            $(document).on('click', '.linkDirect', function () {
                window.location.href = "https://www.revica.org/manager-order/";
            });

            $(document).on('click', '.closePopupButton.active', function () {
                window.location.href = '<?php echo home_url(); ?>'
            })


            const totalAmountString = $("#order-review .order-total .content").text().trim();
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

<?php else: ?>

    <div class="nof">
        <h2>Không có thông tin đơn hàng</h2>
    </div>
<?php endif; ?>

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

<?php get_footer(); ?>