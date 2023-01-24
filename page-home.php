<?
/*
Template Name: Домашняя страница
*/
get_header();
$user_id = get_current_user_id();
$args = array(
    'post_type' => 'news',
    'publish' => true,
    'order' => 'desc',
    'orderby' => 'date',
    'posts_per_page' => 4,
    'lang' => pll_current_language()
);
$news_posts = new WP_Query($args);/*array with posts*/
$today = date('d.m.Y');
?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/scripts1.js"></script>
	<script>
jQuery(document).ready(function($) {
  let lang = document.documentElement.lang;
    if  (lang == 'uk-UA') {
   jQuery('.header .logo').attr('href', '//xn--80ahyflx1k.xn--j1amh/ua/golovna/');}
});
</script>
    <div class="index-top-sidebar">

        <div class="left-column">
            <div class="flexslider">
                <ul class="slides">

                    <?php
                    if (have_rows('h_slider')): while (have_rows('h_slider')) : the_row();
                        $image = get_sub_field('h_slider_img');
                        $title = get_sub_field('h_slider_title');
                        $page_link = get_sub_field('h_slider_page_link');
                        $page = get_sub_field('h_slider_page');
                        $link = get_sub_field('h_slider_link');
                        $current_link = '';
                        ?>
                        <li>
                            <img src="<?php echo $image; ?>" alt=""/>
                        <span class="title">
                            <span>
                                <span class="head">
                                    <?php echo $title; ?>
                                </span>
                                <?php if ($page_link == 'page'):
                                    $current_link = get_page_link($page->ID);
                                elseif ($page_link = 'link'):
                                    $current_link = $link;
                                endif;
                                ?>

                                <a href="<?php echo $current_link; ?>"> Читать дальше</a></span>
                        </span>
                        </li>

                    <?php endwhile; endif; ?>
                </ul>
            </div>
        </div>

        <div class="right-column">
            <div class="news-sidebar">
                <div style="padding: 0; font-weight: 500; position: relative; font: 18px 'Ubuntu', Arial;color: #000;">
               <?php pll_e('social2'); ?>
                    <a style="position: absolute;top: 9px;right: -2px;color: #959595;font: 12px 'arial';" href="<?php pll_e('news_link'); ?>"><?php pll_e('read_all'); ?></a>
                </div>
                <ul>
                    <?php if ($news_posts->have_posts()) : while ($news_posts->have_posts()) : $news_posts->the_post(); ?>


                        <li>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                            → <?php 
                            if (get_the_date('d.m.Y') == $today):
                            $d = pll_e('today');
                        else:
                            $d = get_the_date('d.m.Y');
                        endif;  echo $d; ?>
                        </li>

                        <?php wp_reset_postdata(); ?>
                    <?php endwhile; endif; ?>
                </ul>
            </div>
        </div>

    </div>
    <div class="index-nav">
        <ul>
            <?php
            if (have_rows('h_services_link')): while (have_rows('h_services_link')) : the_row();
                $page = get_sub_field('h_s_l');
                $icon = get_sub_field('h_s_i');
                ?>
                <li>
                    <a href="<?php echo get_page_link($page->ID);?>">
                        <span class="icon" style="background-image: url(<?php echo $icon; ?>)"></span>
                        <?php echo $page->post_title;?><br>
                    </a>
                </li>

            <?php endwhile; endif; ?>
        </ul>
    </div>
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
                    <a href="<?php echo get_page_link($page->ID);?>">    <?php pll_e('uzb2'); ?></a>
                </li>

            <?php endwhile; endif; ?>
        </ul>

    </div>
    <div id="seo-text">
    </div>

    <div class="footer-place"></div>

    </section>
<?php get_footer();
