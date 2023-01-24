<?
get_header();
$user_id = get_current_user_id();
?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/scripts1.js"></script>

    <div class="content-position index">

        <div class="content-column">
            <?php the_content();?>
        </div>
        <?php get_sidebar(); ?>
    </div>


    <div class="index-banners">

        <ul>
            <?php
            if (have_rows('h_b_pages')): while (have_rows('h_b_pages')) : the_row();
                $page = get_sub_field('h_b_page');
                $title = get_sub_field('h_b_title');
                $caption = get_sub_field('h_b_caption');
                ?>

                <li>
                    <div class="_tit"><?php echo $caption;?></div>

                    <p>
                        <?php echo $title;?>
                    </p>
                    <a href="<?php echo get_page_link($page->ID);?>"><?php pll_e('Узнать больше'); ?></a>
                </li>

            <?php endwhile; endif; ?>
        </ul>

    </div>
    <div id="seo-text">
    </div>

    <div class="footer-place"></div>

    </section>
<?php get_footer();