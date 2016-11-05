<?php namespace Banhmi\BackEnd\Controllers;
/**
 * SettingSection
 */
use Banhmi\Interfaces\iBox;

class SettingSection extends Setting implements iBox
{
  /**
   * Add setting section
   *
   * @see  https://developer.wordpress.org/reference/functions/add_settings_section/
   */
  function add()
  {
    add_settings_section(
      $this->model->id,
      $this->model->title,
      [$this, 'display'],
      $this->model->group
    );
  }

  /**
   * Remove setting section
   */
  function remove()
  {
    unset($GLOBALS['wp_settings_sections'][$this->model->group][$this->model->id]);
  }
}
