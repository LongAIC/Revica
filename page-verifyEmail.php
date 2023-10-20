<?php
/*
Template Name: Page verifyEmail
*/
?>
<?php get_header();
session_start();
?>
    <input type="hidden" name="ajakUrl" value="<?php echo admin_url('admin-ajax.php'); ?>">
    <main id="main" class="verifyEmail">
        <div class="user-container">
            <div id="content_pages">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="auth-card-header">
                        <a class="app-logo" href="<?php bloginfo('home'); ?>" title="<?php bloginfo('title'); ?>">
                            <img src="<?php the_field('logo', 'option') ?>" alt="<?php bloginfo('title'); ?>"/>
                        </a>
                    </div>
                    <div class="auth-recon-content">
                        <div class="confirm-content">
                            <p style="width: 300px;">Bạn vui lòng kiểm tra email để nhận được mã xác thực email nhé!</p>
                        </div>
                        <p class="nort"></p>
                        <div class="confirm-code-input">
                            <div class="react-code-input" style="display: inline-block;">
                                <input type="text" class="slice_value">
                                <input type="text" class="slice_value">
                                <input type="text" class="slice_value">
                                <input type="text" class="slice_value">
                                <input type="text" class="slice_value">
                                <input type="text" class="slice_value">
                            </div>
                        </div>
                        <div class="ant-space ant-space-horizontal ant-space-align-center" style="gap: 8px;">
                            <div class="ant-space-item" style="">
                                <button type="button" class="xac-thuc-email"><span>Xác thực</span></button>
                            </div>
                            <div class="ant-space-item">
                                <button type="button" class="gui-lai-email"><span>Gửi lại email</span></button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function () {
            $('.slice_value').on('input', function () {
                var $this = $(this);
                var inputValue = $this.val();
                
                if (inputValue.length > 1) {
                    $this.val(inputValue.slice(0, 1));
                }
                
                if (inputValue.length === 1) {
                    $this.next('.slice_value').focus();
                }
            });
            $(".xac-thuc-email").click(function () {
                var concatenatedString = "";
                var check = true;
                $(".react-code-input input").each(function () {
                    if ($(this).val() == '') {
                        alert("Hãy nhập đủ thông tin");
                        check = false;

                        return false;
                    } else {
                        concatenatedString += $(this).val();
                    }
                });
                if (check == true) {
                    $(this).text("Đang xác nhận");

                    if (concatenatedString == localStorage.getItem("code")) {
                        window.location.href = '<?php echo home_url() . "/dang-nhap" ?>';
                    } else {
                        $(".nort").text("Sai mã xác nhận");
                        $(".xac-thuc-email").text("Xác thực lại");
                    }

                    //var data = {
                    //    action: "verifyMail",
                    //    code: concatenatedString,
                    //
                    //};
                    //$.ajax({
                    //    url: $("input[name='ajakUrl']").val(),
                    //    type: "POST",
                    //    data: data,
                    //    success: function(response) {
                    //        if (response == false) {
                    //            $(".nort").text("Sai mã xác nhận");
                    //            $(".xac-thuc-email").text("Xác thực lại");
                    //        } else {
                    //            window.location.href = '<?php //echo home_url() . "/dang-nhap" ?>//';
                    //        }
                    //    },
                    //    error: function(error) {
                    //        console.log("Error:", error);
                    //    }
                    //});


                }
            });
            $(".gui-lai-email").click(function () {
                $(this).text("Đang xử lý");
                $codenew = localStorage.setItem('code', '<?php echo generateRandomString(); ?>');
                var data = {
                    action: "sendCodeAgain",
                    email: localStorage.getItem("email"),
                    code: localStorage.getItem("code")
                };
                $.ajax({
                    url: $("input[name='ajakUrl']").val(),
                    type: "POST",
                    data: data,
                    success: function (response) {
                        $(".gui-lai-email").text("Gửi lại mail");
                        if (response == true) {
                            $(".nort").text("Hãy kiểm tra lại mail");
                        } else {
                            $(".nort").text("Gửi mail thất bại");
                        }
                    },
                    error: function (error) {
                        console.log("Error:", error);
                    }
                });


            });
        });
    </script>
<?php get_footer(); ?>