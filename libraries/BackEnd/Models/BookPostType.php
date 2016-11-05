<?php namespace Banhmi\BackEnd\Models;
/**
 * BookPostType
 */
final class BookPostType extends AbstractModel
{
  /**
   * Constructor
   */
  function __construct()
  {
  	$labels = [
  		'name'                  => _x('Books', 'Post Type General Name', 'banhmi'),
  		'singular_name'         => _x('Book', 'Post Type Singular Name', 'banhmi'),
  		'archives'              => __('Book Archives', 'banhmi'),
  		'all_items'             => __('All Books', 'banhmi'),
  		'add_new_item'          => __('Add New Book', 'banhmi'),
  		'new_item'              => __('New Book', 'banhmi'),
  		'edit_item'             => __('Edit Book', 'banhmi'),
  		'update_item'           => __('Update Book', 'banhmi'),
  		'view_item'             => __('View Book', 'banhmi'),
  		'search_items'          => __('Search Book', 'banhmi'),
  		'featured_image'        => __('Book cover', 'banhmi'),
  		'set_featured_image'    => __('Set book cover', 'banhmi'),
  		'remove_featured_image' => __('Remove book cover', 'banhmi'),
  		'use_featured_image'    => __('Use as book cover', 'banhmi'),
  		'insert_into_item'      => __('Insert into book', 'banhmi'),
  		'uploaded_to_this_item' => __('Uploaded to this book', 'banhmi')
  	];

  	$args = [
  		'label'             => __('Book', 'banhmi'),
  		'description'       => __('Book is love, book is life.', 'banhmi'),
  		'labels'            => $labels,
  		'supports'          => ['title', 'editor', 'excerpt', 'thumbnail', 'comments'],
  		'taxonomies'        => ['book_genre'],
  		'public'            => true,
      'has_archive'       => true,
  		'menu_position'     => 5,
  		'menu_icon'         => 'dashicons-book-alt',
  		'show_in_nav_menus' => false,
      'show_in_rest'      => true
  	];

    $this->data = [
      'type' => 'book',
      'args' => $args
    ];
  }

  /**
   * Sanitize
   */
  function sanitize($book)
  {

  }

  /**
   * Save
   */
  function save($book)
  {

  }
}
