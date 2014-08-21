<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php if(is_home()) bloginfo('name'); else wp_title(''); ?></title>

  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/idangerous.swiper.css" />
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/fonts.css" />
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/icons.css" />
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/style.css" />
  <link rel="stylesheet" media="only screen and (min-width: 1000px) and (max-width: 1336px)" href="<?php bloginfo('template_url'); ?>/css/style_1024.css" />
  <link rel="stylesheet" type="text/css" media="screen and (min-width: 580px) and (max-width: 1000px)" href="<?php bloginfo('template_url'); ?>/css/tablet.css" />
  <link rel="stylesheet" type="text/css" media="screen and (max-width: 580px)" href="<?php bloginfo('template_url'); ?>/css/mobile.css" />

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php
    wp_get_archives('type=monthly&format=link');
    wp_head();
  ?>
</head>

<body>
  <div class="overlay"></div>
  <header class="header-container">
    <div class="limiter">
      <a href="#" class="bt-menu">Menu</a>

      <h1 class="logo">
        <a href="index.php" title="Douat">Douat</a>
      </h1>

      <nav class="nav-header">
        <ul>
          <li class="node-1"><a href="sobre.php">A Douat</a></li>
          <li class="node-2 parent">
            <a href="malha.php">Malhas</a>
            <ul>
              <li><a href="malha.php">Fitness</a></li>
              <li><a href="malha.php">Lingerie</a></li>
              <li><a href="malha.php">Escolar</a></li>
              <li><a href="malha.php">Praia</a></li>
            </ul>
          </li>
          <li class="node-3"><a href="servicos.php">Serviços prestados</a></li>
          <li class="node-4"><a href="representantes.php">Representantes</a></li>
          <li class="node-5"><a href="trabalhe.php">Trabalhe Conosco</a></li>
          <li class="node-6"><a href="contato.php">Contato</a></li>
          <li class="node-7 parent">
            <a href="#">Mídias Sociais</a>
            <ul>
              <li><a href="#">Facebook</a></li>
              <li><a href="#">Instagram</a></li>
              <li><a href="#">Blog</a></li>
            </ul>
          </li>
        </ul>
        <span class="fake-nav node-1" data-node="1" data-url="sobre.php"></span>
        <span class="fake-nav node-2" data-node="2" data-url="#"></span>
        <span class="fake-nav node-3" data-node="3" data-url="servicos.php"></span>
        <span class="fake-nav node-4" data-node="4" data-url="representantes.php"></span>
        <span class="fake-nav node-5" data-node="5" data-url="trabalhe.php"></span>
        <span class="fake-nav node-6" data-node="6" data-url="contato.php"></span>
        <span class="fake-nav node-7" data-node="7" data-url="#"></span>
      </nav>

    </div>

  </header>
  <div class="limiter">
    <div class="topo-blog">
      <h2><a href="<?php bloginfo('url'); ?>"><span>Blog</span> Douat</a></h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
  </div>

