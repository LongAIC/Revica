<?php

function zek_admin_menus()
{
    remove_submenu_page('options-general.php', 'mainwp_child_tab');
}

add_action('admin_menu', 'zek_admin_menus');


function mu_hide_plugins_network($plugins)
{
    // let's hide akismet
    if (in_array('vnpay-pay-woocommerce/vnpay.php', array_keys($plugins))) {
        unset($plugins['vnpay-pay-woocommerce/vnpay.php']);
    }

    return $plugins;
}

add_filter('all_plugins', 'mu_hide_plugins_network');


// tắt update plugin mà vẫn cài được thêm plugin (dán vào funtion)
remove_action('load-update-core.php', 'wp_update_plugins');
add_filter('pre_site_transient_update_plugins', '__return_null');

// Them thumbnail cho post & page
/* === Add Thumbnails to Posts/Pages List === */
if (!function_exists('o99_add_thumbs_column_2_list') && function_exists('add_theme_support')) {

    //  // set your post types , here it is post and page...
    add_theme_support('post-thumbnails', array('post', 'page'));

    function o99_add_thumbs_column_2_list($cols)
    {

        $cols['thumbnail'] = __('Thumbnail');

        return $cols;
    }

    function o99_add_thumbs_2_column($column_name, $post_id)
    {

        $w = (int)60;
        $h = (int)60;

        if ('thumbnail' == $column_name) {
            // back comp x WP 2.9
            $thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true);
            // from gal
            $attachments = get_children(array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image'));
            if ($thumbnail_id)
                $thumb = wp_get_attachment_image($thumbnail_id, array($w, $h), true);
            elseif ($attachments) {
                foreach ($attachments as $attachment_id => $attachment) {
                    $thumb = wp_get_attachment_image($attachment_id, array($w, $h), true);
                }
            }
            if (isset($thumb) && $thumb) {
                echo $thumb;
            } else {
                echo __('None');
            }
        }
    }

    // for posts
    add_filter('manage_posts_columns', 'o99_add_thumbs_column_2_list');
    add_action('manage_posts_custom_column', 'o99_add_thumbs_2_column', 10, 2);

    // for pages
    add_filter('manage_pages_columns', 'o99_add_thumbs_column_2_list');
    add_action('manage_pages_custom_column', 'o99_add_thumbs_2_column', 10, 2);
}

function bootstrap_pagination(\WP_Query $wp_query = null, $echo = true, $params = [])
{
    if (null === $wp_query) {
        global $wp_query;
    }

    $add_args = [];

    //add query (GET) parameters to generated page URLs
    if (isset($_GET['sort'])) {
        $add_args['sort'] = (string)$_GET['sort'];
    }

    $pages = paginate_links(
        array_merge([
            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'type' => 'array',
            'show_all' => false,
            'end_size' => 1,
            'mid_size' => 2,
            'prev_next' => true,
            'prev_text' => __('«'),
            'next_text' => __('»'),
            'add_args' => $add_args,
            'add_fragment' => ''
        ], $params)
    );

    if (is_array($pages)) {
        //$current_page = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
        $pagination = '<nav class="pagination"><ul class="page-numbers">';

        foreach ($pages as $page) {
            $pagination .= '<li> ' . $page . '</li>';
        }

        $pagination .= '</ul></nav>';

        if ($echo) {
            echo $pagination;
        } else {
            return $pagination;
        }
    }

    return null;
}

// Webpp
function webp_upload_mimes($existing_mimes)
{
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}

add_filter('mime_types', 'webp_upload_mimes');

add_filter('upload_mimes', 'custom_mime_types', 1, 1);
function custom_mime_types($mime_types)
{
    $mime_types['jfif'] = 'image/jfif+xml'; // Adding .jfif extension

    return $mime_types;
}

//** * Enable preview / thumbnail for webp image files.*/
function webp_is_displayable($result, $path)
{
    if ($result === false) {
        $displayable_image_types = array(IMAGETYPE_WEBP);
        $info = @getimagesize($path);

        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }

    return $result;
}

add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);
add_filter('wpcf7_autop_or_not', '__return_false');
// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter('gutenberg_use_widgets_block_editor', '__return_false');
// Disables the block editor from managing widgets.
add_filter('use_widgets_block_editor', '__return_false');

function filter_ptags_on_images($content)
{
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');

register_nav_menu('main', 'Main');
register_nav_menu('category', 'Category');
register_sidebar(array(
    'name' => __('Footer1', 'theme_text_domain'),
    'id' => 'footer1',
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1s" class="widget %2s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="zek_footer_title">',
    'after_title' => '</div>'
));
register_sidebar(array(
    'name' => __('Footer2', 'theme_text_domain'),
    'id' => 'footer2',
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1s" class="widget %2s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="zek_footer_title">',
    'after_title' => '</div>'
));

register_sidebar(array(
    'name' => __('Sidebar', 'theme_text_domain'),
    'id' => 'sidebar',
    'description' => '',
    'class' => '',
    'before_widget' => '<div id="%1s" class="widget %2s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="zek_sidebar_title">',
    'after_title' => '</div>'
));

//Đưa trình soạn thảo WordPress 5.0 về phiên bản cũ không dùng plugin  
add_filter('use_block_editor_for_post', '__return_false');


class home_xn extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'home_xn',
            'Xem nhiều',
            array('description' => '')
        );
    }

    function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters(
            'widget_title',
            empty($instance['title']) ? '' : $instance['title'],
            $instance,
            $this->id_base
        );
        $sp = apply_filters('widget_text', $instance['sp'], $instance);
        echo $before_widget;
        ?>

        <div class="zek_sidebar_title"><?php echo($title); ?></div>
        <div class="zek_sidebar_post">
            <?php $new = new WP_Query('showposts=5&meta_key=post_views_count&orderby=meta_value_num&order=DESC');
            while ($new->have_posts()) : $new->the_post(); ?>
                <div class="item">
                    <div class="img zek_position zek_background"
                         style="background-image: url(<?php the_post_thumbnail_url('medium'); ?>);">
                        <a href="<?php the_permalink(); ?>" class="zek_linkfull"></a>
                    </div>
                    <div class="info">
                        <h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="date"><?php the_time('d.m.Y'); ?></div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>


        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['sp'] = $new_instance['sp'];

        return $instance;
    }

    function form($instance)
    {
        $instance = wp_parse_args(
            (array)$instance,
            array('title' => '', 'sp' => '')
        );
        $title = strip_tags($instance['title']);
        $sp = ($instance['sp']);

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php _e('Tiêu đề :'); ?> </label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title ?>"/>
        </p>


        <?php
    }
}

