<?php get_header(); ?>
<div class="banner-archive">
    <?php if (get_option('bg_recruitment') != ""): ?>
        <img src="<?php echo get_option('bg_recruitment'); ?>" alt="<?php the_title(); ?>" />
    <?php else: ?>
        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner_recruitment.png" alt="<?php the_title(); ?>" />
    <?php endif; ?>
    <div class="container">
        <div class="row-fluid heading">
            <h2 data-i18n="recruitment.title">Tuyển dụng</h2>
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
                <div class="post-banner">
                    <?php if(get_post_meta(get_the_ID(), 'post_banner' , true) != ""): ?>
                    <img src="<?php echo get_post_meta(get_the_ID(), 'post_banner', true) ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
                    <?php else :  ?>
                    <img src="<?php bloginfo('stylesheet_directory'); ?>/images/banner_tuyendung.jpg" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
                    <?php endif; ?>
                </div>
                <div class="post-content" id="td-tab">
                    <ul class="post-td-tab">
                        <li>
                            <a data-i18n="recruitment.info" href="#td-overview">Thông tin tuyển dụng</a>
                        </li>
                        <li>
                            <a data-i18n="recruitment.sign" href="#td-reginfo">Đăng ký ứng tuyển</a>
                        </li>
                    </ul>
                    <div id="td-overview">
                        <?php the_content(); ?>
                    </div>
                    <div id="td-reginfo">
                        <?php echo get_post_meta(get_the_ID(), 'method_register', true) ?>
                        <?php
                        if (get_post_meta(get_the_ID(), 'post_td_example', true) != "") : ?>
                        <p class="td-examp"><span data-i18n="downloadText">Tải đơn đăng ký ứng tuyển mẫu:</span> <a data-i18n="link.download" class="btn-tuyendung" href="<?php echo get_post_meta(get_the_ID(), 'post_td_example', true) ?>">Tải về</a></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="tags">
                    <?php the_tags('<b>TAGS: </b>', ', ', ''); ?>
                </div>
                <?php show_share_socials(); ?>
            <?php endwhile; ?>
        </div>
        <div class="span4 sidebar">
            <?php get_sidebar('recruitment'); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>