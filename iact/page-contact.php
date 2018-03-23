<?php
/*
  Template Name: Contact
 */
?>
<?php get_header(); ?>
<div class="banner-archive">
    <?php if(get_option('bg_contact') != ""): ?>
    <img src="<?php echo get_option('bg_contact'); ?>" alt="<?php the_title(); ?>" />
    <?php else: ?>
    
    <img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner_contact.png" alt="<?php the_title(); ?>" />
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
    <!--BEGIN CONTACT PAGE-->
    <?php while (have_posts()) : the_post(); ?>
        <div class="row-fluid contact">
            <div class="span5">
                <?php the_content(); ?>
            </div>
            <div class="span7 gmap">
                <?php echo stripslashes(get_option(SHORT_NAME . "_gmaps")); ?>
            </div>
        </div>
    <?php endwhile; ?>
    <!--END CONTACT PAGE-->
</div>
<?php get_footer(); ?>