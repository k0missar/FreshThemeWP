<?php get_header(); ?>

    <div class="container">
        <main class="main">
            <div class="post">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <div class="post__item">
                        <?php the_post_thumbnail('freshtheme-post', array('class' => 'post__item-image'));?>
                        <h1 class="post__title">
                            <?php the_title(); ?>
                        </h1>
                        <div class="post__info">
                            <p><?php the_date('F Y'); ?> | <?php the_category(', ') ?></p>
                        </div>
                        <div class="post__text">
                            <?php the_content(); ?>
                        </div>
                        <div class="post__social-icon social__icon-list">
                            <div class="social__icon-item">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/svg/icons8-vkontakte.svg" alt="Вконтакте" width="20" height="20">
                            </div>
                            <div class="social__icon-item">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/svg/icons8-odnoklassniki.svg" alt="Одноклассники" width="20" height="20">
                            </div>
                            <div class="social__icon-item">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/svg/icons8-instagram.svg" alt="Инстаграмм" width="20" height="20">
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
            </div>
        </main>
        <?php get_sidebar(); ?>
    </div>

<?php get_footer(); ?>