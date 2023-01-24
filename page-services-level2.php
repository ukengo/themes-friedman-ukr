<?
/*
Template Name: Услуги - Подраздел №2
*/
get_header();
$user_id = get_current_user_id();
$post_id = get_the_ID();
$parent_page_id = get_ancestors( $post_id, 'page' );
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
                <?php if(get_field('page_title')):
                    the_field('page_title');
                else:
                    the_title();
                endif;
                ?>
            </h1>
            <div class="note">
                <?php the_content();?>
            </div>
            <div class="hr"></div>
            <div class="documents-two-column">
                <div class="column">
                    <ul>
                        <?php
                        $childrens_services = get_children( array(
                            'post_parent' => $post_id,
                            'post_type'   => 'page',
                            'order'       => 'DESC',
                            'numberposts' => -1,
                            'post_status' => 'any'
                        ) );

                        if( $childrens_services ):
                            $children_count = count($childrens_services);
                            $i = 0;
                            foreach( $childrens_services as $children):?>
                                <?php if(!get_field('services_child_page_icon', $parent_page_id[0])) {
                                    $bg = get_field('services_child_page_icon', $post_id);
                                }
                                else{
                                    $bg = get_field('services_child_page_icon', $parent_page_id[0]);
                                }?>
                                <li class="<?php echo $parent_page_id[0];?>" style="background:url(<?php echo $bg;?>) no-repeat">
                                    <a href="<?php echo get_page_link($children->ID);?>">
                                        <?php echo $children->post_title;?>
                                    </a>
                                </li>
                            <?php endforeach; endif;?>

                    </ul>
                </div>
            </div>
        </div>
        <?php get_sidebar();?></div>
    <div></div>
    <div id ="seo-text">
    </div>
<?php get_sidebar('news');?>

    <div class="footer-place"></div>

    </section>
<?php get_footer();