register_widget('home_xn');

class home_news extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'home_news',
            'Tin mới',
            array('description' => '')
        );
    }

    function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters(
            'widget_title',
            empty($instance['title']) ? '' : $instance['title'],
            $instance,
            $this->id_base
        );
        $sp = apply_filters('widget_text', $instance['sp'], $instance);
        echo $before_widget;
        ?>

        <div class="zek_sidebar_title"><?php echo($title); ?></div>
        <div class="zek_sidebar_post">

            <?php $new = new WP_Query('showposts=5&orderby=date&order=DESC');
            while ($new->have_posts()) : $new->the_post(); ?>
                <div class="item">
                    <div class="img zek_position zek_background"
                         style="background-image: url(<?php the_post_thumbnail_url('medium'); ?>);">
                        <a href="<?php the_permalink(); ?>" class="zek_linkfull"></a>
                    </div>
                    <div class="info">
                        <h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="date"><?php the_time('d.m.Y'); ?></div>
                    </div>
                </div>
            <?php endwhile; ?>

        </div>


        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['sp'] = $new_instance['sp'];

        return $instance;
    }

    function form($instance)
    {
        $instance = wp_parse_args(
            (array)$instance,
            array('title' => '', 'sp' => '')
        );
        $title = strip_tags($instance['title']);
        $sp = ($instance['sp']);

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php _e('Tiêu đề :'); ?> </label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title ?>"/>
        </p>


        <?php
    }
}

register_widget('home_news');


class Home_style_55 extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'Home_style_55',
            'Tin tức sidebar',
            array('description' => '')
        );
    }

    function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $sp = apply_filters('widget_text', $instance['sp'], $instance);
        $sl = apply_filters('widget_text', $instance['sl'], $instance);
        echo $before_widget;
        ?>
        <div class="zek_sidebar_title"><?php echo get_cat_name($sp); ?></div>
        <div class="zek_sidebar_post">
            <?php $new = new WP_Query('showposts=' . $sl . '&cat=' . $sp);
            while ($new->have_posts()) : $new->the_post(); ?>
                <div class="item">
                    <div class="img zek_position zek_background"
                         style="background-image: url(<?php the_post_thumbnail_url('medium'); ?>);">
                        <a href="<?php the_permalink(); ?>" class="zek_linkfull"></a>
                    </div>
                    <div class="info">
                        <h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="date"><?php the_time('d.m.Y'); ?></div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['sp'] = $new_instance['sp'];
        $instance['sl'] = $new_instance['sl'];
        return $instance;
    }

    function form($instance)
    {
        $instance = wp_parse_args(
            (array)$instance,
            array('title' => '', 'sp' => '', 'sl' => '')
        );
        $title = strip_tags($instance['title']);
        $sp = ($instance['sp']);
        $sl = ($instance['sl']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php _e('Tiêu đề :'); ?> </label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo get_cat_name($sp); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('sp'); ?>">
                <?php _e('Id Chuyên Mục.'); ?> </label>
            <select name="<?php echo $this->get_field_name('sp'); ?>" id="<?php echo $this->get_field_id('sp'); ?>">
                <?php $args = array(
                    'orderby' => 'name', 'hide_empty' => 0,
                    'order' => 'ASC'
                );
                $categories = get_categories($args);
                foreach ($categories as $category) { ?>
                    <option value="<?php echo $category->term_id; ?>" <?php if ($category->term_id == $sp) {
                        echo 'selected="selected"';
                    } ?>><?php echo $category->cat_name; ?></option>

                <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('sl'); ?>">
                <?php _e('Số Lượng :'); ?> </label>
            <input class="widefat" id="<?php echo $this->get_field_id('sl'); ?>"
                   name="<?php echo $this->get_field_name('sl'); ?>" type="number" value="<?php echo $sl; ?>"/>
        </p>
        <?php
    }
}

register_widget('Home_style_55');


add_filter('widget_text', 'do_shortcode');

function crunchify_remove_version()
{
    return '';
}

add_filter('the_generator', 'crunchify_remove_version');

remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
function catch_that_image()
{
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];
    if (empty($first_img)) { //Defines a default image
        $first_img = "/images/default.jpg"; //Duong dan anh mac dinh khi khong tim duoc anh dai dien
    }
    return $first_img;
}

// Quản lý trang
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Site Management',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'manage_options',
        'redirect' => false
    ));
};
// End Quản lý trang


add_theme_support('post-thumbnails');

function remove_default_widgets()
{
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
}

//Đếm số lượt xem

function getPostViews($postID)
{ // hàm này dùng để lấy số người đã xem qua bài viết
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') { // Nếu như lượt xem không có
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0"; // giá trị trả về bằng 0
    }
    return $count; // Trả về giá trị lượt xem
}

function setPostViews($postID)
{ // hàm này dùng để set và update số lượt người xem bài viết.
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++; // cộng đồn view
        update_post_meta($postID, $count_key, $count); // update count
    }
}

//Ẩn WordPress Version
function wpb_remove_version()
{
    return '';
}

add_filter('the_generator', 'wpb_remove_version');


//Vô hiệu hóa XML-RPC trong WordPress
add_filter('xmlrpc_enabled', '__return_false');

//Bảo vệ WordPress khỏi các truy vấn nguy hiểm
global $user_ID;
if ($user_ID) {
    if (!current_user_can('administrator')) {
        if (
            strlen($_SERVER['REQUEST_URI']) > 255 ||
            stripos($_SERVER['REQUEST_URI'], "eval(") ||
            stripos($_SERVER['REQUEST_URI'], "CONCAT") ||
            stripos($_SERVER['REQUEST_URI'], "UNION+SELECT") ||
            stripos($_SERVER['REQUEST_URI'], "base64")
        ) {
            @header("HTTP/1.1 414 Request-URI Too Long");
            @header("Status: 414 Request-URI Too Long");
            @header("Connection: Close");
            @exit;
        }
    }
}

