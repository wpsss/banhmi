<?php namespace Banhmi\BackEnd\Controllers;
/**
 * SettingField
 */
use Banhmi\Interfaces\iBox;

class SettingField extends Setting implements iBox
{
  /**
   * Add a setting field
   *
   * @see  https://developer.wordpress.org/reference/functions/add_settings_field/
   */
  function add()
  {
    add_settings_field(
      $this->model->id,
      $this->model->title,
      [$this, 'display'],
      $this->model->group,
      $this->model->section,
      $this->model->args
    );
  }

  /**
   * Remove a setting field
   */
  function remove()
  {
    unset($GLOBALS['wp_settings_fields'][$this->model->group][$this->model->section][$this->model->id]);
  }
}
