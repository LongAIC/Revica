<?php
/*
Template Name: Page Đăng nhập
*/
?>
<?php get_header(); ?>
<main id="main" class="sign-in">
    <div class="user-container">
        <div id="content_pages">
            <?php while (have_posts()) : the_post();
                setPostViews($post->ID); ?>
                <div class="content_pages_left">
                    <img alt="image-signin" src="<?php echo get_stylesheet_directory_uri(); ?>/images/image-signin.svg">
                </div>
                <div class="content_pages_right">
                    <h1>Đăng nhập</h1>
                    <?php if (is_user_logged_in()) {
                        $current_user = wp_get_current_user();
                        $profile_url = get_author_posts_url($current_user->ID);
                        $logout_url = wp_logout_url(home_url());

                        $jwt = create_JWT($current_user->ID);
                        $linkDashboard = get_field('domain_dashboard', 'option');
                        $linkRedirect = $linkDashboard . "/route?token=" . $jwt . "&redirect_url=" . home_url() . "&callback_url=" . home_url();
                    ?>
                            <script>
                                window.location.href='<?php echo $linkRedirect; ?>';
                            </script>
                        <div class="regted">
                            Bạn đã đăng nhập với tên tài khoản <a href="<?php echo esc_url($profile_url); ?>"><?php echo esc_html($current_user->display_name); ?></a>. Bạn có muốn <a href="<?php echo esc_url($logout_url); ?>">Thoát</a> không?
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="formdangnhap">
                            <?php
                            if (isset($_GET['login']) && $_GET['login'] === 'failed') {
                            ?>
                                <div id="login-error" class="border-5px" style="background-color: #f2dede;border:1px solid #ebccd1;color: #a94442;padding:10px;margin-bottom: 20px">
                                    <p style="margin:0;">Thất bại: Tên tài khoản hoặc mật khẩu không đúng. Vui lòng thử lại!</p>
                                </div>
                            <?php
                            }
                            ?>
                            <form method="post" action="<?php echo esc_url(wp_login_url()); ?>" class="wp-user-form">
                                <div class="form-group username">
                                    <input type="text" name="log" placeholder="User name" />
                                </div>
                                <div class="form-group password">
                                    <input type="password" name="pwd" value="" size="20" id="user_pass" placeholder="Mật khẩu" />
                                </div>
                                <?php do_action('login_form'); ?>
                                <div class="button login_fields">
                                    <?php wp_nonce_field('custom_login_action', 'custom_login_nonce'); ?>
                                    <input type="submit" name="wp-submit" value="<?php esc_attr_e('Đăng nhập'); ?>" tabindex="14" class="user-submit login-button" />
                                    <input type="hidden" name="redirect_to" value="<?php echo home_url().'/dang-nhap' ?>" />
                                    <input type="hidden" name="custom_login" value="1" />
                                    <input type="hidden" name="custom_token_login" value="<?php echo wp_create_nonce('custom_nonce') ?>">
                                </div>
                            </form>
                            <div class="sign-link">
                                <a class="forget-pass" href="<?php echo esc_url(get_bloginfo('url') . '/quen-mat-khau'); ?>">Quên mật khẩu?</a>
                            </div>
                            <div class="user-card-footer-action">
                                <span>Hoặc đăng nhập</span>
                                <div class="user-social-link">
                                    <?php echo do_shortcode('[google-login]'); ?>
                                    <?php echo do_shortcode('[facebook-login]'); ?>
                                </div>
                            </div>
                            <div class="user-card-footer">
                                <span>Bạn chưa có tài khoản?</span>
                                <span class="user-card-footer-link">
                                    <a class="button-login underlineNone colorTextPrimary" href="<?php echo esc_url(get_bloginfo('url') . '/dang-ky'); ?>">Đăng ký</a>
                                </span>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>