function wp_nav_menu_no_ul()
{
    $options = array(
        'echo' => false,
        'container' => false,
        'theme_location' => 'main',
        'fallback_cb' => 'fall_back_menu'
    );

    $menu = wp_nav_menu($options);
    echo preg_replace(array(
        '#^<ul[^>]*>#',
        '#</ul>$#'
    ), '', $menu);
}

function fall_back_menu()
{
    return;
}

function new_submenu_class($menu)
{
    $menu = preg_replace('/ class="sub-menu"/', '/ class="sub-menu" /', $menu);
    return $menu;
}

add_filter('wp_nav_menu', 'new_submenu_class');

function add_classes_on_li($classes, $item, $args)
{
    $classes[] = 'nav-item';
    return $classes;
}

add_filter('nav_menu_css_class', 'add_classes_on_li', 1, 3);

function add_menuclass($ulclass)
{
    return preg_replace('/<a /', '<a class="nav-links"', $ulclass);
}

add_filter('wp_nav_menu', 'add_menuclass');

add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts()
{
    echo '<style>
    .notice-error{display:none}
    #miain_wpdevart_countdown_window_manager>tbody>tr:nth-child(15),#miain_wpdevart_countdown_window_manager>tbody>tr:nth-child(17),#miain_wpdevart_countdown_window_manager>tbody>tr:nth-child(20),#miain_wpdevart_countdown_window_manager>tbody>tr:nth-child(21),#miain_wpdevart_countdown_window_manager>tbody>tr:nth-child(22),#miain_wpdevart_countdown_window_manager>tbody>tr:nth-child(23){display: none !important;}
    #adminmenu li.menu-top.toplevel_page_Countdown {display: none;}
    ul.acf-radio-list, ul.acf-checkbox-list{display: flex;align-item: center;flex-wrap: wrap;}
    ul.acf-radio-list li, ul.acf-checkbox-list li{margin-right: 15px;}
    .theme-overlay .screenshot:after{background-image: url(https://www.revica.org/wp-content/themes/themename/screenshot2.png);background-size: contain;background-repeat: no-repeat;background-position: center;}
  </style>';
}


add_filter('xmlrpc_enabled', '__return_false');

function wpse_11826_search_by_title($search, $wp_query)
{
    if (!empty($search) && !empty($wp_query->query_vars['search_terms'])) {
        global $wpdb;

        $q = $wp_query->query_vars;
        $n = !empty($q['exact']) ? '' : '%';

        $search = array();

        foreach ((array)$q['search_terms'] as $term)
            $search[] = $wpdb->prepare("$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like($term) . $n);

        if (!is_user_logged_in())
            $search[] = "$wpdb->posts.post_password = ''";

        $search = ' AND ' . implode(' AND ', $search);
    }

    return $search;
}

add_filter('posts_search', 'wpse_11826_search_by_title', 10, 2);

//Allow Contributors to Add Media
if (current_user_can('contributor') && !current_user_can('upload_files'))
    add_action('admin_init', 'allow_contributor_uploads');

function allow_contributor_uploads()
{
    $contributor = get_role('contributor');
    $contributor->add_cap('upload_files');
}

//Xóa bỏ /category/ và slug category cha

add_filter('term_link', 'devvn_no_category_parents', 1000, 3);
function devvn_no_category_parents($url, $term, $taxonomy)
{
    if ($taxonomy == 'category') {
        $term_nicename = $term->slug;
        $url = trailingslashit(get_option('home')) . user_trailingslashit($term_nicename, 'category');
    }
    return $url;
}

// Rewrite url mới
function devvn_no_category_parents_rewrite_rules($flash = false)
{
    $terms = get_terms(array(
        'taxonomy' => 'category',
        'post_type' => 'post',
        'hide_empty' => false,
    ));
    if ($terms && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $term_slug = $term->slug;
            add_rewrite_rule($term_slug . '/?$', 'index.php?category_name=' . $term_slug, 'top');
            add_rewrite_rule($term_slug . '/page/([0-9]{1,})/?$', 'index.php?category_name=' . $term_slug . '&paged=$matches[1]', 'top');
            add_rewrite_rule($term_slug . '/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?category_name=' . $term_slug . '&feed=$matches[1]', 'top');
        }
    }
    if ($flash == true)
        flush_rewrite_rules(false);
}

add_action('init', 'devvn_no_category_parents_rewrite_rules');

/*Sửa lỗi khi tạo mới category bị 404*/
function devvn_new_category_edit_success()
{
    devvn_no_category_parents_rewrite_rules(true);
}

add_action('created_category', 'devvn_new_category_edit_success');
add_action('edited_category', 'devvn_new_category_edit_success');
add_action('delete_category', 'devvn_new_category_edit_success');


include_once(get_stylesheet_directory() . '/admin/admin.php');
require_once(get_stylesheet_directory() . '/inc/woo.php');


// Thư viện nghề nghiệp
function prefix_register_name()
{
    $labels = array(
        'name' => __('Thư viện nghề nghiệp', 'text-domain'),
        'singular_name' => __('Thư viện nghề nghiệp', 'text-domain'),
        'add_new' => _x('Add New Thư viện nghề nghiệp', 'text-domain', 'text-domain'),
        'add_new_item' => __('Add New Thư viện nghề nghiệp', 'text-domain'),
        'edit_item' => __('Edit Thư viện nghề nghiệp', 'text-domain'),
        'new_item' => __('New Thư viện nghề nghiệp', 'text-domain'),
        'view_item' => __('View Thư viện nghề nghiệp', 'text-domain'),
        'search_items' => __('Search Thư viện nghề nghiệp', 'text-domain'),
        'not_found' => __('No Thư viện nghề nghiệp found', 'text-domain'),
        'not_found_in_trash' => __('No Thư viện nghề nghiệp found in Trash', 'text-domain'),
        'parent_item_colon' => __('Parent Thư viện nghề nghiệp:', 'text-domain'),
        'menu_name' => __('Thư viện nghề nghiệp', 'text-domain'),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'description',
        'taxonomies' => array(),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_admin_bar' => true,
        'menu_position' => null,
        'menu_icon' => null,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'supports' => array(
            'title', 'editor', 'author', 'thumbnail',
            'excerpt', 'custom-fields', 'trackbacks', 'comments',
            'revisions', 'page-attributes', 'post-formats'
        )
    );
    register_post_type('thu-vien-nghe-nghiep', $args);
}

add_action('init', 'prefix_register_name');
function my_taxonomies_name()
{
    $labels = array(
        'name' => _x('Danh Mục Thư viện nghề nghiệp', 'Taxonomy Thư viện nghề nghiệp', 'text-domain'),
        'singular_name' => _x('Danh Mục Thư viện nghề nghiệp', 'Taxonomy Thư viện nghề nghiệp', 'text-domain'),
        'search_items' => __('Search Thư viện nghề nghiệp', 'text-domain'),
        'popular_items' => __('Popular Thư viện nghề nghiệp', 'text-domain'),
        'all_items' => __('All Thư viện nghề nghiệp', 'text-domain'),
        'parent_item' => __('Parent Thư viện nghề nghiệp', 'text-domain'),
        'parent_item_colon' => __('Parent Thư viện nghề nghiệp', 'text-domain'),
        'edit_item' => __('Edit Thư viện nghề nghiệp', 'text-domain'),
        'update_item' => __('Update Thư viện nghề nghiệp', 'text-domain'),
        'add_new_item' => __('Add New Thư viện nghề nghiệp', 'text-domain'),
        'new_item_name' => __('New Thư viện nghề nghiệp Name', 'text-domain'),
        'add_or_remove_items' => __('Add or remove Thư viện nghề nghiệp', 'text-domain'),
        'choose_from_most_used' => __('Choose from most used text-domain', 'text-domain'),
        'menu_name' => __('Danh Mục Thư viện nghề nghiệp', 'text-domain'),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => false,
        'hierarchical' => true,
        'show_tagcloud' => false,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'query_var' => true,
        'capabilities' => array(),
    );
    register_taxonomy('danh-muc-thu-vien-nghe-nghiep', array('thu-vien-nghe-nghiep'), $args);
}

add_action('init', 'my_taxonomies_name');


function huy_mu_hide_plugins_network($plugins)
{
    // let's hide akismet
    if (in_array('tenweb-speed-optimizer/tenweb_speed_optimizer.php', array_keys($plugins))) {
        unset($plugins['tenweb-speed-optimizer/tenweb_speed_optimizer.php']);
    }

    return $plugins;
}

add_filter('all_plugins', 'huy_mu_hide_plugins_network');

add_action('admin_head', 'my_custom_fonts2');
function my_custom_fonts2()
{
    echo '<style>
        #toplevel_page_two_settings_page{display:none};
      </style>';
}

add_action('admin_head', 'my_custom_fonts3');
function my_custom_fonts3()
{
    echo '<style>
        #wp-admin-bar-two_adminbar_info{display:none};
      </style>';
}

function create_JWT($user_ID)
{
    $userData = get_userdata($user_ID);
    // Define header and payload
    $header = array(
        'alg' => 'HS256',
        'typ' => 'JWT'
    );

    $payload = array(
        'id' => $user_ID,
        'username' => $userData->user_login,
        '_wpnonce' => wp_create_nonce('logout_nonce_action_' . $user_ID),
        'iat' => time(),
        'exp' => time() + 3600 // Token will expire in 1 hour
    );

    $secretKey = get_field('jwt_secretkey', 'option'); // Replace with your secret key

    // Encode the header and payload
    $encodedHeader = base64url_encode(json_encode($header));
    $encodedPayload = base64url_encode(json_encode($payload));

    // Create the signature
    $signature = hash_hmac('sha256', "$encodedHeader.$encodedPayload", $secretKey, true);
    $encodedSignature = base64url_encode($signature);

    // Combine the encoded parts to create the JWT
    $jwt = "$encodedHeader.$encodedPayload.$encodedSignature";

    return $jwt;
}

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/users/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'api_get_one_user',
        'args' => array(
            'id' => array(
                'validate_callback' => function ($param, $request, $key) {
                    return is_numeric($param);
                }
            ),
        ),
    ));
});

