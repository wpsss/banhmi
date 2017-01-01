<?php namespace Banhmi\BackEnd\Controllers;
/**
 * SubMenuPage
 */
use Banhmi\Interfaces\iBox;

class SubMenuPage extends Setting implements iBox
{
    /**
     * Add submenu page
     *
     * @see  https://developer.wordpress.org/reference/functions/add_submenu_page/
     */
    function add()
    {
        $this->hook_suffix = add_submenu_page(
            $this->model->parent,
            $this->model->title,
            $this->model->title,
            $this->model->capability,
            $this->model->slug,
            [$this, 'display']
        );
    }

    /**
     * Remove submenu page
     *
     * @see  https://developer.wordpress.org/reference/functions/remove_submenu_page/
     */
    function remove()
    {
        remove_submenu_page(
            $this->model->parent,
            $this->model->slug
        );
    }
}
