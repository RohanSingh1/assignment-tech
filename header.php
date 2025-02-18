<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <div class="logo">
                <a href="<?php echo home_url(); ?>">
                    <?php if ( has_custom_logo() ) {
                        the_custom_logo();
                    } else { ?>
                        <span>Logo</span>
                    <?php } ?>
                </a>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <svg width="89" height="72" viewBox="0 0 134 107" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="49" y="49" width="56" height="6" fill="black"/>
                    <rect x="49" y="66" width="56" height="6" fill="black"/>
                    <rect x="49" y="32" width="56" height="6" fill="black"/>
                </svg>
            </button>

            <nav class="main-menu">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'menu_id'        => 'primary-menu'
                ) );
                ?>
            </nav>
        </div>
    </div>
</header>

<?php wp_footer(); ?>

</body>
</html>