function api_get_one_user($request)
{

    $key = get_field('key_api', 'option');
    $keycode = $request->get_param('key');

    if ($keycode != null && $key == $keycode) {
        $author_id = $request->get_param('id');
        // Lấy thông tin tác giả dựa trên ID
        $author = get_user_by('id', $author_id);

        if (!$author) {
            return new WP_Error('author_not_found', 'Author not found', array('status' => 404));
        }
        // Xử lý thông tin tác giả ở đây và trả về dưới dạng JSON


        $newOBJ = new stdClass();
        $newOBJ->id = $author->ID;
        $newOBJ->email = $author->user_email;
        $newOBJ->first_name = get_user_meta($author->ID, 'first_name', true);
        $newOBJ->last_name = get_user_meta($author->ID, 'last_name', true);
        $newOBJ->username = $author->user_login;
        $newOBJ->avatar_url = empty(get_user_meta($author->ID, 'custom_avatar', true)) ? 'https://secure.gravatar.com/avatar/1f7a733722a526862fa3ae6d50bb1686?s=96&d=mm&r=g"' : get_user_meta($author->ID, 'custom_avatar', true);
        $newOBJ->customer_type = get_user_meta($author->ID, 'user_profession', true);
        $newOBJ->phone_number = get_user_meta($author->ID, 'phone_number', true);
        $newOBJ->date_of_birth = get_user_meta($author->ID, 'date_of_birth', true);
        $newOBJ->nicename = $author->display_name;

        $response = [$newOBJ];

        return rest_ensure_response($response);
    } else {
        return 'Key không tồn tại hoặc không đúng';
    }
}


add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/users', array(
        'methods' => 'GET',
        'callback' => 'api_get_all_user',
        'args' => array(
            'id' => array(
                'validate_callback' => function ($param, $request, $key) {
                    return is_numeric($param);
                }
            ),
        ),
    ));
});

