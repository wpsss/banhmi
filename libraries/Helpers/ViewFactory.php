<?php namespace Banhmi\Helpers;
/**
 * ViewFactory
 *
 * A simple view factory.
 */
final class ViewFactory
{
  /**
   * Banhmi
   *
   * A service provider which provides settings and registered services.
   *
   * @var  object
   */
  private $theme;

  /**
   * Created views
   *
   * @var  array
   */
  private $views;

  /**
   * Namespace
   *
   * @var  string
   */
  private $namespace;

  /**
   * Constructor
   */
  function __construct(\Banhmi $theme, array $views = [])
  {
    $this->theme = $theme;
    $this->views = $views;
    $this->namespace = is_admin() ? 'Banhmi\\BackEnd\\Views\\' : 'Banhmi\\FrontEnd\\Views\\';
  }

  /**
   * Create view
   *
   * @param  string  $name  Class name without namespace.
   */
  function create($name)
  {
    $class = $this->namespace . $name;

    if ( isset($this->views[$class]) )
      return $this->views[$class];

    if ( !class_exists($class) ) {
      throw new \InvalidArgumentException( sprintf( __('Class "%s" not found.', 'banhmi'), $class ) );
    } else {
      $view = new $class($this->theme);
      $this->views[$class] = $view;
      return $view;
    }
  }
}
