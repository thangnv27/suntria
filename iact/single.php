<?php get_header(); ?>
<div class="banner-archive">
    <?php if(get_option('bg_post') != ""): ?>
    <img src="<?php echo get_option('bg_post'); ?>" alt="<?php the_title(); ?>" />
    <?php else: ?>
    <img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner_post.png" alt="<?php the_title(); ?>" />
    <?php endif; ?>
    <div class="container">
        <div class="row-fluid heading">
            <h2><?php the_title(); ?></h2>
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
                <h1 class="post-title"><?php the_title(); ?></h1>
                <div class="post-meta">
                    <span class="post-date"><?php the_time('d/m/Y'); ?></span>
                    <span> | </span>
                    <span class="pitem-category"><?php the_category(', '); ?></span>
                </div>
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
                <div class="tags">
                    <?php the_tags('<b>TAGS: </b>', ', ', ''); ?>
                </div>
                <?php show_share_socials(); ?>
            <?php endwhile; ?>
        </div>
        <div class="span4 sidebar">
            <?php get_sidebar('single'); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>