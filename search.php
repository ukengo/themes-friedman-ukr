<?php
/*
Template Name: Поиск
*/

get_header();
?>
    <div class="content-position">
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/scripts1.js"></script>
        <div class="content-column">
            <div class="">
                <h3><?php pll_e('Вы искали: '); ?><?php the_search_query(); ?></h3>
            </div>

            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="//schema.org/">
                <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
                }?>
            </div>
            <?php if (have_posts()) : ?>

                <?php while (have_posts()) : the_post(); ?>

                    <div class="search-item">

                        <h3>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>

                        <?php the_date('d.m.Y', '<p>', '</p>'); ?>
                        <?php if(get_the_content()):?>
                            <?php the_excerpt(); ?>
                        <?php endif;?>

                        <a href="<?php the_permalink(); ?>" class="more">
                            <?php pll_e('Детальнее'); ?>
                        </a>
                    </div>

                <?php endwhile;  ?>
            <?php else : ?>
                <div class="alert alert-error"><?php pll_e('Поиск не дал результатов'); ?></div>
            <?php endif; ?>
        </div>
        <?php get_sidebar();?>
    </div>


    </section>

<?php
get_footer();