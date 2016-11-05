<?php namespace Banhmi\Interfaces;
/**
 * iBrowser
 */
interface iBrowser extends \SplObserver
{
  /**
   * Render data
   *
   * @param  mixed  $data
   */
  function render($data);
}
