<?php namespace Banhmi\Interfaces;
/**
 * iEntity
 */
interface iEntity extends iData, \SplSubject
{
  /**
   * Exist
   */
  function __isset($property);

  /**
   * Get
   */
  function __get($property);

  /**
   * Set
   */
  function __set($property, $value);

  /**
   * Unset
   */
  function __unset($property);
}
