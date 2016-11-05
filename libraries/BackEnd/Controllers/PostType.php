<?php namespace Banhmi\BackEnd\Controllers;
/**
 * PostType
 */
use Banhmi\Interfaces\iContent;

class PostType extends AbstractController implements iContent
{
  /**
   * Register custom post type
   *
   * @see  https://developer.wordpress.org/reference/functions/register_post_type/
   */
  function register()
  {
    register_post_type(
      $this->model->type,
      $this->model->args
    );
  }

  /**
   * Unregister custom post type
   *
   * @see  https://developer.wordpress.org/reference/functions/unregister_post_type/
   */
  function unregister()
  {
    unregister_post_type($this->model->type);
  }
}
