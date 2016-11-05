<?php namespace Banhmi\BackEnd\Controllers;
/**
 * Taxonomy
 */
use Banhmi\Interfaces\iContent;

class Taxonomy extends AbstractController implements iContent
{
  /**
   * Register taxonomy
   *
   * @see  https://developer.wordpress.org/reference/functions/register_taxonomy/
   */
  function register()
  {
    register_taxonomy(
      $this->model->taxonomy,
      $this->model->type,
      $this->model->args
    );
  }

  /**
   * Unregister taxonomy
   *
   * @see  https://developer.wordpress.org/reference/functions/unregister_taxonomy/
   */
  function unregister()
  {
    unregister_taxonomy($this->model->taxonony);
  }
}
