<?php get_header(); ?>
<div class="banner-archive">
    <?php if(get_option('bg_partner') != ""): ?>
    <img src="<?php echo get_option('bg_partner'); ?>" alt="<?php single_cat_title(); ?>" />
    <?php else: ?>
    <img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner_partner.png" alt="<?php single_cat_title(); ?>" />
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
            <div class="archive-item">
                <?php while (have_posts()) : the_post(); ?>
                <div class="post-item clearfix">
                    <div class="span4">
                            <img title="<?php the_title(); ?>" alt="<?php the_title(); ?>" class="img-rounded" src="<?php get_image_url(); ?>" onerror="this.src=no_image_src"/>
                    </div>
                    <div class="span8">
                        <h3 class="partner-title"><?php the_title(); ?></h3>
                        <div class="pitem-excerpt">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <?php getpagenavi(); ?>
        </div>
        <div class="span4 sidebar">
            <?php get_sidebar() ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>