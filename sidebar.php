<?php
$page_id = 13;
$page_link = get_page_link($page_id);
$child_page_id = 20;
$childrens = get_children( array(
    'post_parent' => $child_page_id,
    'post_type'   => 'page',
    'order'       => 'ASC',
    'numberposts' => -1,
    'post_status' => 'any'
) );
?>

<div class="right-sidebar">
    <div class="knowledge-base">
        <p class="head">
            <?php
            $m_page = get_field('doc_side_main_NEW','options');
            ?>
            <a href="<?php echo get_page_link($m_page->ID);?>" style=color:#7d7d7d>
                <?php echo $m_page->post_title;?>
            </a>
        </p>
        <ul>
        <?php
        if( have_rows('doc_side_pages_NEW','options') ):  while ( have_rows('doc_side_pages_NEW','options') ) : the_row();
            $page_info = get_sub_field('doc_side_page_NEW','options');
            ?>

            <li class="first">
                <a href="<?php echo get_page_link($page_info->ID);?>">
                    <?php the_field('pt2', $page_info->ID);?>
                </a>
            </li>

        <?php endwhile; endif?>
        </ul>
    </div>
    <?php if(get_field('side_banner_img', 'options')):?>
    <div class="banner-box">
        <a href="<?php the_field('side_banner_link', 'options');?>"><img src="<?php the_field('side_banner_img', 'options');?>" alt=""/></a>
    </div>
    <?php endif;?>
</div>