<?php get_header(); ?>

    <div class="container">
        <main class="main">
            <div class="content">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <div class="content__item">
                        <?php the_post_thumbnail('freshtheme-post', array('class' => 'content__item-image'));?>
                        <div class="content__date">
                            <p><?php the_date('F Y'); ?></p>
                        </div>
                        <h2 class="content__title">
                            <a class="content__title-link" href="<?php the_permalink() ?>" title="Ссылка на: <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="content__category">
                            <p><?php the_category(', ') ?></p>
                        </div>
                        <div class="content__text">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="content__social-icon social__icon-list">
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