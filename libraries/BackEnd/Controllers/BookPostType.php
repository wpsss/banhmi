<?php namespace Banhmi\BackEnd\Controllers;
/**
 * BookPostType
 */
final class BookPostType extends PostType
{
  /**
   * Do notification
   *
   * @see  https://developer.wordpress.org/reference/hooks/post_updated_messages/
   *
   * @param  array  $messages  All available messages.
   *
   * @return  array  $messages
   */
  function notify($messages)
  {
    $messages['book'] = [
      0  => '', // Unused. Messages start at index 1.
      1  => __('Book updated.', 'banhmi'),
      2  => __('Custom field updated.', 'banhmi'),
      3  => __('Custom field deleted.', 'banhmi'),
      4  => __('Book updated.', 'banhmi'),
      5  => isset($_GET['revision']) ? __('Book restored to revision from', 'banhmi') . ' ' . wp_post_revision_title( absint($_GET['revision']) ) : false,
      6  => __('Book published.', 'banhmi'),
      7  => __('Book saved.', 'banhmi'),
      8  => __('Book submitted.', 'banhmi'),
      9  => __('Book scheduled.', 'banhmi'),
      10 => __('Book draft updated.', 'banhmi')
    ];

    return $messages;
  }
}
