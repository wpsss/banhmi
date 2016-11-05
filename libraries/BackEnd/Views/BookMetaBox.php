<?php namespace Banhmi\BackEnd\Views;
/**
 * BookMetaBox
 */
final class BookMetaBox extends AbstractView
{
	/**
	 * Render
	 */
	function render($meta)
  {
    ?><table style="width:100%;"><tbody><?php

      foreach ($meta->fields as $field) :

        $value = !empty($meta->values[$field['name']]) ? $meta->values[$field['name']] : '';

        echo sprintf(
          '<tr><td><label><strong>%s</strong><input class="widefat" type="text" name="%s" value="%s" placeholder="%s"></label></td></tr>',
          $field['label'],
          $meta->key . '[' . $field['name'] . ']',
          $value, $field['description']
        );

      endforeach;

    ?></tbody></table><?php
	}
}
