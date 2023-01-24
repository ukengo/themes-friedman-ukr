<?
/*
Template Name: Услуги
*/
get_header();
$user_id = get_current_user_id();
$post_id = get_the_ID();
$current_link = get_page_link($post_id);
?>
    <div class="content-position">
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/scripts1.js"></script>
        <div class="content-column">

            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div class="breadcrumbs" id="breadcrumbs">', '</div>');
            }
            ?>
            <h1>
                <?php if (!get_field('page_title')):
                    the_title();
                else:
                    the_field('page_title');
                endif;
                ?>
            </h1>
            <div class="note">
                <?php the_content(); ?>
            </div>
            <div class="hr"></div>


            <div class="services-box">
                <h2><span class="icon"
                          style="background-image:url(<?php echo get_template_directory_uri(); ?>/img/st_img/1.png)"></span><?php pll_e('Разрешительные документы'); ?></h2>
                <div class="columns">
                    <div class="column">
                        <?php
                        if (have_rows('services_col_1')): while (have_rows('services_col_1')) : the_row();
                            $page_info = get_sub_field('services_razd');
                            ?>

                            <h3><?php echo $page_info->post_title; ?></h3>
                            <ul class="links-list">
                                <?php
                                $childrens = get_children(array(
                                    'post_parent' => $page_info->ID,
                                    'post_type' => 'page',
                                    'order' => 'desc',
                                    'orderby' => 'date',
                                    'numberposts' => -1,
                                    'post_status' => 'any'
                                ));
                                foreach ($childrens as $children):?>
                                    <li>
                                        <a href="<?php echo get_page_link($children->ID); ?>"><?php echo $children->post_title; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endwhile; endif ?>
                    </div>
                    <div class="column">
                        <?php
                        if (have_rows('services_col_2')): while (have_rows('services_col_2')) : the_row();
                            $page_info = get_sub_field('services_razd2');
                            ?>

                            <h3><?php echo $page_info->post_title; ?></h3>
                            <ul class="links-list">
                                <?php
                                $childrens = get_children(array(
                                    'post_parent' => $page_info->ID,
                                    'post_type' => 'page',
                                    'order' => 'desc',
                                    'numberposts' => -1,
                                    'post_status' => 'any'
                                ));
                                foreach ($childrens as $children):?>
                                    <li>
                                        <a href="<?php echo get_page_link($children->ID); ?>"><?php echo $children->post_title; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endwhile; endif ?>
                    </div>
                    <div class="column">
                        <?php
                        if (have_rows('services_col_3')): while (have_rows('services_col_3')) : the_row();
                            $page_info = get_sub_field('services_razd3');
                            ?>

                            <h3><?php echo $page_info->post_title; ?></h3>
                            <ul class="links-list">
                                <?php
                                $childrens = get_children(array(
                                    'post_parent' => $page_info->ID,
                                    'post_type' => 'page',
                                    'order' => 'desc',
                                    'numberposts' => -1,
                                    'post_status' => 'any'
                                ));
                                foreach ($childrens as $children):?>
                                    <li>
                                        <a href="<?php echo get_page_link($children->ID); ?>"><?php echo $children->post_title; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endwhile; endif ?>
                    </div>
                </div>
            </div>

            <div class="services-box">
                <h2><span class="icon"
                          style="background-image:url(<?php echo get_template_directory_uri(); ?>/img/st_img/2.png)"></span><?php pll_e('Таможенное оформление'); ?></h2>
                <div class="columns">
                    <div class="column">
                        <ul class="links-list">
                            <?php
                            if (have_rows('tam_col_1')): while (have_rows('tam_col_1')) : the_row();
                                $page_info = get_sub_field('tam_razd');
                                ?>

                                <li>
                                    <a href="<?php echo get_page_link($page_info->ID); ?>"><?php echo $page_info->post_title; ?></a>
                                </li>
                            <?php endwhile; endif ?>
                        </ul>

                    </div>
                    <div class="column">
                        <ul class="links-list">
                            <?php
                            if (have_rows('tam_col_2')): while (have_rows('tam_col_2')) : the_row();
                                $page_info = get_sub_field('tam_razd2');
                                ?>

                                <li>
                                    <a href="<?php echo get_page_link($page_info->ID); ?>"><?php echo $page_info->post_title; ?></a>
                                </li>
                            <?php endwhile; endif ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="services-box">
                <h2><span class="icon"
                          style="background-image:url(<?php echo get_template_directory_uri(); ?>/img/st_img/4.png)"></span><?php pll_e('Перевозки'); ?>
                </h2>
                <div class="columns">
                    <div class="column">
                        <ul class="links-list">
                            <?php
                            if (have_rows('per_col_1')): while (have_rows('per_col_1')) : the_row();
                                $page_info = get_sub_field('per_razd');
                                ?>

                                <li>
                                    <a href="<?php echo get_page_link($page_info->ID); ?>"><?php echo $page_info->post_title; ?></a>
                                </li>
                            <?php endwhile; endif ?>
                        </ul>
                    </div>
                    <div class="column">
                        <ul class="links-list">
                            <?php
                            if (have_rows('per_col_2')): while (have_rows('per_col_2')) : the_row();
                                $page_info = get_sub_field('per_razd2');
                                ?>

                                <li>
                                    <a href="<?php echo get_page_link($page_info->ID); ?>"><?php echo $page_info->post_title; ?></a>
                                </li>
                            <?php endwhile; endif ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="services-box">
                <h2><span class="icon"
                          style="background-image:url(<?php echo get_template_directory_uri(); ?>/img/st_img/3.png)"></span><?php pll_e('Прочие услуги в сфере ВЭД'); ?></h2>
                <div class="columns">
                    <div class="column">
                        <ul class="links-list">
                            <?php
                            if (have_rows('dr_col_1')): while (have_rows('dr_col_1')) : the_row();
                                $page_info = get_sub_field('dr_razd');
                                ?>

                                <li>
                                    <a href="<?php echo get_page_link($page_info->ID); ?>"><?php echo $page_info->post_title; ?></a>
                                </li>
                            <?php endwhile; endif ?>
                        </ul>
                    </div>
                    <div class="column">
                        <ul class="links-list">
                            <?php
                            if (have_rows('dr_col_2')): while (have_rows('dr_col_2')) : the_row();
                                $page_info = get_sub_field('dr_razd2');
                                ?>

                                <li>
                                    <a href="<?php echo get_page_link($page_info->ID); ?>"><?php echo $page_info->post_title; ?></a>
                                </li>
                            <?php endwhile; endif ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
    <div id="seo-text">
    </div>
<?php get_sidebar('news');?>

    <div class="footer-place"></div>

    </section>
<?php get_footer();