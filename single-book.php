<?php
/**
 * Single Book Page.
 *
 * @package  Banhmi\Templates
 */

// Breadcrumb.
$this->services['view']->create('Breadcrumb')->render($query);

// Site main.
?><main class="site-main" itemscope itemtype="https://schema.org/mainContentOfPage"><?php
  $this->services['view']->create('SingleBook')->render($query->posts[0]);
?></main><?php
// End site main.
