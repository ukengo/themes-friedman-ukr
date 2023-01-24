<?
/*
Template Name: База знаний - Подраздел №2
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

                <?php if(!get_field('page_title')):
                    the_title();
                else:
                    the_field('page_title');
                endif;
                ?>
            </h1>
            <div class="note">
                <?php the_content();?>
            </div>
            <div class="hr"></div>

            <ul class="links-list">
                <?php
                $childrens = get_children( array(
                    'post_parent' => $post_id,
                    'post_type'   => 'page',
                    'order'       => 'DESC',
                    'numberposts' => -1,
                    'post_status' => 'any'
                ) );

                if( $childrens ):
                    $children_count = count($childrens);
                    $i = 0;
                    foreach( $childrens as $children ):?>
                        <li>
                            <a href="<?php echo $current_link.$children->post_name.'/';?>">
                                <?php echo $children->post_title;?>
                            </a>
                        </li>
                    <?php endforeach; endif;?>
            </ul>
        </div>
        <?php get_sidebar();?></div>
    <div></div>
    <div id ="seo-text">
    </div>
<?php get_sidebar('news');?>

    <div class="footer-place"></div>

    </section>
<?php get_footer();
