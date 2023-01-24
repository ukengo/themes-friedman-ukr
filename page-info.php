<?
/*
Template Name: База знаний
*/
get_header();
$user_id = get_current_user_id();
$post_id = get_the_ID();
$current_link = get_page_link($post_id);
?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/scripts.js"></script>
    <div class="content-position">
        <div class="content-column">
            <div class="content-column">

                <?php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<div class="breadcrumbs" id="breadcrumbs">', '</div>');
                }
                ?>
                <h1><?php pll_e('База знаний'); ?></h1>
                <p class="note">

                </p>
                <div class="hr"></div>
                <div class="links-two-column">
                    <?php if (have_rows('bz_cats')): ?>
                        <div class="column">
                            <ul>
                                <?php while (have_rows('bz_cats')) : the_row();
                                    $category = get_sub_field('bz_cat');
                                    $drop = get_sub_field('bz_drop');//y & n
                                    $link = '';
                                    $ul = '';
                                    if ($drop == 'y') {
                                        $link = '#';
                                        $ul = true;
                                        $class = '_child';
                                    } elseif ($drop == 'n') {
                                        $link = get_page_link($category->ID);
                                        $ul = false;
                                        $class = '_nochild';
                                    }
                                    ?>
                                    <li>
                                        <a class="<?php echo $class;?>" href="<?php echo $link; ?>"><?php echo $category->post_title;?></a>
                                        <?php if ($ul):
                                            $childrens = get_children(array(
                                                'post_parent' => $category->ID,
                                                'post_type' => 'page',
                                                'order' => 'desc',
                                                'numberposts' => -1,
                                                'post_status' => 'any'
                                            ));
                                            ?>
                                            <ul>
                                                <?php foreach ($childrens as $child): ?>
                                                    <li>
                                                        <a href="<?php echo get_page_link($child->ID); ?>"><?php echo $child->post_title; ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                    <?php wp_reset_postdata();
                                endwhile; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                        <?php if (have_rows('bz_cats_2')): ?>
                            <div class="column">
                                <ul>
                                    <?php while (have_rows('bz_cats_2')) : the_row();
                                        $category = get_sub_field('bz_cat_2');
                                        $drop = get_sub_field('bz_drop_2');//y & n
                                        $link = '';
                                        $ul = '';
                                        if ($drop == 'y') {
                                            $link = '#';
                                            $ul = true;
                                            $class = '_child';
                                        } elseif ($drop == 'n') {
                                            $link = get_page_link($category->ID);
                                            $ul = false;
                                            $class = '_nochild';
                                        }
                                        ?>
                                        <li>
                                            <a class="<?php echo $class;?>" href="<?php echo $link; ?>"><?php echo $category->post_title;?></a>
                                            <?php if ($ul):
                                                $childrens = get_children(array(
                                                    'post_parent' => $category->ID,
                                                    'post_type' => 'page',
                                                    'order' => 'desc',
                                                    'numberposts' => -1,
                                                    'post_status' => 'any'
                                                ));
                                                ?>
                                                <ul>
                                                    <?php foreach ($childrens as $child): ?>
                                                        <li>
                                                            <a href="<?php echo get_page_link($child->ID); ?>"><?php echo $child->post_title; ?></a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </li>
                                        <?php wp_reset_postdata();
                                    endwhile; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                </div>
            </div>
        </div>
        <?php get_sidebar(); ?></div>
    <div></div>
    <div id="seo-text">
    </div>
<?php get_sidebar('news'); ?>

    <div class="footer-place"></div>

    </section>
<?php get_footer();