<?php
/**
 * Master template
 *
 * Depend on your site structure, create your own one for the best result.
 *
 * @package  Banhmi\Templates
 */
?><!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <?php require $site_head; do_action('wp_head') ?>
</head>
<body class="site">
    <header class="site-header" itemscope itemtype="https://schema.org/WPHeader">
        <?php require $site_header ?>
    </header>
    <?php require $site_main // Maybe there're sidebars, pagination... ?>
    <footer class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
        <?php require $site_footer ?>
    </footer>
    <?php do_action('wp_footer') ?>
</body>
</html>
