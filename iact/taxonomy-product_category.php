<?php get_header(); ?>
<div class="banner-archive">
    <?php if (get_option('bg_product') != ""): ?>
        <img src="<?php echo get_option('bg_product'); ?>" alt="<?php single_cat_title(); ?>" />
    <?php else: ?>
        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner_product.jpg" alt="<?php single_cat_title(); ?>" />
    <?php endif; ?>
    <div class="container">
        <div class="row-fluid heading">
            <h1><?php the_title(); ?></h1>
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
        <div class="span3 sidebar">
            <?php get_sidebar('page-cat'); ?>
        </div>
        <div class="span9 cat-items">
            <div class="cat-title"><h2><?php single_cat_title(); ?></h2></div>
            <div class="clearfix"></div>
            <div class="cat-item-content">
                <?php 
                $counter = 0;
                while (have_posts()) : the_post();
                    if ($counter%3==0): ?>
                    <div class="clearfix"></div>
                    <div class="span4 mb25 ml0 cat-item">
                    <?php else: ?>
                    <div class="span4 mb25 cat-item">
                    <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <img src="<?php echo get_image_url(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" onerror="this.src=no_image_src" />
                        </a>
                        <div class="cat-item-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
                    </div>
                <?php $counter++; endwhile; ?>
            </div>
            <?php getpagenavi(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>