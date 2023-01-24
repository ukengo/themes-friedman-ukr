<?php
get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'news',
    'publish' => true,
    'order' => 'desc',
    'orderby' => 'date',
    'paged' => $paged,
    'posts_per_page' => 5
);
the_post();
$news_posts = new WP_Query($args);/*array with posts*/
$today = date('d.m.Y');
$post_id = get_the_ID();
?>
    <div class="content-position">
		<style> lang-items :{display:none;important;}</style>


        <div class="content-column">

    <div class="breadcrumbs" id="breadcrumbs">
		<span xmlns:v="//rdf.data-vocabulary.org/#">
			<span typeof="v:Breadcrumb">
				<a href="//xn--80ahyflx1k.xn--j1amh/ua/golovna/" rel="v:url" property="v:title"><?php pll_e('breadcrumbs-home1222'); ?></a>
					 → <a href="//xn--80ahyflx1k.xn--j1amh/ua/golovna/" rel="v:url" property="v:title"><?php pll_e('social2'); ?></a>
				<span class="breadcrumb_last"> → <?php the_title(); ?></span>
			</span>
		</span>
	</div>
            <h1><?php the_title(); ?></h1>
            <?php 
          
                $d = get_the_date('d.m.Y');
         ?>
            <span class="date"><?php echo $d; ?></span>
            <div class="art_content">
                <?php the_content(); ?>
            </div>
            <div class="hr"></div>
            <h3><?php pll_e('Свежие новости раздела'); ?></h3>
            <ul class="news-list">

                <?php if ($news_posts->have_posts()) :
                while ($news_posts->have_posts()) : $news_posts->the_post(); ?>
                    <?php if ($post_id != get_the_ID()): ?>
                        <li>
                            <?php 
                               
                                $d = get_the_date('d.m.Y');
                      ?>
                            <span class="date"><?php echo $d; ?></span>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php wp_reset_postdata(); ?>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
        </div>

        <?php get_sidebar(); ?>    
    </div>
    </div>
    <div id="seo-text">
    </div>

    <div class="footer-place"></div>

    </section>
<?php get_footer();
