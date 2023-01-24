<?
/*
Template Name: Заказ услуг
*/
get_header();
$user_id = get_current_user_id();
?>
    <div class="content-position">
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/scripts1.js"></script>
        <div class="content-column">

            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div class="breadcrumbs" id="breadcrumbs">', '</div>');
            }
            ?>
            <h1><?php pll_e('Заказ услуг'); ?></h1>

            <div class="hr"></div>

            <?php echo do_shortcode('[contact-form-7 id="1959" title="Заказ услуг"]'); ?>

            <script type="text/javascript">
                $('#ordForm').submit(
                    function () {
                        dataLayer.push({
                            'event': 'gaTriggerEvent',
                            'gaEventCategory': 'form_send',
                            'gaEventAction': 'Получить консультацию11'
                        });
                    }
                );
            </script>


        </div>
        <?php get_sidebar(); ?></div>
    <div></div>
    <div id="seo-text">
    </div>
<?php get_sidebar('news');?>

    <div class="footer-place"></div>

    </section>
<?php get_footer();