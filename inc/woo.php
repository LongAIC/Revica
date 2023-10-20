<?php
// Sửa số lượng hiển thị ở mỗi chuyên mục
add_filter( 'loop_shop_per_page', function($cols) { return 12; }, 20 );
// Thay đổi số lượng sản phẩm liên quan
function woo_related_products_limit() {
global $product;
$args['posts_per_page'] = 10;
return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
function jk_related_products_args( $args ) {
$args['posts_per_page'] = 4; // 4 related products
$args['columns'] = 4; // arranged in 4 columns
return $args;
}
add_filter('woocommerce_sale_flash','devvn_woocommerce_sale_flash', 10, 3);
function devvn_woocommerce_sale_flash($text, $post, $product){
ob_start();
$sale_price = get_post_meta( $product->get_id(), '_price', true);
$regular_price = get_post_meta( $product->get_id(), '_regular_price', true);
if (empty($regular_price) && $product->is_type( 'variable' )){
$available_variations = $product->get_available_variations();
$variation_id = $available_variations[0]['variation_id'];
$variation = new WC_Product_Variation( $variation_id );
$regular_price = $variation ->regular_price;
$sale_price = $variation ->sale_price;
}
$sale = ceil(( ($regular_price - $sale_price) / $regular_price ) * 100);
if ( !empty( $regular_price ) && !empty( $sale_price ) && $regular_price > $sale_price ) :
$R = floor((255*$sale)/100);
$G = floor((255*(100-$sale))/100);
echo apply_filters( 'devvn_woocommerce_sale_flash', '<span class="sale-flash" style="'. $bg_style .'">-' . $sale . '%</span>', $post, $product );
endif;
return ob_get_clean();
}
add_filter( 'woocommerce_checkout_fields' , 'devvn_custom_override_checkout_fields', 9999 );
function devvn_custom_override_checkout_fields( $fields ) {
$fields['billing']['billing_email']['required'] = false;
return $fields;
}
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
add_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
remove_action('woocommerce_pagination', 'woocommerce_pagination', 10);


add_shortcode( 'stock_status', 'display_product_stock_status' );
function display_product_stock_status( $atts) {
$atts = shortcode_atts(
array('id'  => get_the_ID() ),
$atts, 'stock_status'
);

if( intval( $atts['id'] ) > 0 && function_exists( 'wc_get_product' ) ){
$product = wc_get_product( $atts['id'] );

$stock_status = $product->get_stock_status();

if ( 'instock' == $stock_status) {
$html = '<span class="stock in-stock">Còn hàng</span>';
} else {
$html = '<span class="stock out-of-stock">Hết hàng</span>';
}
}
return $html;
}
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
unset( $tabs['description'] );          // Remove the description tab
unset( $tabs['reviews'] );          // Remove the reviews tab
unset( $tabs['additional_information'] );   // Remove the additional information tab
return $tabs;
}
function mytheme_add_woocommerce_support() {
add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
function devvn_wc_custom_get_price_html( $price, $product ) {
if ( $product->get_price() == 0 ) {
if ( $product->is_on_sale() && $product->get_regular_price() ) {
$regular_price = wc_get_price_to_display( $product, array( 'qty' => 1, 'price' => $product->get_regular_price() ) );

$price = wc_format_price_range( $regular_price, __( 'Free!', 'woocommerce' ) );
} else {
$price = '<span class="amount">' . __( 'Free', 'woocommerce' ) . '</span>';
}
}
return $price;
}
add_filter( 'woocommerce_get_price_html', 'devvn_wc_custom_get_price_html', 10, 2 );
// Gỡ bỏ breadcrumbs woocommerce
add_action( 'init', 'jk_remove_wc_breadcrumbs' );
function jk_remove_wc_breadcrumbs() {
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
add_action( 'woocommerce_before_single_product', 'check_variable' ); function check_variable(){ if ( is_product() ) { global $post; $product = wc_get_product( $post->ID ); if ( $product->is_type( 'variable' ) ) { remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'custom_wc_template_single_price', 10 );
function custom_wc_template_single_price(){
global $product;
if($product->is_type('variable')):
// Main Price
$prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
$price = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
// Sale Price
$prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
sort( $prices );
$saleprice = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
if ( $price !== $saleprice && $product->is_on_sale() ) {
$price = '<del>' . $saleprice . $product->get_price_suffix() . '</del> <ins>' . $price . $product->get_price_suffix() . '</ins>';
}
?>
<style>
div.woocommerce-variation-price,
div.woocommerce-variation-availability,
div.hidden-variable-price {
height: 0px !important;
overflow:hidden;
position:relative;
line-height: 0px !important;
font-size: 0% !important;
}
</style>
<script>
jQuery(document).ready(function($) {
$('input.variation_id').change( function(){
//Correct bug, I put 0
if( 0 != $('input.variation_id').val()){
$('p.price').html($('div.woocommerce-variation-price > span.price').html()).append('<p class="availability">'+$('div.woocommerce-variation-availability').html()+'</p>');
console.log($('input.variation_id').val());
} else {
$('p.price').html($('div.hidden-variable-price').html());
if($('p.availability'))
$('p.availability').remove();
console.log('NULL');
}
});
});
</script>
<?php
echo '<p class="price">'.$price.'</p>
<div class="hidden-variable-price" >'.$price.'</div>';
endif;
}
}
}
}
add_filter( 'woocommerce_variation_is_active', 'desactivar_variaciones_sin_stock', 10, 2 );
function desactivar_variaciones_sin_stock( $is_active, $variation ) {
if ( ! $variation->is_in_stock() ) return false;
return $is_active;
}
add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);

