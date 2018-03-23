<?php get_header(); ?>
<div class="banner-archive">
    <?php if(get_option('bg_page') != ""): ?>
    <img src="<?php echo get_option('bg_page'); ?>" alt="<?php the_title(); ?>" />
    <?php else: ?>
    <img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner_default.png" alt="<?php the_title(); ?>" />
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
        <div class="span8">
            <?php while (have_posts()) : the_post(); ?>
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
                <?php show_share_socials(); ?>
            <?php endwhile; ?>
        </div>
        <div class="span4 sidebar">
            <?php get_sidebar('page'); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>