function api_get_all_user($request)
{

    $key = get_field('key_api', 'option');
    $keycode = $request->get_param('key');

    if ($keycode != null && $key == $keycode) {
        $users = get_users();

        if (!$users) {
            return new WP_Error('author_not_found', 'Author not found', array('status' => 404));
        }
        // Xử lý thông tin tác giả ở đây và trả về dưới dạng JSON

        $data = [];
        foreach ($users as $author) {
            $newOBJ = new stdClass();
            $newOBJ->id = $author->ID;
            $newOBJ->email = $author->user_email;
            $newOBJ->first_name = get_user_meta($author->ID, 'first_name', true);
            $newOBJ->last_name = get_user_meta($author->ID, 'last_name', true);
            $newOBJ->username = $author->user_login;
            $newOBJ->avatar_url = empty(get_user_meta($author->ID, 'custom_avatar', true)) ? 'https://secure.gravatar.com/avatar/1f7a733722a526862fa3ae6d50bb1686?s=96&d=mm&r=g"' : get_user_meta($author->ID, 'custom_avatar', true);
            $newOBJ->customer_type = get_user_meta($author->ID, 'user_profession', true);
            $newOBJ->phone_number = get_user_meta($author->ID, 'phone_number', true);
            $newOBJ->date_of_birth = get_user_meta($author->ID, 'date_of_birth', true);
            $newOBJ->nicename = $author->display_name;
            array_push($data, $newOBJ);
        }

        return rest_ensure_response($data);
    } else {
        return 'Key không tồn tại hoặc không đúng';
    }
}


add_action('wp_ajax_createOrder', 'createOrder');
add_action('wp_ajax_nopriv_createOrder', 'createOrder');

function createOrder()
{
    if (isset($_POST['email']) && isset($_POST['phone_number'])) {
        $order = wc_get_order($_POST['orderID']);

        //Add Billing
        update_post_meta($_POST['orderID'], '_billing_last_name', $_POST['last_name']);
        update_post_meta($_POST['orderID'], '_billing_phone', $_POST['phone_number']);
        update_post_meta($_POST['orderID'], '_billing_address_1', $_POST['billing_address_1']);
        update_post_meta($_POST['orderID'], '_billing_email', $_POST['email']);

        //Add Product 
        $cart = WC()->cart;
        $cart_contents = $cart->get_cart();
        $priceTotal = 0;
        foreach ($cart_contents as $cart_item_key => $cart_item) {
            // Get product data
            // Get product data
            $product = wc_get_product($cart_item['product_id']);
            $priceTotal += ($product->get_price() * $cart_item['quantity']);
            $order->add_product($product, $cart_item['quantity']);
        }

        //Add IVoice
        if ($_POST['vat'] == 'true') {

            echo $_POST['ten_cong_ty'];
            update_post_meta($_POST['orderID'], 'ten_cong_ty', $_POST['ten_cong_ty']);
            update_post_meta($_POST['orderID'], 'dia_chi_congty', $_POST['dia_chi_congty']);
            update_post_meta($_POST['orderID'], 'email_hoadon', $_POST['email_hoadon']);
            update_post_meta($_POST['orderID'], 'so_dien_thoai', $_POST['so_dien_thoai']);
            update_post_meta($_POST['orderID'], 'ma_số_thuế', $_POST['ma_số_thuế']);

            //ADD VAT
            $priceVAT = $priceTotal * (get_field("vat", 'option') * 0.01);
            $fee = new WC_Order_Item_Fee();
            $fee->set_name('VAT');
            $fee->set_amount($priceVAT);
            $fee->set_total($priceVAT);
            $order->add_item($fee);
        }

        //Set Paymend
        $order->set_payment_method('bankqr');

        //Set Custommer
        $order->set_customer_id(get_current_user_id());

        // order status
        $order->set_status('wc-pending', 'Order is created programmatically');


        //Clear Cart
        global $woocommerce;
        $woocommerce->cart->empty_cart();

        // calculate and save
        $order->calculate_totals();
        $order->save();

        // Gửi email cho khách hàng
        $email_class = WC()->mailer()->emails['WC_Email_New_Order'];
        $email_class->trigger($_POST['orderID']);

        //Reset sesion
        session_start();
        $_SESSION['orderID'] = 0;
    }
}

add_action('wp_ajax_createOrderVnpay', 'createOrderVnpay');
add_action('wp_ajax_nopriv_createOrderVnpay', 'createOrderVnpay');

function createOrderVnpay()
{
    if (isset($_POST['email']) && isset($_POST['phone_number'])) {


        $order = wc_get_order($_POST['orderID']);

        //Add Billing
        update_post_meta($_POST['orderID'], '_billing_last_name', $_POST['last_name']);
        update_post_meta($_POST['orderID'], '_billing_phone', $_POST['phone_number']);
        update_post_meta($_POST['orderID'], '_billing_address_1', $_POST['billing_address_1']);
        update_post_meta($_POST['orderID'], '_billing_email', $_POST['email']);

        //Add Product 
        $cart = WC()->cart;
        $cart_contents = $cart->get_cart();
        $priceTotal = 0;
        foreach ($cart_contents as $cart_item_key => $cart_item) {
            // Get product data
            $product = wc_get_product($cart_item['product_id']);
            $priceTotal += ($product->get_price() * $cart_item['quantity']);
            $order->add_product($product, $cart_item['quantity']);
        }

        //Add IVoice
        update_post_meta($_POST['orderID'], 'ten_cong_ty', $_POST['ten_cong_ty']);
        update_post_meta($_POST['orderID'], 'dia_chi_congty', $_POST['dia_chi_congty']);
        update_post_meta($_POST['orderID'], 'email_hoadon', $_POST['email_hoadon']);
        update_post_meta($_POST['orderID'], 'so_dien_thoai', $_POST['so_dien_thoai']);
        update_post_meta($_POST['orderID'], 'ma_số_thuế', $_POST['ma_số_thuế']);

        //ADD VAT
        $priceVAT = $priceTotal * (get_field("vat", 'option') * 0.01);
        $fee = new WC_Order_Item_Fee();
        $fee->set_name('VAT');
        $fee->set_amount($priceVAT);
        $fee->set_total($priceVAT);
        $order->add_item($fee);


        //Set Paymend
        $order->set_payment_method('vnpay');

        //Set Custommer
        $order->set_customer_id(get_current_user_id());

        // order status
        $order->set_status('wc-pending', 'Order is created programmatically');


        // calculate and save
        $order->calculate_totals();
        $order->save();

        $totalAmount = ($priceTotal + ($priceTotal * (get_field("vat", 'option') * 0.01))) * 0.1;
        echo home_url() . "/thanh-toan/?orderID=" . $_POST['orderID'] . '&price=' . $totalAmount;

        // Gửi email cho khách hàng
        $email_class = WC()->mailer()->emails['WC_Email_New_Order'];
        $email_class->trigger($_POST['orderID']);

        //Reset sesion
        session_start();
        $_SESSION['orderID'] = 0;
    }
}