function custom_variation_price( $price, $product ) {

$price = '';


$price .= woocommerce_price($product->get_price());

return $price;
}
add_shortcode('product_img_with_hover', 'obe_hover_shortcode');
function obe_hover_shortcode() {
global $product;
$post_thumbnail_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_image_ids();
$class = ($attachment_ids) ? 'hover' : '';
if ( $post_thumbnail_id ) {
$html = wp_get_attachment_image( $post_thumbnail_id, true,false,array('class'=>$class) );
} else {
$html = sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
}


if ($attachment_ids) {
$html .= '<div class="img-2">';
    $html .= wp_get_attachment_image( $attachment_ids[0],true );
$html .= '</div>';
}
return $html;
}
// Add our custom product cat rewrite rules
function devvn_no_product_cat_parents_rewrite_rules($flash = false) {
$terms = get_terms( array(
'taxonomy' => 'product_cat',
'post_type' => 'product',
'hide_empty' => false,
));
if($terms && !is_wp_error($terms)){
foreach ($terms as $term){
$term_slug = $term->slug;
add_rewrite_rule($term_slug.'/?$', 'index.php?product_cat='.$term_slug,'top');
add_rewrite_rule($term_slug.'/page/([0-9]{1,})/?$', 'index.php?product_cat='.$term_slug.'&paged=$matches[1]','top');
add_rewrite_rule($term_slug.'/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?product_cat='.$term_slug.'&feed=$matches[1]','top');
}
}
if ($flash == true)
flush_rewrite_rules(false);
}
add_action('init', 'devvn_no_product_cat_parents_rewrite_rules');

