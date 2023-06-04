<!DOCTYPE html>
<html lang="ru" class="page-html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
    <title><?php bloginfo('name') ?></title>
    <?php wp_head() ?>
</head>
<body class="page-body">
    <header class="header">
        <div class="header__logo">
            <p class="header__logo-name"><?php bloginfo('name') ?></p>
        </div>
        <nav class="header__nav nav">
            <div class="nav__btn"></div>
            <?php wp_nav_menu([
                'theme_location' => 'primary_menu',
                'container' => 'ul',
                'menu_class' => 'nav__list',
            ]); ?>
        </nav>
    </header>