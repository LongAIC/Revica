<?php get_header();wp_reset_query(); ?>
<main id="main">
	<div id="zek_library_detail_page">
		<?php $rows=get_field( 'banner'); if($rows) ?>
		<?php { ?>
		<?php foreach($rows as $row) { ?>
		<div class="zek_library_detail_banner">
			<div class="container-fluid">
				<div class="zek_block zek_position zek_background" style="background-image: url(<?php echo  $row['bg'] ?>);">
					<div class="inner">
						<h1 class="title"><?php echo  $row['title'] ?></h1>
						<p class="text"><?php echo  $row['text'] ?></p>
						<div class="price"><span>$Mức Lương:</span><span><?php echo  $row['price'] ?></span></div>
					</div>
					<div class="img"><img src="<?php echo  $row['img'] ?>" alt=""></div>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php } ?>
		<div class="zek_library_detail_body">
			<div class="container">
				<?php $rows=get_field( 'section1'); if($rows) ?>
				<?php { ?>
				<?php foreach($rows as $row) {$text = $row['text']; ?>
				<div class="zek_block zek_library_detail_sec1">
					<div class="zek_home_title">
						<div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt=""></div>
						<h2 class="title"><?php echo  $row['title'] ?></h2>
						<?php if ($text):?>
						<p class="text"><?php echo $text ?></p>
						<?php endif;?>
					</div>
					<div class=" zek_table">
						<?php echo  $row['table'] ?>
					</div>
				</div>
				<?php } ?>
				<?php } ?>
				<?php $chas = get_field('section2');
				if($chas) { ?>
				<?php foreach ($chas as $cha) {$text = $cha['text']; ?>
				<div class="zek_block zek_library_detail_sec2">
					<div class="zek_home_title">
						<div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt=""></div>
						<h2 class="title"><?php echo  $cha['title'] ?></h2>
						<?php if ($text):?>
						<p class="text"><?php echo $text ?></p>
						<?php endif;?>
					</div>
					<div class="zek_tab_content">
						<ul id="myTab" role="tablist" class="tab-title">
							<?php
	                        if($cha['tabs']) {
	                        $x=0;foreach ($cha['tabs'] as $con) {$x++; ?>
							<li role="presentation">
								<button class="nav-link <?php if ($x==1) { ?>active<?php } ?>" id="lib-tab<?php echo $x?>" data-bs-toggle="tab" data-bs-target="#lib<?php echo $x?>" type="button" role="tab" aria-controls="lib<?php echo $x?>" aria-selected="true"><h3><?php echo $con['name'];  ?></h3></button>
							</li>
							<?php } ?>
							<?php } ?>
						</ul>
						<div class="tab-content">
							<?php
	                        if($cha['tabs']) {
	                        $x=0;foreach ($cha['tabs'] as $con) {$x++; ?>
							<div class="tab-pane <?php if ($x==1) { ?>active<?php } ?>" id="lib<?php echo $x?>" role="tabpanel" aria-labelledby="lib-tab<?php echo $x?>">
								<div class="content-post clearfix">
									<?php echo $con['content'];  ?>
								</div>
								<div class="row row-margin">
									<?php
			                        if($con['list']) {
			                        foreach ($con['list'] as $con2) {?>
									<div class="col-xl-3 col-lg-3 col-md-6 col-12">
										<div class="item">
											<h4 class="key"><?php echo $con2['key'];  ?></h4>
											<div class="box">
												<p class="value"><?php echo $con2['value'];  ?></p>
											</div>
										</div>
									</div>
									<?php } ?>
									<?php } ?>
								</div>
							</div>
							<?php } ?>
							<?php } ?>
						</div>
					</div>
				</div>
				<?php } ?>
				<?php } ?>
				<?php $chas = get_field('section3');
	            if($chas) { ?>
	            <?php foreach ($chas as $cha) { ?>
	            <div class="zek_block zek_service_detail_sec3">
                    <div class="zek_home_title">
                        <div class="star"><img src="<?php bloginfo('template_url'); ?>/images/ic_star.svg" alt=""></div>
                        <h2 class="title"><?php echo $cha['title'];  ?></h2>
                    </div>
                    <div class="zek_slider zek_position">
                        <div class="swiper mySwiper_service">
                            <div class="swiper-wrapper">
                                <?php
                                if($cha['list']) {
                                foreach ($cha['list'] as $con) { ?>
                                <div class="swiper-slide">
                                    <div class="item text-center zek_position">
                                        <a href="<?php echo $con['link']; ?>" class="zek_linkfull"></a>
                                        <div class="img">
                                            <img src="<?php echo $con['img']; ?>" alt="">
                                        </div>
                                        <h3 class="name"><?php echo $con['name']; ?></h3>
                                    </div>
                                </div>
                                <?php } }?>
                            </div>
                        </div>
                        <div class="swiper-button-next swiper-button-next-rl"></div>
						<div class="swiper-button-prev swiper-button-prev-rl"></div>
                    </div>
	            </div>
	            <?php } }?>
			</div>
		</div>
		<?php $chas = get_field('section4','option');
        if($chas) { ?>
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
                                if($cha['list']) {
                                foreach ($cha['list'] as $con) { ?>
                                <li><?php echo $con['text']; ?></li>
                                <?php } }?>
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
        <?php } }?>
	</div>
</main>
<?php get_footer(); ?>