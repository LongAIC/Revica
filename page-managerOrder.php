<?php
/*
Template Name: Page Quản lý đơn hàng
*/
?>
<?php get_header(); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/managerOrder.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<?php


if (class_exists('WooCommerce')) {
    $current_user = wp_get_current_user();
     $current_user->display_name;
    $user_id = get_current_user_id();
    $avatar = get_avatar($user_id, 90);
    $user_display_name = get_the_author_meta('display_name', $user_id);

if ($current_user->ID !== 0) {

    $qty = 10;
    $page = 1;
    if(isset($_GET['qty'])){
        $qty = $_GET['qty'];
    }
    if(isset($_GET['pages'])){
        $page = $_GET['pages'];
    }

    $resultsPost = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT mt.post_id FROM {$wpdb->prefix}postmeta mt INNER JOIN {$wpdb->prefix}posts wp ON mt.post_id = wp.ID WHERE mt.meta_key = %s AND wp.post_status IN ('publish','wc-pending', 'wc-completed', 'processing', 'wc-processing', 'wc-failed') AND mt.meta_value = %d",
            '_customer_user',
            get_current_user_id(),
        ),
        ARRAY_A
    );
     $qtyCount= count($resultsPost);
    if($qtyCount < $qty){
        $page = 0;
    }

    $numberofpage = ceil((int)$qtyCount / (int)$qty);
    if($numberofpage < 1){
        $numberofpage = 1;
    }
    if($page <= 0){
        $page = 0;
    }
    else{
    $page = (int)$qty * ((int)$page - 1);
    }
    if($qtyCount < $_GET['qty'] ){
        $page = 0;
    }

    global $wpdb;
    $results = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT mt.post_id FROM {$wpdb->prefix}postmeta mt INNER JOIN {$wpdb->prefix}posts wp ON mt.post_id = wp.ID WHERE mt.meta_key = %s AND wp.post_status IN ('publish', 'wc-pending', 'wc-completed', 'processing', 'wc-processing','wc-failed') AND mt.meta_value = %d ORDER BY wp.post_date DESC LIMIT %d , %d",
            '_customer_user',
            get_current_user_id(),
            $page,
            $qty
        ),
        ARRAY_A
    );

    $resultsA = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT post_status FROM {$wpdb->prefix}posts WHERE post_type = %s" ,
            'shop_order',
        )
        ,ARRAY_A);
    ?>
    <div class="managerOrder">
        <div class="order_main">
            <div class="order_tab">
                <div class="user_account_space">
                    <?php
                    $user = wp_get_current_user();
                    $custom_avatar = get_user_meta($user->ID, 'custom_avatar', true);
                    if ($custom_avatar) {
                        echo '<img src="' . esc_url($custom_avatar) . '" class="custom_avatar" />';
                    } else {
                        echo '<img src="' . esc_url(get_avatar_url($user->ID)) . '" class="custom_avatar" />';
                    }
                    ?>
                    <span>Hello, <?php echo $user_display_name; ?></span>
                </div>
                <a id="tab-donhang" class="order_tab_header order_active_tab">
                    <svg width="28" height="28" viewbox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.5 8.75H24.5L23.3333 24.5H4.66667L3.5 8.75Z" stroke="#178D9C" stroke-width="2"
                              stroke-linejoin="round"/>
                        <path d="M9.33301 11.0833V3.5H18.6663V11.0833" stroke="#178D9C" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9.33301 19.8333H18.6663" stroke="#178D9C" stroke-width="2" stroke-linecap="round"/>
                        <path d="M9.33301 15.75H18.6663" stroke="#178D9C" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <span>Quản lý đơn hàng & Thanh toán</span>
                </a>
                <a id="tab-taikhoan" class="order_tab_header">
                    <svg width="26" height="26" viewbox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_21_43535)">
                            <path d="M13 16.25C14.7949 16.25 16.25 14.7949 16.25 13C16.25 11.2051 14.7949 9.75 13 9.75C11.2051 9.75 9.75 11.2051 9.75 13C9.75 14.7949 11.2051 16.25 13 16.25Z"
                                  stroke="#178D9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M21.0163 16.25C20.8721 16.5768 20.8291 16.9392 20.8928 17.2906C20.9566 17.6421 21.1241 17.9664 21.3738 18.2217L21.4388 18.2867C21.6403 18.4879 21.8001 18.7269 21.9091 18.9899C22.0182 19.2529 22.0743 19.5349 22.0743 19.8196C22.0743 20.1043 22.0182 20.3863 21.9091 20.6493C21.8001 20.9123 21.6403 21.1513 21.4388 21.3525C21.2376 21.554 20.9987 21.7138 20.7356 21.8228C20.4726 21.9318 20.1907 21.988 19.9059 21.988C19.6212 21.988 19.3392 21.9318 19.0762 21.8228C18.8132 21.7138 18.5742 21.554 18.373 21.3525L18.308 21.2875C18.0527 21.0378 17.7284 20.8702 17.377 20.8065C17.0255 20.7428 16.6631 20.7858 16.3363 20.93C16.0159 21.0673 15.7427 21.2954 15.5502 21.586C15.3577 21.8767 15.2544 22.2172 15.253 22.5658V22.75C15.253 23.3246 15.0247 23.8757 14.6184 24.2821C14.2121 24.6884 13.661 24.9167 13.0863 24.9167C12.5117 24.9167 11.9606 24.6884 11.5543 24.2821C11.1479 23.8757 10.9197 23.3246 10.9197 22.75V22.6525C10.9113 22.2939 10.7952 21.9462 10.5866 21.6544C10.3779 21.3627 10.0863 21.1405 9.74967 21.0167C9.42292 20.8725 9.06046 20.8295 8.70904 20.8932C8.35761 20.9569 8.03333 21.1244 7.77801 21.3742L7.71301 21.4392C7.51178 21.6406 7.27282 21.8004 7.00979 21.9095C6.74677 22.0185 6.46482 22.0746 6.18009 22.0746C5.89536 22.0746 5.61342 22.0185 5.35039 21.9095C5.08736 21.8004 4.8484 21.6406 4.64717 21.4392C4.44573 21.238 4.28591 20.999 4.17688 20.736C4.06784 20.4729 4.01172 20.191 4.01172 19.9063C4.01172 19.6215 4.06784 19.3396 4.17688 19.0766C4.28591 18.8135 4.44573 18.5746 4.64717 18.3733L4.71217 18.3083C4.96192 18.053 5.12946 17.7287 5.19318 17.3773C5.2569 17.0259 5.21388 16.6634 5.06967 16.3367C4.93235 16.0163 4.70433 15.743 4.41368 15.5505C4.12303 15.358 3.78244 15.2547 3.43384 15.2533H3.24967C2.67504 15.2533 2.12394 15.0251 1.71761 14.6187C1.31128 14.2124 1.08301 13.6613 1.08301 13.0867C1.08301 12.512 1.31128 11.9609 1.71761 11.5546C2.12394 11.1483 2.67504 10.92 3.24967 10.92H3.34717C3.70575 10.9116 4.05351 10.7956 4.34525 10.5869C4.63698 10.3782 4.8592 10.0866 4.98301 9.75001C5.12722 9.42326 5.17023 9.0608 5.10651 8.70937C5.04279 8.35794 4.87526 8.03366 4.62551 7.77834L4.56051 7.71334C4.35906 7.51212 4.19925 7.27316 4.09021 7.01013C3.98118 6.7471 3.92505 6.46516 3.92505 6.18043C3.92505 5.89569 3.98118 5.61375 4.09021 5.35072C4.19925 5.08769 4.35906 4.84873 4.56051 4.64751C4.76173 4.44606 5.00069 4.28625 5.26372 4.17721C5.52675 4.06818 5.80869 4.01206 6.09342 4.01206C6.37816 4.01206 6.6601 4.06818 6.92313 4.17721C7.18616 4.28625 7.42512 4.44606 7.62634 4.64751L7.69134 4.71251C7.94666 4.96226 8.27094 5.12979 8.62237 5.19351C8.9738 5.25724 9.33626 5.21422 9.66301 5.07001H9.74967C10.0701 4.93268 10.3434 4.70466 10.5358 4.41401C10.7283 4.12337 10.8316 3.78278 10.833 3.43418V3.25001C10.833 2.67537 11.0613 2.12427 11.4676 1.71795C11.8739 1.31162 12.425 1.08334 12.9997 1.08334C13.5743 1.08334 14.1254 1.31162 14.5317 1.71795C14.9381 2.12427 15.1663 2.67537 15.1663 3.25001V3.34751C15.1677 3.69611 15.271 4.0367 15.4635 4.32735C15.656 4.618 15.9293 4.84602 16.2497 4.98334C16.5764 5.12755 16.9389 5.17057 17.2903 5.10685C17.6417 5.04313 17.966 4.87559 18.2213 4.62584L18.2863 4.56084C18.4876 4.35939 18.7265 4.19958 18.9896 4.09055C19.2526 3.98151 19.5345 3.92539 19.8193 3.92539C20.104 3.92539 20.3859 3.98151 20.649 4.09055C20.912 4.19958 21.1509 4.35939 21.3522 4.56084C21.5536 4.76207 21.7134 5.00103 21.8225 5.26406C21.9315 5.52709 21.9876 5.80903 21.9876 6.09376C21.9876 6.37849 21.9315 6.66043 21.8225 6.92346C21.7134 7.18649 21.5536 7.42545 21.3522 7.62668L21.2872 7.69168C21.0374 7.947 20.8699 8.27128 20.8062 8.62271C20.7424 8.97413 20.7855 9.33659 20.9297 9.66334V9.75001C21.067 10.0704 21.295 10.3437 21.5857 10.5362C21.8763 10.7287 22.2169 10.832 22.5655 10.8333H22.7497C23.3243 10.8333 23.8754 11.0616 24.2817 11.4679C24.6881 11.8743 24.9163 12.4254 24.9163 13C24.9163 13.5746 24.6881 14.1257 24.2817 14.5321C23.8754 14.9384 23.3243 15.1667 22.7497 15.1667H22.6522C22.3036 15.1681 21.963 15.2714 21.6723 15.4638C21.3817 15.6563 21.1537 15.9296 21.0163 16.25Z"
                                  stroke="#178D9C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                            <clippath id="clip0_21_43535">
                                <rect width="26" height="26" fill="white"/>
                            </clippath>
                        </defs>
                    </svg>
                    <span>Thông tin tài khoản</span>
                </a>
            </div>
            <div id="content-donhang" class="order_tab_content order_active_content order_table">
                <div class="order_head">
                    <div class="right_head">
                        <h2>Quản lý đơn hàng & Thanh toán</h2>
                        <?php
                        $jwt = create_JWT($user_id);
                        $linkDashboard = get_field('domain_dashboard', 'option');
                        $linkRedirect = $linkDashboard . "/route?token=" . $jwt . "&redirect_url=" . $linkDashboard . '/route/test-now' . "&callback_url=" . home_url();
                        ?>
                        <a href="<?php echo $linkRedirect; ?>">
                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 12L19 12" stroke="white" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                            <b>Làm test ngay</b>
                        </a>
                    </div>
                </div>
                <div class="order_table">
                    <div class="order_heading">
                        <h3>Đơn hàng/Sản phẩm</h3>
                        <h3>Ngày tạo</h3>
                        <h3>Số lượng</h3>
                        <h3>Mã giảm giá</h3>
                        <h3>Giá</h3>
                        <h3>Trạng thái</h3>
                        <h3>Hành động</h3>
                    </div>
                    <?php
                    foreach ($results as $orders) {

                        $order = wc_get_order($orders['post_id']);
                        $order_id = $order->get_id();
                        $order_status = $order->get_status();
                        $order_discounts = $order->get_items('coupon');
                        $order_pro = wc_get_order($order_id);
                        $total_quantity = 0;
                        if ($order_pro) {
                            $items = $order_pro->get_items();
                            foreach ($items as $item_id => $item_data) {
                                $quantity = $item_data->get_quantity();
                                $total_quantity += $quantity; // Cộng dồn số lượng sản phẩm
                            }
                        }
                        ?>
                        <div class="box_extend">
                            <div class="productcode_column">
                                <span style="display: flex;justify-content: start;">RVC<?php echo $order->get_order_number(); ?></span>
                                <span><?php echo $order->get_date_created()->format('d/m/Y'); ?></span>
                                <span><?php echo $total_quantity; ?></span>
                                <span class="coupon-item">
                                        <?php
                                        if (!empty($order_discounts)) {
                                            foreach ($order_discounts as $coupon_item) {
                                                $coupon_code = $coupon_item->get_code();
                                                echo $coupon_code . " , ";
                                            }
                                        } else {
                                            echo '<b></b>';
                                        }
                                        ?>
                                    </span>
                                <span>
                                        <?php
                                        $order_total = $order->get_total();
                                        $formatted_order_total = number_format($order_total, 0, '.', '.');
                                        ?>
                                    <?php echo $formatted_order_total; ?> ₫
                                    </span>
                                <span class="statusname <?php
                                if ($order_status === "pending" || $order_status === "on-hold" || $order_status === "processing") {
                                    echo "waiting";
                                } else if ($order_status === "completed") {
                                    echo "pay_succeed";
                                } else if ($order_status === "unsucceed" || $order_status === "failed") {
                                    echo "unsucceed";
                                }

                                ?>">

                                    <?php  if( wc_get_order_status_name($order_status) == 'Thất bại') { echo 'Thất bại';}else{ echo wc_get_order_status_name($order_status); }  ?>

                                </span>
                                <span class="action">Chi tiết</span>
                            </div>
                            <div class="childoforder">
                                <div class="childextend">
                                    <?php
                                    if ($order_pro) {
                                        $items = $order_pro->get_items();
                                        foreach ($items as $item_id => $item_data) {
                                            $product_name = $item_data->get_name();
                                            echo '<div class="extend">';
                                            echo "<span>  " . $product_name . "</span>";
                                            echo "<span>" . $order->get_date_created()->format('d/m/Y') . "</span>";
                                            echo "<span>" . $quantity = $item_data->get_quantity() . "</span>";
                                            echo "<span>" . "</span>";

                                            $quantity = $item_data->get_quantity();
                                            $product = $item_data->get_product();
                                            $product_price = $product->get_price();

                                            $formatted_price = number_format($product_price * $quantity, 0, '.', '.');
                                            echo "<span>" . $formatted_price . " ₫" . "</span>";
                                            echo "<span>" . "</span>";
                                            if ($order_status === "completed") {
                                                $jwt = create_JWT($user_id);
                                                $linkDashboard = get_field('domain_dashboard', 'option');
                                                $linkRedirect = $linkDashboard . "/route?token=" . $jwt . "&redirect_url=" . $linkDashboard . '/route/test-now/' . get_product_sku_by_slug($product->slug) . "&callback_url=" . home_url();

                                                echo '<a href=' . $linkRedirect . ' class="start_test">Làm test ngay</a>';

                                            }
                                            else if($order_status === "pending"){
                                                $linkCheckout = home_url()."/repayment/?orderID=".$order_id;
                                                echo '<a href='.$linkCheckout.' class="start_test">Thanh toán lại</a>';
                                            }
                                            else {
                                                echo '<span class="start_test"></span>';
                                            }

                                            echo "</div>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>  
                        </div>  
                    <?php } ?>
                    <div class="box_phan_trang">
                            <p>Lưu ý: Những đơn hàng không thực hiện thanh toán thành công sẽ bị xóa sau 30 ngày</p>
                            <div class="phan_trang">
                            <div class="number_phan_trang">
                                <a id="phan_trang_trai" href="<?php 
                                $back = $_GET['pages'] - 1;
                                if($back <= 0)
                                {
                                    echo NULL;
                                }
                                else{
                                echo home_url(); ?>/manager-order/?qty=<?php echo $qty ?>&pages=<?php echo $_GET['pages'] - 1 ;
                                }
                                ?>"><svg style="transform: rotate(180deg);" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M6 13.5L10.5 9L6 4.5" stroke="#828282" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg></a>
                                <!-- <div class="number">
                                    <a class="active" data-qty="1" href="<?php echo home_url(); ?>/manager-order/?qty=<?php echo $qty ?>&pages=1">1</a>
                                    <?php
                                        for( $i=2; $i<=$numberofpage; $i++){
                                            ?>
                                            <a data-qty="<?php echo $i ?>" href="<?php echo home_url(); ?>/manager-order/?qty=<?php echo $qty ?>&pages=<?php echo $i ?>"><?php echo $i ?></a>
                                            <?php
                                        }
                                    ?>
                                </div> -->
                                <div class="number">
                                    <?php
                                    $currentPage = $_GET['pages'];
                                    if ($numberofpage > 5) {
                                        echo '<a data-qty="1" href="' . home_url() . '/manager-order/?qty=' . $qty . '&pages=1">1</a>';
                                        echo '<a data-qty="2" href="' . home_url() . '/manager-order/?qty=' . $qty . '&pages=2">2</a>';
                                        if ($currentPage == 2) {
                                            echo '<a data-qty="3" href="' . home_url() . '/manager-order/?qty=' . $qty . '&pages=3">3</a>'; 
                                        }
                                        if ($currentPage >= 5) {
                                            echo '<span>...</span>';
                                        }
                                        if ($currentPage == 3) {
                                            echo '<a data-qty="3" href="' . home_url() . '/manager-order/?qty=' . $qty . '&pages=3">3</a>'; 
                                            echo '<a data-qty="4" href="' . home_url() . '/manager-order/?qty=' . $qty . '&pages=4">4</a>';
                                        }
                                        
                                        if ($currentPage >= 4 && $currentPage < $numberofpage - 1) {
                                            echo '<a data-qty="' . ($currentPage - 1) . '" href="' . home_url() . '/manager-order/?qty=' . $qty . '&pages=' . ($currentPage - 1) . '">' . ($currentPage - 1) . '</a>';
                                            echo '<a class="active" data-qty="' . $currentPage . '" href="' . home_url() . '/manager-order/?qty=' . $qty . '&pages=' . $currentPage . '">' . $currentPage . '</a>';
                                            
                                            echo '<a data-qty="' . ($currentPage + 1) . '" href="' . home_url() . '/manager-order/?qty=' . $qty . '&pages=' . ($currentPage + 1) . '">' . ($currentPage + 1) . '</a>';
                                        }
                                        if($currentPage == $numberofpage - 1){
                                            echo '<a data-qty="' . ($currentPage - 1) . '" href="' . home_url() . '/manager-order/?qty=' . $qty . '&pages=' . ($currentPage - 1) . '">' . ($currentPage - 1) . '</a>';
                                            echo '<a class="active" data-qty="' . $currentPage . '" href="' . home_url() . '/manager-order/?qty=' . $qty . '&pages=' . $currentPage . '">' . $currentPage . '</a>';
                                        }
                                        
                                        if ($currentPage < $numberofpage - 2) {
                                            echo '<span>...</span>';
                                        }
                                        if ($currentPage == $numberofpage){
                                            echo '<a data-qty="' . ($currentPage - 1) . '" href="' . home_url() . '/manager-order/?qty=' . $qty . '&pages=' . ($currentPage - 1) . '">' . ($currentPage - 1) . '</a>';
                                        }
                                        echo '<a data-qty="' . $numberofpage . '" href="' . home_url() . '/manager-order/?qty=' . $qty . '&pages=' . $numberofpage . '">' . $numberofpage . '</a>';
                                    } else {
                                        for ($i = 2; $i <= $numberofpage; $i++) {
                                            echo '<a data-qty="' . $i . '" href="' . home_url() . '/manager-order/?qty=' . $qty . '&pages=' . $i . '">' . $i . '</a>';
                                        }
                                    }
                                    ?>
                                </div>





                                <a id="phan_trang_phai" href="<?php 
                                $next = $_GET['pages'] + 1;
                                if($next > $numberofpage)
                                {
                                    echo NULL;
                                }
                                else{
                                echo home_url(); ?>/manager-order/?qty=<?php echo $qty ?>&pages=<?php echo $_GET['pages'] + 1 ;
                                }
                                ?>" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M6 13.5L10.5 9L6 4.5" stroke="#828282" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg></a>
                            </div>
                            <div class="san_pham_trang">
                                <div class="select_so_trang" id="select_so_trang"><?php echo $qty ?> / Trang</div>
                                <div id="box_select">
                                    <div class="box_select">

                                        <a class="active" data-pages="10" href="<?php echo home_url(); ?>/manager-order/?qty=10&pages=1">10 / Trang</a>

                                        <a data-pages="20" href="<?php echo home_url(); ?>/manager-order/?qty=20&pages=1">20 / Trang</a>

                                        <a data-pages="50" href="<?php echo home_url(); ?>/manager-order/?qty=50&pages=1">50 / Trang</a>

                                        <a data-pages="100" href="<?php echo home_url(); ?>/manager-order/?qty=100&pages=1">100 / Trang</a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        </div>    
                        <script>
                            $(document).ready(function() {
                                $('.number a').each(function() {
                                    if($(this).attr('data-qty') == '<?php echo $_GET['pages']; ?>'){
                                        $('.number a').removeClass("active");
                                        $(this).addClass("active");
                                    }                         
                                });
                            });
                            $(document).ready(function() {
                                $('.box_select a').each(function() {
                                    if($(this).attr('data-pages') == '<?php echo $_GET['qty']; ?>'){
                                        $('.box_select a').removeClass("active");
                                        $(this).addClass("active");
                                    }                            
                                });
                            });
                            $("#select_so_trang").click(function(){
                                if($(this).hasClass("active")){
                                    $("#box_select").hide();
                                    $(this).removeClass("active");
                                }
                                else{
                                    $("#box_select").show();
                                    $(this).addClass("active");
                                }
                            });
                            $(document).on("click", function(event) {
                            var target = event.target;
                            if (!$(target).closest("#select_so_trang").length) {
                                $("#box_select").hide();
                                $("#select_so_trang").removeClass("active");
                            }
                        });
                        </script>     
                    <?php 
                    } else {
                        echo 'Người dùng chưa đăng nhập';
                    }
                    } else {
                        echo 'WooCommerce chưa được cài đặt hoặc kích hoạt';
                    }
                    ?>
                </div>
            </div>
            <div id="content-taikhoan" class="order_tab_content">
                <div class="header-account">
                    <h2 class="title-head">Thông tin tài khoản</h2>
                    <p class="sub-title-head">Thông tin cá nhân của người dùng</p>
                </div>
                <div id="login-success-popup">
                    <?php
                    $user_id = get_current_user_id();
                    $current_user = wp_get_current_user();
                    $updated = false;

                    if (isset($_POST['user_profile_nonce_field']) && wp_verify_nonce($_POST['user_profile_nonce_field'], 'user_profile_nonce')) {

                        /* Update thông tin user. */

                        if (!empty($_POST['last_name'])) {
                            update_user_meta($current_user->ID, 'last_name', sanitize_text_field($_POST['last_name']));
                        }

                        if (!empty($_POST['tel']) && $_POST['tel'] != $current_user->tel) {
                            update_user_meta($current_user->ID, 'phone_number', sanitize_text_field($_POST['tel']));
                        }

                        if (!empty($_POST['dateOfBirth']) && $_POST['dateOfBirth'] != $current_user->dateOfBirth) {
                            $formatted_date = DateTime::createFromFormat('d/m/Y', $_POST['dateOfBirth']);
                            $formatted_date_str = $formatted_date ? $formatted_date->format('d/m/Y') : '';
                            update_user_meta($current_user->ID, 'date_of_birth', $formatted_date_str);
                        }

                        if (!empty($_POST['user_profession'])) {
                            update_user_meta($current_user->ID, 'user_profession', sanitize_text_field($_POST['user_profession']));
                        }

                        if (!empty($_POST['user_email']) && $_POST['user_email'] !== $current_user->user_email) {
                            // Cập nhật trường user_email mới
                            update_user_meta($user_id, 'user_email', sanitize_email($_POST['user_email']));
                        }
                        if (!empty($_POST['user_email']) && $_POST['user_email'] !== $current_user->user_email) {
                            $existing_user = get_user_by('email', $_POST['user_email']);
                            if (!$existing_user) {
                                update_user_meta($user_id, 'user_email', sanitize_email($_POST['user_email']));
                            }
                        }

                        if (isset($_POST['reset_avatar'])) {
                            delete_user_meta($user_id, 'custom_avatar');
                        } elseif (isset($_FILES['upload_avatar'])) {
                            $file_upload = $_FILES['upload_avatar'];
                            $avatar_data = array();
                            if (isset($file_upload['error']) && $file_upload['error'] === 0) {
                                $file_extension = strtolower(pathinfo($file_upload['name'], PATHINFO_EXTENSION));
                                $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
                                $allowed_size = 800 * 1024; // 800kB in bytes

                                if (in_array($file_extension, $allowed_extensions) && $file_upload['size'] <= $allowed_size) {
                                    $avatar_data = hk_user_upload_image($file_upload);
                                    if ($avatar_data) {
                                        update_user_meta($user_id, 'custom_avatar', $avatar_data['url']);
                                    }
                                }
                            }
                        }
                    }
                    ?>
                    <?php if ($updated) : ?>
                        <p style="color:#DBA21E;">Cập nhật thông tin thành công.</p>
                    <?php endif; ?>
                    <form role="form" action="" id="user_edit" method="POST" enctype="multipart/form-data">
                        <?php wp_nonce_field('user_profile_nonce', 'user_profile_nonce_field'); ?>
                        <div class="form-group-row-avatar">
                            <label for="avatar">Ảnh đại diện</label>
                            <div class="form-group-avatar">
                                <?php
                                $user = wp_get_current_user();
                                $custom_avatar = get_user_meta($user->ID, 'custom_avatar', true);
                                if ($custom_avatar) {
                                    echo '<img src="' . esc_url($custom_avatar) . '" class="custom_avatar" />';
                                } else {
                                    echo '<img src="https://secure.gravatar.com/avatar/1f7a733722a526862fa3ae6d50bb1686?s=96&d=mm&r=g" class="custom_avatar" />';
                                }
                                ?>
                                <div class="button-avatar">
                                    <div class="two-button-avatar">
                                        <button type="button" name="reset_avatar" class="btn reset_avatar">Đặt lại
                                        </button>
                                        <div class="upload-file">
                                            <span>Tải lên</span>
                                            <input type="file" name="upload_avatar" id="upload_avatar" accept="image/*">

                                            <script>
                                                $('#upload_avatar').on('change', function (e) {
                                                    var fileInput = e.target;
                                                    if (fileInput.files && fileInput.files[0]) {
                                                        var reader = new FileReader();
                                                        reader.onload = function (e) {
                                                            var fileUrl = e.target.result;
                                                            console.log('File URL:', fileUrl);
                                                            // Tại đây, bạn có thể làm gì đó với fileUrl, ví dụ: hiển thị hình ảnh trước khi tải lên
                                                            $(".custom_avatar").attr('src', fileUrl);
                                                            localStorage.setItem("avatar", fileUrl);
                                                            $(".avatar").attr('src', fileUrl);
                                                        };
                                                        reader.readAsDataURL(fileInput.files[0]);
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    <span>Hợp lệ với JPG, GIF hoặc PNG. Kích thước tối đa 800kB</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group-row">
                            <div class="form-group">
                                <label for="nickname">Tên đầy đủ</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                       placeholder="Chưa lưu"
                                       value="<?php echo esc_attr($current_user->last_name); ?>"
                                       required oninvalid="setCustomValidity('Vui lòng điền Tên đầy đủ')"
                                       oninput="setCustomValidity('')">
                            </div>
                            <div class="form-group">
                                <label for="nickname">User name</label>
                                <input type="text" class="form-control disable-btn" id="user_login" name="user_login"
                                       value="<?php echo esc_attr($current_user->user_login); ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group-row">
                            <div class="form-group">
                                <label for="tel">Số điện thoại</label>
                                <input type="tel" class="form-control" id="tel" oninput="validateNumberInput(this)"
                                       name="tel" placeholder="Chưa lưu"
                                       value="<?php echo get_user_meta(get_current_user_id(), 'phone_number', true); ?>"
                                       required
                                       oninvalid="setCustomValidity('Vui lòng điền Số điện thoại')"
                                       oninput="setCustomValidity('')">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <?php
                                $user_data = get_userdata($current_user->ID);
                                $user_email = $user_data->user_email;
                                $is_email_filled = !empty($user_email);
                                ?>
                                <input type="email"
                                       class="form-control <?php echo $is_email_filled ? 'disable-btn' : ''; ?>"
                                       id="user_email" name="user_email" placeholder="Chưa lưu"
                                       value="<?php echo esc_attr($user_email); ?>" <?php echo $is_email_filled ? 'disabled' : ''; ?>
                                       required oninvalid="setCustomValidity('Vui lòng điền Email')"
                                       oninput="setCustomValidity('')">
                            </div>
                        </div>
                        <div class="form-group-row">
                            <div class="form-group">
                                <label for="customerType">Nghề nghiệp</label>
                                <select class="form-control" name="user_profession" id="user_profession">
                                    <option value="Học sinh" <?php echo (get_user_meta($current_user->ID, 'user_profession', true) === 'Học sinh') ? 'selected' : ''; ?>>
                                        Học sinh
                                    </option>
                                    <option value="Sinh viên" <?php echo (get_user_meta($current_user->ID, 'user_profession', true) === 'Sinh viên') ? 'selected' : ''; ?>>
                                        Sinh viên
                                    </option>
                                    <option value="Người đi làm" <?php echo (get_user_meta($current_user->ID, 'user_profession', true) === 'Người đi làm') ? 'selected' : ''; ?>>
                                        Người đi làm
                                    </option>
                                    <option value="Phụ huynh" <?php echo (get_user_meta($current_user->ID, 'user_profession', true) === 'Phụ huynh') ? 'selected' : ''; ?>>
                                        Phụ huynh
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dateOfBirth">Ngày sinh</label>
                                <?php
                                    $user_data = get_userdata($current_user->ID);
                                    $date_of_birth = get_user_meta($current_user->ID, 'date_of_birth', true);
                                ?>
                                <input type="text" class="form-control" name="dateOfBirth" id="dateOfBirth" placeholder="Ngày sinh" value="<?php echo esc_attr($date_of_birth); ?>" required oninvalid="setCustomValidity('Vui lòng điền Ngày sinh')" oninput="setCustomValidity('')">
                            </div>
                        </div>
                        <div class="form-group-submit">
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                        </div>
                    </form>
                    <script>
                        function validateNumberInput(input) {
                            // Loại bỏ các ký tự không phải số
                            input.value = input.value.replace(/[^0-9]/g, '');
                        }
                    </script>
                </div>
                <div class="user-change-password">
                    <h2 class="title-head">Thay đổi mật khẩu</h2>
                    <?php
                    $change_error = '';

                    if (isset($_POST['change_password'])) {
                        $current_password = $_POST['current_password'];
                        $new_password = $_POST['new_password'];
                        $confirm_password = $_POST['confirm_password'];

                        $user = wp_get_current_user();

                        // Kiểm tra mật khẩu hiện tại
                        if (wp_check_password($current_password, $user->data->user_pass, $user->ID)) {
                            // Kiểm tra mật khẩu mới và xác nhận mật khẩu
                            if ($new_password === $confirm_password) {
                                // Kiểm tra mật khẩu mới không chứa dấu cách và không viết có dấu
                                if (!containsWhiteSpace($new_password) && !containsAccent($new_password)) {
                                    wp_set_password($new_password, $user->ID);
                                    $change_success = true;
                                } else {
                                    $change_error = 'Mật khẩu mới không được chứa dấu cách hoặc viết có dấu.';
                                }
                            } else {
                                $change_error = 'Xác nhận mật khẩu không khớp.';
                            }
                        } else {
                            $change_error = 'Mật khẩu hiện tại không đúng.';
                        }
                    }

                    // Hàm kiểm tra xem mật khẩu có chứa dấu cách không
                    function containsWhiteSpace($password)
                    {
                        return preg_match('/\s/', $password);
                    }

                    // Hàm kiểm tra xem mật khẩu có viết có dấu không
                    function containsAccent($password)
                    {
                        return preg_match('/[áàảãạăắằẳẵặâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵ]/', $password);
                    }

                    ?>
                    <?php if (isset($change_success)) : ?>
                        <p style="color:#DBA21E;">Mật khẩu đã được thay đổi thành công.</p>
                    <?php elseif (!empty($change_error)) : ?>
                        <p style="color: red;"><?php echo $change_error; ?></p>
                    <?php endif; ?>
                    <form id="form-change-pass" method="post">
                        <div class="form-group">
                            <label for="current_password">Mật khẩu hiện tại:</label>
                            <input type="password" class="form-control" name="current_password"
                                   placeholder="Nhập mật khẩu hiện tại" required>
                            <span class="show-btn"><i class="fas fa-eye"></i></span>
                        </div>
                        <div class="form-group">
                            <label for="new_password">Mật khẩu mới:</label>
                            <input type="password" class="form-control" name="new_password"
                                   placeholder="Nhập mật khẩu mới" required>
                            <span class="show-btn"><i class="fas fa-eye"></i></span>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Xác nhận mật khẩu:</label>
                            <input type="password" class="form-control" name="confirm_password"
                                   placeholder="Xác nhận mật khẩu" required>
                            <span class="show-btn"><i class="fas fa-eye"></i></span>
                        </div>
                        <input type="submit" name="change_password" value="Lưu thay đổi">
                    </form>
                </div>
            </div>
        </div>
    </div>
                    </div>

<?php

if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID'];
    $order = wc_get_order($orderID);
    $orderStatus = $order->get_status();

    if ($orderStatus == 'completed') {
        $order->update_status('completed');
        $jwt = create_JWT($user_id);
        $linkDashboard = get_field('domain_dashboard', 'option');
        $linkRedirect = $linkDashboard . "/route?token=" . $jwt . "&redirect_url=" . $linkDashboard . '/route/test-now' . "&callback_url=" . home_url();
        ?>

        <div id="confirmationPopup" class="overlay">
            <div class="popup-content">
                <div class="header-popup">
                    <h2><img src="https://www.revica.org/wp-content/themes/themename/images/checked.png"> Thanh toán
                        thành công</h2>
                    <p>Tham gia test ngay cùng Revica</p>
                </div>
                <div class="button-confirm">
                    <button class="closePopupButton">Quản lý đơn hàng</button>
                    <button class="confirm-button">Làm test ngay</button>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $("#confirmationPopup").fadeIn();
                $(".closePopupButton").click(function () {
                    $("#confirmationPopup").fadeOut();
                });
                $(".confirm-button").click(function () {
                    window.location.href = '<?php echo $linkRedirect; ?>';
                });

                jQuery.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'woo_sendmail',
                        orderid: '<?php echo $orderID; ?>'
                    },
                    success: function (response) {
                        console.log('Done');
                    },
                    error: function (error) {
                        // Handle any errors
                    }
                });
            });
        </script>
    <?php }
}

?>


    <script src="<?php echo get_template_directory_uri() ?>/js/managerOrder.js"></script>
    <script>
        $(document).ready(function () {
            var $url = localStorage.getItem("avatar");
            console.log($url);

            if ($url !== null && $url !== '') {
                $(".custom_avatar").attr('src', $url);
            }

            $(".reset_avatar").click(function () {
                var defaultAvatarUrl = 'https://secure.gravatar.com/avatar/1f7a733722a526862fa3ae6d50bb1686?s=96&d=mm&r=g';
                $(".custom_avatar").attr('src', defaultAvatarUrl);
                localStorage.setItem("avatar", defaultAvatarUrl);
            });
        });
    </script>
<?php get_footer(); ?>