<?php
/**
 * Hooks which will be fired on both back-end and front-end.
 *
 * @package  Banhmi
 */

// Disable XML-RPC service.
// add_filter('xmlrpc_enabled', '__return_false', PHP_INT_MAX);

// Remove X-Pingback header.
// add_filter('pings_open', '__return_false', PHP_INT_MAX);

// Register book custom post type.
$m = new Banhmi\BackEnd\Models\BookPostType;
$c = new Banhmi\BackEnd\Controllers\BookPostType($m);
add_filter('init', [$c, 'register'], 10, 0);
add_filter('post_updated_messages', [$c, 'notify']);

// Register book genre taxonomy.
$m = new Banhmi\BackEnd\Models\BookGenreTaxonomy;
$c = new Banhmi\BackEnd\Controllers\Taxonomy($m);
add_filter('init', [$c, 'register'], 10, 0);