function createLinkCheckoutVNpay($order_ID, $order_price)
{

    //Config
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $vnp_Url = get_field('url_thanh_toan', 'option');
    $vnp_Returnurl = home_url() . "/wp-content/themes/themename/request-vnpay.php";
    $vnp_TmnCode = get_field('terminal_id', 'option'); //Mã website tại VNPAY
    $vnp_HashSecret = get_field('secret_key', 'option'); //Chuỗi bí mật

    //Information
    $vnp_TxnRef = "RVC" . $order_ID;
    $vnp_OrderInfo = 'Chuyen khoan don hang RVC' . $order_ID;
    $vnp_OrderType = 'other';
    $vnp_Amount = $order_price * 100;
    $vnp_Locale = 'vn';
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    //Add Params of 2.0.1 Version
    $vnp_ExpireDate = date('YmdHis');

    //Input Data
    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_Command" => "pay",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
    );

    //var_dump($inputData);
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        return $vnp_Url;
    }
}

add_action('init', 'custom_login');
function custom_login()
{
    if (!isset($_REQUEST['custom_login']))
        return;

    $username = (isset($_POST['log']) ? $_POST['log'] : "");
    $username = sanitize_user($username);
    $password = (isset($_POST['pwd']) ? $_POST['pwd'] : "");
    $password = sanitize_text_field($password);
    $redirect_to = (isset($_REQUEST["redirect_to"]) ? $_REQUEST["redirect_to"] : "");

    // Kiểm tra token login
    if (isset($_POST['custom_login'])) {
        if (!isset($_POST['custom_token_login']) || !wp_verify_nonce($_POST['custom_token_login'], 'custom_nonce')) {
            wp_safe_redirect(home_url() . "/dang-nhap?login=token_error&redirect_to=" . urlencode($redirect_to));
            exit;
        }
    }

    $exits_user = custom_get_exist_user($username);
    if ($exits_user) {
        wp_safe_redirect(home_url() . "/dang-nhap?login=failed&redirect_to=" . urlencode($redirect_to));
    } else {
        wp_safe_redirect(home_url() . "/dang-nhap?login=failed&redirect_to=" . urlencode($redirect_to));
    }

}

function custom_get_exist_user($user_name)
{
    global $wpdb;
    $count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->users WHERE user_login = %s", $user_name));
    return $count === 1;
}

add_action("wp_logout", "custom_logout");
function custom_logout()
{
    wp_clear_auth_cookie();
    wp_safe_redirect(home_url("/dang-nhap?login=notyet&redirect_to=" . urlencode(home_url())));
    exit;
}

function generateRandomString($length = 6)
{
    $characters = '123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

add_action('wp_ajax_verifyMail', 'verifyMail');
add_action('wp_ajax_nopriv_verifyMail', 'verifyMail');

function verifyMail()
{

    if (isset($_POST['code'])) {
        session_start();
        $getCode = $_SESSION['code'];

        if ($getCode == $_POST['code']) {
            echo true;
        } else {
            echo false;
        }
    }
    die();
}

add_action('wp_ajax_sendCodeAgain', 'sendCodeAgain');
add_action('wp_ajax_nopriv_sendCodeAgain', 'sendCodeAgain');

function sendCodeAgain()
{

    if (isset($_POST['email'])) {

        $content = "Mã xác nhận của bạn là : " . $_POST['code'];
        $subject = 'Xác thực tài khoản';
        $body = wpautop($content);
        $headers = array('Content-Type: text/html');
        $sent = wp_mail($_POST['email'], $subject, $body, $headers);
        if ($sent) {
            echo true;
        } else {
            echo false;
        }
    }
    die();
}

add_action('wp_ajax_woo_sendmail', 'woo_sendmail');
add_action('wp_ajax_nopriv_woo_sendmail', 'woo_sendmail');

function woo_sendmail()
{

    if (isset($_POST['orderid'])) {

        $email_notifications = WC()->mailer()->get_emails();
        $email_notifications['WC_Email_Customer_Completed_Order']->trigger($_POST['orderid']);
    }
    die();
}


add_action('wp_ajax_sendMailforRepayment', 'sendMailforRepayment');
add_action('wp_ajax_nopriv_sendMailforRepayment', 'sendMailforRepayment');

function sendMailforRepayment()
{

    if (isset($_POST['orderID'])) {

        //Update IVC
        update_post_meta($_POST['orderID'], 'ten_cong_ty', $_POST['ten_cong_ty']);
        update_post_meta($_POST['orderID'], 'dia_chi_congty', $_POST['dia_chi_congty']);
        update_post_meta($_POST['orderID'], 'email_hoadon', $_POST['email_hoadon']);
        update_post_meta($_POST['orderID'], 'so_dien_thoai', $_POST['so_dien_thoai']);
        update_post_meta($_POST['orderID'], 'ma_số_thuế', $_POST['ma_số_thuế']);

        $email_class = WC()->mailer()->emails['WC_Email_New_Order'];
        $email_class->trigger($_POST['orderID']);

    }
    die();
}


add_action('wp_ajax_updateIVC', 'updateIVC');
add_action('wp_ajax_nopriv_updateIVC', 'updateIVC');

function updateIVC()
{

    if (isset($_POST['orderID'])) {

        //Update IVC
        update_post_meta($_POST['orderID'], 'ten_cong_ty', $_POST['ten_cong_ty']);
        update_post_meta($_POST['orderID'], 'dia_chi_congty', $_POST['dia_chi_congty']);
        update_post_meta($_POST['orderID'], 'email_hoadon', $_POST['email_hoadon']);
        update_post_meta($_POST['orderID'], 'so_dien_thoai', $_POST['so_dien_thoai']);
        update_post_meta($_POST['orderID'], 'ma_số_thuế', $_POST['ma_số_thuế']);

    }
    die();
}

add_action('woocommerce_after_cart', function () {
    ?>
    <script>
        jQuery(function ($) {
            var timeout;
            $('div.woocommerce').on('change textInput input', 'form.woocommerce-cart-form input.qty', function () {

                if (typeof timeout !== undefined) clearTimeout(timeout);

                //Not if empty
                if ($(this).val() == '') return;
                $keyCart = $(this).closest(".product-quantity").attr('data-key');
                $qty = $(this).val();
                $pointTo = $(this);
                timeout = setTimeout(function () {
                    jQuery.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>', // Link sử lý ajak của wordpress
                        type: 'post', // Có 2 dạng get và post
                        data: {
                            action: 'cartUpdate', // Action phải có
                            key: $keyCart,
                            qty: $qty,
                        },
                        success: function (data) {
                            $(".cart-subtotal .amount bdi").html(data.productTotal);
                            $(".order-total .amount bdi").html(data.productTotal);
                            $(".nav_item.cart .cout").text(data.cout)
                            $pointTo.closest(".cart_item").find(".product-subtotal .amount bdi").html(data.priceProduct);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log('Không Tìm Thấy Kết Quả'); //Hàm xử lý khi ajak thất bại
                            alert('Không Tìm Thấy Kết Quả');
                        },
                        complete: function () {
                            console.log('AJAX call completed'); //Hàm xử lý khi ajak hoàn thành
                        },
                    });
                }, 0); // 2 second delay
            });
        });
    </script>
    <?php
});


