<?php namespace Banhmi;
/**
 * AbstractView
 */
use Banhmi\Interfaces\iBrowser;

abstract class AbstractView implements iBrowser
{
  /**
   * Banhmi container
   *
   * A service provider which provides settings and registered services.
   *
   * @var  object
   */
  protected $theme;

  /**
   * Constructor
   */
  function __construct(\Banhmi $theme)
  {
    $this->theme = $theme;
  }
    
  /**
   * Update
   */
  function update(\SplSubject $model)
  {
    $this->render($model);
  }
}
