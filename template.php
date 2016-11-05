<?php
/**
 * Base template
 *
 * Depend on your site structure, create your own one for the best result.
 *
 * @see  Banhmi\FrontEnd\hooks.php
 *
 * @package  Banhmi\Templates
 */

// Locate head template.
$head = locate_template([
  'part-templates/head-' . $template,
  'part-templates/head.php'
]);

// Locate header template.
$header = locate_template([
  'part-templates/header-' . $template,
  'part-templates/header.php'
]);

// Locate main template.
$main = locate_template([
  'part-templates/main-' . $template,
  'page-templates/' . $template,
  $template
]);

// Locate footer template.
$footer = locate_template([
  'part-templates/footer-' . $template,
  'part-templates/footer.php'
]);

// Enqueue app script.
$this->services['js']->enqueue('app');

// Enqueue app stylesheet.
$this->services['css']->enqueue('app');

// Render document.
?><!DOCTYPE html>
<html lang="<?= $this->settings['language'] ?>">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <?php include $head; do_action('wp_head') ?>
</head>
<body class="site">
  <header class="site-header" itemscope itemtype="https://schema.org/WPHeader">
    <?php include $header ?>
  </header>
  <?php include $main // Maybe there're sidebars, pagination... ?>
  <footer class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
    <?php include $footer ?>
  </footer>
  <?php do_action('wp_footer') ?>
</body>
</html>
