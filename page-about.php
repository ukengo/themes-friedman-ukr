<?
/*
Template Name: Компания
*/
get_header();
$user_id = get_current_user_id();
?>
    <div class="content-position">

        <div class="content-column">

            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div class="breadcrumbs" id="breadcrumbs">', '</div>');
            }
            ?>

            <h1>
                <?php if(get_field('page_title')):
                    the_field('page_title');
                else:
                    the_title();
                endif;
                ?>
            </h1>
			
			
            <div class="art_content">
                <div style="text-align: justify;">
                    <?php the_content();?>
                </div>
            </div>
        </div>
        <?php get_sidebar();?>
    </div>
    <div id ="seo-text">
    </div>
<?php get_sidebar('news');?>

    <div class="footer-place"></div>

    </section>
<?php get_footer();