/*Sửa lỗi khi tạo mới taxomony bị 404*/
add_action( 'create_term', 'devvn_new_product_cat_edit_success', 10);
add_action( 'edit_terms', 'devvn_new_product_cat_edit_success', 10);
add_action( 'delete_term', 'devvn_new_product_cat_edit_success', 10);
function devvn_new_product_cat_edit_success( ) {
devvn_no_product_cat_parents_rewrite_rules(true);
}
add_filter('term_link', 'devvn_no_term_parents', 1000, 3);
function devvn_no_term_parents($url, $term, $taxonomy) {
if($taxonomy == 'product_cat'){
$term_nicename = $term->slug;
$url = trailingslashit(get_option( 'home' )) . user_trailingslashit( $term_nicename, 'category' );
}
return $url;
}
function devvn_remove_slug( $post_link, $post ) {
if ( !in_array( get_post_type($post), array( 'product' ) ) || 'publish' != $post->post_status ) {
return $post_link;
}
if('product' == $post->post_type){
$post_link = str_replace( '/cua-hang/', '/', $post_link ); //Thay cua-hang bằng slug hiện tại của bạn
}else{
$post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
}
return $post_link;
}
add_filter( 'post_type_link', 'devvn_remove_slug', 10, 2 );
/*Sửa lỗi 404 sau khi đã remove slug product hoặc cua-hang*/
function devvn_woo_product_rewrite_rules($flash = false) {
global $wp_post_types, $wpdb;
$siteLink = esc_url(home_url('/'));
foreach ($wp_post_types as $type=>$custom_post) {
if($type == 'product'){
if ($custom_post->_builtin == false) {
$querystr = "SELECT {$wpdb->posts}.post_name, {$wpdb->posts}.ID
FROM {$wpdb->posts}
WHERE {$wpdb->posts}.post_status = 'publish'
AND {$wpdb->posts}.post_type = '{$type}'";
$posts = $wpdb->get_results($querystr, OBJECT);
foreach ($posts as $post) {
$current_slug = get_permalink($post->ID);
$base_product = str_replace($siteLink,'',$current_slug);
add_rewrite_rule($base_product.'?$', "index.php?{$custom_post->query_var}={$post->post_name}", 'top');
add_rewrite_rule($base_product.'comment-page-([0-9]{1,})/?$', 'index.php?'.$custom_post->query_var.'='.$post->post_name.'&cpage=$matches[1]', 'top');
add_rewrite_rule($base_product.'(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?'.$custom_post->query_var.'='.$post->post_name.'&feed=$matches[1]','top');
}
}
}
}
if ($flash == true)
flush_rewrite_rules(false);
}
add_action('init', 'devvn_woo_product_rewrite_rules');
/*Fix lỗi khi tạo sản phẩm mới bị 404*/
function devvn_woo_new_product_post_save($post_id){
global $wp_post_types;
$post_type = get_post_type($post_id);
foreach ($wp_post_types as $type=>$custom_post) {
if ($custom_post->_builtin == false && $type == $post_type) {
devvn_woo_product_rewrite_rules(true);
}
}
}
add_action('wp_insert_post', 'devvn_woo_new_product_post_save');
class Home_style_2 extends WP_Widget {
function __construct(){
parent::__construct('Home_style_2',
'Sản phẩm sidebar',
array('description' => ''));
}
function widget( $args, $instance ) {
extract($args);
$title = apply_filters( 'widget_title',
empty($instance['title']) ? '' : $instance['title'],
$instance, $this->id_base);
$sp = apply_filters( 'widget_text', $instance['sp'], $instance );
echo $before_widget;
?>
<?php $term=get_term_by('id', $sp, 'product_cat') ?>
<div class="module_best_sale_product margin-bottom-30">
    <div class="title_module_ heading"> <h2 class="title-head"><a href="#" title="<?php echo $term->name; ?>"><?php echo $term->name; ?></a></h2> </div>
    <div class="sale_off_today">
        <div class="not-dqowl wrp_list_product">
            <?php
            $args = array( 'showposts'=>5,'orderby' => 'ID',
            'order' => 'DESC',
            'tax_query' => array(
            'relation'  => 'AND',
            array(
            'taxonomy'         => 'product_cat',
            'field'            => 'id',
            'terms'            => array( $sp ),
            )
            ),
            );
            $query = new WP_Query( $args );while($query->have_posts()) : $query->the_post();global $product;?>
            <div class="item_small">
                <div class="product-mini-item clearfix   on-sale">
                    <a href="<?php the_permalink();?>" class="product-img">
                        <?php the_post_thumbnail('medium')?>
                    </a>
                    <div class="product-info">
                        <h3><a href="<?php the_permalink();?>" title="<?php the_title();?>" class="product-name text3line"><?php the_title();?></a></h3>
                        <div class="price-box">
                            <?php woocommerce_get_template( 'loop/price.php' ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile;
            ?>
        </div>
    </div>
</div>
<?php
echo $after_widget;
}
function update( $new_instance, $old_instance ) {
$instance = $old_instance;
$instance['title'] = strip_tags($new_instance['title']);
$instance['sp'] =  $new_instance['sp'];
return $instance;
}
function form( $instance ) {
$instance = wp_parse_args( (array) $instance,
array( 'title' => '', 'sp' => '' ) );
$title = strip_tags($instance['title']);
$sp = ($instance['sp']);
?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e('Tiêu đề :'); ?> </label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
    name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo  ($title);?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('sp'); ?>">
    <?php _e('Chọn Chuyên Mục.'); ?> </label>
    <select name="<?php echo $this->get_field_name('sp'); ?>" id="">
        <?php
        $args = array(
        'orderby' => 'name',
        'hide_empty' => 0 ,'taxonomy'=>'product_cat'
        );
        $categories = get_categories( $args );
        foreach ( $categories as $category ) {?>
        <option value="<?php echo $category->cat_ID ?>" <?php if($category->cat_ID==$sp){echo 'selected="selected"';} ?>> <?php echo $category->name; ?></option>
        <?php }
        ?>
    </select>
</p>
<?php
}
}
register_widget('Home_style_2');
function evergreen_product_schema ($data) {
global $product;

$data['brand'] = get_bloginfo() ? get_bloginfo() : null;
$data['gtin13'] = zeroise($product->get_id(),13) ? zeroise($product->get_id(),13) : null;

return $data;
}
add_filter( 'woocommerce_structured_data_product', 'evergreen_product_schema' );


add_filter( 'woocommerce_variable_sale_price_html', 'wpglorify_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wpglorify_variation_price_format', 10, 2 );
 
function wpglorify_variation_price_format( $price, $product ) {
 
// Main Price
$prices = array( $product->get_variation_price( 'max', true ), $product->get_variation_price( 'min', true ) );
$price = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
 
// Sale Price
$prices = array( $product->get_variation_regular_price( 'max', true ), $product->get_variation_regular_price( 'min', true ) );
sort( $prices );
$saleprice = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
 
if ( $price !== $saleprice ) {
$price = '<del>' . $saleprice . $product->get_price_suffix() . '</del> <ins>' . $price . $product->get_price_suffix() . '</ins>';
}
return $price;
}
?>