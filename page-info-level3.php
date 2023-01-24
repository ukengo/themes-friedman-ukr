<?
/*
Template Name: База знаний - Подраздел №3
*/
get_header();
$user_id = get_current_user_id();
$post_id = get_the_ID();
$parent_page_id = get_ancestors( $post_id, 'page' );//нужен $parent_page_id[1]
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
                <?php if(!get_field('page_title')):
                    the_title();
                else:
                    the_field('page_title');
                endif;
                ?>
            </h1>
            <div class="art_content">
                <?php the_content();?>
            </div>
            <?php if (have_rows('dop_mats')):?>
                <div class="relevant-links">
                    <div style="padding: 0 0 16px;font: 16px 'Ubuntu', Arial; color: #000;"><?php pll_e('other_materials'); ?></div>
                    <ul class="links-list">
                        <?php while (have_rows('dop_mats')) : the_row();
                            $dop_mat = get_sub_field('dop_mat');
                            ?>

                            <li>
                                <a href="<?php echo get_page_link($dop_mat->ID);?>">
                                    <?php echo $dop_mat->post_title;?>
                                </a>
                            </li>
                        <?php endwhile;?>
                    </ul>
                </div>
            <?php else:
                $childrens_services = get_children( array(
                    'post_parent' => $parent_page_id[0],
                    'post_type'   => 'page',
                    'order'       => 'DESC',
                    'numberposts' => 7,
                    'post_status' => 'any'
                ) );
                $children_count = count($childrens_services) - 1;
                if($children_count >= 1):
                    ?>
                    <div class="relevant-links">
                        <div style="padding: 0 0 16px;font: 16px 'Ubuntu', Arial;
color: #000;"><?php pll_e('other_materials'); ?></div>
                        <ul class="links-list">
                            <?php

                            foreach ($childrens_services as $child):?>
                                <?php if($child->ID != $post_id):?>
                                    <li>
                                        <a href="<?php echo get_page_link($child->ID);?>">
                                            <?php echo $child->post_title;?>
                                        </a>
                                    </li>
                                <?php endif;?>

                            <?php endforeach;?>
                        </ul>
                    </div>
                <?php endif; endif;?>

        </div>
        <?php get_sidebar();?>
    </div>
    <div id="seo-text">
    </div>
<?php get_sidebar('news');?>

    <div class="footer-place"></div>

    </section>
<?php get_footer();
