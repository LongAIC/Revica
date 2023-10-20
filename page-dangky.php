<?php
/*
Template Name: Page Đăng ký
*/

?>
<?php get_header(); ?>
    <main id="main" class="register">
        <div class="user-container">
            <div id="content_pages">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="auth-card-header">
                        <a class="app-logo" href="<?php bloginfo('home'); ?>" title="<?php bloginfo('title'); ?>">
                            <img src="<?php the_field('logo', 'option') ?>" alt="<?php bloginfo('title'); ?>"/>
                        </a>
                    </div>
                    <h1>Đăng ký và khám phá bản thân ngay hôm nay</h1>
                    <?php
                    if (is_user_logged_in()) {
                        $user_id = get_current_user_id();
                        $current_user = wp_get_current_user();
                        $profile_url = get_author_posts_url($user_id);
                        $current_url = get_permalink();
                        ?>
                        <div class="regted">
                            Bạn đã đăng nhập với tên tài khoản <a
                                    href="<?php echo $profile_url ?>"><?php echo $current_user->display_name; ?></a>.
                            Bạn có muốn <a href="<?php echo esc_url(wp_logout_url($current_url)); ?>">Thoát</a> không?
                        </div>
                        <?php
                    } else {
                        $err = '';
                        $success = '';

                        if (isset($_POST['task']) && $_POST['task'] == 'register') {
                            $lastName = sanitize_text_field($_POST['user-last-name']);
                            $user_login = sanitize_text_field($_POST['user_login']);
                            $phoneNumber = sanitize_text_field($_POST['phoneNumber']);
                            $user_email = sanitize_email($_POST['user_email']);
                            $dateOfBirth = sanitize_text_field($_POST['dateOfBirth']);
                            $pwd1 = trim($_POST['pwd1']);
                            $pwd2 = trim($_POST['pwd2']);

                            if (empty($lastName) || empty($user_login) || empty($phoneNumber) || empty($user_email) || empty($dateOfBirth) || empty($pwd1) || empty($pwd2)) {
                                $err = 'Vui lòng không bỏ trống những thông tin bắt buộc!';
                            } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                                $err = 'Địa chỉ Email không hợp lệ!';
                                $_POST['user_email'] = '';
                            } elseif (email_exists($user_email)) {
                                $err = 'Địa chỉ Email đã tồn tại!';
                            } elseif (username_exists($user_login)) {
                                $err = 'Tên đăng nhập đã tồn tại!';
                            } elseif ($pwd1 !== $pwd2) {
                                $err = 'Hai mật khẩu không giống nhau!';
                            } else {
                                $user_id = wp_insert_user(array(
                                    'user_login' => $user_login,
                                    'user_pass' => $pwd1,
                                    'user_email' => $user_email,
                                    'user_registered' => date('Y-m-d H:i:s'),
                                    'last_name' => $lastName,
                                    'nickname' => $lastName,
                                    'display_name' => $lastName,
                                    'description' => '',
                                    'role' => 'subscriber',
                                ));
                                update_user_meta($user_id, 'phone_number', $phoneNumber);


                                if (is_wp_error($user_id)) {
                                    $err = 'Có lỗi xảy ra khi tạo tài khoản.';
                                } else {

                                    session_start();
                                    $code = generateRandomString();

                                    $content = "Mã xác nhận của bạn là : " . $code;
                                    $subject = 'Xác thực tài khoản';
                                    $body = wpautop($content);
                                    $headers = array('Content-Type: text/html');
                                    $sent = wp_mail($user_email, $subject, $body, $headers);

                                    if ($sent) {
                                        // Lưu thông tin tùy chỉnh của người dùng vào cơ sở dữ liệu
                                        add_user_meta($user_id, 'phone_number', $phoneNumber);
                                        if (!empty($dateOfBirth)) {
                                            $dateOfBirth = sanitize_text_field($_POST['dateOfBirth']);
                                            $formatted_date = DateTime::createFromFormat('d/m/Y', $dateOfBirth);
                                            $formatted_date_str = $formatted_date ? $formatted_date->format('d/m/Y') : '';
                                            add_user_meta($user_id, 'date_of_birth', $formatted_date_str);
                                        }
                                        if (isset($_POST['user_profession'])) {
                                            $user_profession = sanitize_text_field($_POST['user_profession']);
                                            add_user_meta($user_id, 'user_profession', $user_profession);
                                        }
                                        // Thông báo đăng ký thành công
                                        $success = 'Bạn đã đăng ký thành công!';
                                    } else {
                                        $success = 'Gửi mail thất bại';
                                    }
                                }
                            }
                        }
                        ?>

                        <!-- Hiển thị thông báo lỗi/thành công -->
                        <div id="message">
                            <?php if (!empty($err)) : ?>
                                <div class="error" style="text-align: center;"><?php echo $err; ?></div>
                            <?php endif; ?>

                            <?php if (!empty($success)) : ?>
                                <script>
                                    localStorage.setItem('code', '<?php echo $code; ?>');
                                    localStorage.setItem('email', '<?php echo $user_email; ?>');
                                    window.location.href = '<?php echo home_url(); ?>/verifyemail';
                                </script>
                                <div class="success" style="text-align: center;"><?php echo $success; ?><a
                                            href="<?php echo home_url('/dang-nhap'); ?>"> Đăng nhập</a></div>
                            <?php endif; ?>
                        </div>

                        <form id="signup-form" class="ant-form ant-form-horizontal signup-form" method="post"
                              role="form">
                            <div class="form-group">
                                <div class="ant-input-affix-wrapper">
                                <span class="ant-input-prefix"><svg stroke="currentColor" fill="currentColor"
                                                                    stroke-width="0" viewBox="0 0 448 512" height="1em"
                                                                    width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path>
                                    </svg></span>
                                    <input type="text" class="form-control" name="user-last-name" id="user-last-name"
                                           placeholder="Họ và tên"
                                           value="<?php echo isset($_POST['user-last-name']) ? $_POST['user-last-name'] : ''; ?>">
                                </div>
                                <div id="name_help" class="ant-form-item-explain ant-form-item-explain-connected"
                                     role="alert" style="display: none;">
                                    <div class="ant-form-item-explain-error">Vui lòng nhập tên của bạn!</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="ant-input-affix-wrapper">
                                <span class="ant-input-prefix"><svg stroke="currentColor" fill="currentColor"
                                                                    stroke-width="0" viewBox="0 0 448 512" height="1em"
                                                                    width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path>
                                    </svg></span>
                                    <input type="text" class="form-control" name="user_login" id="user_login"
                                           placeholder="Tên đăng nhập"
                                           value="<?php echo isset($_POST['user_login']) ? $_POST['user_login'] : ''; ?>">
                                </div>
                                <div id="userName_help" class="ant-form-item-explain ant-form-item-explain-connected"
                                     role="alert" style="display: none;">
                                    <div class="ant-form-item-explain-error" style="">Vui lòng nhập tên đăng nhập!</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="ant-input-affix-wrapper">
                                <span class="ant-input-prefix"><svg stroke="currentColor" fill="currentColor"
                                                                    stroke-width="0" viewBox="0 0 512 512" height="1em"
                                                                    width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z"></path>
                                    </svg></span>
                                    <input type="tel" class="form-control" name="phoneNumber" id="phoneNumber"
                                           placeholder="Số điện thoại"
                                           value="<?php echo isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : ''; ?>">
                                </div>
                                <div id="phoneNumber_help" class="ant-form-item-explain ant-form-item-explain-connected"
                                     role="alert" style="display: none;">
                                    <div class="ant-form-item-explain-error" style="">Vui lòng nhập số điện thoại!</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="ant-input-affix-wrapper">
                                <span class="ant-input-prefix"><svg stroke="currentColor" fill="currentColor"
                                                                    stroke-width="0" viewBox="0 0 24 24" height="1em"
                                                                    width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"></path>
                                    </svg></span>
                                    <input type="email" class="form-control" name="user_email" id="user_email"
                                           placeholder="Email"
                                           value="<?php echo isset($_POST['user_email']) ? $_POST['user_email'] : ''; ?>">
                                </div>
                                <div id="email_help" class="ant-form-item-explain ant-form-item-explain-connected"
                                     role="alert" style="display: none;">
                                    <div class="ant-form-item-explain-error" style="">Vui lòng nhập tên đăng nhập của
                                        bạn!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="ant-input-affix-wrapper">

                                    <input type="text" class="form-control" name="dateOfBirth" id="dateOfBirth"
                                           placeholder="Ngày sinh"
                                           value="<?php echo isset($_POST['dateOfBirth']) ? $_POST['dateOfBirth'] : ''; ?>">
                                    <span class="ant-picker-suffix">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                         viewBox="0 0 512 512" height="1em" width="1em"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M32 456a24 24 0 0024 24h400a24 24 0 0024-24V176H32zm320-244a4 4 0 014-4h40a4 4 0 014 4v40a4 4 0 01-4 4h-40a4 4 0 01-4-4zm0 80a4 4 0 014-4h40a4 4 0 014 4v40a4 4 0 01-4 4h-40a4 4 0 01-4-4zm-80-80a4 4 0 014-4h40a4 4 0 014 4v40a4 4 0 01-4 4h-40a4 4 0 01-4-4zm0 80a4 4 0 014-4h40a4 4 0 014 4v40a4 4 0 01-4 4h-40a4 4 0 01-4-4zm0 80a4 4 0 014-4h40a4 4 0 014 4v40a4 4 0 01-4 4h-40a4 4 0 01-4-4zm-80-80a4 4 0 014-4h40a4 4 0 014 4v40a4 4 0 01-4 4h-40a4 4 0 01-4-4zm0 80a4 4 0 014-4h40a4 4 0 014 4v40a4 4 0 01-4 4h-40a4 4 0 01-4-4zm-80-80a4 4 0 014-4h40a4 4 0 014 4v40a4 4 0 01-4 4h-40a4 4 0 01-4-4zm0 80a4 4 0 014-4h40a4 4 0 014 4v40a4 4 0 01-4 4h-40a4 4 0 01-4-4zM456 64h-55.92V32h-48v32H159.92V32h-48v32H56a23.8 23.8 0 00-24 23.77V144h448V87.77A23.8 23.8 0 00456 64z"></path>
                                    </svg></span>
                                </div>
                                <div id="dateOfBirth_help" class="ant-form-item-explain ant-form-item-explain-connected"
                                     role="alert" style="display: none;">
                                    <div class="ant-form-item-explain-error" style="">Vui lòng nhập ngày sinh!</div>
                                </div>
                            </div>
                            <div class="form-group password">
                                <div class="ant-input-affix-wrapper ant-input-password ant-input-affix-wrapper-status-error">
                                <span class="ant-input-prefix"><svg stroke="currentColor" fill="currentColor"
                                                                    stroke-width="0" viewBox="0 0 1024 1024"
                                                                    height="1em" width="1em"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                        <path d="M832 464h-68V240c0-70.7-57.3-128-128-128H388c-70.7 0-128 57.3-128 128v224h-68c-17.7 0-32 14.3-32 32v384c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V496c0-17.7-14.3-32-32-32zM540 701v53c0 4.4-3.6 8-8 8h-40c-4.4 0-8-3.6-8-8v-53a48.01 48.01 0 1 1 56 0zm152-237H332V240c0-30.9 25.1-56 56-56h248c30.9 0 56 25.1 56 56v224z"></path>
                                    </svg></span>
                                    <input type="password" class="form-control pwd" name="pwd1" id="pwd1"
                                           placeholder="Mật khẩu"
                                           value="<?php echo isset($_POST['pwd1']) ? $_POST['pwd1'] : ''; ?>">
                                    <span class="show-btn"><i class="fas fa-eye"></i></span>
                                </div>
                                <div id="password_help" class="ant-form-item-explain ant-form-item-explain-connected"
                                     role="alert" style="display: none;">
                                    <div class="ant-form-item-explain-error" style="">Vui lòng nhập mật khẩu của bạn!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group password">
                                <div class="ant-input-affix-wrapper ant-input-password ant-input-affix-wrapper-status-error">
                                <span class="ant-input-prefix"><svg stroke="currentColor" fill="currentColor"
                                                                    stroke-width="0" viewBox="0 0 1024 1024"
                                                                    height="1em" width="1em"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                        <path d="M832 464h-68V240c0-70.7-57.3-128-128-128H388c-70.7 0-128 57.3-128 128v224h-68c-17.7 0-32 14.3-32 32v384c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V496c0-17.7-14.3-32-32-32zM540 701v53c0 4.4-3.6 8-8 8h-40c-4.4 0-8-3.6-8-8v-53a48.01 48.01 0 1 1 56 0zm152-237H332V240c0-30.9 25.1-56 56-56h248c30.9 0 56 25.1 56 56v224z"></path>
                                    </svg></span>
                                    <input type="password" class="form-control pwd" name="pwd2" id="pwd2"
                                           placeholder="Nhập lại mật khẩu"
                                           value="<?php echo isset($_POST['pwd2']) ? $_POST['pwd2'] : ''; ?>">
                                    <span class="show-btn"><i class="fas fa-eye"></i></span>
                                </div>
                                <div id="confirmPassword_help"
                                     class="ant-form-item-explain ant-form-item-explain-connected" role="alert"
                                     style="display: none;">
                                    <div class="ant-form-item-explain-error" style="">Vui lòng nhập lại mật khẩu!</div>
                                </div>
                            </div>
                            <div class="form-group" id="user-profession">
                                <h2 style="margin: auto;">Bạn là ai?</h2>
                                <div id="customerType" class="ant-radio-group ant-radio-group-outline">
                                    <label class="ant-radio-button-wrapper">
                                    <span class="ant-radio-button">
                                        <input type="radio" class="ant-radio-button-input" name="user_profession"
                                               value="Học sinh" <?php echo (isset($_POST['user_profession']) && $_POST['user_profession'] === 'Học sinh') ? 'checked' : ''; ?>>
                                        <span class="ant-radio-button-inner"></span>
                                    </span>
                                        <span>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hocsinh.svg">
                                        <p>Học sinh</p>
                                    </span>
                                    </label>
                                    <label class="ant-radio-button-wrapper">
                                    <span class="ant-radio-button">
                                        <input type="radio" class="ant-radio-button-input" name="user_profession"
                                               value="Sinh viên" <?php echo (isset($_POST['user_profession']) && $_POST['user_profession'] === 'Sinh viên') ? 'checked' : ''; ?>>
                                        <span class="ant-radio-button-inner"></span>
                                    </span>
                                        <span>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sinhvien.svg">
                                        <p>Sinh viên</p>
                                    </span>
                                    </label>
                                    <label class="ant-radio-button-wrapper">
                                    <span class="ant-radio-button">
                                        <input type="radio" class="ant-radio-button-input" name="user_profession"
                                               value="Người đi làm" <?php echo (isset($_POST['user_profession']) && $_POST['user_profession'] === 'Người đi làm') ? 'checked' : ''; ?>>
                                        <span class="ant-radio-button-inner"></span>
                                    </span>
                                        <span>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/nguoidilam.svg">
                                        <p>Người đi làm</p>
                                    </span>
                                    </label>
                                    <label class="ant-radio-button-wrapper">
                                    <span class="ant-radio-button">
                                        <input type="radio" class="ant-radio-button-input" name="user_profession"
                                               value="Phụ huynh" <?php echo (isset($_POST['user_profession']) && $_POST['user_profession'] === 'Phụ huynh') ? 'checked' : ''; ?>>
                                        <span class="ant-radio-button-inner"></span>
                                    </span>
                                        <span>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/phuhuynh.svg">
                                        <p>Phụ huynh</p>
                                    </span>
                                    </label>
                                </div>
                                <div id="customerType_help"
                                     class="ant-form-item-explain ant-form-item-explain-connected" role="alert"
                                     style="display: none;">
                                    <div class="ant-form-item-explain-error">Vui lòng chọn vị trí của bạn!</div>
                                </div>
                            </div>
                            <div class="form-group signup-checkbox">
                                <label class="ant-checkbox-wrapper">
                                <span class="ant-checkbox">
                                    <input id="iAgreeTo" type="checkbox" class="ant-checkbox-input" name="i_agree_to"
                                           value="1">
                                    <span class="ant-checkbox-inner"></span>
                                </span>
                                    <span>Tôi đồng ý <span class="signup-link"><a href="https://www.revica.org/dieu-khoan-dich-vu/">Điều khoản</a> và <a href="https://www.revica.org/chinh-sach-bao-mat/">Chính sách</a></span></span>
                                </label>
                                <div id="iAgreeTo_help" class="ant-form-item-explain ant-form-item-explain-connected"
                                     role="alert" style="display: none;">
                                    <div class="ant-form-item-explain-error" style="">Bạn cần chấp nhận điều khoản!
                                    </div>
                                </div>
                            </div>
                            <?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
                            <div class="button">
                                <button id="btn-dangky" type="submit" class="btn btn-primary">Đăng ký</button>
                                <input type="hidden" name="task" value="register"/>
                            </div>
                        </form>
                        <div class="form-field-action">
                            <span class="signup-text-grey">Bạn đã có tài khoản?</span>
                            <a class="underlineNone colorTextPrimary"
                               href="<?php echo esc_url(get_bloginfo('url') . '/dang-nhap'); ?>">Đăng nhập</a>
                        </div>
                        <div class="signup-footer">
                            <span class="signup-text signup-text-grey">Hoặc đăng ký với</span>
                            <div class="signup-socialLink">
                                <?php echo do_shortcode('[google-login]'); ?>
                                <?php echo do_shortcode('[facebook-login]'); ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php endwhile; ?>
            </div>
        </div>
    </main>
    
    <script>
        // Function to validate and show error message for a field
        function validateField(field, helpTextId) {
            var value = $(field).val().trim();
            if (value === '') {
                $(helpTextId).show();
                return false;
            } else {
                $(helpTextId).hide(); // Hide the error message if the field is not empty
            }
            return true;
        }

        // Function to validate profession radio buttons
        function validateProfession() {
            var isValid = $('input[name="user_profession"]').is(':checked');
            if (!isValid) {
                $('#customerType_help').show();
                return false;
            } else {
                $('#customerType_help').hide(); // Hide the error message if profession is selected
            }
            return true;
        }

        // Function to validate "Agree to" checkbox
        function validateAgreeTo() {
            var isChecked = $('#iAgreeTo').is(':checked');
            if (!isChecked) {
                $('#iAgreeTo_help').show();
                return false;
            } else {
                $('#iAgreeTo_help').hide(); // Hide the error message if the checkbox is checked
            }
            return true;
        }

        // Function to hide all error messages
        function hideErrorMessages() {
            $('#customerType_help, #iAgreeTo_help').hide();
        }

        $("#btn-dangky").click(function() {
            event.preventDefault();
            // Hide error messages
            hideErrorMessages();

            // Validate form fields
            var isNameValid = validateField('#user-last-name', '#name_help');
            var isUserNameValid = validateField('#user_login', '#userName_help');
            var isPhoneNumberValid = validateField('#phoneNumber', '#phoneNumber_help');
            var isEmailValid = validateField('#user_email', '#email_help');
            var isDateOfBirthValid = validateField('#dateOfBirth', '#dateOfBirth_help');
            var isPasswordValid = validateField('#pwd1', '#password_help');
            var isConfirmPasswordValid = validateField('#pwd2', '#confirmPassword_help');
            var isProfessionValid = validateProfession();
            var isAgreeToValid = validateAgreeTo();

            if (isNameValid && isUserNameValid && isPhoneNumberValid && isEmailValid && isDateOfBirthValid && isPasswordValid && isConfirmPasswordValid && isProfessionValid && isAgreeToValid) {
                $(this).prop("disabled", false);
                $('#signup-form').submit();
            }
        });

        // Event handler to hide error message when user selects a profession
        $('input[name="user_profession"]').on('click', function () {
            $('#customerType_help').hide();
        });

        // Event handler to hide error message when user interacts with the "Agree to" checkbox
        $('#iAgreeTo').on('change', function () {
            $('#iAgreeTo_help').hide();
        });

        jQuery(".form-group .show-btn").click(function () {
            if ($(this).hasClass("active")) {
                $(this).closest(".form-group").find(".form-control").attr("type", 'password');
                $(this).removeClass("active");
            } else {
                $(this).closest(".form-group").find(".form-control").attr("type", 'text');
                $(this).addClass("active");
            }
        });

        $('input[name="user_profession"]').on('click', function () {
            // Xóa class "active" khỏi tất cả các label trước khi thêm vào label mới
            $('.ant-radio-button-wrapper').removeClass('active');

            // Kiểm tra xem input nào được chọn và thêm class "active" vào label tương ứng
            if ($(this).is(':checked')) {
                $(this).closest('.ant-radio-button-wrapper').addClass('active');
            }
        });
    </script>

<!--     <script>
        $('#signup-form').submit(function () {

            var isPhoneNumber = /^\d{10}$/.test($("#phoneNumber").val());
            var isEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test($("#user_email").val());

            console.log(isPhoneNumber);
            console.log($("#phoneNumber").val());
            if (isPhoneNumber == false) {
                document.getElementById('phoneNumber').setCustomValidity("Vui lòng nhập chính xác số điện thoại");
            } else {
                document.getElementById('phoneNumber').setCustomValidity(""); // Xóa thông báo tùy chỉnh
            }
            if (isEmail == false) {
                document.getElementById('user_email').setCustomValidity("Vui lòng nhập chính xác địa chỉ email");
            } else {
                document.getElementById('user_email').setCustomValidity(""); // Xóa thông báo tùy chỉnh
            }

        });
    </script>  -->
<?php get_footer(); ?>