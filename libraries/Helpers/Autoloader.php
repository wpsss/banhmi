<?php namespace Banhmi\Helpers;
/**
 * Autoloader
 *
 * !NOTICE: Only works with PSR-4 and unqualified classes.
 */
class Autoloader
{
  /**
   * Instance
   *
   * @var  object
   */
  private static $instance;

  /**
   * Registered namspaces|classes collection
   *
   * @var  array
   */
  private $classes = [];

  /**
   * Singleton
   */
  static function getInstance()
  {
    if ( !isset(self::$instance) )
      self::$instance = new self;

    return self::$instance;
  }

  /**
   * Register namespaces|classes
   */
  function register(array $classes)
  {
    $this->map($classes);

    spl_autoload_register([$this, 'load']);
  }

  /**
   * Map namespaces|classes to the registered collection
   */
  private function map(array $classes)
  {
    $max = count($classes);

    for ($i = 0; $i < $max; $i++) {
      if ( !empty($classes[$i][2]) ) {
        $prepend_array = [$classes[$i][0] => $classes[$i][1]];
        $this->classes = $prepend_array + $this->classes;
      } else {
        $append_array  = [$classes[$i][0] => $classes[$i][1]];
        $this->classes = $this->classes + $append_array;
      }
    }
  }

  /**
   * Load file for the given class name
   */
  private function load($class)
  {
    $pos = strpos($class, '\\');
    $ns  = substr($class, 0, $pos) ? : false; // Extract namespace.

    if ( $ns && isset($this->classes[$ns]) ) { // PSR-4 class.
      $file = str_replace(['\\', $ns], ['/', $this->classes[$ns]], $class) . '.php';
    } elseif ( isset($this->classes[$class]) && $this->classes[$class] ) { // Unqualified class.
      $file = $this->classes[$class] . '/' . $class . '.php';
    } else { // Global class.
      return;
    }

    require $file; // Intend to throw error if the file does not exist.
  }

  /**
   * No construction
   */
  private function __construct()
  {

  }

  /**
   * Nope clone
   */
  private function __clone()
  {

  }

  /**
   * No wake-up
   */
  private function __wakeup()
  {

  }
}
