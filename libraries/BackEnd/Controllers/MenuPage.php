<?php namespace Banhmi\BackEnd\Controllers;
/**
 * MenuPage
 */
use Banhmi\Interfaces\iBox;

class MenuPage extends Setting implements iBox
{
    /**
     * Add
     *
     * @internal  Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     *
     * @see  https://developer.wordpress.org/reference/functions/add_menu_page/
     */
    function add()
    {
        $this->hook_suffix = add_menu_page(
            $this->model->title,
            $this->model->title,
            $this->model->capability,
            $this->model->slug,
            [$this, 'display'],
            $this->model->icon,
            $this->model->position
        );
    }

    /**
     * Remove
     *
     * @internal  Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!     
     *
     * @see  https://developer.wordpress.org/reference/functions/remove_menu_page/
     */
    function remove()
    {
        remove_menu_page($this->model->slug);
    }
}
