<?php
/*
Template Name: Page Chỉnh sửa tài khoản
*/
?>
<?php get_header(); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.css">

<main id="main" class="edit-account">
    <div class="user-container">
        <div id="content_pages">
            <?php while (have_posts()) : the_post();
                setPostViews($post->ID); ?>
                <div id="login-success-popup">
                    <div class="header-login-popup">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/images/chamthan.svg" />
                        <h2>Bạn vui lòng điền đầy đủ thông tin cá nhân tại những phần đánh dấu sao “<span>*</span>”<br />để hoàn tất quá trình đăng nhập</h2>
                    </div>
                    <?php
                    $user_id = get_current_user_id();
                    $current_user = wp_get_current_user();


                    if (isset($_POST['user_profile_nonce_field']) && wp_verify_nonce($_POST['user_profile_nonce_field'], 'user_profile_nonce')) {

                        /* Update thông tin user. */


                        if (!empty($_POST['last_name'])) {
                            update_user_meta($current_user->ID, 'last_name', sanitize_text_field($_POST['last_name']));
                        }

                        if (!empty($_POST['phone_number']) && $_POST['phone_number'] != $current_user->phone_number) {
                            update_user_meta($current_user->ID, 'phone_number', sanitize_text_field($_POST['phone_number']));
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

                        $jwt = create_JWT($current_user->data->ID);
                        $linkDashboard = get_field('domain_dashboard', 'option');
                        $linkRedirect = $linkDashboard . "/route?token=" . $jwt . "&redirect_url=" . home_url() . "&callback_url=" . home_url();
                        wp_redirect($linkRedirect);

                    }
                    ?>
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
                                    echo '<img src="' . esc_url(get_avatar_url($user->ID)) . '" class="custom_avatar" />';
                                }
                                ?>
                                <div class="button-avatar">
                                    <div class="two-button-avatar">
                                        <button type="submit" name="reset_avatar" class="btn reset_avatar">Đặt lại</button>
                                        <div class="upload-file">
                                            <span>Tải lên</span>
                                            <input type="file" name="upload_avatar" id="upload_avatar" accept="image/*">
                                        </div>
                                    </div>
                                    <span>Hợp lệ với JPG, GIF hoặc PNG. Kích thước tối đa 800kB</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group-row">
                            <div class="form-group">
                                <label for="nickname">Tên đầy đủ <span>*</span></label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Chưa lưu" value="<?php echo esc_attr($current_user->last_name); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nickname">User name</label>
                                <input type="text" class="form-control disable-btn" id="user_login" name="user_login" value="<?php echo esc_attr($current_user->user_login); ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group-row">
                            <div class="form-group">
                                <label for="tel">Số điện thoại <span>*</span></label>
                                <input type="tel" class="form-control" id="phone_number" oninput="validateNumberInput(this)" name="phone_number" placeholder="Chưa lưu" value="<?php echo esc_attr($current_user->phone_number); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span>*</span></label>
                                <?php
                                $user_data = get_userdata($current_user->ID);
                                $user_email = $user_data->user_email;
                                $is_email_filled = !empty($user_email);
                                ?>
                                <input type="email" class="form-control <?php echo $is_email_filled ? 'disable-btn' : ''; ?>" id="user_email" name="user_email" placeholder="Chưa lưu" value="<?php echo esc_attr($user_email); ?>" <?php echo $is_email_filled ? 'disabled' : ''; ?> required>
                            </div>
                        </div>
                        <div class="form-group-row">
                            <div class="form-group">
                                <label for="customerType">Nghề nghiệp <span>*</span></label>
                                <select class="form-control" name="user_profession" id="user_profession">
                                    <option value="Học sinh" <?php echo (get_user_meta($current_user->ID, 'user_profession', true) === 'Học sinh') ? 'selected' : ''; ?>>Học sinh</option>
                                    <option value="Sinh viên" <?php echo (get_user_meta($current_user->ID, 'user_profession', true) === 'Sinh viên') ? 'selected' : ''; ?>>Sinh viên</option>
                                    <option value="Người đi làm" <?php echo (get_user_meta($current_user->ID, 'user_profession', true) === 'Người đi làm') ? 'selected' : ''; ?>>Người đi làm</option>
                                    <option value="Phụ huynh" <?php echo (get_user_meta($current_user->ID, 'user_profession', true) === 'Phụ huynh') ? 'selected' : ''; ?>>Phụ huynh</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dateOfBirth">Ngày sinh <span>*</span></label>
                                <?php
                                    $user_data = get_userdata($current_user->ID);
                                    $date_of_birth = get_user_meta($current_user->ID, 'date_of_birth', true);
                                ?>
                                <input type="text" class="form-control" name="dateOfBirth" id="dateOfBirth" placeholder="Ngày sinh" value="<?php echo esc_attr($date_of_birth); ?>" required>
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
            <?php endwhile; ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>