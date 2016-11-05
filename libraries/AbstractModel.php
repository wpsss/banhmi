<?php namespace Banhmi;
/**
 * AbstractModel
 */
use Banhmi\Interfaces\iEntity;

abstract class AbstractModel implements iEntity
{
  /**
   * Entity's properties
   *
   * @var  array
   */
  protected $data = [];

  /**
   * Entity's observers
   *
   * @var  array
   */
  protected $observers = [];

  /**
   * Check if a property isset or not
   *
   * @return  bool
   */
  function __isset($name)
  {
    return isset($this->data[$name]);
  }

  /**
   * Get a property
   *
   * @return  mixed
   */
  function __get($name)
  {
    return isset($this->data[$name]) ? $this->data[$name]: null;
  }

  /**
   * Set a property
   */
  function __set($name, $value)
  {
    $this->data[$name] = $value;

    $this->notify();
  }

  /**
   * Unset a property
   */
  function __unset($name)
  {
    unset($this->data[$name]);

    $this->notify();
  }

  /**
   * Attach an observer
   */
  function attach(\SplObserver $observer)
  {
    $this->observers[] = $observer;
  }

  /**
   * Detach an observer
   */
  function detach(\SplObserver $observer)
  {
    $key = array_search($observer, $this->observers, true);

    if ($key !== false) unset($this->observers[$key]);
  }

  /**
   * Notify observers
   */
  function notify()
  {
    foreach ($this->observers as $observer) {
      $observer->update($this);
    }
  }

  /**
   * Sanitize entity's data
   */
  abstract public function sanitize($data);

  /**
   * Save entity's data
   */
  abstract public function save($data);
}