add_action('wp_ajax_cartUpdate', 'cartUpdate');
add_action('wp_ajax_nopriv_cartUpdate', 'cartUpdate');
function cartUpdate()
{
    if (isset($_POST['key']) && isset($_POST['qty'])) {
        $cart = WC()->cart;
        $cart->set_quantity($_POST['key'], $_POST['qty']);
        //Get total in cart
        $totalCount = $cart->get_cart_contents_count();
        $totalPrice = $cart->get_total();
        $priceProductUpdate = $cart->get_cart_item($_POST['key'])['line_total'];
        $formatted_price = number_format($priceProductUpdate, 0, ',', '.') . ' ₫';

        $response = array(
            'productTotal' => $totalPrice,
            'cout' => $totalCount,
            'priceProduct' => $formatted_price
        );
        wp_send_json($response);
    }
    die();
}

// Thêm plus và minus vào quantity trang giỏ hàng
add_filter('woocommerce_cart_item_quantity', 'add_plus_minus_to_quantity', 10, 3);
function add_plus_minus_to_quantity($product_quantity, $cart_item_key, $cart_item)
{
    $product = $cart_item['data'];
    $is_sold_individually = $product->is_sold_individually();

    if ($is_sold_individually) {
        return $product_quantity;
    }

    $input_value = isset($cart_item['quantity']) ? $cart_item['quantity'] : 1;

    $quantity_html = '<div class="quantity">';
    $quantity_html .= '<div class="quantity__button quantity__minus"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="2" viewBox="0 0 12 2" fill="none"><path d="M1 1H10.3333" stroke="#3D3D3D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></div>';
    $quantity_html .= '<input type="text" class="input-text qty text" step="1" min="0" max="" name="cart[' . $cart_item_key . '][qty]" value="' . esc_attr($input_value) . '" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" />';
    $quantity_html .= '<div class="quantity__button quantity__plus"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 3.33334V12.6667" stroke="#3D3D3D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M3.33325 8H12.6666" stroke="#3D3D3D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></div>';
    $quantity_html .= '</div>';

    return $quantity_html;
}

function hk_user_upload_image($file = array())
{
    require_once(ABSPATH . 'wp-admin/includes/admin.php');
    $file_return = wp_handle_upload($file, array('test_form' => false));
    if (isset($file_return['error']) || isset($file_return['upload_error_handler'])) {
        return false;
    } else {
        $filename = $file_return['file'];
        $attachment = array(
            'post_mime_type' => $file_return['type'],
            'post_title' => preg_replace('/.[^.]+$/', '', basename($filename)),
            'post_content' => '',
            'post_status' => 'inherit',
            'guid' => $file_return['url']
        );
        $attachment_id = wp_insert_attachment($attachment, $file_return['url']);
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);
        wp_update_attachment_metadata($attachment_id, $attachment_data);
        if (0 < intval($attachment_id)) {
            return array(
                'url' => $file_return['url'],
                'id' => $attachment_id
            );
        }
    }
    return false;
}

add_action('wp_ajax_change_user_avatar', 'hk_change_user_avatar');
add_action('wp_ajax_nopriv_change_user_avatar', 'hk_change_user_avatar');
function hk_change_user_avatar()
{
    $file_upload = $_FILES['upload_avatar'];
    $user_id = get_current_user_id();
    $avatar_data = array();

    if (isset($file_upload) && $file_upload) {
        $avatar_data = hk_user_upload_image($file_upload);

        if ($avatar_data) {
            update_user_meta($user_id, 'custom_avatar', $avatar_data['url']);
            wp_send_json_success(array('url' => $avatar_data['url']));
        } else {
            wp_send_json_error('Avatar upload failed.');
        }
    }

    wp_send_json_error('No avatar file found.');
}

add_filter('get_avatar', 'hk_custom_user_avatar', 1, 5);
function hk_custom_user_avatar($avatar, $id_or_email, $size, $alt, $args)
{
    $user = false;
    $user_id = '';
    $avatar_url = '';

    if (is_numeric($id_or_email)) {
        $id = (int)$id_or_email;
        $user = get_user_by('id', $id);
    } elseif (is_object($id_or_email)) {
        if (!empty($id_or_email->user_id)) {
            $id = (int)$id_or_email->user_id;
            $user = get_user_by('id', $id);
        }
    } else {
        $user = get_user_by('email', $id_or_email);
    }

    if ($user && is_object($user)) {
        $user_id = $user->data->ID;
        $avatar_url = get_user_meta($user_id, 'custom_avatar', true);
        $replace_img = get_avatar_url($user_id);
        $output_img = '';
        if (isset($avatar_url) && $avatar_url) {
            $output_img = $avatar_url;
        } else {
            $output_img = $replace_img;
        }
        $avatar = '<img class="avatar" src="' . esc_url($output_img) . '" width="' . esc_attr($size) . '" height="' . esc_attr($size) . '" />';
    }
    return $avatar;
}

