<?php $term = get_queried_object(); ?>
<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */
defined('ABSPATH') || exit;
get_header('shop');
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');
?>
<main id="main">
	<div id="zek_service_page">
		<div class="zek_service_banner">
			<div class="container-fluid">
				<div class="banner zek_background <?php $rows = get_field('album_anh', $term);
													if ($rows) ?><?php { ?><?php $x = 0;
																			foreach ($rows as $row) {
																				$x++; ?>if_gallery<?php } ?><?php } ?>" style="background-image: url(https://revica.org/wp-content/uploads/2023/05/30d91313bee1738a6d474f9bfc031440.png);">
					<div class="inner text-center">
						<div class="box">
							<h1 class="title"><?php if (get_field('title', $term)) : ?><?php the_field('title', $term) ?><?php else : ?><?php woocommerce_page_title(); ?><?php endif; ?></h1>
							<?php if (get_field('text', $term)) : ?><p class="text"><?php the_field('text', $term); ?></p><?php endif; ?>
						</div>
					</div>
				</div>
				<?php $rows = get_field('album_anh', $term);
				if ($rows) ?>
				<?php { ?>
					<?php $x = 0;
					foreach ($rows as $row) {
						$x++; ?>
						<div class="gallery">
							<?php $images = $row['gallery']; ?>
							<div class="row row-margin">
								<div class="col-left">
									<div class="img"><img src="<?php echo $images[1]['url']; ?>" alt="<?php echo $image['alt']; ?>"></div>
									<div class="img"><img src="<?php echo $images[2]['url']; ?>" alt="<?php echo $image['alt']; ?>"></div>
								</div>
								<div class="col-center">
									<div class="img img_center"><img src="<?php echo $images[0]['url']; ?>" alt="<?php echo $image['alt']; ?>"></div>
								</div>
								<div class="col-right">
									<div class="img"><img src="<?php echo $images[3]['url']; ?>" alt="<?php echo $image['alt']; ?>"></div>
									<div class="img"><img src="<?php echo $images[4]['url']; ?>" alt="<?php echo $image['alt']; ?>"></div>
								</div>
							</div>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
		<div class="flex_archive">
			<div class="box_select">
				<?php if (get_field('select', $term) == 'form') : ?>
					<?php $chas = get_field('section4', 'option');
					if ($chas) { ?>
						<?php foreach ($chas as $cha) { ?>
							<div class="zek_home_sec4 zek_position">
								<div class="background"></div>
								<div class="container">
									<div class="row row-margin flex-center">
										<div class="col-xl-6 col-lg-6 col-md-7 col-12">
											<div class="inner">
												<h2 class="title"><?php echo $cha['title'];  ?></h2>
												<ul class="list">
													<?php
													if ($cha['list']) {
														foreach ($cha['list'] as $con) { ?>
															<li><?php echo $con['text']; ?></li>
													<?php }
													} ?>
												</ul>
											</div>
										</div>
										<div class="col-xl-5 col-lg-5 col-md-5 col-12">
											<div class="form">
												<?php echo do_shortcode('[ninja_form id=1]'); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
					<?php }
					} ?>
				<?php elseif (get_field('select', $term) == 'sale') : ?>
					<?php if (have_rows('flash_sale', 'option')) : ?>
						<?php while (have_rows('flash_sale', 'option')) : the_row(); ?>
							<div class="zek_flashsale ">
								<div class="container-fluid">
									<div class="zek_block zek_position">
										<div class="img zek_position">
											<div class="dot dot1"></div>
											<div class="dot dot2"></div>
											<img src="<?php the_sub_field('img'); ?>" alt="">
										</div>
										<div class="inner zek_position">
											<div class="zek_background" style="background-image: url(<?php the_sub_field('bg'); ?>);"></div>
											<div class="box">
												<h2 class="title"><?php the_sub_field('title'); ?></h2>
												<p class="text"><?php the_sub_field('text'); ?></p>
												<div class="flashsale">
													<?php the_sub_field('coutdown'); ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				<?php else : ?>

				<?php endif; ?>

			</div>

			<div class="zek_service_body">
				<div class="container">
					<?php
					$terms = get_terms('product_cat', array(
						'hide_empty' => 0,
						'parent' => get_queried_object_id()
					));
					if (!empty($terms) && !is_wp_error($terms)) { ?>
						<?php
						foreach ($terms as $term) {
						?>
							<div class="zek_block zek_service_list">

								<div class="zek_home_title">
									<div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt=""></div>
									<h2 class="title"><a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a></h2>
									<p class="text"><?php the_field('text', $term); ?></p>
								</div>
								<div class="row row-margin">
									<?php
									$args = array(
										'post_type' => 'product',
										'showposts' => 6,
										'tax_query' => array(
											array(
												'taxonomy' => 'product_cat',
												'field' => 'ID',
												'terms' => $term->term_id,
											),
										),
									);
									$loop = new WP_Query($args);
									while ($loop->have_posts()) : $loop->the_post();
										$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'shop_catalog', false, '');
									?>

										<?php wc_get_template_part('content', 'product'); ?> <!-- Code gọi item sản phẩm (file content-product.php) -->

									<?php
									endwhile;
									wp_reset_query();
									?>
								</div>
							</div>
						<?php }
					} else { ?>
						<div class="zek_service_list zek_block">
							<?php
							/**
							 * Hook: woocommerce_archive_description.
							 *
							 * @hooked woocommerce_taxonomy_archive_description - 10
							 * @hooked woocommerce_product_archive_description - 10
							 */
							do_action('woocommerce_archive_description');
							?>
							<?php
							if (woocommerce_product_loop()) {
								/**
								 * Hook: woocommerce_before_shop_loop.
								 *
								 * @hooked woocommerce_output_all_notices - 10
								 * @hooked woocommerce_result_count - 20
								 * @hooked woocommerce_catalog_ordering - 30
								 */
								do_action('woocommerce_before_shop_loop');
								woocommerce_product_loop_start();
								if (wc_get_loop_prop('total')) {
									while (have_posts()) {
										the_post();
										/**
										 * Hook: woocommerce_shop_loop.
										 */
										do_action('woocommerce_shop_loop');
										wc_get_template_part('content', 'product');
									}
								}
								woocommerce_product_loop_end();
								/**
								 * Hook: woocommerce_after_shop_loop.
								 *
								 * @hooked woocommerce_pagination - 10
								 */
								do_action('woocommerce_after_shop_loop');
							} else {
								/**
								 * Hook: woocommerce_no_products_found.
								 *
								 * @hooked wc_no_products_found - 10
								 */
								do_action('woocommerce_no_products_found');
							}
							?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</main>
<?php get_footer('shop'); ?>