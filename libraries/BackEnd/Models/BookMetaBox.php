<?php namespace Banhmi\BackEnd\Models;
/**
 * BookMetaBox
 */
final class BookMetaBox extends AbstractModel
{
  /**
   * Constructor
   */
  function __construct()
  {
    $id = isset($_GET['post']) ? absint($_GET['post']) : 0;

    $this->data = [
      'id'       => 'book-meta-book',
      'key'      => '_book_metadata',
      'title'    => __('Book Details', 'banhmi'),
      'screen'   => 'book',
      'context'  => 'normal',
      'priority' => 'high',
      'fields'   => [
        [
          'name'        => 'price',
          'label'       => __('Price', 'banhmi'),
          'description' => __('E.g. $7.5', 'banhmi')
        ],
        [
          'name'        => 'isbn',
          'label'       => __('ISBN', 'banhmi'),
          'description' => __('E.g. 978-1118442272', 'banhmi')
        ],
        [
          'name'        => 'bookEdition',
          'label'       => __('Edition', 'banhmi'),
          'description' => __('E.g. 2nd Edition', 'banhmi')
        ],
        [
          'name'        => 'bookFormat',
          'label'       => __('Format', 'banhmi'),
          'description' => __('E.g. Paperback', 'banhmi')
        ],
        [
          'name'        => 'numberOfPages',
          'label'       => __('Number of Pages', 'banhmi'),
          'description' => __('E.g. 456', 'banhmi')
        ]
      ],
      'values' => get_post_meta($id, '_book_metadata', true)
    ];
  }

  /**
   * Do sanitization
   *
   * @var  array  $meta  An array of raw meta values.
   *
   * @return  array  $meta  An array of sanitized meta values.
   */
  function sanitize($meta)
  {
    $meta['isbn'] = sanitize_text_field($meta['isbn']);
    $meta['price'] = sanitize_text_field($meta['price']);
    $meta['bookFormat'] = sanitize_text_field($meta['bookFormat']);
    $meta['bookEdition'] = sanitize_text_field($meta['bookEdition']);
    $meta['numberOfPages'] = absint($meta['numberOfPages']);

    return $meta;
  }

  /**
   * Save metadata
   *
   * @param  int  $book_id  ID of current book.
   */
  function save($book_id)
  {
    if ( defined('DOING_AJAX') && DOING_AJAX ) return;

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

    if ( !current_user_can('edit_post', $book_id) || wp_is_post_revision($book_id) ) return;

    $metadata = isset($_POST['_book_metadata']) ? $this->sanitize($_POST['_book_metadata']) : [];

    update_post_meta($book_id, '_book_metadata', $metadata, $this->data['values']);
  }
}
