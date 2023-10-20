<?php
/*
Template Name: Logout Direct
*/
$jwt = create_JWT(get_current_user_id());
// Xóa cookies phiên đăng nhập
setcookie('wordpress_logged_in', '', time() - 3600, '/');
setcookie('wp-settings-1', '', time() - 3600, '/');
setcookie('wp-settings-time-1', '', time() - 3600, '/');

// Xóa thông tin liên quan trong cơ sở dữ liệu
global $wpdb;
$user_id = get_current_user_id();
$wpdb->query("DELETE FROM $wpdb->usermeta WHERE user_id = $user_id AND meta_key LIKE 'session_tokens%'");



$linkDashboard = get_field('domain_dashboard', 'option');
$linkRedirect = $linkDashboard . "/route?token=" . $jwt . "&redirect_url=" . $linkDashboard . "/logout&callback_url=" . home_url();

// Chuyển hướng người dùng sau khi logout
wp_redirect($linkRedirect);
