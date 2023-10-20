<?php

get_header();
    /* Template Name: Chuyển hưởng vnpay  */;

echo $code = 123;

$content = "Mã xác nhận của bạn là : " . $code;
$subject = 'Xác thực tài khoản';
$body = wpautop($content);
$headers = array('Content-Type: text/html');
$sent = wp_mail("lelong24072306@gmail.com", $subject, $body, $headers);
?>




<?php get_footer(); ?>