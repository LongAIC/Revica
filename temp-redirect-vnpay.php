<?php

get_header();

/* Template Name: Chuyển hưởng vnpay  */

?>

<?php if (isset($_GET['orderID']) && isset($_GET['price'])) : ?>
    <script>
        // Chuyển hướng sử dụng JavaScript nếu hàm header() không hoạt động
        window.onload = function() {
            window.location.href = "<?php echo createLinkCheckoutVNpay($_GET['orderID'], $_GET['price']); ?>";
        };
    </script>

<?php endif; ?>


<?php get_footer(); ?>