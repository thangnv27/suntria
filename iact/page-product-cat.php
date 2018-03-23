<?php
/*
  Template Name: Loại sản phẩm
 */
?>
<?php get_header(); ?>
<div class="banner-archive">
    <?php if (get_option('bg_product') != ""): ?>
        <img src="<?php echo get_option('bg_product'); ?>" alt="<?php the_title(); ?>" />
    <?php else: ?>
        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner_product.jpg" alt="<?php the_title(); ?>" />
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
        <?php while (have_posts()) : the_post(); ?>
        <div class="span9 cat-items">
            <div class="cat-title"><h2><?php the_title(); ?></h2></div>
            <div class="clearfix"></div>
            <div class="cat-item-content">
                <?php 
                foreach (get_terms('product_category') as $key => $cat) : 
                    if ($key%3==0): ?>
                    <div class="clearfix"></div>
                    <div class="span4 mb25 ml0 cat-item">
                    <?php else: ?>
                    <div class="span4 mb25 cat-item">
                    <?php endif; ?>
                        <a href="<?php echo get_term_link($cat->slug, 'product_category'); ?>">
                            <img title="<?php echo $cat->name; ?>" alt="<?php echo $cat->name; ?>" src="<?php echo z_taxonomy_image_url($cat->term_id); ?>" onerror="this.src=no_image_src" />
                        </a>
                        <div class="cat-item-title"><a href="<?php echo get_term_link($cat->slug, 'product_category'); ?>"><?php echo $cat->name; ?></a></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
<?php get_footer(); ?>