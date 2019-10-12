<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="Roark">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php wp_head(); ?>
    </head>
    <body class="<?php echo implode(' ', get_body_class()); ?>">
        <?php if( function_exists( 'wp_body_open' ) ) wp_body_open(); ?>
        <header>
            <nav>
                <div class="text-logo">
                    <a href="<?php echo esc_url( get_home_url() ); ?>"> <div>
                            <?php bloginfo( 'name' ); ?>
                        </div> </a>
                </div>
                <?php wp_nav_menu( array(
                        'menu' => 'main',
                        'menu_class' => 'menu',
                        'menu_id' => 'menu-menu',
                        'container' => 'ul'
                ) ); ?>
            </nav>
        </header>
        <main id="content">