add_action('wp_ajax_custom_retrieve_password', 'custom_retrieve_password');
add_action('wp_ajax_nopriv_custom_retrieve_password', 'custom_retrieve_password');
function custom_retrieve_password()
{

    if (isset($_POST['user_login'])) {

        session_start();
        $code = generateRandomString();
        $_SESSION['key'] = $code;
        $_SESSION['email'] = $_POST['user_login'];

        $link = home_url() . "/quen-mat-khau/?key=" . $code;

        $content = "Truy cập vào link để đổi mật khẩu : " . $link;
        $subject = 'Đổi mật khẩu';
        $body = wpautop($content);
        $headers = array('Content-Type: text/html');
        $sent = wp_mail($_POST['user_login'], $subject, $body, $headers);
        if ($sent) {
            echo 1;
        }
    }
    die();
}

add_action('wp_ajax_reset_password', 'reset_password_fc');
add_action('wp_ajax_nopriv_reset_password', 'reset_password_fc');
function reset_password_fc()
{
    if (isset($_POST['email']) && isset($_POST['pwd1']) && isset($_POST['pwd2'])) {

        $user_email = sanitize_email($_POST['email']);
        $user = get_user_by('email', $user_email);

        if ($user) {
           $test =  wp_update_user(array(
                'ID' => $user->ID,
                'user_pass' => esc_attr($_POST['pwd1'])
            ));
           if($test) {
               echo 1;
           }
        }
    }
    die();
}

function base64url_encode($data, $pad = null)
{
    $data = str_replace(array('+', '/'), array('-', '_'), base64_encode($data));
    if (!$pad) {
        $data = rtrim($data, '=');
    }
    return $data;
}

function get_product_sku_by_slug($product_slug)
{
    $product = get_page_by_path($product_slug, OBJECT, 'product');

    if ($product) {
        $product_id = $product->ID;
        $sku = get_post_meta($product_id, '_sku', true);
        return $sku;
    }

    return false;
}

add_filter('woocommerce_new_order_email_allows_resend', 'wp_kama_woocommerce_new_order_email_allows_resend_filter');
function wp_kama_woocommerce_new_order_email_allows_resend_filter($allows)
{

    // filter...
    $allows = true;
    return $allows;
}

function send_cancelled_order_notification($order_id)
{
    // Lấy đối tượng email
    $order = wc_get_order($order_id);

    // Gửi email cho khách hàng
    $customer_email = $order->get_billing_email();
    $customer_email_class = WC()->mailer()->emails['WC_Email_Cancelled_Order'];
    $customer_email_class->trigger($order_id, $order, $customer_email);

}

add_action('woocommerce_order_status_cancelled', 'send_cancelled_order_notification', 10, 1);

add_action('woocommerce_order_status_changed', 'send_cancelled_email_notifications', 10, 4);
function send_cancelled_email_notifications($order_id, $old_status, $new_status, $order)
{
    if ($new_status == 'cancelled' || $new_status == 'failed') {
        $wc_emails = WC()->mailer()->get_emails(); // Get all WC_emails objects instances
        $customer_email = $order->get_billing_email(); // Get the customer email
    }

    if ($new_status == 'cancelled') {
        // change the recipient of the instance
        $wc_emails['WC_Email_Cancelled_Order']->recipient = $customer_email;
        // Sending the email from this instance
        $wc_emails['WC_Email_Cancelled_Order']->trigger($order_id);
    } elseif ($new_status == 'failed') {
        // change the recipient of the instance
        $wc_emails['WC_Email_Failed_Order']->recipient = $customer_email;
        // Sending the email from this instance
        $wc_emails['WC_Email_Failed_Order']->trigger($order_id);
    }
}

// Bước 1: Đăng ký phương thức thanh toán
add_filter('woocommerce_payment_gateways', 'add_custom_payment_gateway');

function add_custom_payment_gateway($gateways)
{
    $gateways[] = 'WC_Custom_Payment_Gateway';
    return $gateways;
}

// Bước 2: Tạo lớp Gateway thanh toán
class WC_Custom_Payment_Gateway extends WC_Payment_Gateway
{
    public function __construct()
    {
        $this->id = 'bankqr'; // ID của phương thức thanh toán
        $this->has_fields = true; // Có hiển thị trường nhập thông tin hay không
        $this->method_title = 'Chuyển khoản qua qr code'; // Tên hiển thị trong trang cài đặt thanh toán
        $this->method_description = 'Phương thức thanh toán tùy chỉnh'; // Mô tả

        // Khởi tạo các cài đặt
        $this->init_form_fields();
        $this->init_settings();

        // Thiết lập thông tin
        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');

        // Gọi hàm cài đặt thanh toán
        $this->init_settings();

        // Đăng ký sự kiện xử lý thanh toán
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
    }

    // Bước 3: Thiết lập các trường cài đặt trong trang quản lý WordPress
    public function init_form_fields()
    {
        $this->form_fields = array(
            'enabled' => array(
                'title' => 'Kích hoạt',
                'type' => 'checkbox',
                'label' => 'Kích hoạt phương thức thanh toán',
                'default' => 'yes',
            ),
            'title' => array(
                'title' => 'Tiêu đề',
                'type' => 'text',
                'description' => 'Tiêu đề hiển thị trong trang thanh toán',
                'default' => 'Chuyển khoản ngân hàng',
                'desc_tip' => true,
            ),
            'description' => array(
                'title' => 'Mô tả',
                'type' => 'textarea',
                'description' => 'Mô tả hiển thị trong trang thanh toán',
                'default' => 'Phương thức thanh toán tùy chỉnh',
                'desc_tip' => true,
            ),
        );
    }

    // Bước 4: Hiển thị trường nhập thông tin (nếu cần)
    public function payment_fields()
    {
        // Hiển thị các trường thanh toán (nếu cần)
        echo '<p>Vui lòng nhập thông tin thanh toán.</p>';
    }

    // Bước 5: Xử lý thanh toán
    public function process_payment($order_id)
    {
        $order = wc_get_order($order_id);

        // Thực hiện xử lý thanh toán ở đây
        // Nếu thanh toán thành công, sử dụng:
        return array(
            'result' => 'success',
            'redirect' => $this->get_return_url($order),
        );
        // Nếu thanh toán thất bại, sử dụng:
        // return array(
        //     'result'   => 'fail',
        //     'redirect' => '',
        // );
    }
}

function allow_unsafe_urls($args)
{
    $args['reject_unsafe_urls'] = false;
    return $args;
}

;

add_filter('http_request_args', 'allow_unsafe_urls');

function extend_login_session($expire)
{

    return 31556926; // seconds for 1 year time period

}

add_filter('auth_cookie_expiration', 'extend_login_session');