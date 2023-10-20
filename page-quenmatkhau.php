<?php
/*
Template Name: Page Quên mật khẩu
*/
?>
<?php get_header(); ?>
<style type="text/css">
    .page-template-page-quenmatkhau > .alert {
        display: none;
    }
</style>
<main id="main" class="forget-password">
    <div class="user-container">
        <div id="content_pages">
            <?php
            while (have_posts()) : the_post();
                setPostViews($post->ID);
                ?>
                <div class="auth-card-header">
                    <a class="app-logo" href="<?php bloginfo('home'); ?>" title="<?php bloginfo('title'); ?>">
                        <img src="<?php the_field('logo', 'option') ?>" alt="<?php bloginfo('title'); ?>"/>
                    </a>
                </div>
                <div class="content_pages_detail">
                    <div class="content_pages_left">
                        <img alt="image-signin"
                             src="<?php echo get_stylesheet_directory_uri(); ?>/images/image-signin.svg">
                    </div>
                    <?php if (isset($_GET['key'])): ?>
                        <div class="content_pages_right">
                            <h3>Nhập mật khẩu mới</h3>
                            <form method="post"  class="forget-form-changepass">
                                <div class="form-group">
                                    <input style="margin-bottom: 10px;" type="text" class="form-control"
                                           placeholder="Nhập mât khẩu mới"
                                           name="pwd1" required
                                    >
                                    <input style="margin-bottom: 10px;" type="text" class="form-control"
                                           placeholder="Nhập lại mật khẩu"
                                           name="pwd2" required
                                    >

                                    <div class="form-field">
                                        <button type="submit" class="btn btn-primary btn-new-pass">
                                            <?php _e('Đổi mật khẩu mới', 'text-domain'); ?>
                                        </button>
                                    </div>
                            </form>
                            <div class="alert-nor"></div>
                        </div>
                        <script>
                            $(document).ready(function () {
                                $(".forget-form-changepass").on('submit', function (event) {
                                    event.preventDefault(); // Ngăn chặn việc tải lại trang
                                    var pwd1 = $("input[name='pwd1']").val();
                                    var pwd2 = $("input[name='pwd2']").val();
                                    if (pwd1 != pwd2) {
                                        $(".alert-nor").text("Hai mật khẩu không khớp");
                                    } else if (pwd1 == '' || pwd2 == '') {
                                        $(".alert-nor").text("Mật khẩu không được để trống");
                                    } else {
                                        $(".btn-new-pass").text("Đang xử lý");
                                        $.ajax({
                                            type: 'POST',
                                            url: '<?php echo admin_url("admin-ajax.php"); ?>',
                                            data: {
                                                action: 'reset_password',
                                                pwd1: pwd1,
                                                pwd2: pwd2,
                                                email: localStorage.getItem("email"),
                                            },
                                            success: function (response) {
                                                if (response == 1) {
                                                    window.location.href = 'https://www.revica.org/dang-nhap';
                                                } else {
                                                    $(".alert-nor").text("Đã sảy ra lỗi ! Hãy liên hệ với admin để được xử lý.");
                                                }
                                            }
                                        });
                                    }
                                });
                            });
                        </script>

                    <?php else: ?>
                        <div class="content_pages_right">
                            <p class="forget-para">Bạn quên mật khẩu? Đừng lo lắng.<span> Hãy cho chúng tôi biết Email và chúng tôi sẽ gửi mật khẩu cho bạn.</span>
                            </p>
                            <?php
                            if (isset($_POST['user_login'])) {
                                $user_login = $_POST['user_login'];
                                $errors = retrieve_password();

                                if (!is_wp_error($errors)) {
                                    echo '<div class="alert alert-success">' . __('Yêu cầu khôi phục đã được gửi. Hãy kiểm tra email của bạn', 'text-domain') . '</div>';
                                } else {
                                    echo '<div class="alert alert-danger">Không có email tồn tại trên hệ thống</div>';
                                }
                            } else {
                                ?>
                                <form method="post" id="basic" class="forget-form">
                                    <div class="form-group">
                                        <input style="margin-bottom: 10px;" type="text" class="form-control"
                                               placeholder="Địa chỉ Email"
                                               name="user_login" id="user_login" required
                                        >
                                        <div class="form-field">
                                            <button type="submit" class="btn btn-primary reset-pass">
                                                <?php _e('Gửi Email', 'text-domain'); ?>
                                            </button>
                                        </div>
                                        <p class="forget-footer">Bạn đã có mật khẩu?<a href="/dang-nhap">Đăng nhập</a>
                                        </p>
                                </form>
                            <?php } ?>
                        </div>
                        <script>
                            jQuery(document).ready(function ($) {
                                $('#user_login').on('input', function () {
                                    var email = $(this).val();
                                    var isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                                    var emailInput = $(this);

                                    if (isValidEmail) {
                                        emailInput.css({
                                            'border-color': '#dbb54b',
                                            'box-shadow': '0 0 0 2px rgba(206, 155, 37, .2)',
                                            'border-right-width': '1px',
                                            'outline': '0'
                                        });
                                    } else {
                                        emailInput.css({
                                            'border-color': '#ff7875',
                                            'box-shadow': '0 0 0 2px rgba(255,77,79,.2)',
                                            'border-right-width': '1',
                                            'outline': '0'
                                        });
                                    }
                                });
                            });
                        </script>
                        <script>
                            $(document).ready(function () {
                                $('.forget-form').on('submit', function (event) {
                                    event.preventDefault(); // Ngăn chặn việc tải lại trang
                                    var email = $('#user_login').val();
                                    var isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                                    if (!email || (isValidEmail && $('#user_login')[0].checkValidity())) {
                                        $(".reset-pass").text("Đang gửi mail");
                                        $.ajax({
                                            type: 'POST',
                                            url: '<?php echo admin_url("admin-ajax.php"); ?>',
                                            data: {
                                                action: 'custom_retrieve_password',
                                                user_login: email,
                                            },
                                            success: function (response) {
                                                if (response == 1) {
                                                    $(".forget-form").html('<div class="alert alert-success">Yêu cầu khôi phục đã được gửi. Hãy kiểm tra email của bạn</div>');
                                                } else {
                                                    $(".forget-form").html('<div class="alert alert-danger">Không có email tồn tại trên hệ thống</div>');
                                                }
                                            }
                                        });
                                    } else {
                                        $('#response-container').html('<div class="alert alert-danger">Vui lòng nhập địa chỉ email hợp lệ</div>');
                                    }
                                });
                            });
                        </script>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
