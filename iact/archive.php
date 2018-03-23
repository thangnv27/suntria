<?php get_header(); ?>
<div class="banner-archive">
    <?php if(get_option('bg_post') != ""): ?>
    <img src="<?php echo get_option('bg_post'); ?>" alt="<?php single_cat_title(); ?>" />
    <?php else: ?>
    <img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner_post.png" alt="<?php single_cat_title(); ?>" />
    <?php endif; ?>
    <div class="container">
        <div class="row-fluid heading">
            <h1><?php single_cat_title(); ?></h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row-fluid breadcrumbs">
        <?php
        if (function_exists('bcn_display')) {
            bcn_display();
        }
        ?>
    </div>
</div>
<div class="container">
    <div class="row-fluid archive">
        <div class="span8">
            <?php while (have_posts()) : the_post(); ?>
            <div class="post-item clearfix">
                <div class="span4">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <img title="<?php the_title(); ?>" alt="<?php the_title(); ?>" class="img-rounded" src="<?php get_image_url(); ?>" onerror="this.src=no_image_src"/>
                    </a>
                </div>
                <div class="span8">
                    <a class="pitem-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><h3><?php the_title(); ?></h3></a>
                    <div class="pitem-meta">
                        <span class="pitem-date"><?php the_time('d/m/Y, H:i'); ?></span>
                        <span> | </span>
                        <span class="pitem-category"><?php the_category(', '); ?></span>
                    </div>
                    <div class="pitem-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="pitem-details"><a data-i18n="link.more" href="<?php the_permalink(); ?>">Xem tiếp +</a></div>
                </div>
            </div>
            <?php endwhile; ?>
            <?php getpagenavi(); ?>
        </div>
        <div class="span4 sidebar">
            <?php get_sidebar() ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>