<?php namespace Banhmi\BackEnd\Models;
/**
 * BookGenreTaxonomy
 */
final class BookGenreTaxonomy extends AbstractModel
{
  /**
   * Constructor
   */
  function __construct()
  {
  	$labels = [
  		'name'          => _x('Book Genre', 'Taxonomy General Name', 'banhmi'),
  		'singular_name' => _x('Book Genre', 'Taxonomy Singular Name', 'banhmi'),
  		'all_items'     => __('All Book Genre', 'banhmi'),
  		'new_item_name' => __('New Book Genre Name', 'banhmi'),
  		'add_new_item'  => __('Add New Book Genre', 'banhmi'),
  		'edit_item'     => __('Edit Book Genre', 'banhmi'),
  		'update_item'   => __('Update Book Genre', 'banhmi'),
  		'view_item'     => __('View Book Genre', 'banhmi'),
  		'popular_items' => __('Popular Book Genre', 'banhmi'),
  		'search_items'  => __('Search Book Genre', 'banhmi')
  	];

  	$args = [
  		'labels'            => $labels,
  		'public'            => true,
      'hierarchical'      => true,
  		'show_in_nav_menus' => false,
  		'rewrite'           => ['slug' => 'book-genre', 'with_front' => true, 'hierarchical' => true],
      'show_in_rest'      => true
  	];

    $this->data = [
      'type'     => 'book',
      'args'     => $args,
      'taxonomy' => 'book_genre'
    ];
  }

  /**
   * Sanitize
   */
  function sanitize($genre)
  {

  }

  /**
   * Save
   */
  function save($genre)
  {

  }
}
