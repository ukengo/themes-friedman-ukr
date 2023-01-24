<?
/*
Template Name: новости1213
*/
get_header();
$user_id = get_current_user_id();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'news',
    'lang' => pll_current_language(),
    'publish' => true,
    'order' => 'desc',
    'orderby' => 'date',
    'paged' => $paged,
    'posts_per_page' => 10
);

$news_posts = new WP_Query($args);/*array with posts*/
$today = date('d.m.Y');
?>
<div class="content-position">

    <div class="content-column">


        <h1><?php pll_e('social2'); ?></h1>

        <div class="news-page">

            <div class="hr"></div>
            <ul class="news-list">

            <?php if ($news_posts->have_posts()) : while ($news_posts->have_posts()) : $news_posts->the_post(); ?>

                <li>
                    <?php if(get_the_date('d.m.Y') == $today):
                        $d = 'Сегодня';
                    else:
                        $d = get_the_date('d.m.Y');
                    endif;?>
                    <span class="date"><?php echo $d;?></span>
                    <a href="<?php the_permalink();?>">
                        <?php the_title();?>
                    </a>
                </li>
            <?php wp_reset_postdata(); ?>
<?php endwhile; ?>
            </ul>

            <?php
            $big = 999999999; // need an unlikely integer
            $args = array(
                'base'         => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                'format'       => '?page=%#%',
                'total'        => $news_posts->max_num_pages,
                'current'      => max( 1, get_query_var('paged') ),
                'show_all'     => False,
                'end_size'     => 1,
                'mid_size'     => 2,
                'prev_next'    => True,
                'prev_text'    => __('<'),
                'next_text'    => __('>'),
                'type'         => 'list',
                'add_args'     => False,
                'add_fragment' => '',
                'before_page_number' => '',
                'after_page_number'  => ''
            );
            echo paginate_links($args);
            ?>
<?php endif;?>
        </div>
    </div>
    <?php get_sidebar();?>
</div>
<div id ="seo-text">
</div>

<div class="footer-place"></div>

</section>

<?php wp_reset_postdata();
get_footer();