<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="YNO Designs">

    <title><?php echo esc_html( get_bloginfo( 'name' ) ); ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
    
    <!-- Bootstrap core CSS -->
    <link href="<?php echo get_stylesheet_directory_uri().'/css/bootstrap.min.css'; ?>" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="<?php echo get_stylesheet_directory_uri().'/css/fonts/Roboto.css'; ?>" rel="stylesheet">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
<header id="header" role="banner">
<section id="branding">
<div id="site-title" class="text-center"><?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '<h1>'; } ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><img src="/wp-content/themes/receifly/img/Receipt-Fly-Logo-512.jpg" class="logo text-center"/><span class="visually-hidden"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span></a><?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '</h1>'; } ?></div>
<div id="site-description" class="text-center"><?php bloginfo( 'description' ); ?></div>
</section>
<nav id="menu" role="navigation">
<div id="search">
<?php //get_search_form(); ?>
</div>
<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
</nav>
</header>
<div id="container">