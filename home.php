<?php
/**
 * Default Home Page.
 *
 * @package  Banhmi\Templates
 */

// Site main.
?><main class="site-main" itemscope itemtype="https://schema.org/mainContentOfPage"><?php
  if ( !empty($query->posts) ) {
    $view = $this->services['view']->create('ArchivePost');
    foreach ($query->posts as $post) {
      $view->render($post);
    }
  } else {
    _e('No posts found.', 'banhmi');
  }
?></main><?php

// Pagination.
$this->services['view']->create('Pagination')->render($query);
