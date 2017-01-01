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
                $key = $field['name'];
                $value = !empty($meta->values[$key]) ? $meta->values[$key] : '';
                echo sprintf(
                    '<tr><td><label><strong>%s</strong><input class="widefat" type="text" name="%s" value="%s" placeholder="%s"></label></td></tr>',
                    $field['label'],
                    $meta->key . '[' . $key . ']',
                    $value, $field['description']
                );
            endforeach;
        ?></tbody></table><?php
	}
}
