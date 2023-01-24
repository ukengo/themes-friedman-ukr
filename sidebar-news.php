<?php
//$cur_lang = pll_e('cur_lang');
$args = array(
    'post_type' => 'news',
    'publish' => true,
    'order' => 'desc',
    'orderby' => 'date',
    'lang' => pll_current_language($value),
    'posts_per_page' => 4

);

$news_posts = new WP_Query($args);/*array with posts*/
$today = date('d.m.Y');
?>
<div class="news-sidebar">
	
    <div style="padding: 0 0 13px;font-weight: 700;font: 16px 'Ubuntu', Arial;color: #000;"><?php echo pll_e('social2'); ?></div>
    <ul>
        <?php if ($news_posts->have_posts()) : while ($news_posts->have_posts()) : $news_posts->the_post(); ?>

            <?php $d = get_the_date('d.m.Y'); ?>
            <li>
                <span class="date"><?php echo $d; ?></span>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </li>
            <?php wp_reset_postdata(); ?>
        <?php endwhile; endif;?>
    </ul>
</div>
