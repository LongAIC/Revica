<footer id="footer">
    <div class="container">
        <div class="zek_footer_logo">
            <a href="<?php bloginfo('home');?>" title="<?php bloginfo('title'); ?>"><img src="<?php the_field('logo','option') ?>" alt="<?php bloginfo('title');?>"/></a>
        </div>
        <div class="zek_footer_main">
            <div class="f-widget">
                <?php dynamic_sidebar( 'footer1'); ?>
            </div>
        </div>
        <div class="zek_footer_bot">
            <div class="f-widget">
                <?php dynamic_sidebar( 'footer2'); ?>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript" src="<?php bloginfo('template_url' ); ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url' ); ?>/js/swiper-bundle.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url' ); ?>/js/datetime-picker.js"></script>
<script src="<?php bloginfo('template_url' ); ?>/js/wow.min.js"></script>
<script>
 new WOW().init();
</script>
<script>
    $("#thong_tin_tai_khoan").click(function (){
        window.location.href='<?php echo home_url(). '/manager-order/#tab-taikhoan' ?>';
    });
    (function($) {
        var searchTerm;

        $.expr[':'].containsCaseInsensitive = function (n, i, m) {
            return $(n).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
        };

        $('#accordion_search_bar').on('input', function () {
            searchTerm = $(this).val().trim();

            if (searchTerm.length >= 3) {
                $('.accordion-item').each(function () {
                    var $panelContainer = $(this);
                    var $accordionButton = $panelContainer.find('.accordion-button');
                    var $accordionCollapse = $panelContainer.find('.accordion-collapse');

                    if ($panelContainer.is(':containsCaseInsensitive(' + searchTerm + ')')) {
                        $accordionCollapse.addClass('show');
                        $accordionButton.attr('aria-expanded', 'true');
                    } else {
                        $accordionCollapse.removeClass('show');
                        $accordionButton.attr('aria-expanded', 'false');
                    }
                });

                $('.accordion-body > .item').each(function () {
                    var $item = $(this);

                    if ($item.is(':containsCaseInsensitive(' + searchTerm + ')')) {
                        $item.show();
                    } else {
                        $item.hide();
                    }
                });
            } else {
                $('.accordion-button').attr('aria-expanded', 'false');
                $('.accordion-collapse').removeClass('show');
                $('.accordion-body > .item').show();
            }
        });
    })(jQuery);
</script>
<script type="text/javascript" src="<?php bloginfo('template_url' ); ?>/js/custom.js"></script>


<?php the_field('code_footer','option')?>
<?php wp_footer(); ?>
</div>
</body>
</html>